<?php

namespace App\Http\Controllers;

use Redirect;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use Socialite;
use App\mapel;
use Alert;
use Image;
use Auth;
use Hash;

class mapelcontroller extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {   
        $var['mapel'] = mapel::orderBy('jenis', 'asc')->get();
        return view('dashboard.mapel.index', $var);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input  = $request->all();
        $file   = array('gambar'=>$request->file('gambar'));

        if($request->file('gambar')->isValid()) {
            $destinationPath    = 'uploads/mapel';
            $extension          = $request->file('gambar')->getClientOriginalExtension();
            $filename           = rand(11111,99999) . '.' . $extension;
            $request->file('gambar')->move($destinationPath, $filename);

            $img = Image::make($destinationPath . '/' . $filename);
            $img->resize(300, null, function ($constraint) {
              $constraint->aspectRatio();
            });
            $img->save();

          $input['gambar'] = $destinationPath . '/' . $filename;

          mapel::create($input);
          return Redirect('admin/mapel')->with(['success' => 'Berhasil Menambahkan Data']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, request $request){
        $mapel = mapel::find($id);

        if($request->hasFile('gambar')) {
            File::delete($mapel->gambar);
            $destinationPath    = 'uploads/mapel';
            $extension          = $request->file('gambar')->getClientOriginalExtension();
            $filename           = rand(11111,99999).'.'.$extension;
            $request->file('gambar')->move($destinationPath, $filename);

            $gambar=$destinationPath.'/'.$filename;
        }
        else {
            $gambar=$mapel->gambar;
        }

        
        $mapel->nm_mapel    = $request['nm_mapel'];
        $mapel->jenis       = $request['jenis'];
        $mapel->gambar      = $gambar;
        $mapel->save();

        return Redirect('admin/mapel')->with(['success' => 'Berhasil Mengubah Data']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $d = mapel::where('id', $id)->first();
        File::delete($d->gambar);
        mapel::destroy($id);
        return Redirect('admin/mapel')->with(['success' => 'Berhasil Menghapus Data']);
    }
}
