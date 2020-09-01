@extends('layouts.user')
@section('content')

<h3 class="title-type">Mini Course</h3>
<div class="row">
    <div class="col-md-6">
        <div class="work-box">
          <a href="{{asset('modul/'.$bw->id.'/show')}}">
            <div class="work-img imgHolder">
              <img src="{{ asset($bw->gambar)}}" class="img-thumbnail br-20" />
              <span class="badge badge-warning top-label">Most Watched</span>
            </div>
          </a>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p><b>{{$bw->judul}}</b></p>
            </div>
            <div class="col-md-6">
              @if(strlen($bw->isi) > 105)
              {!!html_entity_decode(substr($bw->isi, 0, 105) . "...")!!}
                  @else
              {!!html_entity_decode($bw->isi)!!}
              @endif  
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
        @foreach($mini as $d)
            <div class="col-md-6">
                <div class="work-box">
                  <a href="{{asset('modul/'.$d->id.'/show')}}">
                    <div class="work-img">
                      <img src="{{ asset($d->gambar)}}" class="img-thumbnail br-20" />
                    </div>
                  </a>
                </div>
                <p><b>{{$d->judul}}</b></p>
            </div>
        @endforeach
        <div class="col-md-6">
            <div class="work-box">
              <a href="{{asset('course/kategori?ktg=' . $bw->kategori_modul . '')}}">
                <div class="work-img">
                  <img src="{{ asset('assets/more.png')}}" class="img-thumbnail br-20" />
                </div>
              </a>
            </div>
        </div>
            
        </div>
    </div>
</div>

<h3 class="title-type">Online Certification</h3>
<div class="row mb-5">
    <div class="col-md-6">
        <div class="work-box">
          <a href="{{asset('modul/'.$bw2->id.'/show')}}">
            <div class="work-img imgHolder">
              <img src="{{ asset($bw2->gambar)}}" class="img-thumbnail br-20" />
                <span class="badge badge-warning top-label">Most Wanted</span>
            </div>
          </a>
        </div>
        
        <div class="row">
            <div class="col-md-5">
                <p><b>{{$bw2->judul}}</b></p>
            </div>
            <div class="col-md-6">
                  @if(strlen($bw2->isi) > 105)
                  {!!html_entity_decode(substr($bw2->isi, 0, 105) . "...")!!}
                      @else
                  {!!html_entity_decode($bw2->isi)!!}
                  @endif  
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
        @foreach($cer as $d)
            <div class="col-sm-6">
                <div class="work-box">
                  <a href="{{asset('modul/'.$d->id.'/show')}}">
                    <div class="work-img">
                      <img src="{{ asset($d->gambar)}}" class="img-thumbnail br-20" />
                    </div>
                  </a>
                </div>
                <p><b>{{$d->judul}}</b></p>
            </div>
        @endforeach
            <div class="col-sm-6">
                <div class="work-box">
                  <a href="{{asset('course/kategori?ktg=' . $bw2->kategori_modul . '')}}">
                    <div class="work-img">
                      <img src="{{ asset('assets/more.png')}}" class="img-thumbnail br-20" />
                    </div>
                  </a>
                </div>
            </div>

        </div>
    </div>
</div> 

@endsection