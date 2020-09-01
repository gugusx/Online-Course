<?php

namespace App\Http\Controllers;

use App\help;
use App\kategorivideo;
use App\kategorimod;
use App\modul;
use App\mapel;
use App\read;
use App\role_user;
use App\User;
use App\voucher;
use App\video;
use App\sfk;
use App\cart;
use App\webinar;
use App\trainers;
use Illuminate\Support\Facades\Auth;
use Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Image;
use RealRashid\SweetAlert\Facades\Alert;

class blogcontroller extends Controller {
    protected $rules = [
        'email'    => ['required', 'min:5', 'unique:users'],
        'password' => ['required', 'min:6'],
        'name'     => ['required'],
        'no_hp'    => ['required', 'unique:users'],

    ];

    protected $imgrules = [
        'gambar' => 'image|mimes:jpg,png,jpeg'
    ];

    protected $aturan = [

        'email'    => ['required', 'min:5'],

        'password' => ['required'],
    ];

    // New Design

    public function home() {

        $var['moduls'] = modul::count();
        $var['videos'] = video::count();

        $var['mapel']  = mapel::limit(7)->get();
        $var['pageLink'] = 'home';

        // Modul
       $var['mini'] = modul::where('status', 'Y')
                    ->where('sertifikat', 0)
                    ->where('status', 'Y')
                    ->inRandomOrder()
                    ->limit(3)->get();

        $var['cer'] = modul::where('status', 'Y')
                    ->where('sertifikat', 1)
                    ->where('status', 'Y')
                    ->inRandomOrder()
                    ->limit(3)->get();
        
        $var['sfk'] = DB::table('sfk_video')
                      ->join('users', 'sfk_video.user_id', '=', 'users.id')
                      ->select('sfk_video.*', 'users.name', 'users.gambar')
                      ->orderBY('sfk_video.created_at', 'desc')
                      ->where('sfk_video.approval', 1)
                      ->limit(4)->get();

        return view('user.index', $var);
    }

    public function company()
    {
        $var['pageLink'] = 'about';
        return view('user.companyprofile', $var);
    }

    public function ttc() {
        $var['pageLink'] = 'ttc';
        return view('user.ttc', $var);
    }

    public function try() {
        $var['pageLink'] = 'course';

        $var['bw'] = modul::where('status', 'Y')
                    ->where('sertifikat', 0)
                    ->orderBY('count', 'desc')->first();

        $var['mini'] = modul::where('status', 'Y')
                    ->where('sertifikat', 0)
                    ->where('id', '!=', $var['bw']->id)
                    ->where('status', 'Y')
                    ->inRandomOrder()
                    ->limit(3)->get();

        $var['bw2'] = modul::where('status', 'Y')
                    ->where('sertifikat', 1)
                    ->orderBY('count', 'desc')->first();

        $var['cer'] = modul::where('status', 'Y')
                    ->where('sertifikat', 1)
                    ->where('id', '!=', $var['bw2']->id)
                    ->where('status', 'Y')
                    ->inRandomOrder()
                    ->limit(3)->get();

        return view('user.course', $var);
    }

    public function detail(modul $modul) {

        if (!Auth::guest()) {
            $cread         = read::where('user_id', Auth::user()->id)->get();
            $var['cekmod'] = cart::where('modul_id', $modul->id)->where('user_id', Auth::user()->id)->where('stcart', 1)->count();
            $var['cekmo'] = cart::where('modul_id', $modul->id)->where('user_id', Auth::user()->id)->where('stcart', 1);
        } else {
            $cread = '';
            $var['cekmod'] = 0;
        }

        $pageLink = 'course';

        $modul->count = $modul->count + 1;
        $modul->save();
        $kategorivideo = kategorivideo::where('modul_id', $modul->id)->get();
        $video         = video::orderBY('list', 'asc')->get();
        $videoc        = video::join('Kategorivideo', 'Kategorivideo_id', '=', 'Kategorivideo.id')
                        ->where('Kategorivideo.modul_id', $modul->id)
                        ->count();

        $var['vtime']  = video::join('Kategorivideo', 'Kategorivideo_id', '=', 'Kategorivideo.id')
                        ->where('Kategorivideo.modul_id', $modul->id)
                        ->select(DB::raw('SUM(TIME_TO_SEC(durasi)) as durasi'))
                        ->first();

        $ktg           = kategorivideo::where('modul_id', $modul->id)->count();
        $trainers      = trainers::find($modul->trainer_id);


        return view('user.detailvideo',$var, compact('kategorivideo', 'modul', 'video', 'videoc', 'ktg', 'cread', 'pageLink', 'trainers'));
    }

