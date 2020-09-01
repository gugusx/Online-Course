<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard Hafecs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/hykl.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/select2/css/select2.min.css')}}">
    <script type="text/javascript" src="{{asset('js/sweetalert2.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/stylechar.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script type="text/javascript" src="{{asset('js/utils.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/analyser.js')}}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript"></script>

    @yield('css-section')
</head>
<style>
    body{
color:#424852;
}
.hijau{
    background-color:#e67e22;
    color:#fff;

    border:none;
    }
    .hijau:hover{
    background-color:#d35400;
    color:#fff;
    }

    .hijau:focus{
    background-color:#c24d00;
    color:#fff;
    }

    .btn-sq-lg {
 width: 100px !important;
  height: 100px !important;
  font-size: 10px;
}


ul.shortcut-list {
    list-style: none;
    list-style-image: none;


    padding: 0;
    margin: 0;
    display:inline;

    color:#666666;
}

ul.shortcut-list li {
    background:url(img/habuk.png) repeat-x scroll top left #d3d3d3;
    border: 1px solid #bcbcbc;
    float: left;
    overflow:auto;


    margin: 10px 5px;
    cursor: pointer;
    border-radius: 5px 5px 5px 5px
}

ul.shortcut-list li:hover {
    background: none repeat scroll top left #e7e7e7;
    border-color: #a3a3a3
}

ul.shortcut-list li a {
    display: inline-block;
    position: relative;
    text-align: center;
    width: 117px;
    height: 68px;
    padding: 10px 5px;
    overflow: hidden
}

ul.shortcut-list li img {
    display: block;
    margin: 0 auto;
    padding-bottom: 0px;
    overflow: hidden
}

ul.shortcut-list li:hover a {
    text-decoration: none;
    height: 68px;
    top: 1px
}

</style>

@php 
    $order = DB::table('transaksi')->where('status', 0)->count();
