<div class="form-group">
{!! Form::label('name','Name',array('class'=>'col-md-4 control-label'))!!}
<div class="col-md-6">
{!! Form::text('name',null,array('class'=>'form-control','placeholder'=>'Nama '),'')!!}

</div>
</div>


<div class="form-group">
{!! Form::label('no_hp','Nomer HP',array('class'=>'col-md-4 control-label'))!!}
<div class="col-md-6">
{!! Form::text('no_hp',null,array('class'=>'form-control','placeholder'=>'Nomer HP '),'')!!}

</div>
</div>




	<input type="hidden" name="_token" value="{{ csrf_token() }}">


<div class="form-group">
{!! Form::label('email','E-mail',array('class'=>'col-md-4 control-label'))!!}
<div class="col-md-6">
{!! Form::text('email',null,array('class'=>'form-control'),'')!!}

</div>
</div>

<div class="form-group">
{!! Form::label('password','Password',array('class'=>'col-md-4 control-label'))!!}
<div class="col-md-6">
{!! Form::password('password',array('class'=>'form-control  '),'')!!}
</div>
</div>

<div class="form-group">
{!! Form::Label('gambar','Gambar',array('class'=>'col-md-4 control-label'))!!}
<div class="col-md-6">

{!! Form::file('gambar', array('class' => 'form-control')) !!}
</div>
</div>


<div class="col-md-6 col-md-offset-4">
{!! Form::submit($submit_text,['class'=>'btn btn-primary'])!!}

</div>
