<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\user;
use App\cart;
use App\transaksi;
use App\notifikasi;
use App\Mail\MailModul;
use Illuminate\Support\Facades\Mail;

class ordercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $var['tran'] = transaksi::join('users', 'user_id', '=', 'users.id')
                    ->join('bank', 'bank_id', '=', 'bank.id')
                    ->select('transaksi.*', 'users.name', 'bank.atm')
                    ->orderBY('transaksi.created_at')
                    ->get();

        return view('dashboard.order.index', $var);
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
    public function update(Request $request)
    {
        $d = $request->all();
        $stt = $d['apply'];

        $tran = transaksi::where('id', $d['id'])->first();
        $cart = cart::where('transaksi_id', $tran->kode)->count();

        $user = user::where('id', $tran->user_id)->first();

        $r = transaksi::join('users', 'user_id', '=', 'users.id')
                ->join('bank', 'bank_id', '=', 'bank.id')
                ->select('transaksi.*', 'users.name', 'bank.atm')
                ->orderBY('transaksi.created_at', 'desc')
                ->first();

        $data = [
            'name'      => $r->name,
            'kode'      => $r->kode,
            'tgl'       => $r->created_at,
            'total'     => $r->total,
            'metode'    => $r->atm,
            'status'    => $d['apply'],
        ];

        // echo "<pre>";
        // var_dump($data);
        // exit;

        if($stt == 0) {
            for ($i=0; $i < $cart; $i++) { 
                cart::where('transaksi_id', $tran->kode)->update(['stcart' => '0']);
            }
        } else {
            for ($i=0; $i < $cart; $i++) { 
                cart::where('transaksi_id', $tran->kode)->update(['stcart' => '1']);
            }

            Mail::to($user->email)->send(new MailModul($data));
        }

        $notif = [
            'notif'     => 'Pembelian kursus anda telah dikonfirmasi',
            'user_id'   => $tran->user_id,
            'link'      => 'checkout/success/'. $tran->kode,
            'about'     => 'pembelian',
        ];

        notifikasi::create($notif);

        transaksi::find($tran->id)->update(['status' => $stt]);
        echo $stt;
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
