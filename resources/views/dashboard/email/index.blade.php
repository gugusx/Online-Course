@extends('layouts.app')
@section('content')

@include('sweet::alert')


<div class="container-fluid">
	<div class="row">

		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Data Email</div>
				<div class="panel-body">

				<div class="col-md-4 " style="margin-bottom:2%">
{!! link_to_route('admin.email.create','Tambah email','',array('class'=>'btn btn-success'))!!}

</div>




<br>
				<table class="table table-hover table-striped" >
				<tr class="hidden-xs">
				<th width="30">No</th>
				<th>Judul</th>
					<th >Isi</th>

	
				<th >Delete</th>


				</tr>
<?php $no=1 ?>
					@foreach($email as $r)


				<tr>
			<td data-label="No">{{$no}}. </td>
				<td data-label="Nama">{{$r->judul}}</td>
								<td data-label="Isi">{{$r->isi}}</td>

			
			   </td>
					<td data-label="Hapus">

{!! Form::open(array('class'=>'form-inline','method'=>'DELETE','route'=>array('admin.email.destroy',$r->id)))!!}


	<button class="btn btn-danger btn-xs" data-toggle='confirmation'><span class="glyphicon glyphicon-trash"></span> Hapus</button>
 	{!! form::close()!!}
<!-- Modal HTML -->

</td>



			</tr>
			<?php $no++ ?>
				@endforeach

				</table>
				 <?php echo str_replace('/?','?',$email->render()); ?>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection
