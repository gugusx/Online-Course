@extends('layouts.app')
@section('content')
@include('sweet::alert')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Appearance</div>
                <div class="panel-body">
                    @foreach($errors->all() as $error)
                    <div class='alert alert-danger alert-dismissable'><a href='' class='close' data-dismiss='alert' aria-label='close'> &times; </A>{{$error}}  </div>
                    @endforeach

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

                    @for ($i = 0; $i < 3; $i++)
                    <form action="{{ route('admin.appearance.upload', ['slide' => ($i+1)]) }}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset("laravel/public/slides/$images[$i]") }}" alt="Image" class="img-responsive thumbnail">
                                </div>
                                <div class="col-md-8">
                                    <label style="font-size: 20px;">Slide {{ ($i+1) }}</label>
                                    {{ csrf_field() }}
                                    <input type="file" class="form-control" name="gambar" required="">
                                    <input type="hidden" name="nomor" value="{{ ($i+1) }}">
                                    <input type="hidden" name="old_gambar" value="{{ $images[$i] }}">
                                    <br>
                                    <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-upload"></i> Upload</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr style="margin-top: 0;">
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection