@extends('app')
@section('content')
    <script src="{{asset('../js/jquery-1.8.2.js')}}"></script>
	   <script src="{{asset('../js/jquery-ui-1.9.0.custom.js')}}"></script>
     <link href="{{asset('../development-bundle/themes/hot-sneaks/jquery-ui.css')}}" rel="stylesheet">
     <script src="{{asset('../development-bundle/ui/i18n/jquery.ui.datepicker-id.js')}}"></script>
     
       <script type="text/javascript"> 
	   var $fikri= jQuery.noConflict();
        $fikri(document).ready(function(){
           $fikri("#tanggal").datepicker({
              showAnim: "drop",
              showOptions: { direction: "up" },
			     changeMonth: true,
              changeYear: true,
			   dateFormat: "yy-mm-dd"
           });
        });
     </script>
	 
<div class="container-fluid">
<div class="row">
<div class="col-md-10 col-md-offset-1">
<div class="panel panel-default">
<div class="panel-heading">Edit Data {{$user->name}}</div>
<div class="panel-body">
@if ($errors->any())

@foreach($errors->all() as $error)
<div class='alert alert-danger alert-dismissable'><a href='' class='close' data-dismiss='alert' aria-label='close'> &times; </A>{{$error}}  </div>
@endforeach
</div>

@endif


{!! Form::model($user,['method'=>'PATCH','route'=>['user.update',$user->id],'class'=>'form-horizontal','files'=>true])!!}
<div class="form-group">
{!! Form::label('name','Nama',array('class'=>'col-md-4 control-label'))!!}
<div class="col-md-6">
{!! Form::text('name',null,array('class'=>'form-control','placeholder'=>'Nama '),'')!!}

</div>
</div>

<div class="form-group">
{!! Form::label('username','Username',array('class'=>'col-md-4 control-label'))!!}
<div class="col-md-6">
{!! Form::text('username',null,array('class'=>'form-control','placeholder'=>'Username  '),'')!!}

</div>
</div>






<div class="form-group">
{!! Form::label('jk','Jenis Kelamin',array('class'=>'col-md-4 control-label'))!!}
<div class="col-md-6">
<input type="radio" name="jk" value="L" id="L">&nbsp;<label for="L" >Laki-Laki</label>
<br>
<input type="radio" name="jk" value="P" id="P">&nbsp;<label for="P">Perempuan</label>

</div>
</div>

<div class="form-group">
{!! Form::label('tempat_lahir','Tempat Lahir',array('class'=>'col-md-4 control-label'))!!}
<div class="col-md-6">
{!! Form::text('tempat_lahir',null,array('class'=>'form-control'),'')!!}

</div>
</div>

<div class="form-group">
{!! Form::label('ttl','Tanggal Lahir',array('class'=>'col-md-4 control-label'))!!}
<div class="col-md-6">

{!! Form::text('ttl',null,array('class'=>'form-control','id'=>'tanggal'),'')!!}
</div>
</div>

<div class="form-group">
{!! Form::label('alamat','Alamat',array('class'=>'col-md-4 control-label'))!!}
<div class="col-md-6">
{!! Form::textarea('alamat',null,array('class'=>'form-control'),'')!!}
</div>
</div>

<div class="form-group">
{!! Form::label('kota','Kota',array('class'=>'col-md-4 control-label'))!!}
<div class="col-md-6">
{!! Form::text('kota',null,array('class'=>'form-control'),'')!!}

</div>
</div>



<div class="form-group">

{!! Form::Label('status','Status',array('class'=>'col-md-4 control-label'))!!}

<div class="col-md-6">
<select name="status" class="form-control">

<option value="User"> User</option>


</select>
</div> 
</div>

	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="id_upline" value="6">
	<input type="hidden" name="akses" Value="Y" >

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
{!! Form::file('gambar','')!!}
</div>
</div>


<div class="col-md-6 col-md-offset-4">
{!! Form::submit('Update',['class'=>'btn primary'])!!}

</div>
{!! Form::close()!!}


</div>
</div>
</div>
</div>
@endsection