@extends('layouts.user')
@section('content')

<div class="card mb-6">
	<div class="panel-body">
		<ol class="breadcrumb" style="background-color: white; margin-bottom: 0; padding: 0;">
		  <li><a href="{{asset('/home')}}" style="color: black;"><i class="fa fa-home"></i></a></li>
		  <li class="active"><a class="text-secondary" href="#">Kursus Saya</a></li>
		</ol>	
	</div>
</div>

@if($modul->count() > 0)
<div class="row">
	{{-- Modul Saya --}}
    @foreach($modul as $md)

    @php

      $vd = DB::table('video')
      ->join('Kategorivideo', 'video.kategorivideo_id', '=', 'Kategorivideo.id')
      ->where('Kategorivideo.modul_id', $md->id)
      ->orderBY('list', 'asc');

      $rd = DB::table('read')
      ->join('video', 'video_id', '=', 'video.id')
      ->join('Kategorivideo', 'video.kategorivideo_id', '=', 'Kategorivideo.id')
      ->where('Kategorivideo.modul_id', $md->id)
      ->where('read.user_id', Auth::user()->id)
      ->orderBY('list', 'asc');

      $percent = ($rd->count() / $vd->count()) * 100;


    @endphp

      <div class="col-md-3">
        <div class="card card-other">
          <div class="work-box2">
            <a href="{{asset('video/show/' . $vd->first()->list . '/' . $md->id )}}">
              <div class="work-img">
                <img src="{{ asset($md->gambar) }}" class="img-thumbnail br-top-img" />
              </div>
            </a>
          </div>
          <div class="panel-body" style="height: 140px">
            <a href="{{asset('video/show/' . $vd->first()->list . '/' . $md->id )}}" class="text-dark">
              <p class="mt-0 mb-0"><b>
              	@if(strlen($md->judul) > 45)
              	{{ substr($md->judul, 0, 45) . "..." }}
              		@else
              	{{$md->judul}}
              	@endif
              </b></p>
            </a>
            <span class="text-small">{{$md->nm_trainer}} / {{$md->jabatan}}</span>
            <div class="progress mt-5 mb-1" style="height: 3px;">
			  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40"
			  aria-valuemin="0" aria-valuemax="100" style="width:{{$percent}}%">
			  </div>
			</div>
			<span class="text-smaller">{{number_format($percent, 0)}}% Complete (success)</span>
          </div>
        </div>
      </div>
    @endforeach
    {{-- End --}}
</div>
@else
<div class="card">
	<div class="panel-body">
	<h3 class="text-center">~Tidak ada kursus~</h3>
	</div>
</div>
@endif

@endsection