    public function profiletrainer(modul $modul){

        $pageLink = 'course';
        $trainers = trainers::find($modul->trainer_id);

      
        return view('user.profiletrainer', compact('pageLink','modul','trainers'));
    }

    public function videodetail($video, $modul_id) {

        $videoc = video::where('list', $video)->get();
        $pageLink = 'course';

        $modul2 = modul::join('users', 'trainer_id', '=', 'users.id')
                ->select('modul.*', 'users.name', 'users.profesi')
                ->where('modul.status', 'Y')
                ->where('sertifikat', 1)
                ->limit(20)
                ->get();

        if ($videoc->count() === 0) {
            return Redirect::back();
        } else {
            $videox = video::where('list', $video)->first();
            if($videox->stat != 'Free') {
                if(Auth::guest()) {
                    return redirect('/login');
                }
            }

            if(!Auth::guest()) {
                $cek_sale   = cart::where('user_id', Auth::user()->id)->where('modul_id', $modul_id)->where('stcart', 1)->count();
            } else {
                $cek_sale   = '';
            }

            if(!Auth::guest() && $cek_sale > 0) {
                $cread      = read::where('user_id', Auth::user()->id)->where('video_id', $videox->id)->count();
                if ($cread < 1) {
                    $read           = new read;
                    $read->user_id  = Auth::user()->id;
                    $read->video_id = $videox->id;
                    $read->save();
                }
                unset($cread);
                $cread     = read::where('user_id', Auth::user()->id)->get();
            } else {
                $cread = '';
            }

            $kategorivideo = kategorivideo::where('id', $videox->kategorivideo_id)->get()->first();
            $kategorivideo2 = kategorivideo::where('modul_id', $modul_id)->get();

            $currentModul  = modul::select('judul')->where('id', $kategorivideo->modul_id)->get()->first()->judul;
            // $videos        = video::orderBY('list', 'asc')->where('kategorivideo_id', $kategorivideo->id)->get();
            $videos         = video::orderBY('list', 'asc')->get();
            $modul         = modul::where('status', 'Y')->where('id', '<>', $kategorivideo->modul_id)->limit(2)->inRandomOrder()->get();

            $previous = video::where('list', '<', $videox->list)->max('list');
            // get next user id
            $next = video::where('list', '>', $videox->list)->min('list');

            $videop = video::where('list', $previous)->first();
            $videon = video::where('list', $next)->first();

            $var['cekmod'] = modul::find($modul_id);
            $var['nav']    = 'vidshow'; 
            return view('user.videoshow', $var, compact('kategorivideo', 'kategorivideo2', 'modul', 'video', 'videox', 'videop', 'videon', 'videos', 'cread', 'currentModul', 'modul2', 'modul_id', 'pageLink', 'cek_sale'))->with('previous', $previous)->with('next', $next);
        }
    }

    public function profile() {
        $var['pageLink'] = '';
        $var['user'] = User::find(Auth::user()->id);
        $var['sfk']  = sfk::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('user.profile', $var);
    }

    public function add_sfk(Request $var) {
        $input = input::all();
        sfk::create($input);
        return Redirect::back()->with(['sfk' => 'Berhasil Menambahkan Video']);
    }

    public function edit_sfk(Request $var, $id) {
        $sfk        = sfk::find($id);
        $sfk->judul = $var->judul;
        $sfk->embed = $var->embed;

        $sfk->save();
        return Redirect::back()->with(['sfk' => 'Berhasil Mengedit Video']);
    }

    public function delete_sfk(Request $var) {
        $sfk  = sfk::find($var->id);
        $sfk->delete();
    }

    public function help() {
        $var['pageLink'] = 'help';
        $var['help'] = help::orderBY('id', 'desc')->first();
        return view('user.help', $var);
    }

    public function sharing() {
        $var['pageLink'] = 'sharing';
        $var['sfk'] = DB::table('sfk_video')
                      ->join('users', 'sfk_video.user_id', '=', 'users.id')
                      ->select('sfk_video.*', 'users.name', 'users.gambar')
                      ->where('sfk_video.approval', 1)
                      ->inRandomOrder()->paginate(12);
        return view('user.sharing', $var);
    }
    
