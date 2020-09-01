@extends('layouts.app')
@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="row">
            <div class="col-md-6">
              <h4>Tambah Modul</h4>
            </div>
            <div class="col-md-6">
              <a href="{{asset('admin/modul')}}" class="btn btn-success pull-right">Kembali</a>
            </div>
          </div>
        </div>
        <div class="panel-body">
          @foreach($errors->all() as $error)
          <div class='alert alert-danger alert-dismissable'><a href='' class='close' data-dismiss='alert' aria-label='close'> &times; </a>
          {{$error}}  </div>
          @endforeach

          @if($msg = Session::get('success'))
          <div class="alert alert-info alert-dismissible mb-2" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              {{$msg}}
          </div>
          @endif

          {!! Form::model(new App\modul, ['class' =>'form-horizontal','files'=>'true','route'=>['admin.modul.store']])!!}
          <div class="row">
            <div class="col-md-6">
              
              <div class="form-group">
                <label>Judul</label>
                <input type="text" class="form-control" name="judul" value="{{old('judul')}}">
              </div>
              
              <div class="form-group">
                <label>Kategori</label>
                <select name="kategori_modul" class="form-control">
                  <option value="">-Pilih-</option>
                  @foreach($kategorimod as $i)
                    <option value="{{$i->id}}" {{(old('kategori_modul') == $i->id ) ? 'selected' : '' }}>{{$i->kategori_mod}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Jenis</label>
                <select name="jenis_id" class="form-control jenis_id select2">
                  <option value="">-Pilih-</option>
                  @foreach($jenis as $i)
                    <option value="{{$i->id}}" {{(old('jenis_id') == $i->id ) ? 'selected' : '' }}>{{$i->nm_jenis}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Jenjang</label>
                <select name="jenjang_id" class="form-control">
                  <option value="">-Pilih-</option>
                  @foreach($jenjang as $i)
                    <option value="{{$i->id}}" {{(old('jenjang_id') == $i->id ) ? 'selected' : '' }}>{{$i->nm_jenjang}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Kelas</label>
                <select name="kelas_id" class="form-control kelas_id select2">
                  <option value="">-Pilih-</option>
                  @foreach($kelas as $i)
                    <option value="{{$i->id}}" {{(old('kelas_id') == $i->id ) ? 'selected' : '' }}>{{$i->nm_kelas}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Mapel</label>
                <select name="mapel_id" class="form-control select2">
                  <option value="">-Pilih-</option>
                  @foreach($mapel as $i)
                    <option value="{{$i->id}}" {{(old('mapel_id') == $i->id ) ? 'selected' : '' }}>{{$i->nm_mapel}}</option>
                  @endforeach
                </select>
              </div>
              
            </div>
            <div class="col-md-6">

              <div class="form-group">
                <label>Sertifikat</label>
                <div style="display: flex">
                  <div class="radio">
                      <input type="radio" name="sertifikat" id="radio1" value="1" {{(old('sertifikat') == '1') ? 'checked' : ''}}>
                      <label for="radio1">Ya</label>
                  </div>
                  &emsp;
                  <div class="radio">
                      <input type="radio" name="sertifikat" id="radio2" value="0" {{(old('sertifikat') == '0') ? 'checked' : ''}}>
                      <label for="radio2">Tidak</label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>Harga</label>
                <input type="text" class="form-control" name="harga" id="form-harga-add" placeholder="Rp. " 
                onkeyup="cek_rupiah(this.value, 'add', 'Rp. ')"
                 value="{{old('harga')}}">
              </div>

              <div class="form-group">
                <label>Gambar</label>
                <input type="file" onChange="readURL(this);" class="form-control" name="gambar">
              </div>
              
              <img src="" id="blah" class="img-thumbnail">

              <div class="form-group">
                <label>Trainer</label>
                <select name="trainer_id" class="form-control select2">
                  <option value="">-Pilih-</option>
                  @foreach($trainers as $i)
                    <option value="{{$i->id}}" {{( old('trainer_id') == $i->id ) ? 'selected' : '' }}>{{$i->nm_trainer}}</option>
                  @endforeach
                </select>
              </div>

            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label>Keterangan</label>
                <textarea type="text" class="form-control ckeditor" name="isi">{{old('isi')}}</textarea>
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

<script src="{{asset('assets/new/js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script>

  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#blah')
                  .attr('src', e.target.result)
                  .height(64);
          };

          reader.readAsDataURL(input.files[0]);
      }
  }

  function cekJenjang(val) {
    $.ajax({
      type : 'POST',
      url  : '{{url('cekJenjang')}}',
      data : {
        "_token" :"{{ csrf_token() }}",
        "val" : val,
      },
      error: function(data)
      {
        console.log(data);
      },
        success: function(data)
      {
        var html = '';
        for (var i = 0; i < data.length; i++) {
          html+= '<option value="'+data[i].id+'">'+data[i].nm_kelas+'</option>';
        }
        $(".kelas_id").html(html);
    },
    })
  }

  function cek_rupiah(val, no, rp) {
     $("#form-harga-"+no).val(rupiah(val, rp));
  }

  function rupiah(angka, prefix){
      var number_string   = angka.replace(/[^,\d]/g, '').toString(),
      split               = number_string.split(','),
      sisa                = split[0].length % 3,
      rupiah              = split[0].substr(0, sisa),
      ribuan              = split[0].substr(sisa).match(/\d{3}/gi);

      if(ribuan){
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }

</script>

@endsection
