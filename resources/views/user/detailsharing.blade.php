@extends('layouts.user')
@section('content')
<style>
	h4 {
		margin: 0px;
	}
</style>
@php
function parse($url) {
    parse_str( parse_url( $url, PHP_URL_QUERY ), $parseurl );
    return $parseurl['v'];
}

function tgl($created_at) {

	$dt 	= new DateTime($created_at);
	$date 	= $dt->format('Y-m-d');

	$BulanIndo = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];

	$tahun  = substr($date, 0, 4);
	$bulan  = substr($date, 5, 2);
	$tgl    = substr($date, 8, 2);
	$result = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun;
	return ($result);
}

function convertYoutube($string) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "<iframe class='border-0' src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
        $string
    );
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
<style>
.iframe-spec > iframe {
	height: 450px;
}
iframe {
	width: 100%;
}
hr {
    margin-top: 0px;
    margin-bottom: 10px;
}

.icon-play {
    position: absolute;
    color: #fff;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    top: 33%;
    left: 50%;
    font-size: 45px;
    opacity: .8;
    text-shadow: 0px 0px 30px rgba(0, 0, 0, 0.5);
}
</style>
<div class="row">
	@foreach($sfk_v as $d)
	@php   
	    $url = $d->embed;
	    parse_str( parse_url( $url, PHP_URL_QUERY ), $parseurl );
	    $parse = $parseurl['v'];
	@endphp
	<div class="col-md-12">
        <div class="iframe-spec">
            <iframe src="//www.youtube.com/embed/{{$parse}}/?rel=0&amp;autoplay=1" frameborder="0" allowfullscreen></iframe>
        </div>
		
		<div class="mt-5">
            <div class="card">
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-3 col-md-1">
						<img src="{{asset(($d->gambar))}}" class="img-thumbnail" style="border-radius: 50%" alt="">
					</div>
					<div class="col-xs-9 col-md-11 pl-0">
						<h4 class="text-dark">{{$d->judul}}</h4>
						<span>{{$d->name}} / {{tgl($d->created_at)}}</span>
					</div>
				</div>
			</div>
            </div>
		</div>
		
	</div>
	@endforeach
</div>

<h4 class="title-type">Video Lainnya</h4>
<hr>
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
                        <span>{{$d->name}}</span> / {{time_elapsed_string($d->created_at)}}
                    </div>
                </div>
        	</div>
        </div>

    </div>
	@endforeach
</div>
@endsection