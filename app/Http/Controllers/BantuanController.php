<?php

namespace App\Http\Controllers;

use App\balasan_pesan;
use App\bantuan;
use App\Mail\MailBantuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class BantuanController extends Controller
{

    public function index()
    {
        $bantuans=DB::table('bantuans')->join('users', 'user_id', '=', 'users.id')->select('bantuans.*', 'users.name', 'users.email', 'users.gambar')->paginate(10);
        $balasan_pesans=DB::table('balasan_pesans')->join('users', 'user_id', '=', 'users.id')->select('balasan_pesans.*', 'users.name', 'users.gambar')->get();
        return view('dashboard.bantuan.index',compact('bantuans', 'balasan_pesans'));
    }

    public function storeTiketBantuan(Request $request)
    {

        $bantuan = new bantuan();
        $bantuan->user_id = Auth::user()->id;
        if($request->hasfile('lampiran')){
            $files = $request->file('lampiran');
            foreach($files as $file){
                $filename = Auth::user()->id.'_'.date('d-m-Y').'_'.$file->getClientOriginalName();
                $file->move(public_path('/lampiran/'.Auth::user()->id), $filename);
                $data[] = $filename; 
            }
        }
        $bantuan->subjek = $request->subjek;
        $bantuan->kategori_layanan = $request->kategori_layanan;
        $bantuan->prioritas = $request->prioritas;
        $bantuan->pesan = $request->pesan;
   
        $bantuan->lampiran=json_encode($data);
        $bantuan->save();

        $databantuan = array(
            'subjek' => $request->subjek,
            'prioritas' => $request->prioritas,
            'pesan' => $request->pesan
        );

     Mail::to('hafecs.yogya@gmail.com')->send(new MailBantuan($databantuan));
   
        return back()->with('success', 'Terima kasih. Tiket Bantuan anda akan segera diproses.');
    }

    public function storeBalasanPesan(Request $request, $bantuanid)
    {

        $balasan = new balasan_pesan();
        $bantuan= bantuan::where('id', $bantuanid)->first();
        $balasan->user_id = Auth::user()->id;
        $balasan->pesan_id = $bantuan->id;
        if($request->hasfile('lampiran')){
            $files = $request->file('lampiran');
            foreach($files as $file){
                $filename = Auth::user()->id.'_'.date('d-m-Y').'_'.$file->getClientOriginalName();
                $file->move(public_path('/lampiran/'.Auth::user()->id), $filename);
                $data[] = $filename; 
            }
        }
    
        $balasan->balasan_pesan = $request->balasan_pesan;
   
        $balasan->lampiran=json_encode($data);
        $balasan->save();
   
        return back()->with('success', 'Balasan Terkirim');
    }

    public function storeBalasanAdmin(Request $request, $id)
    {

        $balasan = new balasan_pesan();
        $bantuan= bantuan::where('id', $id)->first(); 
        $balasan->user_id = Auth::user()->id;
        $balasan->pesan_id = $bantuan->id;
        $balasan->balasan_pesan = $request->balasan_pesan;
   
        
        $balasan->save();
   
        return back()->with('success', 'Balasan terkirim');
    }

    public function edit($id)
    {
        $bantuans = DB::table('bantuans')->where('id', $id)->first();
        return view('dashboard.bantuan', compact('bantuans', 'id'));
    }

    public function update(Request $request, $id)
    {
        switch($request->get('approve'))
        {
            case 0:
                bantuan::postpone($id);
                break;
            case 2:
                bantuan::reject($id);
                break;
            case 3:
                bantuan::postpone($id);
                break;
           
            default:    
                break;

        }
        return redirect('admin/bantuan');
    }

    public function sendFeedback()
    {
        
    }

}
