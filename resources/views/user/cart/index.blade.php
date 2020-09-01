@extends('layouts.user')
@section('content')
@php
    function rp($angka) {
      $rp = "Rp. " . number_format($angka, 0, ',', '.');
      return $rp;
    }

    function minutes($seconds) {
	    return sprintf("%02.2d", floor($seconds / 60), $seconds % 60);
	}
@endphp
<style>
	.badge-warningb {
	    color: #fff;
	    background-color: #FFCE0E;
	    border-radius: 0px;
	}

	.card-cart {
		border: 1px solid #E5E5E5; border-radius: 4px; margin-bottom: 10px;
	}

	hr {
		margin: 5px 0;
	}

	@media (min-width:767px) {
		.img-w {
			width: 170px;
		}

		.ml-15 {
			margin-left: 15px;
		}

		.margin-cart {
			border-left: 1px solid #E5E5E5; margin-top: 12px; height: 8rem;
		}

		.top-label-cart {
			position: absolute;
		    top: 66px;
		    left: 82%;
		    font-size: 18px;
		}
	}

	@media (max-width:767px) {
		.img-w {
			width: 100%;
		}

		.panel-body {
			margin: 10px;
		}

		.margin-cart {
			margin: 10px;
		}

		.margin-cart-b {
			margin-left: 10px;
		}

		.top-label-cart {
			position: absolute;
		    top: 31px;
		    left: 82%;
		    font-size: 36px;
		}

		.m-10-cart {
			margin: 10px;
		}

	}

	.pz-cart {
		font-size: 14px;
		color: #247EC6;
	}

	.font-none {
		font-family: none;
	}

	.card-other {
		transition: 0.3s;
      	box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
	}

	.card-other:hover {
      	box-shadow: 0 3px 14px -2px rgba(0,0,0,0.2);
	}

</style>
<div class="m-10-cart">
<div class="card mb-6">
	<div class="panel-body">
		<ol class="breadcrumb" style="background-color: white; margin-bottom: 0; padding: 0;">
		  <li><a href="{{asset('/home')}}" style="color: black;"><i class="fa fa-home"></i></a></li>
		  <li class="active"><a class="text-secondary" href="#">Keranjang Belanja</a></li>
		</ol>	
	</div>
</div>

@if($msg = Session::get('success'))
<div class="alert alert-info alert-dismissible" role="alert" style="border-radius: 10px;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
  {{$msg}}
</div>
@endif

