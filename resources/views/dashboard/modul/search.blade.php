@extends('layouts.app')
@section('content')
@include('sweet::alert')
<?php
function rp($angka)
{
  $rp = "Rp. " . number_format($angka, 0, ',', '.');
  return $rp;
}
?>

<div class="container-fluid">
	<div class="row">

		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Data Modul</div>
					<div class="panel-body">
						<div class="col-md-4 " style="margin-bottom:2%">
						{!! link_to_route('admin.modul.create','Tambah ','',array('class'=>'btn btn-success'))!!}
						<a href="{{url('admin/kategori_modul')}}" class="btn btn-primary">Kategori Modul</a>
						</div>


						<div class="col-md-4 col-md-offset-4" style="margin-bottom:2%">
							{!! Form::open(['method'=>'GET','url'=>'admin/cari_modul','role'=>'search'])!!}
							<div class="input-group custom-search-form">
								<input type="text" class="form-control" name="search" placeholder="cari..." value="{{$_GET['search']}}" required>
								<span class="input-group-btn">
								<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span>&nbsp;Cari</button>
								</span>
							</span>
							</div>
							{!! Form::close()!!}
						</div>
						<br>
						{{-- <div class="table-responsive"> --}}
							<table class="table table-hover table-striped">
								<thead>
								<tr>
									<th width="30">No</th>
									<th width="240">Judul</th>
									<th>Kategori</th>
									<th>Jenis</th>
									<th>Harga</th>
									<th width="100">Aksi</th>
								</tr>
								</thead>
								<tbody>
								<?php $no=1 ?>
								@foreach($modul as $r)
								<tr>
									<td>{{$no}}. </td>
									<td>{{$r->judul}}</td>
									<td>{{$r->kategori_mod}}</td>
									<td>
										@if($r->sertifikat == 1)
										<span class="badge badge-success">Certificate</span>
										@else 
										<span class="badge badge-primary">Not Certificate</span>
										@endif
									</td>
									<td>{{rp($r->harga)}}</td>
									<td>			
									 <div style="display: flex;">  
									 	<a href="{{asset('admin/modul/'.$r->id.'/edit')}}" class="btn btn-info btn-xs" style="color:#fff">
									 	<span class="glyphicon glyphicon-pencil"></span></a>&nbsp;
										{!! Form::open(array('class'=>'form-inline','method'=>'DELETE','route'=>array('admin.modul.destroy',$r->id)))!!}
											<button class="btn btn-danger btn-xs" data-toggle='confirmation'>
											<span class="glyphicon glyphicon-trash"></span></button>
										 {!! form::close()!!}
									 </div>
									</td>
								</tr>
								<?php $no++ ?>
								@endforeach
								</tbody>
							</table>
						{{-- </div> --}}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
