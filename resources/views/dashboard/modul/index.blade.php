@extends('layouts.app')
@section('content')
@include('sweet::alert')
@php
function rp($angka)
{
  $rp = "Rp. " . number_format($angka, 0, ',', '.');
  return $rp;
}
@endphp

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Data Modul</div>
					<div class="panel-body">
						@if($msg = Session::get('success'))
				          <div class="alert alert-info alert-dismissible mb-3" role="alert">
				              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				                  <span aria-hidden="true">&times;</span>
				              </button>
				              {{$msg}}
				          </div>
				         @endif

						<div class="col-md-4 " style="margin-bottom:2%">
						{!! link_to_route('admin.modul.create','Tambah ','',array('class'=>'btn btn-success'))!!}
						<a href="{{url('admin/kategori_modul')}}" class="btn btn-primary">Kategori Modul</a>
						</div>


						<div class="col-md-4 col-md-offset-4" style="margin-bottom:2%">
							{!! Form::open(['method'=>'GET','url'=>'admin/cari_modul','role'=>'search'])!!}
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
						{{-- <div class="table-responsive"> --}}
							<table class="table table-hover table-striped">
								<thead>
								<tr>
									<th width="30">No</th>
									<th width="240">Judul</th>
									<th>Kategori</th>
									<th>Jenis</th>
									<th>Sertifikat</th>
									<th>Harga</th>
									<th>Trainer</th>
									<th>Publish</th>
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
									<td>{{ ($r->nm_jenis == null) ? '-' : $r->nm_jenis }}</td>
									<td>
										@if($r->sertifikat == 1)
										<span class="badge badge-success" style="background-color: #28a745">Certificate</span>
										@else 
										<span class="badge">Not Certificate</span>
										@endif
									</td>
									<td>{{($r->harga == 0) ? '-' : rp($r->harga)}}</td>
									<td>{{$r->nm_trainer}}</td>
									<td>
										{{-- @if ($r->status == 'N')
										<form action="{{ asset('update-post') }}" method="post">
											{{ csrf_field() }}
											<input type="hidden" name="id" value="{{$r->id}}">
      										<input type="hidden" name="apply" value="Y">
											<button type="submit" class="btn btn-success btn-sm">Publish</button>
										</form>
										@else
											<span class="badge badge-primary">Published</span>
										@endif --}}
										<span class="badge badge-primary hidden" id="span-publish-{{$r->id}}">Published</span>
										@if ($r->status == 'Y')
										<span class="badge badge-primary">Published</span>
										@else
										<div class="switch" id="switch-publish-{{$r->id}}">
		                                    <label>
		                                        <input type="checkbox" value="{{$r->id}}" 
		                                        @if ($r->status == 'Y')
		    									checked
		    									@endif 
		    									id="update-post-{{$r->id}}">
		                                    <span class="lever switch-col-blue"></span>
		                                    </label>
		                                </div>
		                                @endif
									</td>
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
						<?php echo str_replace('/?','?',$modul->render()); ?>
				</div>
			</div>
		</div>
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
@foreach($modul as $d)
<script>
$("#update-post-{{$d->id}}").on("change", function () {
	var val = $(this).val();
    var apply = $(this).is(':checked') ? 'Y' : 'N';

    toastr.success('Modul Dipublikasikan');
	$("#span-publish-"+val).fadeIn();
	$("#switch-publish-"+val).hide();
	
    $.ajax({
    	type: 'post',
    	url: '{{asset('update-post')}}',
    	data : {
    		"_token" : "{{ csrf_token() }}",
    		"id" : val,
    		"apply" : apply,
    	}, success:function(data) {
			
    	}
    })
})
</script>
@endforeach

@endsection
