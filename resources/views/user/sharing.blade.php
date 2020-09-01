@extends('layouts.user')
@section('content')
@php

function tgl($date) {
      $BulanIndo = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];

      $tahun  = substr($date, 0, 4);
      $bulan  = substr($date, 5, 2);
      $tgl    = substr($date, 8, 2);
      $result = $tgl . "-" . $BulanIndo[(int) $bulan - 1] . "-" . $tahun;
      return ($result);
}

function convertYoutube($string) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "<iframe class='border-0' src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
        $string
    );
}

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
@endphp
<div class="row">
    <div class="col-xs-12 col-md-6">
        <h4 class="title-type mt-2">Sharing for Knowledge</h4>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="float-right">
            <a href="{{asset('profile')}}" class="btn btn-indigo btn-sm hidden-xs hidden-sm" style="font-size: 17px">
            Upload</a>
        </div>
    </div>
</div>
<style>
iframe {
	height: 100%;
	width: 100%;
}
hr {
    margin-top: 0px;
    margin-bottom: 10px;
}
</style>
<!-- video-testimonial-section -->

<div class="row">
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
                    <div class="col-xs-9 col-md-9 pl-0">
                        <h5 class="text-dark mt-0 mb-1">
                            <a data-fancybox href="{{$d->embed}}" class="text-dark hidden-lg hidden-md">{{$d->judul}}</a>
                            <a href="{{route('detailsharing', ['id' => $d->id])}}" class="text-dark hidden-xs">
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

{{ $sfk->links() }}

@endsection