    public function detailsharing($id) {
        $var['pageLink'] = 'sharing';
        $var['sfk_v'] = DB::table('sfk_video')
                      ->join('users', 'sfk_video.user_id', '=', 'users.id')
                      ->select('sfk_video.*', 'users.name', 'users.gambar')
                      ->where('sfk_video.approval', 1)
                      ->where('sfk_video.id', $id)
                      ->get();

        $var['sfk'] = DB::table('sfk_video')
                      ->join('users', 'sfk_video.user_id', '=', 'users.id')
                      ->select('sfk_video.*', 'users.name', 'users.gambar')
                      ->where('sfk_video.id', '!=', $id)
                      ->where('sfk_video.approval', 1)
                      // ->orderBY('sfk_video.user_id', '=', $var['sfk_v']->first()->user_id, 'desc')
                      ->inRandomOrder()
                      ->limit(8)->get();

        $var['idsfk'] = $id;

        return view('user.detailsharing', $var);
    }

    public function regis() {
        return view('auth.register');
    }
    
    public function upgrade() {
        return view('user.upgrade');
    }

    public function editakun_b(request $req) {
        $id     = $req->id;
        $lama   = $req->lama;
        $baru   = $req->baru;
        $pass   = $req->pass;
        $hash   = Hash::make($lama);
        $cek = User::where('password', $hash)->count();
        if($cek > 0) {
            if($baru != $pass) {
                echo "1";
            } else {
                User::where('id', $id)->update([
                    'password' => Hash::make($pass),
                ]);
                echo "2";
            }
        } else {
            echo "0";
        }
    }

    public function editakun(request $req) {
        $id         = $req->id;
        $password   = $req->password;

        if($password == '') {
            $pass = $user->password;
        } else {
            $pass = Hash::make($password);
        }

        User::where('id', $id)->update([
            'password' => $pass,
        ]);

    }

    public function cek_email(Request $req) {
        $cek = User::where('email', $req->val)->count();
        echo $cek;
    }
    
    public function cari_data(Request $var, $page) {
        if($page == 'sharing') {
            $var['pageLink'] = 'sharing';
            $var['sfk'] = DB::table('sfk_video')
                      ->join('users', 'sfk_video.user_id', '=', 'users.id')
                      ->select('sfk_video.*', 'users.name', 'users.gambar')
                      ->where('sfk_video.approval', 1)
                      ->where('sfk_video.judul', 'like', '%'.$var->cari.'%')
                      ->orWhere('users.name', 'like', '%'.$var->cari.'%')
                      ->paginate();
            return view('user.sharing', $var);
        } else {
            $var['pageLink'] = '';
            $var['modul'] = modul::join('users', 'trainer_id', '=', 'users.id')
                        ->join('kategori_modul', 'kategori_modul', '=', 'kategori_modul.id', 'LEFT')
                        ->join('jenis', 'jenis_id', '=', 'jenis.id', 'LEFT')
                        ->join('jenjang', 'jenjang_id', '=', 'jenjang.id', 'LEFT')
                        ->join('kelas', 'kelas_id', '=', 'kelas.id', 'LEFT')
                        ->join('mapel', 'mapel_id', '=', 'mapel.id', 'LEFT')
                        ->select('modul.*', 'users.name', 'users.profesi')
                        ->where('modul.status', 'Y')

                        ->where('kategori_modul.kategori_mod',  'like', '%'.$var->cari.'%')
                        ->orWhere('modul.judul',  'like', '%'.$var->cari.'%')
                        ->orWhere('users.name',  'like', '%'.$var->cari.'%')
                        ->orWhere('jenis.ket',  'like', '%'.$var->cari.'%')
                        ->orWhere('jenjang.nm_jenjang',  'like', '%'.$var->cari.'%')
                        ->orWhere('kelas.nm_kelas',  'like', '%'.$var->cari.'%')
                        ->orWhere('kelas.nm_kelas',  'like', '%'.$var->cari.'%')
                        ->orWhere('mapel.nm_mapel',  'like', '%'.$var->cari.'%')
                        ->get();

            return view('user.search', $var);
        }
    }

    public function redirect() {
        if(Auth::guest()) {
            return Redirect('/login');
        } else {
            $id  = 0;
            $id  = Auth::user()->id;
            $rol = role_user::where('user_id', $id)->first();

            if ($rol->role_id == 10) {
                return Redirect('/admin');
            } else {
                return Redirect('/home');
            }
        }
    }

    public function admin() {
        $modul  = modul::orderBY('id', 'desc')->paginate(10);
        $moduls = modul::count();
        $videos = video::count();
        $users = user::count();
        
        $tahun = date('Y');
        
        $users_premium = user::where('level', 'Premium')->count();
        return view('admin.index', compact('modul', 'moduls', 'videos', 'users', 'users_premium', 'tahun'));
    }
    