<div class="card mb-6">
	<div class="panel-body">
		@if($cartx > 0)
		<div class="row">
			<div class="col-md-9">
			<h5 class="font-weight-bold">{{$cartx}} kursus dalam keranjang anda</h5>	
				@foreach($cart as $d)
				<div class="card-cart">
				@php

					$vtime  = DB::table('video')->join('Kategorivideo', 'Kategorivideo_id', '=', 'Kategorivideo.id')
	                        ->where('Kategorivideo.modul_id', $d->modul_id)
	                        ->select(DB::raw('SUM(TIME_TO_SEC(video.durasi)) as durasi'))
	                        ->first();

					$vd = DB::table('video')
					      ->join('Kategorivideo', 'video.kategorivideo_id', '=', 'Kategorivideo.id')
					      ->where('Kategorivideo.modul_id', $d->modul_id)->count();

					$us = DB::table('cart')->where('modul_id', $d->modul_id)->where('stcart', '1')->count();

				@endphp
				<div class="row">
					<div class="col-md-3">
						<a href="{{asset('modul/'.$d->modul_id.'/show')}}">
						<img src="{{asset($d->gambar)}}" class="img-w p-4" alt="">
						</a>
					</div>
					<div class="col-md-6 margin-cart-b">
						<a href="{{asset('modul/'.$d->modul_id.'/show')}}">
							<h5 class="text-grey mb-1 mt-5">{{$d->judul}}</h5>
						</a>
						<p style="font-size: 13px;">Oleh {{$d->nm_trainer}}, {{$d->jabatan}}</p>
						<div class="row">
							<div class="col-xs-4 col-md-4">
								<p class="pz-cart"><i class="fa fa-clock-o mr-1"></i>{{minutes($vtime->durasi)}} Menit</p>
							</div>
							<div class="col-xs-4 col-md-4">
								<p class="pz-cart"><i class="fa fa-video-camera mr-1"></i>{{$vd}} Video</p>
							</div>
							<div class="col-xs-4 col-md-4">
								<p class="pz-cart"><i class="fa fa-user mr-1"></i>{{$us}} Peserta</p>
							</div>
						</div>
					</div>
					<div class="col-md-3 margin-cart">
						<span class="badge badge-warningb mt-1">Harga Spesial</span>
						<p style="color: #A6A6A6; font-size: 14px;" class="mt-2 mb-0 font-none"><b><strike>{{rp($d->harga_lama)}}</strike></b></p>
						<h4 class="text-blue mt-2 font-none"><b>{{rp($d->harga)}}</b></h4>
						<a onclick="delete_cart({{$d->idc}})" href="#" class="text-secondary top-label-cart">
							<i class="fa fa-trash"></i></a>
					</div>
				</div>
				</div>
				@endforeach
			</div>
			<div class="col-md-3">
			<h5 class="mb-4">Total :</h5>
			<p style="color: #A6A6A6; font-size: 14px;" class="mt-0 mb-0 font-none"><b><strike>{{rp($price->hl)}}</strike></b></p>
			<h3 class="mt-0 font-none"><b>{{rp($price->hb)}}</b></h3>
			@if($cartc->count() > 0)
				<a href="{{asset('pembayaran/' . $cartc->first()->transaksi_id )}}" class="btn btn-blue btn-block">
					<b>Pembayaran</b></a>
			@else 
				<a href="{{asset('checkout')}}" class="btn btn-red btn-block"><b>Checkout</b></a>
			@endif
			</div>
		</div>
		@else
			<h3 class="text-center mt-2">~Keranjang anda sedang kosong~</h3>
		@endif
	</div>
</div>

<h3><b>Modul Lainnya</b></h3>

<div class="row_b">
  <div class="regular slider">
    {{-- Modul Lainnya --}}
    @foreach($modul as $d)
	@php
		$join = DB::table('cart')->where('stcart', 1)->where('modul_id', $d->id)->count();
	@endphp

	<div class="col-md-3">
	    <div class="card card-other">
	      	<div class="work-box2">
            	<a href="{{asset('modul/' . $d->id . '/show' )}}">
		          	<div class="work-img">
		            	<img src="{{ asset($d->gambar) }}" class="img-thumbnail br-top-img" />
		          	</div>
		        </a>
	      	</div>
	      	<div class="panel-body" style="height: 145px">
            	<a class="text-dark" href="{{asset('modul/' . $d->id . '/show' )}}">
		          	<p class="mt-0 mb-0"><b>
		          	@if(strlen($d->judul) > 45)
		          	{{ substr($d->judul, 0, 45) . "..." }}
		          		@else
		          	{{$d->judul}}
		          	@endif
		         	</b></p>
		        </a>
		        <span class="text-smaller">{{$d->nm_trainer}}</span>
			    @if($d->sertifikat == 1)
		        <br>
				@for($i = 1; $i <= 5; $i++)
		        <span class="fa fa-star text-star checked-star mt-2"></span>
		        @endfor
		        <span class="text-secondary">({{$join}})</span>
		        <br>

			    <div class="floating-box mt-2">
			    	<strike>{{rp($d->harga_lama)}}</strike>
			    </div>
		    <div class="floating-box">
			    	<b class="text-large">{{rp($d->harga)}}</b>
			    </div>
			    @endif
	      	</div>
	    </div>
	</div>

@endforeach
    {{-- End --}}
  </div>
</div>

</div>
<script>
	function delete_cart(id) {
		$.ajax({
		    type: 'post',
		    url: '{{asset('/delete_cart')}}',
		    data : {
		    	"_token" : "{{ csrf_token() }}",
		    	"id" : id,
		    },
		    success: function(data) {
		        location.reload();
		    }
		});
	}
</script>

@endsection