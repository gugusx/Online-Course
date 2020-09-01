<div class="form-group">
{!! Form::label('judul','Judul',array('class'=>'col-md-1 control-label'))!!}
<div class="col-md-11">
{!! Form::text('judul',null,array('class'=>'form-control','placeholder'=>'Judul '),'')!!}
</div>
</div>
<?php $uri = Request::segment('4'); ?>


<div class="form-group">
{!! Form::Label('gambar','Gambar',array('class'=>'col-md-1 control-label'))!!}
	<div class="col-md-11">
	{!! Form::file('gambar', array('class' => 'form-control')) !!}
	</div>
</div>

<div class="form-group">
	<label class="col-md-1 control-label">
		Kategori
	</label>
<div class="col-md-11">
	<select name="kategori_modul" class="form-control" required="">
		<option value="">- Pilih Kategori -</option>
		@foreach($kategorimod as $d)
			<option value="{{$d->id}}" 
			@if($uri != '')
			@if($modul->kategori_modul == $d->id)
				{{'selected'}}
			@endif 
			@endif 
				>{{$d->kategori_mod}}</option>
		@endforeach
	</select>
</div>
</div>


<div class="form-group">

<div class="col-md-12">
{!! Form::textarea('isi',null,array('class'=>'form-control','id'=>'area'),'')!!}
</div>
</div>

	<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="col-md-6">
{!! Form::submit($submit_text,['class'=>'btn btn-primary'])!!}

</div>
