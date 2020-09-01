<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Alert;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected function login(Request $request) {   
        $input = $request->all();
  
        $this->validate($request, [
            'email'     => 'required',
            'password'  => 'required',
        ]);
  
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'no_hp';
        auth()->attempt(
            [
                $fieldType => $input['email'], 
                'password' => $input['password']
            ]
        );

        if(auth()->user() == null) {
            return redirect('/login')->with(['danger' => 'Data yang anda masukan salah']);
        } else {

            if (auth()->user()->level == 'Premium' && auth()->user()->tgl_expired < date('Y-m-d')) {
                User::where('id', Auth::user()->id)->update(['level' => 'Free', 'jenis' => null, 'tgl_expired' => null]);
            }

            // echo $video->role_id;
            // exit;

            if (auth()->user()->role_id == '10') {
                return redirect('/admin');
            } else {
                Alert::success('Berhasil Login', 'Success')->autoclose(2500);
                return redirect('/home');
            }
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
