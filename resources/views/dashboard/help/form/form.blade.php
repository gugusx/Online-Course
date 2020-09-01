<div class="form-group">
{!! Form::label('judul','Judul',array('class'=>'col-md-1 control-label'))!!}
<div class="col-md-11">
{!! Form::text('judul',null,array('class'=>'form-control','placeholder'=>'Judul '),'')!!}

</div>
</div>






<div class="form-group">

<div class="col-md-12">
{!! Form::textarea('keterangan',null,array('class'=>'form-control','id'=>'area'),'')!!}
</div>
</div>



	<input type="hidden" name="_token" value="{{ csrf_token() }}">





<div class="col-md-6">
{!! Form::submit($submit_text,['class'=>'btn btn-primary'])!!}

</div>
