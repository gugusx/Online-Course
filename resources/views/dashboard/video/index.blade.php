@extends('layouts.app')
@section('content')

@include('sweet::alert')
<style>
	.select2-container {
        width: 100% !important;
        padding: 0;
    }
</style>

@php 
	function strtime($time) {
		return substr($time, 0, -3);
	}
@endphp

<div class="container-fluid">
	<div class="row">

		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Data Video</div>
				<div class="panel-body">

					@foreach($errors->all() as $error)
			          <div class='alert alert-danger alert-dismissable'><a href='' class='close' data-dismiss='alert' aria-label='close'> &times; </a>
			          {{$error}}  </div>
			          @endforeach

			          @if($msg = Session::get('success'))
			          <div class="alert alert-info alert-dismissible mb-4" role="alert">
			              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                  <span aria-hidden="true">&times;</span>
			              </button>
			              {{$msg}}
			          </div>
			          @endif

				<div class="col-md-4 " style="margin-bottom:2%">
{!! link_to_route('admin.video.create','Tambah  Video','',array('class'=>'btn btn-success'))!!}

</div>

<div class="col-md-4 col-md-offset-4" style="margin-bottom:2%">
{!! Form::open(['method'=>'GET','url'=>'admin/cari_video','role'=>'search'])!!}
<div class="input-group custom-search-form">
<input type="text" class="form-control" name="search" placeholder="cari..." required>
<span class="input-group-btn">
<span class="input-group-btn">
<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span>&nbsp;Cari</button>
</span>
</span>
</div>
{!! Form::close()!!}
</div>

<br>
			<div>
				<table class="table table-hover table-striped" >
					<thead>
						<tr>
		    				<th width="30">No</th>
		    				<th width="200">Kategori</th>
		    				<th width="250">Modul</th>
		    				<th width="300">Judul</th>
		    				<th>Tipe</th>
		    				<th>Durasi</th>
		    				<th>Aksi</th>
						</tr>
					</thead>
				<?php $no = 1?>
					@foreach($video as $r)
				<tbody>
				<tr>
					<td data-label="No">{{$no}}. </td>
					<td data-label="Kategori">{{$r->kategori}}</td>	
					<td data-label="Judul">{{$r->judulmodul}}</td>
					<td data-label="Modul">{{$r->vjudul}}</td>
					<td data-label="Tipe">{{$r->stat}}</td>
					<td data-label="Durasi">{{ $r->durasi }}</td>
					<td width="100" data-label="Aksi">
						<div style="display: flex;">
					 <button data-toggle="modal" data-target="#edit_video_{{$r->id}}" class="btn btn-info btn-xs" style="color:#fff"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;
					{!! Form::open(array('class'=>'form-inline','method'=>'DELETE','route'=>array('admin.video.destroy',$r->id)))!!}
					<button class="btn btn-danger btn-xs" data-toggle='confirmation'>
						<span class="glyphicon glyphicon-trash"></span></button>
				 	{!! form::close()!!}
 	</div>
					</td>
				</tr>
				</tbody>
			<?php $no++?>
				@endforeach
				</table>
			</div>
				 <?php echo str_replace('/?', '?', $video->render()); ?>

				</div>
			</div>
		</div>
	</div>
</div>

@foreach($video as $r)
<div class="modal fade" id="edit_video_{{$r->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>&nbsp;Edit Kategori Video</h4>
      </div>
{!! Form::model($video,['method'=>'PATCH','route'=>['admin.video.update',$r->id],'class'=>'form-horizontal','files'=>true])!!}
{{-- <form action="{{route('admin.video.update', $r->id)}}" method="post"></form> --}}
	    <div class="modal-body">
	        <div class="row">
	            <div class="col-md-6">

	            	<div class="form-group">
		                <label>Judul</label>
		                <input type="text" class="form-control" name="judul" value="{{$r->vjudul}}">
		            </div>

		            <div class="form-group">
		                <label>Kategori</label><br>
		                <select name="kategorivideo_id" class="form-control select2">
		                  <option value="">-Pilih-</option>
		                  @foreach($kategorivideo as $i)
		                    <option value="{{$i->id}}" {{($r->kategorivideo_id == $i->id ) ? 'selected' : '' }}>{{$i->kategori}}</option>
		                  @endforeach
		                </select>
		              </div>

		              <div class="form-group">
		                <label>Status</label>
		                <div style="display: flex">
		                  <div class="radio">
		                      <input type="radio" name="stat" id="radio1-{{$r->id}}" value="Free" {{($r->stat == 'Free') ? 'checked' : ''}}>
		                      <label for="radio1-{{$r->id}}">Free</label>
		                  </div>
		                  &emsp;
		                  <div class="radio">
		                      <input type="radio" name="stat" id="radio2-{{$r->id}}" value="Premium" {{($r->stat == 'Premium') ? 'checked' : ''}}>
		                      <label for="radio2-{{$r->id}}">Premium</label>
		                  </div>
		                </div>
		            </div>

	            </div>
	            <div class="col-md-6">
	              	<div class="form-group">
		                <label>Embed</label>
		                <textarea name="embed" class="form-control" rows="4">{{$r->embed}}</textarea>
		            </div>

		            <div class="form-group">
		              <label>Durasi</label>
		              <input type="time" class="form-control" step="1" name="durasi" value="{{$r->durasi}}">
		            </div>
	            </div>
	          </div>
	    </div>
	    
	    <div class="modal-footer">
	        <button class="btn btn-primary">Submit</button>
	    </div>
		{!! Form::close() !!}
    </div>
  </div>
</div>
@endforeach

@endsection
