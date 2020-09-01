@extends('layouts.app')
@section('content')

@include('sweet::alert')


<div class="container-fluid">
	<div class="row">

		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Data Webinar  </div>
				<div class="panel-body">

				<div class="col-md-4 " style="margin-bottom:2%">
{!! link_to_route('admin.webinar.create','Tambah Webinar','',array('class'=>'btn btn-success'))!!}

</div>



<div class="col-md-4 col-md-offset-4" style="margin-bottom:2%">
{!! Form::open(['method'=>'GET','url'=>'admin/cari_webinar','role'=>'search'])!!}
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
				<th >No</th>
				<th >Judul</th>
				<th>Tanggal</th>
				<th>Jam</th>

				<th>Edit</th>
				<th >Delete</th>


				</tr>
<?php $no=1 ?>
					@foreach($webinar as $r)


				<tr>
			<td data-label="No">{{$no}}</td>
				<td data-label="Judul">{{$r->judul}}</td>
					<td data-label="Tanggal">{{$r->tanggal}}</td>
					<td data-label="Tanggal">{{$r->jam}}</td>

					 <td data-label="Edit">			  <a href="{{asset('admin/webinar/'.$r->id.'/edit')}}" class="btn btn-info btn-xs" style="color:#fff"><span class="glyphicon glyphicon-pencil"></span> Edit</a>

			   </td>
					<td data-label="Hapus">

{!! Form::open(array('class'=>'form-inline','method'=>'DELETE','route'=>array('admin.webinar.destroy',$r->id)))!!}


	<button class="btn btn-danger btn-xs" data-toggle='confirmation'><span class="glyphicon glyphicon-trash"></span> Hapus</button>
 	{!! form::close()!!}
<!-- Modal HTML -->

</td>



			</tr>
			<?php $no++ ?>
				@endforeach

				</table>


				</div>
			</div>
		</div>
	</div>
</div>

@endsection
