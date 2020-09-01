<?php

namespace App\Http\Controllers;

use Alert;
use App\webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;

class webinarcontroller extends Controller {
    public function index() {
        $webinar = webinar::orderBY('id', 'desc')->paginate(10);
        return view('dashboard.webinar.index', compact('webinar'));
    }

    public function create() {

        return view('dashboard.webinar.create');
    }

    public function store() {
        Alert::success('Penambahan Data Berhasil Di Lakukan', 'Berhasil')->autoclose(2500);
        $input = Input::all();
        webinar::create($input);
        return redirect('admin/webinar');
    }

    public function edit(webinar $webinar) {
        $webinar = webinar::find($webinar->id);
        return view('dashboard.webinar.edit', compact('webinar'));
    }

    public function update(webinar $webinar) {
        Alert::success('Pengeditan Data Berhasil Di Lakukan', 'Berhasil')->autoclose(2500);
        $webinar = webinar::find($webinar->id);
        $input   = array_except(Input::all(), '_method');
        $webinar->update($input);

        return redirect('admin/webinar');
    }

    public function destroy(webinar $webinar) {
        Alert::success(' Data Berhasil Di Hapus', 'Berhasil')->autoclose(2500);
        $webinar->delete();
        return redirect('admin/webinar');
    }

    public function search(request $request) {
        $cari    = $request->get('search');
        $webinar = webinar::where('judul', 'LIKE', '%' . $cari . '%')->get();

        return view('dashboard.webinar.search', compact('webinar'));
    }

}
