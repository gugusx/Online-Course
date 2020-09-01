<style>
    .foo {
        height: 100px;
    }

    .form-control {
        width: 90%;
    }
</style>

<div class="form-group">
    {!! Form::label('judul','Judul',array('class'=>'col-md-1 control-label'))!!}
    <div class="col-md-11">
        {!! Form::text('judul',null,array('class'=>'form-control','placeholder'=>'Judul '),'')!!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('embed','Embed',array('class'=>'col-md-1 control-label'))!!}
    <div class="col-md-11">
        {!! Form::textarea('embed',null,array('class'=>'form-control'),'')!!}
    </div>
</div>

<div class="row" style="margin-left: 30px;">
    <div class="col-md-6">
        <div class="form-group">
            <label>Modul</label><br>
            <select class="form-control select2" name="modul_id" id="combokategori">
                <option value="0">--Pilih Modul--</option>
                @foreach($modul as $r)
                <option value="{{$r->id}}">{{$r->judul}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Mapel</label><br>
            <select class="form-control select2" name="mapel_id" id="combokategori">
                <option value="0">--Pilih Mapel--</option>
                @foreach($mapel as $m)
                <option value="{{$m->id}}">{{$m->nm_mapel}} - {{ ($m->jenis == 1) ? 'Natural Science' : 'Social Science' }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Kategori</label>
            <select class="form-control select2" name="kategorivideo_id" id="subkategori">
                <option class="0">--Pilih kategori Video--</option>
                @foreach($kategorivideo as $x)
                <option value="{{$x->id}}" class="{{$x->modul_id }}">{{$x->kategori}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tipe</label>
            <select class="form-control" name="stat" id="tipe">
                <option class="">--Pilih Tipe Video--</option>
                <option value="Free">Free</option>
                <option value="Premium">Premium</option>
            </select>
        </div>
    </div>
</div>

<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="modal-footer">
    {!! Form::submit($submit_text,['class'=>'btn btn-primary'])!!}
</div>