@extends('layouts.app')
@section('content')

<?php 
	$uri = Request::segment('3');
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					Data Kategori Modul
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
		                		<th>Kategori</th>
		                		<th width="120">Aksi</th>
	                		</tr>
	                	</thead>
	                	<tbody>
	                		<?php $no = 1; ?>
	                		@foreach($kategorimod as $d)
	                		<tr>
	                			<td>{{$no++}}. </td>
	                			<td>{{$d->kategori_mod}}</td>
	                			<td>
	                				<a href="{{url('admin/delete_km/' . $d->id)}}" onclick="return confirm('Yakin Menghapus Data ?')" class="btn btn-danger">Hapus</a>
	                				<a href="{{url('admin/kategori_modul/' . $d->id)}}" class="btn btn-success">Edit</a>
	                				{{-- <button data-toggle="modal" data-target="#edit_kategori_{{$d->id}}" class="btn btn-success">Edit</a> --}}
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
					Form {{ ($uri == '') ? 'Tambah' : 'Edit' }}
				</div>
				<div class="panel-body">
					<form action="{{ ($uri == '') ? url('admin/insert_km') : url('admin/edit_km/' . $uri) }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label>Kategori</label>
							<input type="text" class="form-control" name="kategori_mod" value="{{ ($uri == '') ? '' : $kg->kategori_mod }}" autocomplete="off">
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

@endsection