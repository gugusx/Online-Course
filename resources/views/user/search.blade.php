@extends('layouts.user')
@section('content')

@php
	function rp($angka) {
      $rp = "Rp. " . number_format($angka, 0, ',', '.');
      return $rp;
    }
@endphp

<div class="row">
	@if($modul->count() > 0)

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
			    @else 
			    <br>
			    <br>
			    <span class="badge badge-primary">Mini Courses</span>
			    @endif
	      	</div>
	    </div>
	</div>

@endforeach

@else 
	<div class="col-md-12">
		<div class="card">
			<div class="panel-body">
				<h3 class="text-center mt-2">~ Course tidak ditemukan ~</h3>
			</div>
		</div>
	</div>
@endif
</div>

@endsection