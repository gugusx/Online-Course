@extends('layouts.app')
@section('content')

@include('sweet::alert')
<style>
	.select2-container {
        width: 100% !important;
        padding: 0;
    }
</style>

<div class="container-fluid">
	<div class="row">

		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Data Kategori Video</div>
				<div class="panel-body">

					@if($msg = Session::get('success'))
			          <div class="alert alert-info alert-dismissible mb-0" role="alert">
			              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                  <span aria-hidden="true">&times;</span>
			              </button>
			              {{$msg}}
			          </div>
			        @endif

				<div class="col-md-4 " style="margin-bottom:2%">
					<button class="btn btn-success" data-toggle="modal" data-target="#add_kategori">Tambah</button>

</div>



<div class="col-md-4 col-md-offset-4" style="margin-bottom:2%">
{!! Form::open(['method'=>'GET','url'=>'admin/cari_kategorivideo','role'=>'search'])!!}
<div class="input-group custom-search-form">
<input type="text" class="form-control" name="search" placeholder="cari..." required>
<span class="input-group-btn">
<span class="input-group-btn">
<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span>  &nbspCari</button>
</span>
</span>
</div>
{!! Form::close()!!}

</div>

<br>
				<table class="table table-hover table-striped" >
				<tr class="hidden-xs">
				<th width="30">No</th>
				<th>Judul Topik</th>
				<th>Modul</th>
				<th width="100">Aksi</th>

				</tr>
<?php $no=1 ?>
					@foreach($kategorivideo as $r)


				<tr>
			<td data-label="No">{{$no}}. </td>
				<td data-label="Judul">{{$r->kategori}}</td>
				<td data-label="Modul">{{$r->judul}}</td>

					 <td data-label="Aksi">			  
									 <div style="display: flex;">  
					 	<button data-toggle="modal" data-target="#edit_kategori_{{$r->id}}" class="btn btn-info btn-xs" style="color:#fff"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;


{!! Form::open(array('class'=>'form-inline','method'=>'DELETE','route'=>array('admin.kategorivideo.destroy',$r->id)))!!}


	<button class="btn btn-danger btn-xs" data-toggle='confirmation'><span class="glyphicon glyphicon-trash"></span></button>
 	{!! form::close()!!}
 </div>
<!-- Modal HTML -->

</td>



			</tr>
			<?php $no++ ?>
				@endforeach

				</table>
				 <?php echo str_replace('/?','?',$kategorivideo->render()); ?>

				</div>
			</div>
		</div>
		<div class="col-md-3" style="padding: 0">
			<div class="panel panel-default">
				<div class="panel-heading">Data Kategori Video  </div>
				{!! Form::model(new App\kategorivideo, ['files'=>'true','route'=>['admin.kategorivideo.store']])!!}
				<div class="panel-body">
					<div class="form-group">
						<label>Judul</label>
	            		<input type="text" class="form-control" name="kategori">
					</div>
					<div class="form-group">
		                <label>Modul</label>
		                <select name="modul_id" class="form-control modul_id select2">
		                  	<option value="">-Pilih-</option>
		                  	@foreach($modul as $i)
		                    	<option value="{{$i->id}}" {{(old('modul_id') == $i->id ) ? 'selected' : '' }}>{{$i->judul}}</option>
		                  	@endforeach
		                </select>
		            </div>
	            	<div class="modal-footer">
				        <button class="btn btn-primary" type="submit">Submit</button>
				    </div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@foreach($kategorivideo as $r)
<div class="modal fade" id="edit_kategori_{{$r->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i>&nbsp;Edit Kategori Video</h4>
      </div>
{!! Form::model($kategorivideo,['method'=>'PATCH','route'=>['admin.kategorivideo.update',$r->id],'class'=>'form-horizontal','files'=>true])!!}
	    <div class="modal-body">
	        <div class="row">
	            <div class="col-md-6">
	              <div class="form-group">
	                <label>Embed</label>
	                <textarea name="embed" class="form-control" rows="4">{{old('embed')}}</textarea>
	              </div>

	            </div>
	            <div class="col-md-6">
	              <div class="form-group">
	                <label>Kategori</label>
	                <select name="kategorivideo_id" class="form-control select2">
	                  <option value="">-Pilih-</option>
	                  @foreach($kategorivideo as $i)
	                    <option value="{{$i->id}}" {{(old('kategorivideo_id') == $i->id ) ? 'selected' : '' }}>{{$i->kategori}}</option>
	                  @endforeach
	                </select>
	              </div>

	              <div class="form-group">
	                <label>Status</label>
	                <div style="display: flex">
	                  <div class="radio">
	                      <input type="radio" name="stat" id="radio1" value="Free" {{(old('stat') == 'Free') ? 'checked' : ''}}>
	                      <label for="radio1">Free</label>
	                  </div>
	                  &emsp;
	                  <div class="radio">
	                      <input type="radio" name="stat" id="radio2" value="Premium" {{(old('stat') == 'Premium') ? 'checked' : ''}}>
	                      <label for="radio2">Premium</label>
	                  </div>
	                </div>
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
