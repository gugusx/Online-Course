@extends('layouts.app')
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
<div class="panel-heading">Tambah Webinar</div>
<div  class="panel-body">

@foreach($errors->all() as $error)
<div class='alert alert-danger alert-dismissable'><a href='' class='close' data-dismiss='alert' aria-label='close'> &times; </A>{{$error}}  </div>
@endforeach

{!! Form::model(new App\webinar, ['class' =>'form-horizontal','files'=>'true','route'=>['admin.webinar.store']])!!}

@include('dashboard/webinar/form/formadd',['submit_text'=>'Tambah Data'])

{!! Form::close() !!}
</div>
</div>
</div>
</div>
</div>
@endsection
