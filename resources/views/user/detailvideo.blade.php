@extends('layouts.user')
@section('content')
@include('sweet::alert')

<style>
    .more-link {
        color: #2F4389;
    }

    .more-link:hover {
        color: #2F4389;
    }

    .less-link {
        color: #2F4389;
    }

    .less-link:hover {
        color: #2F4389;
    }

    .sticky {
        position: sticky;
        position: -webkit-sticky;
        top: 15px;
    }

    .row {
        display: unset;
    }
</style>

@php
function rp($angka)
{
  $rp = "Rp. " . number_format($angka, 0, ',', '.');
  return $rp;
}

function tgl($created_at) {

    $dt     = new DateTime($created_at);
    $date   = $dt->format('Y-m-d');

    $BulanIndo = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];

    $tahun  = substr($date, 0, 4);
    $bulan  = substr($date, 5, 2);
    $tgl    = substr($date, 8, 2);
    $result = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun;
    return ($result);
}

function strtime($time) {
    return substr($time, 3, 5);
}

function minutes($seconds) {
    return sprintf("%02.2d", floor($seconds / 60), $seconds % 60);
}

$vd = DB::table('video')
      ->join('Kategorivideo', 'video.kategorivideo_id', '=', 'Kategorivideo.id')
      ->where('Kategorivideo.modul_id', $modul->id)
      ->orderBY('list', 'asc');

@endphp
<div class="row">
    <div class="col-md-12">
        <h3 class="mt-0" align="center">{{$modul->judul}}</h3>
        <hr>
    </div>
    <div class="col-md-7">
        <div class="work-box">
            <div class="work-img">
            <a href="{{asset('video/show/' . $vd->first()->list . '/' . $modul->id )}}">
              <img src="{{ asset($modul->gambar)}}" class="img-thumbnail border-radius-20" />
            </a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4 text-center pt-3">
                <img src="{{asset($trainers->gambar)}}" style="border-radius: 50%; height: 120px;" class="img-thumbnail mb-2" alt="">
                <br>
                <a href="{{asset('/modul/' . $modul->id . '/show/trainer')}}">
                <b>{{$trainers->nm_trainer}}</b><br>
                </a>
                <span>{{$trainers->jabatan}}</span>
            </div>
            <div class="col-md-8 text-justify pt-3">
                <div class="readmore">
            <!--    {!!html_entity_decode($modul->isi)!!} --> Biografi singkat trainer
                </div>
            </div>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-expander/1.7.0/jquery.expander.js"></script>
        <script type="text/javascript">
            $(".readmore").expander({
                  slicePoint : 301,
                  expandText: 'More',
                  userCollapseText : 'Less'
            });
        </script>
        <div class="row mt-4">
            <div class="col-md-12 pl-0 pr-0">
                <div class="accordion" id="accordion2">
                @foreach($kategorivideo as $r)

                  <div class="accordion-group panel panel-light border-radius-5" style="margin-bottom: 7px;">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="text-dark" data-toggle="collapse" href="#collapse{{$r->id}}">
                                {{$r->kategori}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{$r->id}}" class="accordion-body collapse">
                      <div class="panel-body">
                        @php
                        $n = 1;
                        @endphp
                        <ul class="list-group">
                            @foreach($video->where('kategorivideo_id', $r->id) as $x)
                            <a style="display: flex;" 
                                @if($x->stat == 'Premium' && $cekmod == 0)
                                        onclick="warningLock()" 
                                        href="#!"
                                @else 
                                href="{{asset('video/show/' . $x->list . '/' . $modul->id)}}"
                                @endif class="list-group-item">

                                @if(!Auth::guest() && $cekmod > 0)
                                @php
                                    $ccread = $cread->where('video_id', $x->id)->count();
                                @endphp

                                    @if($ccread > 0)
                                    <span class="glyphicon glyphicon-ok mr-4 mtb-auto" style="color: green"></span>
                                    @else
                                    <span class="glyphicon glyphicon-film mr-4 mtb-auto"></span>
                                    @endif
                                @else
                                <span class="glyphicon glyphicon-film mr-4 mtb-auto"></span>
                                @endif
                                
                                <span class="mtb-auto">{{$x->judul}}</span>

                                @if($x->stat == 'Premium' && $cekmod == 0) 
                                    <i class="fa fa-lock ml-auto mtb-auto"></i>
                                @else
                                    <p class="ml-auto text-smaller mtb-auto">{{strtime($x->durasi)}}</p>
                                @endif

                            </a>
                            <?php $n++?>
                            @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>

                @endforeach
                </div>
            </div>
        </div>

    </div>
    <div class="sticky col-md-5" style="margin-bottom: 30px;text-align:justify">
        <div class="card mb-3">
            <div class="panel-body">
                @if($modul->sertifikat == 1)
                <div class="text-center">
            
            @if($cekmod == 0)
                <h4 class="m-0"><b>{{rp($modul->harga)}}</b></h4>
                @if(Auth::guest())
                <button id="sertif-guest" class="btn btn-hijau btn-block shadow-lg">Beli Sertifikat ini</button>
                @else
                <button class="btn btn-hijau btn-block shadow-lg" 
                id="btn-add-cart-{{$modul->id}}" onclick="addcart({{$modul->id}}, {{Auth::user()->id}})">Beli Sertifikat ini</button>
                @endif
            @else
            {{-- <a href="{{asset('video/show//' . $modul->id)}}" class="btn btn-hijau btn-block shadow-lg">Pergi ke Kursus</a> --}}
            <div class="alert alert-danger mb-0"><i class="fa fa-info mr-2"></i>
                Anda telah membeli course ini pada {{tgl($cekmo->first()->updated_at)}}</div>
            @endif

                </div>
                <br>
                <ul>
                    <li><b>{{$videoc}}</b> Video ({{ minutes($vtime->durasi) }} Menit)</li>
                    <li><b>1</b> Modul</li>
                    <li>Bebas Akses Seterusnya</li>
                    <li>Sertifikat Digital (diberikan setelah menyelesaikan semua modul)</li>
                </ul>
                @else 
                    <div class="text-center">
                        <h4 class="m-0"><b>Informasi Modul</b></h4>
                        <hr class="m-1 mb-2">
                    </div>
                    <ul>
                        <li><b>{{$videoc}}</b> Video ({{ $vtime->durasi }} Jam)</li>
                        <li><b>{{$ktg}}</b> Kategori Video</li>
                        <li><b>4</b> Video Premium</li>
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    $("#sertif-guest").click(function() {
        Swal.fire(
            'Silahkan login terlebih dahulu',
            '',
            'info'
        ).then(function() {
            window.location.href = "{{asset('login')}}"
        })
    }) 

    function warningLock() {
        Swal.fire(
            'Video ini bersifat premium',
            'Silahkan membeli modul ini untuk menonton seluruh video',
            'info'
        )
    }

    function addcart(id, user) {
        $.ajax({
            type: 'POST',
            url : "{{url('addcart')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
                "user": user,
            }, beforeSend:function(data) {
                $("#btn-add-cart-"+id).text('Loading...');
            }, success:function(data) {
                $("#btn-add-cart-"+id).text('Beli Sertifikat ini');
                if(data == "tran") {
                    Swal.fire(
                        'Harap menunggu hingga proses transaksi selesai',
                        '',
                        'info'
                    )
                } else {
                    window.location.href = "{{asset('cart')}}"; 
                }
            }
        })

    }
</script>

@endsection