@extends('layouts.app')
@section('content')


<div class="container-fluid">
<div class="row">


<div class="col-md-10 col-md-offset-1">

<div class="panel panel-default">
<div class="panel-heading">Edit Data {{$video->judul}}</div>
<div class="panel-body">

  @foreach($errors->all() as $error)
  <div class='alert alert-danger alert-dismissable'><a href='' class='close' data-dismiss='alert' aria-label='close'> &times; </A>{{$error}}  </div>
  @endforeach

{!! Form::model($video,['method'=>'PATCH','route'=>['admin.video.update',$video->id],'class'=>'form-horizontal','files'=>true])!!}
@include('dashboard/video/form/form',['submit_text'=>'Edit Data'])
{!! Form::close()!!}


</div>
</div>
</div>
</div>
@endsection
