@extends('layouts.app')
@section('content')

@include('sweet::alert')


<div class="container-fluid">
	<div class="row">

		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Data Video  </div>
				<div class="panel-body">

				<div class="col-md-4 " style="margin-bottom:2%">
{!! link_to_route('admin.video.create','Tambah  Video','',array('class'=>'btn btn-success'))!!}

</div>



<div class="col-md-4 col-md-offset-4" style="margin-bottom:2%">
{!! Form::open(['method'=>'GET','url'=>'admin/cari_video','role'=>'search'])!!}
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
    				<th width="200">Kategeori</th>
    				<th width="250">Modul</th>
    				<th width="250">Mapel</th>
    				<th width="150">Judul</th>
    				<th width="55">Edit</th>
    				<th >Delete</th>


				</tr>
<?php $no=1 ?>
					@foreach($video as $r)


				<tr>
			<td data-label="No">{{$no}}. </td>
				<td data-label="Judul">{{$r->judulmodul}}</td>
			<td data-label="Kategori">{{$r->kategori}}</td>
			<td data-label="Mapel">{{$r->nm_mapel}}</td>
		<td data-label="Modul">{{$r->vjudul}}</td>

					 <td data-label="Edit">			  <a href="{{asset('admin/video/'.$r->id.'/edit')}}" class="btn btn-info btn-xs" style="color:#fff"><span class="glyphicon glyphicon-pencil"></span> Edit</a>

			   </td>
					<td data-label="Hapus">

{!! Form::open(array('class'=>'form-inline','method'=>'DELETE','route'=>array('admin.video.destroy',$r->id)))!!}


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
