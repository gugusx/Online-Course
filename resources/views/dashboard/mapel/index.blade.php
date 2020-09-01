@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					Data Mata Pelajaran
				</div>
				<div class="panel-body">
					@if($msg = Session::get('success'))
	                    <div class="alert alert-success alert-dismissible" role="alert">
	                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                            <span aria-hidden="true">&times;</span>
	                        </button>
	                        <i class="fa fa-check-circle"></i>&nbsp;{{$msg}}
	                    </div>
	                @endif
	                <table class="table table-hover table-striped example">
	                	<thead>
	                		<tr>
		                		<th width="10">#</th>
		                		<th>Mapel</th>
		                		<th>Jenis</th>
		                		<th>Gambar</th>
		                		<th width="120">Aksi</th>
	                		</tr>
	                	</thead>
	                	<tbody>
	                		<?php $no = 1; ?>
	                		@foreach($mapel as $d)
	                		<tr>
	                			<td>{{$no++}}. </td>
	                			<td>{{$d->nm_mapel}}</td>
	                			<td>{{ ($d->jenis == 1) ? 'Natural Science' : 'Social Science' }}</td>
	                			<td><img src="{{ asset($d->gambar)}}" height="50" class="img-thumbnail" /></td>
	                			<td>
	                				{{-- {{asset('admin/mapel/'. $d->id . '/' . $d->gambar . '/destroy')}} --}}
	                				<a href="{{asset('admin/mapel/destroy/' . $d->id )}}" onclick="return confirm('Yakin Menghapus Data ?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
	                				<a data-toggle="modal" data-target="#edit_mapel_{{$d->id}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
	                			</td>
	                		</tr>
	                		@endforeach
	                	</tbody>
	                </table>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					Form Tambah
				</div>
				<div class="panel-body">
					<form action="{{route('admin.mapel.store')}}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label>Mapel</label>
							<input type="text" class="form-control" name="nm_mapel" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label>Jenis</label>
							<select name="jenis" class="form-control" required="">
								<option value="1">Natural Science</option>
								<option value="2">Social Science</option>
							</select>
						</div>
						<div class="form-group">
							<label>Gambar</label>
							{!! Form::file('gambar', array('class' => 'form-control')) !!}
						</div>
						<div class="modal-footer">
							<button type="Reset" class="btn btn-danger btn-md">Reset</button>
							<button type="Submit" class="btn btn-primary btn-md">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


@foreach($mapel as $d)
		<!-- Modal -->
	<div id="edit_mapel_{{$d->id}}" class="modal fade" role="dialog">
		<div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
		        <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Form Edit</h4>
		        </div>
		     	<form action="{{asset('admin/mapel/update/' . $d->id )}}" method="post" enctype="multipart/form-data">
			      <div class="modal-body">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label>Mapel</label>
						<input type="text" class="form-control" name="nm_mapel" value="{{$d->nm_mapel}}" autocomplete="off" required="">
					</div>
					<div class="form-group">
						<label>Jenis</label>
						<select name="jenis" class="form-control" required="">
							<option value="1" {{($d->jenis == 1) ? 'selected' : ''}}>Natural Science</option>
							<option value="2" {{($d->jenis == 2) ? 'selected' : ''}}>Social Science</option>
						</select>
					</div>
					<div class="form-group">
						<label>Gambar</label>
						<input type="file" class="form-control" name="gambar">
						{{$d->gambar}}
					</div>
			      </div>
			      <div class="modal-footer">
			      	<button type="Reset" class="btn btn-danger btn-md">Reset</button>
					<button type="Submit" class="btn btn-primary btn-md">Simpan</button>
			      </div>
				</form>
	    	</div>

	    </div>
	</div>

@endforeach

@endsection