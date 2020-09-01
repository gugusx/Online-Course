<?php

namespace App\Http\Controllers;

use Alert;
use App\role_user;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Image;
use Redirect;

class usercontroller extends Controller {

    protected $rules = [

        'email'    => ['required', 'min:5'],
        'password' => ['required'],
        'name'     => ['required'],

    ];

    protected $aturan = [

        'email'    => ['required', 'min:5'],

        'password' => ['required'],
    ];

    public function index() {
        $user      = User::orderBY('id', 'desc')->paginate(10);
        $role_user = role_user::all();
        return view('dashboard.admin.index', compact('user', 'role_user'));
    }

    public function create() {
        return view('dashboard.admin.create');
    }

    public function search(request $request) {
        $cari      = $request->get('search');
        $role_user = role_user::all();
        $user      = user::where('name', 'LIKE', '%' . $cari . '%')
                            ->orWhere('email', 'LIKE', '%' . $cari . '%')
                            ->orWhere('no_hp', 'LIKE', '%' . $cari . '%')
                            ->orWhere('created_at', 'LIKE', '%' . $cari . '%')->get();

        return view('dashboard.admin.search', compact('user', 'role_user'));
    }

    public function store(Request $request) {
        alert()->success('Success', 'Add Data')->autoclose(2000);

        $this->validate($request, $this->rules);
        $input = Input::all();
        $file  = ['gambar' => Input::file('gambar')];
        if (Input::file('gambar')->isValid()) {
            $destinationPath = 'uploads';
            $extension       = Input::file('gambar')->getClientOriginalExtension();
            $filename        = rand(11111, 99999) . '.' . $extension;
            Input::file('gambar')->move($destinationPath, $filename);

            $img = Image::make($destinationPath . '/' . $filename);
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();

            $input['gambar'] = $destinationPath . '/' . $filename;

            $password          = Input::get('password');
            $hashed            = Hash::make($password);
            $input['password'] = $hashed;
            User::create($input);

            $userx       = User::orderBy('created_at', 'desc')->first();
            $co          = new role_user;
            $co->user_id = $userx->id;
            $co->role_id = 10;

            $co->save();

            return Redirect('admin/admin');
        }
    }

    public function destroy($id) {
        alert()->success('Success', 'Deleted Data')->autoclose(2000);
        $user = User::find($id);

        $user->delete();

        return Redirect('admin/admin');
    }

    public function edit($id) {
        $user = User::find($id);

        return view('dashboard.admin.edit', compact('user'));
    }

    public function update($id, request $request) {
        alert()->success('Success', 'Updating Data')->autoclose(2000);

        $user = User::find($id);

        $count = User::where('email', '=', $request->email)->where('id', '=', $id)->count();

        if ($count < 1) {
            $input = array_except(Input::all(), '_method');
            $this->validate($request, $this->rules);
            if (Input::hasFile('gambar')) {
                $file = ['gambar' => Input::file('gambar')];
                if (Input::file('gambar')->isValid()) {
                    $destinationPath = 'uploads/'; // upload path
                    $extension       = Input::file('gambar')->getClientOriginalExtension(); // getting image extension
                    $fileName        = rand(11111, 99999) . '.' . $extension; // renaming image
                    Input::file('gambar')->move($destinationPath, $fileName); // uploading file to given path

                    $img = Image::make($destinationPath . '/' . $filename);
                    $img->resize(600, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->save();

                    $input['gambar']   = $destinationPath . $fileName;
                    $password          = input::get('password');
                    $hashed            = Hash::make($password);
                    $input['password'] = $hashed;
                    $user->update($input);
                    return Redirect('admin/admin');
                }
            } else {
                $user              = User::find($id);
                $input             = array_except(Input::all(), '_method');
                $password          = input::get('password');
                $hashed            = Hash::make($password);
                $input['password'] = $hashed;
                $user->update($input);

                return Redirect('admin/admin');
            }
        } else {

            $input = array_except(Input::all(), '_method');
            $this->validate($request, $this->aturan);
            if (Input::hasFile('gambar')) {
                $file = ['gambar' => Input::file('gambar')];
                if (Input::file('gambar')->isValid()) {
                    $destinationPath = 'uploads/'; // upload path
                    $extension       = Input::file('gambar')->getClientOriginalExtension(); // getting image extension
                    $fileName        = rand(11111, 99999) . '.' . $extension; // renaming image
                    Input::file('gambar')->move($destinationPath, $fileName); // uploading file to given path

                    $img = Image::make($destinationPath . '/' . $fileName);
                    $img->resize(600, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->save();

                    $input['gambar']   = $destinationPath . $fileName;
                    $password          = input::get('password');
                    $hashed            = Hash::make($password);
                    $input['password'] = $hashed;
                    $user->update($input);
                    return Redirect('admin/admin');
                }
            } else {
                $user              = User::find($id);
                $input             = array_except(Input::all(), '_method');
                $password          = input::get('password');
                $hashed            = Hash::make($password);
                $input['password'] = $hashed;
                $user->update($input);

                return Redirect('admin/admin');
            }
        }
    }
}
