<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{asset('assets/hafecs_oc.png')}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>HAFECS Online Course</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="{{asset('assets/new/css/bootstrap.min.css')}}" rel="stylesheet" />

    <link href="{{asset('assets/new/css/animate.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/new/css/font-awesome.min.css')}}" rel="stylesheet"/>

    <link href="{{asset('assets/new/css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>

    <!--rangesliderPlugin -->
    <link href="{{asset('assets/new/rangeslider/ion.rangeSlider.css')}}" rel="stylesheet" />
    <link  href="{{asset('assets/new/rangeslider/ion.rangeSlider.skinHTML5.css')}}" rel="stylesheet">

    <link href="{{asset('assets/new/new-style.css')}}" rel="stylesheet"/>

    <link href="{{asset('assets/new/css/demo.css')}}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{asset('assets/slick/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/slick/slick-theme.css')}}">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

    <!-- style rating -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
    <link href="{{asset('assets/new/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
    <script src="{{asset('assets/new/js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

</head>
<body>
    @php
        if(!Auth::guest()) {
            $cartb = DB::table('cart')->where('user_id', Auth::user()->id)->where('stcart', '!=', '1')->count();
        }
    $notif = DB::table('notifikasi')->whereNull('read')->get();
    @endphp
<style>

.modal-body {
    max-height: calc(100vh - 180px);
    overflow-y: auto;
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


    .fancybox-content {
        height: 100%;
        width: 100%;
    }

    .dropdown {
        top: -6px;
    }

    .count-icon {
       position: absolute;left: 30px;top: 3px;
    }

    @if(Auth::guest())
    .navbar .navbar-brand {
        margin: 8px 5px 0px;
    }

    .mt-img-user {
        margin-top: -5px;
    }

    @else
    .mt-img-user {
        margin-top: -2px;
    }
    @endif

    .loader{
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url('//upload.wikimedia.org/wikipedia/commons/thumb/e/e5/Phi_fenomeni.gif/50px-Phi_fenomeni.gif') 
                  50% 50% no-repeat rgb(249,249,249);
    }

</style>

<!-- Modal untuk menampilkan histori tiket bantuan -->
<div class="modal fade" id="historitiket" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 1400px; max-width: 100%;">
    <div class="modal-content">
    @if(!Auth::guest())
    <div class="modal-header">
        <div class="modal-title">
        <div class="form form-inline"> <a style="float: right" type="button" data-toggle="modal" href="#tiketbantuan" role="button" class="btn btn-primary">Ajukan Tiket Bantuan</a>
        <h3>[{{auth()->user()->name}}]-Histori Tiket Bantuan</h3>
        </div></div>
      </div>
    @endif
      <div class="modal-body">
    <table class="table">
    <thead>
      <tr>
        <th style="text-align: center; color: black;font-size: 14px"><b>Kategori</b></th>
        <th style="text-align: center; color: black;font-size: 14px"><b>Subjek</b></th>
        <th style="text-align: center; color: black;font-size: 14px"><b>Status</b></th>
        <th style="text-align: center; color: black;font-size: 14px"><b>Tanggal & Waktu</b></th>
      </tr>
    </thead>
    <tbody>
    @php
        $bantuans = DB::table('bantuans')->get();
        @endphp
        @foreach($bantuans->sortByDesc('created_at') as $bantuan)
      <tr>
        @if(!Auth::guest() && (Auth::user()->id == $bantuan->user_id))
        <td style="text-align: center">{{$bantuan->kategori_layanan}}</td>
        <td style="text-align: justify; text-decoration: underline"><a type="button" role="button" data-toggle="modal" href="#{{$bantuan->id}}-detiltiket">{{$bantuan->subjek}}</a></td>
        <td style="text-align: center">
        @if($bantuan->status == 0)
    
                    <span class="label label-primary">Menunggu</span>
                    @elseif($bantuan->status == 2)
                    <span class="label label-info">Diproses</span>
                    @else($bantuan->status == 3)
                    <span class="label label-success">Selesai</span>
                    @endif
                    </td>
        <td style="text-align: center">{{$bantuan->created_at}}</td>
        @endif
      </tr>
        @endforeach
    </tbody>
  </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- Batas modal histori tiket bantuan -->

<!-- Modal untuk menampilkan formulir tiket bantuan -->
<div class="modal fade" id="tiketbantuan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 1400px; max-width: 100%;">
    <div class="modal-content">
    <div class="modal-header">
        <div class="modal-title" style="text-align: center"><h3>Formulir Tiket Bantuan</h3></div>
      </div>
      <div class="modal-body">
      <div class="container" >
      @if(!Auth::guest())
        <form action="{{route('storeTiketBantuan')}}" method="post" enctype="multipart/form-data">
        @csrf
        <hr>
        <div class="form-inline control-group">
                    <label class="form-control-plaintext" style="width: 150px" for="Nama">Nama</label>
                    <input class="form-control" style="width: 250px" id="Nama" name="name" type="text" value="{{auth()->user()->name}}" readonly />
                    
                   
                    <div class="controls form-inline" style="padding-top: 5px">
                    <label class="form-control-plaintext" style="width: 150px" for="Email">Alamat Email</label>
                    <input class="form-control" style="width: 250px" id="Email" name="user_email"  type="text" value="{{auth()->user()->email}}" readonly />
                    </div>
                   
                </div>
                <br>
                <div class="control-group">
                    <label class="control-label" for="Subjek">Subjek</label>
                    <div class="controls">
                        <input  class="form-control w-100" id="Subjek" name="subjek" type="text" value="" />
                    </div>
                </div>
                <br>
                <div class="form-inline control-group">
                    <label class="control-label" style="width: 150px"  for="Kategori">Kategori Layanan</label>
                    <select name="kategori_layanan" class="form-control" style="width: 250px">
                        <option value="Akun">Akun</option>
                        <option value="Modul Online Course">Modul Online Course</option>
                        <option value="Webinar">Webinar</option>
                        <option value="Karya Kelas">Karya Kelas</option>
                        <option value="Pembayaran">Pembayaran</option>
                    </select>
                  
                   
                    <div class="controls form form-inline" style="padding-top: 5px">
                    <label class="control-label" style="width: 150px" for="Prioritas">Prioritas</label>
                    <select name="prioritas" class="form-control" style="width: 250px" >
                        <option value="Tinggi">Tinggi</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Rendah">Rendah</option>
                    </select>
                    </div>
                  
                </div>
                <br>
                <div class="control-group">
                    <label class="control-label" for="Pesan">Pesan</label>
                    <div class="controls" style="padding-left: 1px">
                        <textarea class="form-control" id="summary-ckeditor" name="pesan"></textarea>
                    </div>
                </div>
                <br>
                <div class="control-group">
                    <label class="control-label" for="Lampiran">Lampiran</label>
                    <div class="controls">
                    <div class="form form-inline control-group increment" >
          <input type="file" name="lampiran[]" class="form-control" style="width: 450px">
            <button class="btn btn-success add" type="button"><i class="glyphicon glyphicon-plus"></i>Tambah</button>
        </div>
        <div class="clone hide">
          <div class="form form-inline clone-form" style="margin-top:10px">
            <input type="file" name="lampiran[]" class="form-control" style="width: 450px">
              <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i>Hapus</button>
          </div>
        </div>
        <h5 style="font-style: italic">Ekstensi file yang diizinkan: .jpg, .jpeg, .png, .zip, .rar, .gz, .7z, .txt, .doc, .docx, .pdf </h5>
                    </div>
                </div>
<br>
              <hr>  <div class="control-group">
              <div class="form form-inline" style="text-align: center">
        <button type="submit" class="btn btn-primary" style="width: 100px">Kirim</button>
        <button type="button" class="btn btn-secondary" style="width: 100px" data-dismiss="modal">Batal</button>
        </div> 
        </div>
        @include('sweetalert::alert')
        </form>
        @endif
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Batas modal formulir tiket bantuan -->

<!-- Modal untuk menampilkan detil histori tiket bantuan -->
@php
$bantuans = DB::table('bantuans')->get();
@endphp
@foreach($bantuans as $bantuan)
    @if(!Auth::guest())
<div class="modal fade" id="{{$bantuan->id}}-detiltiket" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 1400px; max-width: 100%;">
    <div class="modal-content">
    <div class="modal-header">
        <div class="modal-title">
        <h4><b>Subjek:</b> {{$bantuan->subjek}}</h4>
        </div>
    </div>
    <div class="modal-body">
    <div class="container" style="padding-left: 15px; padding-right:15px">
        <hr>
        <div class="control-group">
        <div class="col-md-2">
            <img class="avatar" src="{{asset(auth()->user()->gambar)}}" width="25%">
            <label class="control-label" for="Nama">{{auth()->user()->name}}</label>
		</div>        
        </div>
        <br><br><br>
                <br>
                <div class="control-group">
                    <label class="control-label" for="Pesan" style="text-decoration: underline">Pesan</label>
                    <div class="controls">
                    <div class="card">
                    {!!$bantuan->pesan!!}
                    </div>
                    </div>
                </div>
                <hr>

                @php
        $balasans = DB::table('balasan_pesans')->get();
        @endphp
        @foreach($balasans as $balasan)
        @if($balasan->pesan_id == $bantuan->id)
<br>
<div class="control-group">
        <div class="col-md-2">
            <img class="avatar" src="{{auth()->user()->gambar}}" width="25%">
            <label class="control-label" for="Nama">{{auth()->user()->name}}</label>
		</div>        
        </div>
        <br><br><br>
                <br>
               
<div class="control-group">
                    <label class="control-label" for="Pesan" style="text-decoration: underline">Balasan Pesan</label>
                    <div class="controls">
                    <div class="card">
                    {!!$balasan->balasan_pesan!!}
                    </div>
                    </div>
                </div>
                @else
                <p style="text-align: center;font-size: 20px;"><b> Tidak ada balasan</b></p>
                @endif
@endforeach
<hr>
                <div class="col text-center">
                <a type="button" data-toggle="modal" href="#balaspesan" role="button" class="btn btn-primary">Balas Pesan</a>
                </div>
<br>
              <hr>  <div class="control-group">
              <div class="form form-inline" style="text-align: center">
        <button type="button" class="btn btn-secondary" style="width: 100px" data-dismiss="modal">Batal</button>
        </div> 
        </div>
        </div>
    </div>
    </div>
  </div>
</div>
@endif
@endforeach
<!-- Batas modal detil histori tiket bantuan -->

<!-- Modal untuk menampilkan kolom balasan pesan -->
@php
        $bantuans = DB::table('bantuans')->get();
        @endphp
@foreach($bantuans as $bantuan)
<div class="modal fade" id="balaspesan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 1400px; max-width: 100%;">
    <div class="modal-content">
      <div class="modal-body">
      <div class="container" style="padding-left: 15px; padding-right:15px">
      @if(!Auth::guest())
        <form action="{{route('storeBalasanPesan', $bantuan->id )}}" method="post" enctype="multipart/form-data">
        @csrf
        <hr>
        <div class="form-inline control-group">
                    <label class="form-control-plaintext" style="width: 150px" for="Nama">Nama</label>
                    <input class="form-control" style="width: 250px" id="Nama" name="name" type="text" value="{{auth()->user()->name}}" readonly />
                    
                   
                    <div class="controls form-inline" style="padding-top: 5px">
                    <label class="form-control-plaintext" style="width: 150px" for="Email">Alamat Email</label>
                    <input class="form-control" style="width: 250px" id="Email" name="user_email"  type="text" value="{{auth()->user()->email}}" readonly />
                    </div>
                   
                </div>
               
                <br>
                <div class="control-group">
                    <label class="control-label" for="Pesan">Pesan</label>
                    <div class="controls" style="padding-left: 1px">
                        <textarea class="form-control" id="summary-ckeditor-balas" name="balasan_pesan"></textarea>
                    </div>
                </div>
                <br>
                <div class="control-group">
                    <label class="control-label" for="Lampiran">Lampiran</label>
                    <div class="controls">
                    <div class="form form-inline control-group increment" >
          <input type="file" name="lampiran[]" class="form-control" style="width: 450px">
            <button class="btn btn-success add" type="button"><i class="glyphicon glyphicon-plus"></i>Tambah</button>
        </div>
        <div class="clone hide">
          <div class="form form-inline clone-form" style="margin-top:10px">
            <input type="file" name="lampiran[]" class="form-control" style="width: 450px">
              <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i>Hapus</button>
          </div>
        </div>
        <h5 style="font-style: italic">Ekstensi file yang diizinkan: .jpg, .jpeg, .png, .zip, .rar, .gz, .7z, .txt, .doc, .docx, .pdf </h5>
                    </div>
                </div>
<br>
              <hr>  <div class="control-group">
              <div class="form form-inline" style="text-align: center">
        <button type="submit" class="btn btn-primary" style="width: 100px">Kirim</button>
        <button type="button" class="btn btn-secondary" style="width: 100px" data-dismiss="modal">Batal</button>
        </div> 
        </div>
        @include('sweetalert::alert')
        </form>
        @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- Batas modal balasan pesan -->

<div class="wrapper">
    <div class="sidebar">
    	<div class="sidebar-wrapper">
            <div class="logo hidden-xs">
                <a href="#" class="simple-text">
                    <img src="{{ asset('logo.png')}}" alt="Logo" width="120px">
                </a>
            </div>

            @if (!(Auth::guest()))

            <div class="card card-user bg-blue">
                <div class="image">
                </div>
                <div class="content">
                    <div class="author">
                         <a href="{{asset('/profile')}}">
                        <img class="avatar" src="{{asset((auth()->user()->gambar))}}" alt="..." />

                          <h5 class="text-white">{{auth()->user()->name}}<br />
                             {{-- <small class="text-white">{{auth()->user()->profesi}}</small> --}}
                          </h5>
                        </a>
                    </div>
                    <p class="description text-center"> 
                        <span class="badge badge-warning">{{auth()->user()->profesi}}</span>
                    </p>
                </div>
                <div class="panel-footer bottom-user">
                    <div class="text-center">
                        <a href="{{asset('/profile')}}"><i class="fa fa-user-circle"></i></a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-help stack-card">
                <div class="panel-body">
                     <p class="text-stack">{{(Auth::user()->instansi == '') ? '-' :  Auth::user()->instansi}}</p>
                </div>
            </div>

            @endif

            <ul class="nav">
                @if (Auth::guest())
                <li class="hidden-lg">
                    <a href="{{asset('/login')}}">
                        <i class="fa fa-sign-in"></i>
                        <p>Login</p>
                    </a>
                </li>
                @endif
                <li class="{{ Request::is('home') ? 'active' : '' }}">
                    <a href="{{asset('/home')}}">
                        <i class="pe-7s-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="{{ (Request::is('about')  || $pageLink == 'about') ? 'active' : '' }}">
                    <a href="{{asset('/about')}}">
                        <i class="pe-7s-users"></i>
                        <p>About</p>
                    </a>
                </li>
                <li class="{{ (Request::is('course')  || $pageLink == 'course') ? 'active' : '' }}">
                    <a href="{{asset('/course')}}">
                        <i class="pe-7s-video"></i>
                        <p>Course</p>
                    </a>
                </li>
                <li class="{{ (Request::is('webinar') || $pageLink == 'webinar') ? 'active' : '' }}">
                    <a href="{{asset('/webinar')}}">
                        <i class="pe-7s-monitor"></i>
                        <p>Webinar</p>
                    </a>
                </li>
              
                <li class="{{ (Request::is('sharing') || $pageLink == 'sharing') ? 'active' : '' }}">
                    <a href="{{route('sharing')}}">
                        <i class="pe-7s-light"></i>
                        <p>Sharing <br>for Knowledge</p>
                    </a>
                </li>
                <li class="{{ (Request::is('help') || $pageLink == 'help') ? 'active' : '' }}">
                    <a href="{{asset('/help')}}">
                        <i class="pe-7s-help1"></i>
                        <p>Helpdesk</p>
                    </a>
                </li>
            @if (!(Auth::guest()))
                @if (auth()->user()->level != 'Premium' && auth()->user()->tgl_expired < date('Y-m-d') && !Request::is('upgrade'))
				<li class="active hidden">
                    <a href="{{asset('/upgrade')}}" class="uppro">
                        <i class="pe-7s-rocket"></i>
                        <p>Upgrade to Premium</p>
                    </a>
                </li>
                @endif
            @endif

            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-light fixed-nav-bar" style="background-color: white; border-bottom: 1px solid gainsboro;">
            <div class="container-fluid">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div style="display: flex;" class="hidden-lg hidden-md hidden-sm">
                    <ul class="nav" style="padding-top: 10px;">
                        @if (!Auth::guest())
                        <li class="dropdown" style="top: unset;">
                            <a href="{{asset('/cart')}}" class="top-icon">
                                <i style="font-size: 25px;" class="pe-7s-cart bottom" 
                                data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Keranjang"></i>
                                <span class="count-icon badge badge-warning">{{$cartb}}</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                    <a class="navbar-brand hidden-lg 
                @if (Auth::guest())
                ml-0
                @else 
                m-auto
                @endif
                    " href="#">
                        <img src="{{ asset('logo.png')}}" class="mt-img-user" alt="Logo" width="120px"></a>
                    </div>
                    <form action="{{asset('' . Request::segment(1) . '/query' )}}" method="get">
                        <input type="text" name="cari" value="{{ (!empty($_GET['cari'])) ? $_GET['cari'] : '' }}" class="form-control top-search navbar-brand hidden-xs icon-input" id="iconified" placeholder="&#xF002;" style="padding-top: 11px;">
                    </form>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right hidden-xs hidden-sm">
                        @if (Auth::guest())
                        <li class="dropdown">
                            <a href="{{asset('login')}}" class="text-hafecs" style="font-weight: 600;">
                                <i class="fa fa-sign-in mr-2"></i>Login</a>
                        </li>
                        <li class="dropdown">
                       <a href="{{asset('register')}}" class="text-hafecs" style="font-weight: 600;">
                        <i class="fa fa-user-plus mr-2"></i>Register</a>
                        </li>
                        @else
                        <li class="dropdown">
                            <a href="{{asset('mycourse')}}" class="top-icon pr-0">
                                <i style="font-size: 25px;" class="pe-7s-video bottom" 
                                data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Kursus Saya"></i>
                                <span class="count-icon"></span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#!" class="top-icon pr-0 dropdown-toggle" data-toggle="dropdown">
                                <i style="font-size: 25px;" class="pe-7s-bell bottom" 
                                data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Notifikasi"></i>
                                <span class="count-icon badge badge-info">{{($notif->count() > 0) ? $notif->count() : '' }}</span>
                            </a>

                            <ul class="dropdown-menu" style="border-radius: 3px; padding: 10px;">
                                
                                @if($notif->count() == 0)
                                <li class="text-center"><a>Tidak ada notifikasi</a></li>
                                @else
                                @foreach($notif as $d)
                                <li>
                                    <a onclick="openNotif({{$d->id}})" href="{{asset($d->link)}}">
                                    <i class="fa fa-angle-right mr-2"></i>{{$d->notif}}</a>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="{{asset('/cart')}}" class="top-icon">
                                <i style="font-size: 25px;" class="pe-7s-cart bottom" 
                                data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Keranjang"></i>
                                <span class="count-icon badge badge-warning">{{$cartb}}</span>
                            </a>
                        </li>

                        <!-- Button untuk menampilkan fungsi bantuan -->
                        <li class="dropdown">
                            <a data-toggle="modal" href="#historitiket" role="button" aria-expanded="false" class="top-icon pr-0">
                                <i style="font-size: 25px;" class="pe-7s-help1 bottom" 
                                data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Bantuan"></i>
                                <span class="count-icon"></span>
                            </a>
                        </li>
                        @endif
                     
                    </ul>
                </div>
            </div>
            @if(!(Request::is('home')))
            <div class="hidden-lg form-mobile">
            <form action="{{asset('' . Request::segment(1) . '/query' )}}" method="get" style="display: contents;">
                <i data-feather="arrow-left" onclick="close_form()" class="m-auto"></i>
                <input type="text" class="form-control ml-2 form-mobile-2" name="cari" value="{{ (!empty($_GET['cari'])) ? $_GET['cari'] : '' }}" style="width: 85%" placeholder="Telusuri...">
            </form>
            </div>
            <div class="wrap-top-back hidden-lg hidden-md">
                <a href="{{ url()->previous() }}">
                <div class="icon-back-top">
                    <i data-feather="arrow-left"></i>
                </div>
                </a>
                <p class="text-back-top">Kembali</p>
                <a class="ml-auto" href="#" onclick="open_form()"><i data-feather="search"></i></a>
                {{-- @if(Request::is('sharing'))
                <a class="ml-auto" href="{{asset('profile')}}"><i data-feather="upload"></i></a>
                @endif --}}
            </div>
            @endif
        </nav>

        <script>
            @if(!empty($_GET['cari']))
            $(".form-mobile").show();
            $(".wrap-top-back").hide();
            @else 
            $(".form-mobile").hide();
            @endif
            function open_form() {
                $(".wrap-top-back").slideUp();
                $(".form-mobile").slideDown();
            }

            function close_form() {
                $(".wrap-top-back").slideDown();
                $(".form-mobile").slideUp();
            }
        </script>

        @if(Request::is('home'))
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
        @endphp

        <div class="hidden-lg">
            <center>
              {{-- <img src="http://kursus.hafecs.id/image/BetaBanner.jpg" style="width: 100%" class="img-responsive"> --}}
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="top: 60px;">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @foreach ($images as $i => $x)
                        @if ($i == 0)
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        @else
                        <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"></li>
                        @endif
                    @endforeach
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    @foreach ($images as $i => $img)
                        @if ($i == 0)
                        <div class="item active">
                            <img src="{{ asset('../public/slides/'.$img) }}" alt="Image">
                            <div class="carousel-caption">
                              {{-- caption here --}}
                            </div>
                        </div>
                        @else
                        <div class="item">
                            <img src="{{ asset('../public/slides/'.$img) }}" alt="Image" style="width: 100%;">
                            <div class="carousel-caption">
                              {{-- caption here --}}
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </center>
        </div>
        @endif

        <div class="pd-nav {{ Request::is('home') ? 'pt-home' : '' }}">
            {{ Request::is('home') ? '' : '' }}
            <div class="container-fluid">
                <div class="hidden-lg">
                    <br>
                </div>
                @yield('content')
            </div>
        </div>
        <div class="css-hafecs-mb hidden-lg">
            <div class="css-wrap-mb">
                <div class="css-wrap-item">
                <a href="{{asset('home')}}">
                    <i class="glyphicon glyphicon-home icon-text {{ Request::is('home') ? 'active-menu' : '' }}"></i>
                </a>
                </div>
                <p class="css-text-mb {{ Request::is('home') ? 'active-menu' : '' }}">Home</p>
            </div>
            <div class="css-wrap-mb">
                <div class="css-wrap-item">
                <a href="{{asset('about')}}">
                    <i class="glyphicon glyphicon-user icon-text {{ Request::is('about') ? 'active-menu' : '' }}"></i>
                </a>
                </div>
                <p class="css-text-mb {{ Request::is('about') ? 'active-menu' : '' }}">About</p>
            </div>
            <div class="css-wrap-mb">
                <div class="css-wrap-item">
                <a href="{{asset('course')}}">
                    <i class="glyphicon glyphicon-book icon-text {{ Request::is('course') ? 'active-menu' : '' }}"></i>
                </a>
                </div>
                <p class="css-text-mb {{ Request::is('course') ? 'active-menu' : '' }}">Course</p>
            </div>
            <div class="css-wrap-mb">
                <div class="css-wrap-item">
                <a href="{{asset('webinar')}}">
                    <i class="glyphicon glyphicon-blackboard icon-text {{ Request::is('webinar') ? 'active-menu' : '' }}"></i>
                </a>
                </div>
                <p class="css-text-mb {{ Request::is('webinar') ? 'active-menu' : '' }}">Webinar</p>
            </div>
            <div class="css-wrap-mb">
                <div class="css-wrap-item">
                <a href="{{asset('sharing')}}">
                    <i class="glyphicon glyphicon-facetime-video icon-text {{ Request::is('sharing') ? 'active-menu' : '' }}"></i>
                </a>
                </div>
                <p class="css-text-mb {{ Request::is('sharing') ? 'active-menu' : '' }}">Sharing</p>
            </div>
        </div>

    </div>
</div>
@if (!Auth::guest())
@if (auth()->user()->level != 'Premium' && auth()->user()->tgl_expired < date('Y-m-d') && !Request::is('upgrade'))
<footer class="hidden fixed-bottom mobile-premium">
    <div class="card-footer" style="height: 50px; background: crimson;">
        <p style="padding-top: 10px; color: white;" class="text-center">Belajar dari trainers terbaik 
        <a href="{{asset('/upgrade')}}" class="btn btn-white btn-sm">
        <span class="glyphicon glyphicon-arrow-up"></span> Upgrade ke Premium</a></p>
    </div>
</footer>
@endif
@endif

</body>

    <!--   Core JS Files   -->
	<script src="{{asset('assets/new/js/bootstrap.min.js')}}" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="{{asset('assets/new/js/chartist.min.js')}}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{asset('assets/new/js/bootstrap-notify.js')}}"></script>

    <!--Rang slider -->
    <script src="{{asset('assets/new/rangeslider/ion.rangeSlider.js')}}"></script>
    <script src="{{asset('assets/new/js/rangeslider.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    @yield('js-section')


    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="{{asset('assets/new/js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="{{asset('assets/new/js/demo.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" type="text/javascript" charset="utf-8"></script>
    <script>

        $(function(){
            $('.bottom').tooltip();
            $("#left").tooltip({
                placement: "left",
                title: "tooltip on left"
            });
        });

    $(".regular").slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4, 
        responsive: [
          {
            breakpoint: 1024,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: true,
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
    });

    feather.replace()

    $('#iconified').on('keyup', function() {
        var input = $(this);
        if(input.val().length === 0) {
            input.addClass('icon-input');
        } else {
            input.removeClass('icon-input');
        }
    });

    function openNotif(id) {
        $.ajax({
            type: 'post',
            url: '{{asset('edit_notif')}}',
            data: {
                "_token" : "{{ csrf_token() }}",
                "id" : id,
            }, success: function(data) {
                console.log(data);
            }
        })
    }

    $(document).ready(function() {
        $('.select2').select2();
    });
    </script>

<!-- Ckeditor -->
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'summary-ckeditor' );
    CKEDITOR.replace( 'summary-ckeditor-balas' );
</script>

<!-- Lampiran -->
<script type="text/javascript">

    $(document).ready(function() {

      $(".add").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".remove",function(){ 
          $(this).parents(".clone-form").remove();
      });

    });

</script>

</html>