    public function filtergrafik($val) {
        $forum  = forum::orderBY('count', 'desc')->paginate(5);
        $modul  = modul::orderBY('id', 'desc')->paginate(10);
        $agenda = agenda::orderBY('id', 'desc')->get();
        $moduls = modul::count();
        $videos = video::count();
        $users = user::count();
        
        $tahun = $val;
        
        $users_premium = user::where('level', 'Premium')->count();
        return view('admin.index', compact('forum', 'modul', 'agenda', 'moduls', 'videos', 'users', 'users_premium', 'tahun'));
    }
    
    public function filter_grafik_user() {
        echo "grafik";
    }

    public function appearance() {
        return view('dashboard.appearance.appearance');
    }

    public function appearance_post(Request $request) {
        $messages = [
            'required' => ':attribute harus diisi.',
            'max'      => ':attribute maximal :max karakter.',
            'image'    => ':attribute hanya boleh berekstensi jpg|jpeg|png|gif & max 5MB',
        ];

        $validasi = Validator::make($request->all(), [
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
        ], $messages);

        if ($validasi->fails()) {
            return redirect()
                ->back()
                ->withErrors($validasi);
        }

        @unlink(public_path('slides/' . $request->old_gambar));
        $file  = $request->file('gambar');
        $ext   = strtolower($file->getClientOriginalExtension());
        $bukti = 'slide-' . $request->nomor . "." . $ext;
        $file->move(public_path('slides'), $bukti);

        Alert::success('Upload gambar sukses', 'Berhasil')->autoclose(3000);

        return redirect()->back();
    }

    public function daftar() {

        return view('user.daftar');
    }

    public function edituser() {
        $user = User::find(Auth::user()->id);
        return view('user.edituser', compact('user'));
    }

    public function userupdate(request $request) {
        $this->validate($request, $this->imgrules);
        $this->validate($request, [
            'no_hp' => 'unique:users,no_hp,'.Auth::user()->id
        ]);

        $id   = $request->id;
        $user = User::find($id);
        $file = $request->file('gambar');

        if ($file != '') {
            if($user->gambar != 'avatar.jpeg') {
                File::delete($user->gambar);
            }

            $extension       = $file->getClientOriginalExtension();
            $filename        = Auth::user()->email . '-' . rand(11111, 99999) . '.' . $extension;
            $destinationPath = 'uploads/';
            $request->file('gambar')->move($destinationPath, $filename);

            $img = Image::make($destinationPath . '/' . $filename);
            $img->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();

            $gambar = $destinationPath . $filename;
        } else {
            $gambar = $user->gambar;
        }

        $data = [
            'name'        => $request->name,
            'profesi'     => $request->profesi,
            'instansi'    => $request->instansi,
            'gender'      => $request->gender,
            'alamat'      => $request->alamat,
            'bio'         => $request->bio,
            'no_hp'       => $request->no_hp,
            'gambar'      => $gambar,
        ];

        $exec = User::find($id)->update($data);
        if($exec) {
            return Redirect()->back()->with(['success' => 'Berhasil Mengupdate Data']);
        }
    }

    public function daftarstore(Request $request) {

        $this->validate($request, $this->imgrules);
        $this->validate($request, $this->rules);
        $this->validate($request, [
            'no_hp' => 'unique:users'
        ]);

        $destinationPath = 'uploads';

        if (!empty($request->file('gambar'))) {
            $file      = ['gambar' => Input::file('gambar')];
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $filename  = rand(11111, 99999) . '.' . $extension;
            $request->file('gambar')->move($destinationPath, $filename);

            $img = Image::make($destinationPath . '/' . $filename);
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();

            $gambar = $destinationPath . '/' . $filename;
        } else {
            $gambar = $destinationPath . '/avatar.jpeg';
        }
        $password          = $request->password;
        $hashed            = Hash::make($password);

        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $hashed,
            'gambar'    => $gambar,
        ];

        User::create($data);

        $userx = User::orderBy('id', 'desc')->first();

        $role          = new role_user;
        $role->user_id = $userx->id;
        $role->role_id = 11;
        $role->save();

        Alert()->success(' Register User Berhasil', 'Success')->autoclose(1500);
        // alert()->success('Success', 'Register')->autoclose(2000);
        return Redirect('/login');
    }

    public function mycourse() {
        $var['pageLink'] = '';
        $var['modul'] = cart::where('user_id', Auth::user()->id)
                        ->join('modul', 'modul_id', '=', 'modul.id')
                        ->join('users', 'trainer_id', '=', 'users.id')
                        ->where('cart.stcart', 1)
                        ->select('modul.*', 'cart.updated_at', 'users.name', 'users.profesi')
                        ->get();

        return view('user.mycourse', $var);
    }
}
