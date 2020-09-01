<?php

namespace App\Http\Controllers;

use Redirect;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use Socialite;
use App\modul;
use App\kategorivideo;

use Alert;
use Image;
use Auth;
use Hash;
use DB;

class kategorivideocontroller extends Controller
{
  public function index() {
    $modul = modul::all();
    $kategorivideo = kategorivideo::join('modul', 'modul_id', 'modul.id')->select('kategorivideo.*', 'modul.judul')->paginate(10);
    return view('dashboard.kategorivideo.index',compact('kategorivideo', 'modul'));
  }


public function create()
{
  $modul=modul::all();
  return view('dashboard.kategorivideo.create',compact('modul'));
}

public function store(Request $request){

    $input= $request->all();
Kategorivideo::create($input);
return Redirect()->back()->with(['success' => 'Berhasil Menambahkan Data']);

}


public function edit(kategorivideo $kategorivideo)
 {
   $kategorivideo=Kategorivideo::find($kategorivideo->id);
     $modul=modul::all();
   return view('dashboard.kategorivideo.edit',compact('kategorivideo','modul'));
 }


 public function update(kategorivideo $kategorivideo, request $request)
 {
   $kategorivideo=Kategorivideo::find($kategorivideo->id);
   $input=array_except($request->all(),'_method');
   $kategorivideo->update($input);

   return Redirect()->back()->with(['success' => 'Berhasil Mengedit Data']);

 }

 public function search(request $request)
 {
   $cari=$request->get('search');

   $kategorivideo=DB::table('Kategorivideo')->select('Kategorivideo.id','modul_id','Kategorivideo.kategori','modul.judul')
   ->join('modul','modul.id','=','Kategorivideo.modul_id')->where('kategori','LIKE','%'.$cari.'%')->get();
   return view('dashboard.kategorivideo.search',compact('kategorivideo'));
 }


 public function destroy(kategorivideo $kategorivideo)
{

 $kategorivideo->delete();
 return Redirect()->back()->with(['success' => 'Berhasil Menghapus Data']);

}


}
