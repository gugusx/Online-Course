@extends('layouts.app')
@section('content')

@include('sweet::alert')

<?php
function tgl($date) {
    $BulanIndo = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    $tahun  = substr($date, 0, 4);
    $bulan  = substr($date, 5, 2);
    $tgl    = substr($date, 8, 2);
    $result = $tgl . "-" . $BulanIndo[(int) $bulan - 1] . "-" . $tahun;
    return ($result);
}
?>

<div class="container-fluid">
	<div class="row">

		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Data User</div>
				<div class="panel-body">

				<div class="col-md-4 " style="margin-bottom:2%">
{!! link_to_route('admin.admin.create','Tambah User','',array('class'=>'btn btn-success'))!!}

</div>



<div class="col-md-4 col-md-offset-4" style="margin-bottom:2%">
{!! Form::open(['method'=>'GET','url'=>'admin/cari_admin','role'=>'search'])!!}
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
				<table class="table table-hover table-striped">
				<thead>
				<tr class="hidden-xs">
					<th width="20">No</th>
					<th width="200">Nama</th>
					<th >Status</th>
					<th width="27%">Email</th>
					<th width="10%">Nomer HP</th>
					<th width="150">Tgl Mendaftar</th>
					<th>Edit</th>
					<th >Delete</th>
				</tr>
				</thead>
				<tbody>
				    <?php $no=1 ?>
				    	@foreach($user as $r)
								<tr>
							<td data-label="No">{{ $no }}.</td>
								<td data-label="Nama">{{$r->name}}</td>
					<td data-label="Status">
				@foreach ($role_user->where('user_id',$r->id) as $role)
				@if($role->role_id =='11')
				User
				@else

				Admin
				@endif
				@endforeach
					</td>
					<td data-label="Email">{{$r->email}}</td>
					<td data-label="Nomer HP">{{$r->no_hp}}</td>
					<td data-label="Tanggal Join">{{ tgl(substr($r->created_at, 0, 11)) }}</td>
					 <td data-label="Edit">			  
					 <a href="{{asset('admin/admin/'.$r->id.'/edit')}}" class="btn btn-info btn-xs" style="color:#fff"><span class="glyphicon glyphicon-pencil"></span> Edit</a>

			   </td>
					<td data-label="Hapus">

				{!! Form::open(array('class'=>'form-inline','method'=>'DELETE','route'=>array('admin.admin.destroy',$r->id)))!!}
				<button class="btn btn-danger btn-xs" data-toggle='confirmation'><span class="glyphicon glyphicon-trash"></span> Hapus</button>
			 	{!! form::close()!!}
			<!-- Modal HTML -->

				</td>
			</tr>
			<?php $no++; ?>
			@endforeach
			</tbody>

				</table>
				<?php echo str_replace('/?','?',$user->render()); ?>				
				 

				</div>
			</div>
		</div>
	</div>
</div>

@endsection
