<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cart;
use App\transaksi;
use App\bank;
use App\modul;
use App\video;
use App\notifikasi;
use Auth;
use DB;
use Image;
use File;

class cartcontroller extends Controller
{

    protected $imgrules = [
        'gambar' => 'image|mimes:jpg,png,jpeg'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $var['cart'] = cart::where('user_id', Auth::user()->id)
                        ->join('modul', 'modul_id', '=', 'modul.id')
                        ->join('users', '.modul.trainer_id', '=', 'users.id')
                        ->select('cart.*', 'modul.*', 'cart.id as idc', 'users.name', 'users.profesi')
                        ->where('cart.stcart', '!=', '1')
                        ->get();
        $var['pageLink'] = '';
        $var['price'] = DB::table('cart')
                        ->where('user_id', Auth::user()->id)
                        ->join('modul', 'modul_id', '=', 'modul.id')
                        ->select(DB::raw("SUM(modul.harga_lama) as hl"), DB::raw("SUM(modul.harga) as hb"))
                        ->where('cart.stcart', '!=', '1')
                        ->first();

        $cartx = DB::table('cart')->where('user_id', Auth::user()->id)->where('stcart', '!=', '1')->count();

        $cartc = cart::where('user_id', Auth::user()->id)
                ->where('cart.stcart', '0')
                ->whereNotNull('transaksi_id')->get();

        $var['modul'] = modul::join('users', 'trainer_id', '=', 'users.id')
                        ->select('modul.*', 'users.name', 'users.profesi')
                        ->where('modul.status', 'Y')
                        ->where('sertifikat', 1)
                        ->limit(20)
                        ->get();

        return view('user.cart.index', $var, compact('cartx', 'cartc'));
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
        $mod = $request->mod;
        $i = 0;
        $data = [];
        foreach ($mod as $mod) {
            array_push($data, [
                'modul_id'  => $mod,
                'user_id'   => Auth::user()->id,
                'no_berita' => $request->berita,
                'status'    => '1',
                'cart_id'   => $request->cart[$i],
            ]);
            $i++;
        }

        var_dump($data);

        Sales::insert($data);
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

    public function delete_cart(Request $request) {
        cart::where('id', $request->id)->delete();
    }

    public function addbuy(Request $request)
    {  
        $total  = substr($request->total,0 , -3);
        $rand   = mt_rand(000, 200);
        $pad    = str_pad($rand, 3, '0', STR_PAD_LEFT);
        $digit  = $total . $pad;
        
        $data = [
            'kode'      => mt_rand(10000000, 99999999),
            'user_id'   => Auth::user()->id,
            'bank_id'   => $request->bank,
            'harga'     => $request->total,
            'total'     => $digit,
            'status'    => '0',
        ];

        $cart = cart::where('user_id', Auth::user()->id)
                ->where('stcart', '0')
                ->whereNull('transaksi_id')
                ->get()->toArray();

        for ($i=0; $i < count($cart); $i++) { 
            cart::where('id', $cart[$i]['id'])->update(['transaksi_id' => $data['kode']]);
        }

        transaksi::create($data);
        return redirect('pembayaran/' . $data['kode']);
    }

    public function addcart(Request $request) {

        $cek = cart::where('user_id', $request->user)->where('modul_id', $request->id)->where('stcart', 0)->count();

        $tran = transaksi::where('user_id', $request->user)->where('status', 0)->count();
        if($tran > 0) {
            echo "tran";
        } else {
            if($cek < 1) {
                $data = [
                    'user_id'   => $request->user,
                    'modul_id'  => $request->id,
                    'stcart'    => '0'
                ];

                cart::create($data);
                echo "0";
            } else {
                echo "1";
            }
        }
    }

    public function checkout() {
        $cartc = cart::where('user_id', Auth::user()->id)
                ->where('cart.stcart', '0')
                ->whereNull('transaksi_id')
                ->count();

        if($cartc > 0) {
            $var['pageLink'] = '';
            $var['page'] = 'one';

            $var['cart'] = cart::where('user_id', Auth::user()->id)
                            ->whereNull('transaksi_id')
                            ->join('modul', 'modul_id', '=', 'modul.id')
                            ->join('users', '.modul.trainer_id', '=', 'users.id')
                            ->select('cart.*', 'modul.*', 'cart.id as idc', 'users.name', 'users.profesi')
                            ->get();

            $var['price'] = cart::where('user_id', Auth::user()->id)
                            ->whereNull('transaksi_id')
                            ->join('modul', 'modul_id', '=', 'modul.id')
                            ->select(DB::raw("SUM(modul.harga_lama) as hl"), DB::raw("SUM(modul.harga) as hb"))
                            ->first();

            $var['bank'] = bank::all();


            $cek = transaksi::where('user_id', Auth::user()->id)
                    ->where('status', '1')->count();
            return view('user.cart.checkout', $var, compact('cek'));
        } else {
            return redirect('cart');
        }
    }

    public function pembayaran($kode) {

        $var['pageLink'] = '';
        $var['page'] = 'two';

        $tran = transaksi::where('user_id', Auth::user()->id)
                ->where('kode', $kode)
                ->join('users', 'user_id', '=', 'users.id')
                ->join('bank', 'bank_id', '=', 'bank.id')
                ->select('transaksi.*', 'users.name', 'bank.atm')
                ->first();

        $var['cartx'] = cart::where('transaksi_id', $kode)->count();
        $var['bank'] = bank::find($tran->bank_id)->first();

        if($tran->status == 1) {
            return redirect('result/' . $kode);
        } else {
            return view('user.cart.checkout', $var, compact('tran'));
        }
    }

    public function result($kode) {
        $var['pageLink'] = '';
        $var['page'] = 'tri';

        $tran = transaksi::where('user_id', Auth::user()->id)
                ->where('kode', $kode)
                ->join('users', 'user_id', '=', 'users.id')
                ->join('bank', 'bank_id', '=', 'bank.id')
                ->select('transaksi.*', 'users.name', 'bank.atm')
                ->first();

        $var['modul'] = cart::where('transaksi_id', $kode)
                    ->join('modul', 'modul_id', '=', 'modul.id')
                    ->join('users', 'modul.trainer_id', '=', 'users.id')
                    ->where('modul.status', 'Y')
                    ->select('modul.*', 'users.name', 'users.profesi')
                    ->get();

        $var['cartx'] = cart::where('transaksi_id', $kode)
                        ->count();

        return view('user.cart.checkout', $var, compact('tran'));
    }

    public function edit_notif(Request $request) {
        notifikasi::find($request->id)->update(['read' => '1']);
    }
}
