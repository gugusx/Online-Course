<div class="form-group">
{!! Form::label('judul','Judul',array('class'=>'col-md-1 control-label'))!!}
<div class="col-md-11">
{!! Form::text('kategori',null,array('class'=>'form-control','placeholder'=>'Judul '),'')!!}

</div>
</div>




<div class="form-group">
{!! Form::label('judul','Modul',array('class'=>'col-md-1 control-label'))!!}
<div class="col-md-11">

<select class="form-control" name="modul_id">
<option>--Pilih Modul--</option>
@foreach($modul as $r)
<option value="{{$r->id}}">{{$r->judul}}</option>
@endforeach
</select>
</div>
</div>









	<input type="hidden" name="_token" value="{{ csrf_token() }}">





<div class="col-md-6">
{!! Form::submit($submit_text,['class'=>'btn btn-primary'])!!}

</div>
