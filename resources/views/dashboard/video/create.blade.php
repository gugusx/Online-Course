@extends('layouts.app')
@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
           <div class="row">
            <div class="col-md-6">
              <h4>Tambah Video</h4>
            </div>
            <div class="col-md-6">
              <a href="{{asset('admin/video')}}" class="btn btn-success pull-right">Kembali</a>
            </div>
          </div>
        </div>
        <div class="panel-body">
         
          @foreach($errors->all() as $error)
          <div class='alert alert-danger alert-dismissable'><a href='' class='close' data-dismiss='alert' aria-label='close'> &times; </a>
          {{$error}}  </div>
          @endforeach

          @if($msg = Session::get('success'))
          <div class="alert alert-info alert-dismissible mb-0" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              {{$msg}}
          </div>
          @endif

          {!! Form::model(new App\video, ['class' =>'form-horizontal','files'=>'true','route'=>['admin.video.store']])!!}
          <div class="row">
            <div class="col-md-6">

              <div class="form-group">
                <label>Judul</label>
                <input type="text" class="form-control" name="judul" value="{{old('judul')}}">
              </div>

              <div class="form-group">
                <label>Kategori</label>
                <select name="kategorivideo_id" class="form-control select2">
                  <option value="">-Pilih-</option>
                  @foreach($kategorivideo as $i)
                    <option value="{{$i->id}}" {{(old('kategorivideo_id') == $i->id ) ? 'selected' : '' }}>{{$i->kategori}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Status</label>
                <div style="display: flex">
                  <div class="radio">
                      <input type="radio" name="stat" id="radio1" value="Free" {{(old('stat') == 'Free') ? 'checked' : ''}}>
                      <label for="radio1">Free</label>
                  </div>
                  &emsp;
                  <div class="radio">
                      <input type="radio" name="stat" id="radio2" value="Premium" {{(old('stat') == 'Premium') ? 'checked' : ''}}>
                      <label for="radio2">Premium</label>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-md-6">
            
            <div class="form-group">
              <label>Embed</label>
              <textarea name="embed" class="form-control" rows="4">{{old('embed')}}</textarea>
            </div>

            <div class="form-group">
              <label>Durasi</label>
              <input type="time" class="form-control" name="durasi" step="1" value="{{old('durasi')}}">
            </div>

            </div>
          </div>

          <div class="modal-footer">
            <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Simpan</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

@endsection
