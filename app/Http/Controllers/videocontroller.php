<?php

namespace App\Http\Controllers;

use Alert;
use App\kategorivideo;
use App\modul;
use App\video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;

class videocontroller extends Controller {

    public function index() {
        $video = DB::table('video')
            ->join('Kategorivideo', 'video.Kategorivideo_id', '=', 'Kategorivideo.id')
            ->join('modul as du', 'Kategorivideo.modul_id', '=', 'du.id')
            ->select('du.judul as judulmodul',
                'video.judul as vjudul', 'Kategorivideo.kategori', 'video.embed', 'video.id', 'video.list','video.kategorivideo_id', 'video.stat', 'video.durasi')
            ->orderby('list', 'asc')
            ->paginate(10);
        
        $kategorivideo = Kategorivideo::all();

        return view('dashboard.video.index', compact('video', 'kategorivideo'));
    }

    public function create() {
        $modul         = modul::all();
        $kategorivideo = Kategorivideo::all();

        return view('dashboard.video.create', compact('modul', 'kategorivideo', 'modul'));
    }

    public function store(Request $request) {

        $video  = DB::table('video')->orderby('list', 'desc')->first();
        $videox = DB::table('video')->orderby('list', 'desc')->count();
        $input = $request->all();

        if ($videox < 1) {
            $videoz = 0;
        } else {
            $videoz = $video->list;
        }
        $input['list'] = $videoz + 1;

        video::create($input);
        return Redirect()->back()->with(['success' => 'Berhasil Menambahkan Data']);
    }

    protected $rules = [

        'judul'            => ['required', 'min:5'],

        'embed'            => ['required'],

        'kategorivideo_id' => ['required'],

    ];

    public function edit(video $video) {
        // $video         = video::find($video->id);
        $video = DB::table('video')
            ->join('Kategorivideo', 'video.Kategorivideo_id', '=', 'Kategorivideo.id')
            ->join('modul as du', 'Kategorivideo.modul_id', '=', 'du.id')
            ->where('video.id', $video->id)
            ->select('video.*', 'du.id as modul_id')
            ->first();

        $modul         = modul::all();
        $modul         = modul::all();
        $kategorivideo = kategorivideo::all();
        return view('dashboard.video.edit', compact('kategorivideo', 'modul', 'video', 'modul'));
    }

    public function update(video $video, request $request) {
        
        $this->validate($request, $this->rules);
        video::find($video->id)->update($request->all());

        // $videox       = video::where('list', '=', $request->list)->firstOrFail();
        // $videox->list = $request->listx;
        // $videox->save();

        // $video = video::find($video->id);
        // $input = array_except(Input::all(), '_method');
        // $video->update($input);

        // return redirect('admin/video');

        return redirect()->back()->with(['success' => 'Berhasil Mengedit Data']);
    }

    public function search(request $request) {
        $cari = $request->get('search');

        $video = DB::table('video')->select('du.judul as judulmodul',
            'video.judul as vjudul', 'Kategorivideo.kategori', 'video.embed', 'video.id', 'video.list')
            ->join('Kategorivideo', 'video.Kategorivideo_id', '=', 'Kategorivideo.id')
            ->join('modul as du', 'Kategorivideo.modul_id', '=', 'du.id')
            ->where('video.judul', 'LIKE', '%' . $cari . '%')->get();

        return view('dashboard.video.search', compact('video'));
    }

    public function destroy(video $video) {

        $video->delete();

        $vid = video::where('id', '<', $video->id)->get();

        foreach ($vid as $x) {
            $x->list = $x->list - 1;
            $x->save();
        }
        return Redirect()->back()->with(['success' => 'Berhasil Menghapus Data']);
    }
}
