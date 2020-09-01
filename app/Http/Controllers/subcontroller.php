<?php

namespace App\Http\Controllers;

use Alert;
use App\modul;
use App\kategorimod;
use App\jenjang;
use App\kelas;
use App\mapel;
use App\trainers;
use App\jenis;
use App\user;
use Auth;
use DB;
use Event;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;
use Redirect;

class subcontroller extends Controller
{
    public function index() {
    	$var['pageLink'] = 'course';

    	if(isset($_GET['ktg'])) {
	    	$d = kategorimod::find($_GET['ktg']);
	    	$var['pageName'] = $d->kategori_mod;
	    	$atr = 'kategori_modul';
	    } 

	    if(isset($_GET['mapel'])) {
	    	$d = mapel::find($_GET['mapel']);
	    	$var['pageName'] = $d->nm_mapel;
	    	$atr = 'mapel_id';
	    }

    	$var['modul'] = modul::where($atr, $d->id)
    					->join('users', 'trainer_id', '=', 'users.id')
    					->select('modul.*', 'users.name', 'users.profesi')
                    	->where('modul.status', 'Y')
    					->paginate(12);

    	$var['kategorimod'] = kategorimod::all();
		$var['jenjang']     = jenjang::all();
		$var['kelas']       = kelas::all();
		$var['mapel']       = mapel::all();
		$var['user']    	= user::where('role_id', 12)->get();
		$var['jenis']       = jenis::all();

    	return view('user.sub.subcourse', $var);
    }

    public function filter(Request $req) {
    	$var['pageLink'] = 'course';
    	$data = $req->all();
    	
	    $var['pageName'] = '';

	    $mod = modul::join('users', 'trainer_id', '=', 'users.id')
                        ->select('modul.*', 'users.name', 'users.profesi');

        if(isset($_GET['ktg'])) {
			foreach($data['ktg'] as $i => $x) {
				$mod->where('kategori_modul', $data['ktg'][$i]);
			}
		} 

		if(isset($_GET['jenis'])) {
			foreach($data['jenis'] as $i => $x) {
				$mod->where('jenis_id', $data['jenis'][$i])->orWhere('jenis_id', $data['jenis'][$i]);
			}
		}

		if(isset($_GET['jenjang'])) {
			foreach($data['jenjang'] as $i => $x) {
				$mod->where('jenjang_id', $data['jenjang'][$i]);
			}
		}

		if(isset($_GET['kelas'])) {
			foreach($data['kelas'] as $i => $x) {
				$mod->where('kelas_id', $data['kelas'][$i]);
			}
		}

		if(isset($_GET['mapel'])) {
			foreach($data['mapel'] as $i => $x) {
				$mod->where('mapel_id', $data['mapel'][$i]);
			}
		}

		$modul = $mod->where('modul.status', 'Y')->get();

		// echo "<pre>";
  //   	var_dump($data);
  //   	var_dump($mod);
  //   	exit;


        $var['kategorimod'] = kategorimod::all();
		$var['jenjang']     = jenjang::all();
		$var['kelas']       = kelas::all();
		$var['mapel']       = mapel::all();
		$var['user']    	= user::where('role_id', 12)->get();
		$var['jenis']       = jenis::all();

    	return view('user.sub.subcourse', $var, compact('modul', 'data'));
    } 
}
