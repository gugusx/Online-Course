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

		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Hasil Karya Kelas</div>
				<div class="panel-body">

<br>
			<div>
				<table class="table table-hover table-striped" >
					<thead>
						<tr>
		    				<th width="30">No</th>
		    				<th width="150">Nama</th>
		    				<th width="250">Hasil Karya <br>(klik untuk memperbesar)</th>
		    				<th width="300">Deskripsi Karya</th>
		    				<th style="text-align: center">Status</th>
		    				<th style="text-align: center">Aksi</th>
						</tr>
					</thead>
				<?php $no = 1?>
				@foreach($karyax->sortByDesc('created_at')  as $r)
				<tbody>
				<tr>
					<td data-label="No">{{$no}}. </td>
					<td data-label="Nama">{{$r->name}}</td>	
					<td data-label="Hasil_Karya">
                    @foreach(json_decode($r->hasil_karya, true) as $images)
				
	    			<div class="card-karya card">
	      			
            			<a href="{{ URL::to('hasil_karya/'.$r->user_id.'/'.$images)}}" target="_blank">
		          		<div class="work-img">
		            		<img src="{{asset('hasil_karya/'.$r->user_id.'/'.$images)}}" class="img-thumbnail br-top-img card-img-top-karya" width="50px" />
		          		</div>
						</a>
				
					</div>
					<br>
                    @endforeach 
                    </td>
					<td data-label="Deskripsi_Karya" style="text-align: justify">{{$r->deskripsi_karya}}</td>
					<td data-label="Status" style="text-align: center">
                    @if($r->status == 0)
                    <span class="label label-primary">Pending</span>
                    @elseif($r->status == 1)
                    <span class="label label-success">Approved</span>
                    @elseif($r->status == 2)
                    <span class="label label-danger">Rejected</span>
                    @else
                    <span class="label label-info">Postponed</span>
                    @endif
                    </td>
					<td width="100" data-label="Aksi" style="text-align: center">

                    <a type="button" data-toggle="modal" href="#{{$r->id}}-Aksi" role="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                </td>
				</tr>
				</tbody>
            <?php $no++?>
				@endforeach
                </table>
                
                <?php echo str_replace('/?','?',$karyax->render()); ?>
			</div>
			

				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal untuk menampilkan pilihan aksi -->
@foreach($karyax as $r)
<div class="modal fade" id="{{$r->id}}-Aksi" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">Pilih Aksi</h5>
      </div>
      <div class="modal-body">
    
      <form method="post" action="{{action('KaryaKelasController@update', $r->id)}}">
        @csrf
         <div class="row">
            <div class="form-group">
                <select class="form-control" name="approve">
                  <option value="0" @if($r->status==0)selected @endif>Pending</option>
                  <option value="1" @if($r->status==1)selected @endif>Approve</option>
                  <option value="2" @if($r->status==2)selected @endif>Reject</option>
                  <option value="3" @if($r->status==3)selected @endif>Postponed</option> 
                </select>
            </div>
        </div>
        <div class="form-inline row">
          <div class="form-group" style="float: right;">
            <button type="submit" class="btn btn-success">Update</button>
          </div>
        </div>
      </form>
      

    </div>
  </div>
</div>
</div>
@endforeach



@endsection
