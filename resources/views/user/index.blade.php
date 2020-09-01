@extends('layouts.user')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.css')}}">
<script type="text/javascript"  src="{{asset('js/sweetalert2.min.js')}}"></script>
@include('sweet::alert')

@php
$images = [];
$dir = public_path('slides');
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
        if ($file != '.' && $file != '..') {
            $images[] = $file;
        }
    }
    closedir($dh);
  }
}
sort($images);

function parse($url) {
    parse_str( parse_url( $url, PHP_URL_QUERY ), $parseurl );
    return $parseurl['v'];
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function convertYoutube($string) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "<iframe class='border-0' src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
        $string
    );
}
@endphp

<style>
iframe {
	height: 100%;
	width: 100%;
	border-radius: 15px;
}
hr {
    margin-top: 0px;
    margin-bottom: 10px;
}
</style>

<div class="row hidden-xs">
    <div class="col-md-12">

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            @foreach ($images as $i => $x)
                @if ($i == 0)
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                @else
                <li data-target="#myCarousel" data-slide-to="{{ $i }}"></li>
                @endif
            @endforeach
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner border-radius-20">
                @foreach ($images as $i => $img)
                @if ($i == 0)
                <div class="item active">
                  <img src="{{ asset('../slides/'.$img) }}" alt="" style="width: 100%;">
                </div>
                @else
                <div class="item">
                  <img src="{{ asset('../slides/'.$img) }}" alt="" style="width: 100%;">
                </div>
                @endif
                @endforeach
          </div>

          <!-- Left and right controls -->
          <a class="left carousel-control border-radius-20" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control border-radius-20" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    </div>
</div>

<br>
<div class="row">
    <div class="col-md-6">
        <h3 class="title-type">Mini Course</h3>
    </div>
    <div class="col-md-6">
        <h3 class="title-type hidden-xs">Online Certification</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-6 border-right">
        <div class="row">
        @foreach($mini as $d)
            <div class="col-md-6">  
                <div class="work-box">
                  <a href="{{asset('modul/'.$d->id.'/show')}}">
                    <div class="work-img">
                      <img src="{{ asset($d->gambar)}}" class="img-thumbnail br-img" />
                    </div>
                  </a>
                </div>
                <p><b>{{$d->judul}}</b></p>
            </div>
        @endforeach
        <div class="col-md-6">
            <div class="work-box">
              <a href="{{asset('course/kategori?ktg=' . $mini->first()->kategori_modul . '')}}">
                <div class="work-img">
                  <img src="{{ asset('assets/more.png')}}" class="img-thumbnail br-img" />
                </div>
              </a>
            </div>
        </div>
        </div>
    </div>

    <div class="col-md-6">
        <h3 class="title-type hidden-lg hidden-md" style="margin-top: 30px;">Online Certification</h3>
        <div class="row">
        @foreach($cer as $d)
        <div class="col-md-6">
            <div class="work-box">
              <a href="{{asset('modul/'.$d->id.'/show')}}">
                <div class="work-img">
                  <img src="{{ asset($d->gambar)}}" class="img-thumbnail br-img" />
                </div>
              </a>
            </div>
            <p><b>{{$d->judul}}</b></p>
        </div>
        @endforeach
        <div class="col-md-6">
            <div class="work-box">
              <a href="{{asset('course/kategori?ktg=' . $cer->first()->kategori_modul . '')}}">
                <div class="work-img">
                  <img src="{{ asset('assets/more.png')}}" class="img-thumbnail br-img" />
                </div>
              </a>
            </div>
        </div>
        </div>
    </div>
</div>

<h3 class="title-type title-mapel">Jelajahi Berdasarkan Mata Pelajaran</h3>
<?php 
    $color  = ["blue", "green", "purple", "yellow", "red"]; 
    $random = array_rand($color, 2);
?>
<div class="row">
    <div class="col-md-12">
        @foreach($mapel as $d)
            <a href="{{asset('course/kategori?mapel=' . $d->id . '')}}" class="btn btn-blue mr-3 mb-4 shadow-btn border-10">{{$d->nm_mapel}}</a> 
        @endforeach
        <a href="#!" class="btn btn-indigo mr-3 mb-4 shadow-btn border-10">Lainnya</a> 
    </div>
</div>

<h3 class="title-type mb-5 mt-5">Terbaru di Sharing for Knowledge</h3>
<div class="row mb-5">
@foreach($sfk as $d)
    <div class="col-md-3">
        <div class="card card-other">
            <a data-fancybox href="{{$d->embed}}">
                <i class="fa fa-play-circle icon-play"></i>
                <img class="br-top-img" style="height: 100%; width: 100%;" src="https://img.youtube.com/vi/{{parse($d->embed)}}/sddefault.jpg" alt="">
            </a>
            <div class="panel-body" style="height: 100px;">
                <div class="row">
                    <div class="col-xs-3 col-md-3">
                        <img src="{{asset(($d->gambar))}}" class="img-thumbnail" alt="">
                    </div>
                    <div class="col--xs-9 col-md-9 pl-0">
                        <h5 class="text-dark mt-0 mb-1">
                            <a data-fancybox href="{{$d->embed}}" class="text-dark hidden-lg hidden-md">{{$d->judul}}</a>
                            <a href="{{asset('sharing/video/' . $d->id)}}" class="text-dark hidden-xs">
                                @if(strlen($d->judul) > 30)
                                {{ substr($d->judul, 0, 30) . "..." }}
                                    @else
                                {{$d->judul}}
                                @endif
                            </a>
                        </h5>
                        <span class="text-smaller">{{$d->name}} / {{time_elapsed_string($d->created_at)}}</span> 
                    </div>
                </div>
            </div>
        </div>

    </div>
@endforeach
</div>

@endsection