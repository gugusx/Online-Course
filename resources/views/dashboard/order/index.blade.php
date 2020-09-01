@extends('layouts.app')
@section('content')

@php
function rp($angka)
{
  $rp = "Rp. " . number_format($angka, 0, ',', '.');
  return $rp;
}

function tgl($created_at) {

	$dt 	= new DateTime($created_at);
	$date 	= $dt->format('Y-m-d');

	$BulanIndo = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];

	$tahun  = substr($date, 0, 4);
	$bulan  = substr($date, 5, 2);
	$tgl    = substr($date, 8, 2);
	$result = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun;
	return ($result);
}
@endphp

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Data Order Modul
			</div>
			<div class="panel-body">
				<div class="table-responsive pt-1 pr-1">
					<table class="table table-striped table-bordered example">
						<thead>
							<tr>
								<th width="25">#</th>
								<th>Kode Transaksi</th>
								<th>Tanggal</th>
								<th>Nama</th>
								<th>Pesanan</th>
								<th>Jumlah</th>
								<th>Metode</th>
								<th>Konfirmasi</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 1;
							@endphp
							@foreach($tran as $d)
							@php	
    							$cartx = DB::table('cart')->where('transaksi_id', $d->kode)->count();
							@endphp
							<tr>
								<td>{{$no++}}</td>
								<td>{{$d->kode}}</td>
								<td>{{tgl($d->created_at)}}</td>
								<td>{{$d->name}}</td>
								<td>{{$cartx}} Modul</td>
								<td>{{rp($d->total)}}</td>
								<td>Transfer Via {{$d->atm}}</td>
								<td>
								<div class="switch">
                                    <label>
                                        <input type="checkbox" value="{{$d->id}}" 
                                        @if ($d->status == '1')
    									checked
    									@endif 
    									id="update-stt-{{$d->id}}">
                                    <span class="lever switch-col-blue"></span>
                                    </label>
                                </div>
								</td>
								<td>
									<button class="btn btn-success" data-toggle="modal" data-target="#detail_{{$d->id}}">
										<i class="fa fa-sign-in mr-2"></i>Detail</button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
@foreach($tran as $d)
@php
	$cartx = DB::table('cart')->where('transaksi_id', $d->kode)
            ->join('modul', 'modul_id', '=', 'modul.id')
            ->join('trainers', 'modul.trainer_id', '=', 'trainers.id')
            ->select('modul.*', 'trainers.nm_trainer', 'trainers.jabatan')
            ->get();
@endphp
<div class="modal fade" id="detail_{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="top: 80px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detail Orderan</h4>
      </div>
      <div class="modal-body">
      	<div class="table-resposive">
        	<table class="table table-striped">
        		<tr>
        			<td width="200">Kode Transaksi</td>
        			<td>{{$d->kode}}</td>
        		</tr>
        		<tr>
        			<td>Tanggal</td>
        			<td>{{$d->created_at}}</td>
        		</tr>
        		<tr>
        			<td>Nama</td>
        			<td>{{$d->name}}</td>
        		</tr>
        		<tr>
        			<td>Jumlah</td>
        			<td>{{rp($d->total)}}</td>
        		</tr>
        		<tr>
        			<td>Metode Pembayaran</td>
        			<td>Transfer via {{$d->atm}}</td>
        		</tr>
        		<tr>
        			<td>Status</td>
        			<td>
        				@if($d->status == 0)
        				<span class="badge badge-warning">Belum dikonfirmasi</span>
        				@else
        				<span class="badge badge-success">Sukses</span>
        				@endif
        			</td>
        		</tr>
        		<tr>
        			<td>Pesanan</td>
        			<td>
        				<ul style="padding-left: 18px;">
        					@foreach($cartx as $r)
        					<li>{{$r->judul}}</li>
        					@endforeach
        				</ul>
        			</td>
        		</tr>
        	</table>
        </div>
      </div>
      <div class="modal-footer">
      	<form action="{{ asset('update-stt') }}" method="post">      
      	{{ csrf_field() }}		
      	<input type="hidden" name="id" value="{{$d->id}}">
      	<input type="hidden" name="apply" value="1">
      		<button type="submit" class="btn btn-primary">Konfirmasi</button>
      	</form>
      </div>
    </div>
  </div>
</div>

<script>
	    $("#update-stt-{{$d->id}}").on("change", function () {
	    	var val = $(this).val();
	        var apply = $(this).is(':checked') ? '1' : '0';

	        $.ajax({
	        	type: 'post',
	        	url: '{{asset('update-stt')}}',
	        	data : {
	        		"_token" : "{{ csrf_token() }}",
	        		"id" : val,
	        		"apply" : apply,
	        	}, success:function(data) {
	        		console.log(data);
	        		if(data == 1) {
            			toastr.success('Berhasil dikonfirmasi');
	        		} else {
            			toastr.error('Batal dikonfirmasi');
	        		}
	        	}
	        })
		})
</script>
@endforeach

@endsection