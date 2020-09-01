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
                <option value="{{$r->id}}" 
                    @if($r->id == $video->modul_id)
                        {{'selected'}}
                    @endif
                >{{$r->judul}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Mapel</label><br>
            <select class="form-control select2" name="mapel_id" id="combokategori">
                <option value="0">--Pilih Mapel--</option>
                @foreach($mapel as $m)
                <option value="{{$m->id}}" 
                    @if($m->id == $video->mapel_id)
                        {{'selected'}}
                    @endif
                >{{$m->nm_mapel}} - {{ ($m->jenis == 1) ? 'Natural Science' : 'Social Science' }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>List</label>
            {!! Form::text('list',null,array('class'=>'form-control','placeholder'=>'Judul '),'')!!}
        </div>
        
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Kategori</label><br>
            <select class="form-control select2" name="kategorivideo_id" id="combokategori">
                <option value="0">--Pilih Kategori--</option>
                @foreach($kategorivideo as $r)
                <option value="{{$r->id}}" 
                    @if($r->id == $video->kategorivideo_id)
                        {{'selected'}}
                    @endif
                >{{$r->kategori}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tipe</label>
            <select class="form-control" name="stat" id="tipe">
                <option value="Free" {{ ($video->stat == 'Free') ? 'selected' : '' }}>Free</option>
                <option value="Premium" {{ ($video->stat == 'Premium') ? 'selected' : '' }}>Premium</option>
            </select>
        </div>
    </div>
</div>





<input type="hidden" name="listx" value="{{$video->list}}">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="modal-footer">
    {!! Form::submit($submit_text,['class'=>'btn btn-primary'])!!}
</div>