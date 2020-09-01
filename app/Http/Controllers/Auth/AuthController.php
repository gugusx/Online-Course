<?php

namespace App\Http\Controllers\Auth;

use Alert;
use App\User;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Laravel\Socialite\Facades\Socialite;
use App\role_user;
use Socialite;

class AuthController extends Controller
{

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);

        $cek = User::find(Auth::user()->id)->count();
        if($cek > 0) {

            if (auth()->user()->level == 'Premium' && auth()->user()->tgl_expired < date('Y-m-d')) {
                User::where('id', Auth::user()->id)->update(['level' => 'Free', 'jenis' => null, 'tgl_expired' => null]);
            }

            Alert::success('Berhasil Login', 'Success')->autoclose(2500);
            return redirect('/home');

        } else {
            Alert::success('Berhasil Login', 'Success')->autoclose(2500);
            return redirect('/');
        }
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $cek = User::where('email', $user->email);
        if($cek->count() > 0) {
            User::find($cek->first()->id)->update([
                'provider'      => $provider,
                'provider_id'   => $user->id,
            ]);

            return $cek->first();
        } else {

            $authUser = User::where('provider_id', $user->id)->first();
            if ($authUser) {
                return $authUser;
            }
            else {
                $data = User::create([
                    'name'          => $user->name,
                    'email'         => !empty($user->email)? $user->email : '' ,
                    'provider'      => $provider,
                    'provider_id'   => $user->id,
                    'gambar'        => 'uploads/avatar.jpeg',
                    'role_id'       => '11'
                ]);

                $userx = User::orderBy('id', 'desc')->first();

                $role          = new role_user;
                $role->user_id = $userx->id;
                $role->role_id = 11;
                $role->save();

                return $data;

            }
        }

    }
}