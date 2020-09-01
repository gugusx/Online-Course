<?php

namespace App\Http\Controllers;

use App\karya_kelas;
use App\video;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class KaryaKelasController extends Controller
{

    public function index()
    {
        $karyax=DB::table('karya_kelas')->join('users', 'user_id', '=', 'users.id')->select('karya_kelas.*', 'users.name')->paginate(10);
        return view('dashboard.karyakelas.index',compact('karyax'));
    }
    
    public function storeKaryaKelas(Request $request, video $video)
    {

        $request->validate([
            'hasil_karya' => 'required',
            'hasil_karya.*' => 'mimes:doc,pdf,docx,txt,png,jpg,jpeg,mp4,avi,3gp|max:10000'
        ]);
    

        $karya = new karya_kelas();
        $karya->user_id = Auth::user()->id;
        if($request->hasfile('hasil_karya')){
            $files = $request->file('hasil_karya');
            foreach($files as $file){
                $filename = Auth::user()->id.'_'.date('d-m-Y').'_'.$file->getClientOriginalName();
                $file->move(public_path('/hasil_karya/'.Auth::user()->id), $filename);
                $data[] = $filename; 
            }
        }
        $karya->deskripsi_karya = $request->deskripsi_karya;
   
        $karya->hasil_karya=json_encode($data);
        $video->karya_kelas()->save($karya);
   
        return back()->with('success', 'Terima kasih. Hasil karya Anda akan diproses oleh tim kami.');
    }

    public function edit($id)
    {
        $karyax = DB::table('karya_kelas')->where('id', $id)->first();
        return view('dashboard.karyakelas', compact('karyax', 'id'));
    }

    public function update(Request $request, $id)
    {
        switch($request->get('approve'))
        {
            case 0:
                karya_kelas::postpone($id);
                break;
            case 1:
                karya_kelas::approve($id);
                break;
            case 2:
                karya_kelas::reject($id);
                break;
            case 3:
                karya_kelas::postpone($id);
                break;
            default:    
                break;

        }
        return redirect('admin/karyakelas');
    }

}
