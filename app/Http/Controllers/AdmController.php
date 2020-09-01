<?php

namespace App\Http\Controllers;

use Alert;
use App\agenda;
use App\forum;
use App\help;
use App\kategorivideo;
use App\koderedem;
use App\kategorimod;
use App\kodeuser;
use App\komentar;
use App\modul;
use App\mapel;
use App\notif;
use App\pdf;
use App\read;
use App\role_user;
use App\User;
use App\voucher;
use App\video;
use App\sfk;
use App\webinar;
use Auth;
use DB;
use Event;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;
use Redirect;

class AdmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $forum  = forum::orderBY('count', 'desc')->paginate(5);
        $modul  = modul::orderBY('id', 'desc')->paginate(10);
        $agenda = agenda::orderBY('id', 'desc')->get();
        $moduls = modul::count();
        $videos = video::count();
        $users  = user::count();
        
        $tahun = date('Y');
        
        $users_premium = user::where('level', 'Premium')->count();
        return view('admin.index', compact('forum', 'modul', 'agenda', 'moduls', 'videos', 'users', 'users_premium', 'tahun'));
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