@endphp
<body>
    <div class="col-lg-2">
        <div class="nav-side-menu">
            <div class="brand">
                <!-- E-Berkala -->
                <p>
                    <div class="user-panel" style="background:none;">
                        <div class="co-md-12">
                            <img src="{{ asset('image/icon.jpg')}}" class="img-circle tengah" alt="User Image" style="width:70px" />
                        </div>
                        <P>
                            <div class="pull-center info" style="text-align:center">
                                @php
                                $isi= Auth::user()->name;

                                $potong=substr($isi,0,10);
                                $potong=substr($isi,0,strrpos($potong,' '));
                                @endphp
                                {{$isi}} <br>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="color: #fff">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                <a href="{{asset('/auth/logout')}}" style="color:#fff">Edit</a>
                            </div>
                    </div>
            </div>
            <i class="btn btn-navbar-inverse toggle-btn" data-toggle="collapse" data-target="#menu-content">
                <span class="glyphicon glyphicon-th-large"></span>
            </i>
            <div class="menu-list">
                <ul id="menu-content" class="menu-content collapse out">
                    <li style="border:none">
                    </li>
                    <li class="
                    @if (Request::is('admin') || Request::is('filtergrafik')) 
                    active
                    @endif
                    ">
                        <a href="{{asset('admin')}}"> &nbsp
                            <span class="glyphicon glyphicon-home"></span> &nbsp Dashboard
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/appearance') ? 'active' : '' }}">
                        <a href="{{asset('admin/appearance')}}"> &nbsp
                            <span class="glyphicon glyphicon-picture"></span> &nbsp Appearance
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/admin') ? 'active' : '' }}">
                        <a href="{{asset('admin/admin')}}"> &nbsp
                            <span class="glyphicon glyphicon-user"></span> &nbsp User
                        </a>
                    </li>
                    {{-- <li class="{{ Request::is('admin/webinar') ? 'active' : '' }}">
                        <a href="{{asset('admin/webinar')}}"> &nbsp
                            <span class=" glyphicon glyphicon-globe"></span> &nbsp Webinar
                        </a>
                    </li> --}}
                    <li class="{{ Request::is('admin/order') ? 'active' : '' }}">
                        <a href="{{asset('admin/order')}}"> &nbsp
                            <span class="glyphicon glyphicon-shopping-cart"></span> &nbsp Order <sup>
                                <span class="badge badge-warning">{{$order}}</span></sup>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/modul') ? 'active' : '' }}">
                        <a href="{{asset('admin/modul')}}"> &nbsp
                            <span class="glyphicon glyphicon-book"></span> &nbsp Modul
                        </a>
                    </li>
                    <li data-toggle="collapse" data-target="#new" class="collapsed 
                    @if (Request::is('admin/kategorivideo') || Request::is('admin/video'))
                        active
                    @endif
                    }}">&nbsp
                        <span class=" glyphicon glyphicon-facetime-video"></span> &nbsp Video
                        </a>
                    </li>
                    <ul class="sub-menu collapse" id="new">
                        <li style="color:#fff"><a style="margin-left: 22px;" href="{{asset('admin/kategorivideo')}}"><span class="glyphicon glyphicon-menu-right"></span> &nbsp; Kategori Video</a></li>
                        <li style="color:#fff"><a style="margin-left: 22px;" href="{{asset('admin/video')}}"><span class="glyphicon glyphicon-menu-right"></span> &nbsp; Video</a></li>
                    </ul>
                    <li class="{{ Request::is('admin/mapel') ? 'active' : '' }}">
                        <a href="{{asset('admin/mapel')}}"> &nbsp
                            <span class="glyphicon glyphicon-list"></span> &nbsp Mapel
                        </a>
                    </li>
                    {{-- <li class="{{ Request::is('admin/forum') ? 'active' : '' }}" >
                        <a href="{{asset('admin/forum')}}"> &nbsp
                            <span class="glyphicon glyphicon-blackboard"></span> &nbsp Forum
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/pdf') ? 'active' : '' }}">
                        <a href="{{asset('admin/pdf')}}"> &nbsp
                            <span class="glyphicon glyphicon-file"></span> &nbsp Pdf
                        </a>
                    </li> --}}

                    <!-- Penambahan menu status pada dashboard admin -->
                    <li data-toggle="collapse" data-target="#status" class="collapsed">&nbsp
                        <span class=" glyphicon glyphicon-info-sign"></span> &nbsp Status
                        </a>
                    </li>
                    <ul class="sub-menu collapse" id="status">
                        <li style="color:#fff"><a style="margin-left: 22px;" href="{{asset('admin/karyakelas')}}"><span class="glyphicon glyphicon-menu-right"></span> &nbsp; Karya Kelas</a></li>
                        <li style="color:#fff"><a style="margin-left: 22px;" href="{{asset('admin/bantuan')}}"><span class="glyphicon glyphicon-menu-right"></span> &nbsp; Tiket Bantuan</a></li>
                    </ul>
                    <!-- Batas akhir penambahan -->

                    <li class="{{ Request::is('admin/help') ? 'active' : '' }}">
                        <a href="{{asset('admin/help')}}"> &nbsp
                            <span class="glyphicon glyphicon-wrench"></span> &nbsp Help
                        </a>
                    </li>
                    {{-- <li class="{{ Request::is('admin/agenda') ? 'active' : '' }}">
                        <a href="{{asset('admin/agenda')}}"> &nbsp
                            <span class="glyphicon glyphicon-calendar"></span> &nbsp Agenda
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/email') ? 'active' : '' }}">
                        <a href="{{asset('admin/email')}}"> &nbsp
                            <span class="glyphicon glyphicon-envelope"></span> &nbsp E-Mail
                        </a>
                    </li> --}}
                    {{-- <li class="{{ Request::is('admin/kode') ? 'active' : '' }}">
                        <a href="{{asset('admin/kode')}}"> &nbsp
                            <span class="glyphicon glyphicon-gift"></span> &nbsp Promo
                        </a>
                    </li> --}}
                    {{-- <li class="{{ Request::is('admin/payment') ? 'active' : '' }}">
                        <a href="{{asset('admin/payment')}}"> &nbsp
                            <span class="glyphicon glyphicon-usd"></span> &nbsp Payment
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-10 putih" style="padding: 0px;">
        {{-- <div class="row"> --}}
            {{-- <div class="col-lg-12"> --}}
                <p style="margin-top:25px;">
                    @yield('content')
            {{-- </div> --}}
        {{-- </div> --}}
        <p>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script src="{{asset('js/jquery.chained.mini.js')}}"></script>
    <script type="text/javascript">
    $("#subkategori").chained("#combokategori");
    </script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/datatables.min.js')}}"></script>
    <script src="{{asset('assets/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/select2/js/select2.full.min.js')}}"></script>

    <script src="{{asset('js/bootstrap-confirmation.min.js')}}"></script>
    <script type="text/javascript">
    var $xxx = jQuery.noConflict();
    $xxx(document).ready(function() {
        $xxx('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function(event, element) {
                element.closest('form').submit();
            }
        });
    });
 
 jQuery(function($) {
     $('.example').DataTable( {
            // serverSide: true,
            ordering: false,
            searching: true,
            paging: true,
        });
 });

//  $(document).ready(function() {
//     $('.example').DataTable({
//         "serverSide": true,
//         "paging": false,
//         "lengthChange": false,
//         "searching": false,
//         "autoFill": true,
//         "ordering": true,
//         "info": true,
//         "autoWidth": true
//     });
// });
 
  jQuery(function($) {
    $('.js-example-basic-single').select2();
  });

  jQuery(function($) {
    $('.select2').select2();
  });
  CKEDITOR.replace( 'ckeditor' );

</script>
    @yield('js-section')
</body>


</html>
