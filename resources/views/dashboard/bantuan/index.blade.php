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
				<div class="panel-heading">Histori Tiket Bantuan</div>
				<div class="panel-body">

<br>
			<div>
				<table class="table table-hover table-striped" >
					<thead>
						<tr>
		    				<th width="30">No</th>
		    				<th width="150">Nama</th>
		    				<th width="500">Subjek</th>
		    				<th style="text-align: center">Tanggal&Waktu</th>
		    				<th style="text-align: center">Status</th>
		    				<th style="text-align: center">Aksi</th>
						</tr>
					</thead>
				<?php $no = 1?>
				@foreach($bantuans->sortByDesc('created_at') as $r)
				<tbody>
				<tr>
					<td data-label="No">{{$no}}. </td>
					<td data-label="Nama">{{$r->name}}</td>	
					<td data-label="Subjek"><a data-toggle="modal" href="#{{$r->id}}-Detil" role="button" aria-expanded="false" aria-controls="collapseExample">{{$r->subjek}}</a></td>
					<td data-label="DTanggal&Waktu" style="text-align: justify">{{$r->created_at}}</td>
					<td data-label="Status" style="text-align: center">
                    @if($r->status == 0)
                    <span class="label label-primary">Menunggu</span>
                    @elseif($r->status == 2)
                    <span class="label label-info">Diproses</span>
                    @else($r->status == 3)
                    <span class="label label-success">Selesai</span>
                    @endif
                    </td>
					<td width="100" data-label="Aksi" style="text-align: center">

                    <a type="button" data-toggle="modal" href="#{{$r->id}}-Aksi" role="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a type="button" href="#" role="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-bell"></span></a>
                </td>
				</tr>
				</tbody>
            <?php $no++?>
				@endforeach
                </table>
                
                <?php echo str_replace('/?','?',$bantuans->render()); ?>
			</div>
			

				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal untuk menampilkan pilihan aksi -->
@foreach($bantuans as $r)
<div class="modal fade" id="{{$r->id}}-Aksi" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">Pilih Aksi</h5>
      </div>
      <div class="modal-body">
    
      <form method="post" action="{{action('BantuanController@update', $r->id)}}">
        @csrf
         <div class="row">
            <div class="form-group">
                <select class="form-control" name="approve">
                  <option value="0" @if($r->status==0)selected @endif>Menunggu</option>
                  <option value="2" @if($r->status==2)selected @endif>Diproses</option>
                  <option value="3" @if($r->status==3)selected @endif>Selesai</option>
                </select>
            </div>
        </div>
        <div class="form-inline row">
          <div class="form-group" style="float: right">
            <button type="submit" class="btn btn-success">Update</button>
          </div>
        </div>
      </form>
      

    </div>
  </div>
</div>
</div>
@endforeach

<!-- Modal untuk menampilkan rincian tiket bantuan di dashbpard admin -->
@foreach($bantuans as $r)  
<div class="modal fade" id="{{$r->id}}-Detil" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 1200px; max-width: 100%;">
    <div class="modal-content">
    <div class="modal-header">
        <div class="modal-title">
        <h4><b>Subjek:</b> {{$r->subjek}}</h4>
        </div>
    </div>
    <div class="modal-body">
    <div class="container">
        <hr>
        <div class="control-group">
        <div class="col-md-2">
            <img class="avatar" src="{{asset($r->gambar)}}" width="25%">
            <label class="control-label" for="Nama">{{$r->name}}</label>
		</div>        
        </div>
        <br><br><br>
                <br>
                <div class="control-group" style="margin-left:20px">
                    <label class="control-label" for="Pesan" style="text-decoration: underline">Pesan</label>
                    <div class="controls">
                    <div class="card">
                    {!!$r->pesan!!}
                    </div>
                    </div>
                </div>
                <hr>

             
        @foreach($balasan_pesans as $b)
        @if($b->pesan_id == $r->id)
<br>
<div class="control-group">
        <div class="col-md-2">
            <img class="avatar" src="" width="25%">
            <label class="control-label" for="Nama">Nama Adm</label>
		</div>        
        </div>
        <br><br><br>
                <br>
               
<div class="control-group" style="margin-left:20px">
                    <label class="control-label" for="Pesan" style="text-decoration: underline">Balasan Pesan</label>
                    <div class="controls">
                    <div class="card">
                    {!!$b->balasan_pesan!!}
                    </div>
                    </div>
                </div>

                <div class="control-group" style="margin-left: 20px">
                @foreach(json_decode($r->lampiran, true) as $images)
        <div class="card-karya card">
              <a href="{{ URL::to('lampiran/'.$r->user_id.'/'.$images)}}" target="_blank">
              <div class="work-img">
                <img src="{{asset('lampiran/'.$r->user_id.'/'.$images)}}" class="img-thumbnail br-top-img card-img-top-karya" width="50px" />
              </div>
        </a>
    
      </div>
      <br>

                @endforeach 
                </div><hr>

                @else
                <p style="text-align: center;font-size: 20px;"><b> Tidak ada balasan</b></p>
                @endif
@endforeach

              <hr>  <div class="control-group">
              <div class="form form-inline" style="text-align: center">
              <a type="button" data-toggle="modal" href="#balaspesan-{{$r->id}}"  style="width: 120px" role="button" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Balas Pesan</a>
        <button type="button" class="btn btn-secondary" style="width: 120px" data-dismiss="modal">Batal</button>
        </div> 
        </div>
        </div>
    </div>
    </div>
  </div>
</div>
@endforeach
<!-- Batas modal detil -->

<!-- Modal untuk menampilkan kolom balasan pesan -->
        @foreach($bantuans as $r)
<div class="modal fade" id="balaspesan-{{$r->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 1200px; max-width: 100%;">
    <div class="modal-content">
      <div class="modal-body">
      <div class="container">
        <form action="{{route('storeBalasanAdmin', $r->id )}}" method="post" enctype="multipart/form-data">
        @csrf
        <hr>
                <div class="control-group">
                    <label class="control-label" for="Pesan">Pesan</label>
                    <div class="controls" style="padding-left: 1px">
                        <textarea class="form-control" rows="5" name="balasan_pesan"></textarea>
                    </div>
                </div>
                <br>
              
<br>
              <hr>  <div class="control-group">
              <div class="form form-inline" style="text-align: center">
        <button type="submit" class="btn btn-primary" style="width: 100px">Kirim</button>
        <button type="button" class="btn btn-secondary" style="width: 100px" data-dismiss="modal">Batal</button>
        </div> 
        </div>
        @include('sweetalert::alert')
        </form>
      
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- Batas modal balasan pesan -->

@endsection


