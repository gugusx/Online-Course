<?php

namespace App\Http\Controllers;

use Redirect;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use Socialite;
use App\modul;
use App\kategorimod;
use App\jenjang;
use App\kelas;
use App\mapel;
use App\user;
use App\jenis;
use Alert;
use Image;
use Auth;
use DB;
use Hash;

use App\Mail\MailBlast;
use Illuminate\Support\Facades\Mail;

class modulcontroller extends Controller
{
  protected $rules = [
    'judul' => ['required', 'min:5'],
    'isi' => ['required'],
    'gambar' => 'required', 'image|mimes:jpg,png,jpeg'


  ];

  protected $aturan = [
    'judul' => ['required', 'min:5'],
    'isi' => ['required'],
    'gambar' => 'image|mimes:jpg,png,jpeg'
  ];


  public function index() {
    $modul = modul::join('kategori_modul', 'kategori_modul', '=', 'kategori_modul.id')
            ->join('users', 'trainer_id', '=', 'users.id', 'LEFT')
            ->join('jenis', 'jenis_id', '=', 'jenis.id', 'LEFT')
            ->orderBY('created_at','desc')
            ->select('modul.*', 'kategori_modul.kategori_mod', 'users.name', 'jenis.nm_jenis')
            ->paginate(10);

    return view('dashboard.modul.index',compact('modul'));
  }

public function create()
{
  $var['kategorimod'] = kategorimod::all();
  $var['jenjang']     = jenjang::all();
  $var['kelas']       = kelas::all();
  $var['mapel']       = mapel::all();
  $var['user']        = user::where('role_id', 12)->get();
  $var['jenis']       = jenis::all();

  return view('dashboard.modul.create', $var);
}


public function store(Request $request)
{
  $this->validate($request, $this->rules);

  $input = $request->all();

  $destinationPath = 'uploads/modul';
  $extension       = $request->file('gambar')->getClientOriginalExtension();
  $filename        = rand(11111,99999).'.'.$extension;
  $request->file('gambar')->move($destinationPath, $filename);

  $input['gambar'] = $destinationPath.'/'.$filename;
  $img = Image::make($destinationPath . '/' . $filename);
  $img->resize(800, null, function ($constraint) {
    $constraint->aspectRatio();
  });
  $img->save();

  $input['harga'] = str_replace("Rp ", "", str_replace(".", "", $request->harga));

  $input['status'] = 'N';

  modul::create($input);
  return Redirect()->back()->with(['success' => 'Berhasil Menambahkan Data']);
}


public function edit($id) {
  $var['modul']        = modul::find($id);
  $var['kategorimod']  = kategorimod::all();

  $var['jenjang']     = jenjang::all();
  $var['kelas']       = kelas::all();
  $var['mapel']       = mapel::all();
  $var['user']        = user::where('role_id', 12)->get();
  $var['jenis']       = jenis::all();

  return view('dashboard.modul.edit', $var);
}


public function update(modul $modul ,request $request){
 $this->validate($request, $this->aturan);

  $input = $request->all();
  // var_dump($input);
  // exit;

   if($request->hasFile('gambar')) {
      File::delete($modul->gambar);

      $destinationPath = 'uploads/modul';
      $extension       = $request->file('gambar')->getClientOriginalExtension();
      $filename       = rand(11111,99999).'.'.$extension;
      $request->file('gambar')->move($destinationPath, $filename);

      $input['gambar'] = $destinationPath.'/'.$filename;
    } else {
      $input['gambar'] = $modul->gambar;
    }

    $input['harga'] = str_replace("Rp ", "", str_replace(".", "", $request->harga));

    modul::find($modul->id)->update($input);
    return Redirect()->back()->with(['success' => 'Berhasil Mengedit Data']);
    
}

   public function destroy(modul $modul) {

    File::delete($modul->gambar);
    $modul->delete();
    return Redirect()->back()->with(['success' => 'Berhasil Menghapus Data']);
  }


 public function search(request $request)
 {
   $cari=$request->get('search');
   $modul=modul::where('judul','LIKE','%'.$cari.'%')->get();
   return view('dashboard.modul.search',compact('modul'));
 }

 public function kategori_modul($id = null) {
    $var['kategorimod'] = kategorimod::all();
      if($id == null) {
        $var['kg'] = '';
      } else {
        $var['kg'] = kategorimod::find($id);
      }

    return view('dashboard.modul.kategorimodul', $var);
 }

 public function insert_km(Request $request) {
    $input = $request->all;
    kategorimod::create($input);
    return redirect('admin/kategori_modul')->with(['success' => 'Berhasil Menambahkan Data']);
 }

public function edit_km($id, Request $request) {
    $d = kategorimod::find($id);
    $d->kategori_mod = $request->kategori_mod;
    $d->save();

    return redirect('admin/kategori_modul')->with(['success' => 'Berhasil Mengedit Data']);
}

public function delete_km($id) {
    kategorimod::destroy($id);
    return redirect('admin/kategori_modul')->with(['success' => 'Berhasil Menghapus Data']);
 }

 public function cekJenjang(Request $request) {
    $cek = kelas::where('jenjang_id', $request->val)->get();
    return response()->json($cek);
}

public function update_post(Request $request) {
    $data = $request->all();
    $i = $data['apply'];
    modul::find($data['id'])->update(['status' => $i]);

    $mailto = DB::table('gmail')->get();

    foreach ($mailto as $m) {

      $arr = [
        'name'      => $m->email,
        'modul_id'  => $data['id'],
      ];

      Mail::to($m->email)->send(new MailBlast($arr));
    }

    // if($i == 'Y') {
    //   modul::find($data['id'])->update(['status' => $i]);
    //   echo $i;
    // } else {
    //   modul::find($data['id'])->update(['status' => $i]);
    //   echo $i;
    // }

    // return redirect()->back()->with(['success' => 'Berhasil Mempublish Modul']);

}

}
