@extends('layouts.user')
@section('content')
@php
    function rp($angka) {
      $rp = "Rp. " . number_format($angka, 0, ',', '.');
      return $rp;
    }
@endphp

<style>
.card-other {
	transition: 0.3s;
  	box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.3);
}

.card-other:hover {
  	box-shadow: 0 3px 14px -2px rgba(0,0,0,0.2);
}

.card:hover{ 
  box-shadow: 0 0.15rem 1rem 0 rgba(58, 59, 69, 0.15) !important;
}

.card {
	transition: box-shadow 0.3s ease-in-out;
}

.wizard-inner:hover{ 
  box-shadow: 0 0.15rem 1rem 0 rgba(58, 59, 69, 0.15) !important;
}


.wizard .nav-tabs {
    position: relative;
    /*margin: 20px auto;*/
    margin-bottom: 0;
    border-bottom-color: #e0e0e0;
}

.wizard > div.wizard-inner {
    position: relative;
	transition: box-shadow 0.3s ease-in-out;
}

.connecting-line {
    height: 2px;
    background: #e0e0e0;
    position: absolute;
    width: 67%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}

span.round-tab {
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: #fff;
    border: 2px solid #e0e0e0;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 25px;
}
span.round-tab i{
    color:#555555;
}
.wizard li.active span.round-tab {
    background: #fff;
    border: 2px solid #0B71C3;
    
}
.wizard li.active span.round-tab i{
    color: #0B71C3;
}

span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
}

.wizard .nav-tabs > li {
    width: 33.333%;
}

.wizard li:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #0B71C3;
    transition: 0.1s ease-in-out;
}

.wizard li.active:after {
    /*content: " ";
    position: absolute;
    left: 48%;
    opacity: 1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #0B71C3;*/
}

.wizard .nav-tabs > li a {
    width: 70px;
    height: 70px;
    margin: 20px auto;
    border-radius: 100%;
    padding: 0;
}

    .wizard .nav-tabs > li a:hover {
        background: transparent;
    }

.wizard .tab-pane {
    position: relative;
    padding-top: 15px;
}

.wizard h3 {
    margin-top: 0;
}

@media( max-width : 585px ) {

    .wizard {
        width: 100%;
        height: auto !important;
    }

    span.round-tab {
        font-size: 16px;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard .nav-tabs > li a {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 35%;
    }
}

@media (min-width:767px) {
	.mb-2-cart {
		margin-bottom: 0.5rem !important;
	}

	.mr-8-cart {
		margin-right: 8px;
	}

	.ml-80-cart {
		margin-left: 80px;
	}

	.mr-sbt-cart {
		margin-right: 105px;
	}
}

.text-cart {
	color: #0B71C5;
}

.border-cart-tr {
	border: 1px solid #D5D5D5;
}

.border-mt-tr {
	 border-top: 2px solid #0B71C5; 
	 vertical-align: sub;
}

.upload-konfir {
	 position: absolute;
	 opacity: 0;
	 width: 80px;
}
@if($page == 'two') 
	.connecting-line {
        background: linear-gradient(to right,  #0B71C3 50%,#e0e0e0 0%);
	}
@elseif($page == 'tri')
	.connecting-line {
		background: #0B71C3;
	}
@endif
</style>

<div class="card mb-6">
	<div class="panel-body">
		<ol class="breadcrumb" style="background-color: white; margin-bottom: 0; padding: 0;">
		  <li><a href="{{asset('/home')}}" style="color: black;"><i class="fa fa-home"></i></a></li>
		  <li><a class="text-dark" href="{{asset('/cart')}}">Keranjang Belanja</a></li>
		  <li class="active"><a class="text-secondary" href="#">Proses Pembayaran</a></li>
		</ol>	
	</div>
</div>

	<section>
    <div class="wizard" style="background-color: unset;">
        <div class="wizard-inner"  style="background-color: white; border-radius: 10px;">
            <div class="connecting-line"></div>
            <ul class="nav nav-tabs" role="tablist" style="border-bottom: unset;">

                <li role="presentation" id="checkout-tab" class="{{($page == 'one' || $page == 'two' || $page == 'tri') ? 'active' : '' }}">
                    <a href="#" class="mb-2-cart" data-toggle="tab" aria-controls="step1" role="tab" title="Check Out">
                        <span class="round-tab">
                        	@if($page == 'two' || $page == 'tri')
                            	<i class="glyphicon glyphicon-ok"></i>
                        	@else 
                            	<i class="glyphicon glyphicon-shopping-cart"></i>
                        	@endif
                        </span>
                    </a>
                    <p class="text-center hidden-xs">CHECK OUT</p>
                </li>

                <li role="presentation" class="{{($page == 'two' || $page == 'tri') ? 'active' : '' }}">
                    <a href="#" data-toggle="tab" class="mb-2-cart" aria-controls="step2" role="tab" title="Pembayaran">
                        <span class="round-tab">
                            @if($page == 'one' || $page == 'two')
                            	<i class="fa fa-money mr-8-cart"></i>
                        	@elseif($page == 'tri') 
                            	<i class="glyphicon glyphicon-ok"></i>
                        	@endif
                        </span>
                    </a>
                    <p class="text-center hidden-xs">PEMBAYARAN</p>
                </li>
                <li role="presentation" class="{{($page == 'tri') ? 'active' : '' }}">
                    <a href="#" data-toggle="tab" class="mb-2-cart" aria-controls="step3" role="tab" title="Selesai">
                        <span class="round-tab">
                            @if($page == 'tri')
                            	<i class="glyphicon glyphicon-ok"></i>
                        	@else
                            	<i class="glyphicon glyphicon-check"></i>
                        	@endif
                        </span>
                    </a>
                    <p class="text-center hidden-xs">SELESAI</p>
                </li>

            </ul>
        </div>

        <div role="form">
            <div class="tab-content">
                <div class="tab-pane {{($page == 'one') ? 'active' : '' }}" role="tabpanel" id="step1">
                @if($page == 'one')
                    <div class="row">	
                    	<div class="col-md-8">
	                    	<div class="card">
		                        <div class="panel-body">	
		                    		<h5 class="text-cart"><b>PESANAN ANDA</b></h5>
		                    		<div class="table-responsive">
		                    		<table width="100%">
		                    			<thead>
		                    				<tr>	
		                    					<th><p class="m-0 text-small ml-2">PRODUK</p></th>
		                    					<th><p class="m-0 text-small ml-2">HARGA</p></th>
		                    				</tr>
		                    			</thead>
		                    			<tbody>	
		                    				@foreach($cart as $d)
		                        			<tr class="border-cart-tr">	
		                    					<td class="p-5">
		                    						<input type="hidden" name="modul_id_cart[]" value="{{$d->modul_id}}">
		                    						<input type="hidden" name="cart_id_cart[]" value="{{$d->idc}}">
		                    						{{$d->judul}}
		                    					</td>
		                    					<td>{{rp($d->harga)}}</td>
		                    				</tr>
		                    				<tr style="height: 7px;"><td></td></tr>
		                    				@endforeach
		                    				<tr class="border-mt-tr">
		                    					<td><p class="text-right text-cart p-5"><b>TOTAL PEMBELIAN</b></p></td>
		                    					<td><p class="text-cart"><b>{{rp($price->hb)}}</b></p></td>
		                    				</tr>
		                    				<tr>
		                    					{{-- <td colspan="2">
		                    						<div class="row">
		                    							<div class="col-md-6">
		                    								<p class="text-small">Saya telah membaca dan menyetujui ketentuan
				                    							<a href="#" class="text-cart">syarat dan ketentuan</a> 
				                    						di web ini</p>
		                    							</div>
		                    							<div class="col-md-6">
		                    								<a href="{{asset('pembayaran')}}" class="btn btn-blue btn-block">LANJUT PEMBAYARAN</a>
		                    							</div>
		                    						</div>
		                    					</td> --}}
		                    				</tr>
		                    			</tbody>
		                    		</table>
		                    		</div>
		                    	</div>
		                    </div>
                    	</div>
                    	<div class="col-md-4">
		                    <div class="card">
		                        <div class="panel-body">
		                    		<form action="{{asset('addbuy')}}" method="post">
		                    			@csrf
		                    		<h5 class="text-cart"><b>METODE PEMBAYARAN</b></h5>
		                    		<div class="form-group">	
		                    			<p class="m-0 mb-2 text-small">TRANSFER VIA ATM</p>
		                    			<select id="bank-id-{{Auth::user()->id}}" name="bank" class="form-control"
		                    				required oninvalid="this.setCustomValidity('Pilihan tidak boleh kosong')" oninput="setCustomValidity('')"
		                    				>
		                    				<option value="">-Pilih-</option>
		                    				@foreach($bank as $d)
		                    				<option value="{{$d->id}}">{{$d->atm}}</option>
		                    				@endforeach
		                    			</select>
		                    		</div>
		                    		<input type="hidden" name="total" id="total-id-{{Auth::user()->id}}" value="{{$price->hb}}">
		                    		<button type="submit" 
		                    			class="btn btn-blue btn-block">
		                    			LANJUT PEMBAYARAN</button>
		                    		</form>
		                    	</div>
		                    </div>
                    	</div>
                    	<div class="col-md-1"></div>
                    </div>
                @endif
                </div>
                <div class="tab-pane {{($page == 'two') ? 'active' : '' }}" role="tabpanel" id="step2">
                @if($page == 'two')
                   
                   <div class="row">
                   		<div class="col-md-7">

                        	<div class="card">
	                        	<div class="panel-body">
	                        	<h5 class="text-cart"><b>DETAIL PEMESANAN</b></h5>
		                        	<div class="table-resposive">
		                        	<table class="table table-striped">
		                        		<tr>
		                        			<td>Kode Transaksi</td>
		                        			<td>{{$tran->kode}}</td>
		                        		</tr>
		                        		<tr>
		                        			<td>Tanggal</td>
		                        			<td>{{$tran->created_at}}</td>
		                        		</tr>
		                        		<tr>
		                        			<td>Nama</td>
		                        			<td>{{$tran->name}}</td>
		                        		</tr>
		                        		<tr>
		                        			<td>Pesanan</td>
		                        			<td>{{$cartx}} Modul</td>
		                        		</tr>
		                        		<tr>
		                        			<td>Jumlah</td>
		                        			<td>{{rp($tran->total)}}</td>
		                        		</tr>
		                        		<tr>
		                        			<td>Metode Pembayaran</td>
		                        			<td>Transfer via {{$tran->atm}}</td>
		                        		</tr>
		                        		<tr>
		                        			<td>Status</td>
		                        			<td>
		                        				@if($tran->status == 0)
		                        				<span class="badge badge-warning">Belum dikonfirmasi</span>
		                        				@else
		                        				<span class="badge badge-success">Sukses</span>
		                        				@endif
		                        			</td>
		                        		</tr>
		                        	</table>
		                        	</div>
	                        	</div>
                        	</div>
                   		</div>
                   		<div class="col-md-5">
                   			<div class="card">
	                        	<div class="panel-body">
                        		<h5 class="text-cart"><b>TRANSFER VIA {{$bank->atm}}</b></h5>
	                        		<div class="text-center">
										<img src="{{asset($bank->logo)}}" height="60" alt="">
									</div>
									<div class="table-responsive mt-5">
										<table class="table table-striped">
											<tr>
												<td>No. Rekening</td>
												<td>{{$bank->rekening}}</td>
											</tr>
											<tr>
												<td>Atas Nama</td>
												<td>{{$bank->an}}</td>
											</tr>
											<tr>
												<td>Jumlah</td>
												<td>{{rp($tran->total)}}</td>
											</tr>
										</table>
									</div>
									<p>Silakan lakukan transfer sebesar
										<b>{{rp($tran->total)}} (WAJIB SAMA AGAR MUDAH UNTUK DI VERIFIKASI)</b></p>
									<ul style="padding-left: 17px;">
										<li>Setelah melakukan pembayaran silakan tunggu konfirmasi dari kami</li>
										<li>Jika pembayaran belum dikonfirmasi lebih dari 24 jam silahkan hubungi kami</li>
									</ul>
	                        	</div>
	                        </div>
                   		</div>
                   </div>
                @endif
                </div>
                <div class="tab-pane {{($page == 'tri') ? 'active' : '' }}" role="tabpanel" id="step3">
                @if($page == 'tri')
                	<div class="row">
                		<div class="col-md-6">
                			<div class="card">
	                        	<div class="panel-body">
	                        	<h5 class="text-cart"><b>DETAIL PEMESANAN</b></h5>
		                        	<div class="table-resposive">
		                        	<table class="table table-striped">
		                        		<tr>
		                        			<td>Kode Transaksi</td>
		                        			<td>{{$tran->kode}}</td>
		                        		</tr>
		                        		<tr>
		                        			<td>Tanggal</td>
		                        			<td>{{$tran->created_at}}</td>
		                        		</tr>
		                        		<tr>
		                        			<td>Nama</td>
		                        			<td>{{$tran->name}}</td>
		                        		</tr>
		                        		<tr>
		                        			<td>Pesanan</td>
		                        			<td>{{$cartx}} Modul</td>
		                        		</tr>
		                        		<tr>
		                        			<td>Jumlah</td>
		                        			<td>{{rp($tran->total)}}</td>
		                        		</tr>
		                        		<tr>
		                        			<td>Metode Pembayaran</td>
		                        			<td>Transfer via {{$tran->atm}}</td>
		                        		</tr>
		                        		<tr>
		                        			<td>Status</td>
		                        			<td>
		                        				@if($tran->status == 0)
		                        				<span class="badge badge-warning">Belum dikonfirmasi</span>
		                        				@else
		                        				<span class="badge badge-success">Sukses</span>
		                        				@endif
		                        			</td>
		                        		</tr>
		                        	</table>
		                        	</div>
	                        	</div>
                        	</div>
                		</div>
                		<div class="col-md-6">
                			<div class="card">
                				<div class="panel-body">
		                        <h5 class="text-cart"><b>MODUL ANDA</b></h5>
                        		<div class="row">

                        		@foreach($modul as $md)

							    @php
							      $kv = DB::table('Kategorivideo')->where('modul_id', $md->id)->count();
							      $vd = DB::table('video')
							      ->join('Kategorivideo', 'video.kategorivideo_id', '=', 'Kategorivideo.id')
							      ->where('Kategorivideo.modul_id', $md->id)
							      ->orderBY('list', 'asc');
							    @endphp

							      <div class="col-md-6">
							        <div class="card card-other">
							          <div class="work-box2">
							            <a href="{{asset('video/show/' . $vd->first()->list . '/' . $md->id )}}">
							              <div class="work-img">
							                <img src="{{ asset($md->gambar) }}" class="img-thumbnail br-top-img" />
							              </div>
							            </a>
							          </div>
							          <div class="panel-body" style="height: 165px">
							            <a href="{{asset('video/show/' . $vd->first()->list . '/' . $md->id )}}" class="text-dark">
							              <p class="mt-0 mb-0"><b>
							              	@if(strlen($md->judul) > 40)
							              	{{ substr($md->judul, 0, 40) . "..." }}
							              		@else
							              	{{$md->judul}}
							              	@endif
							              </b></p>
							            </a>
							            <span>{{$md->nm_trainer}} / {{$md->jabatan}}</span>
							            <br>
							            <br>
							            <div class="floating-box">
							               <p><i class="glyphicon glyphicon-tags" style="color: #9E4B4B"></i>&nbsp; <b>{{$kv}}</b> Topik</p>
							            </div>
							              &emsp;
							            <div class="floating-box">
							               <p><i class="glyphicon glyphicon-facetime-video" style="color: #6E1D9E"></i>&nbsp; <b>{{$vd->count()}}</b> Video</p>
							            </div>

							          </div>
							        </div>
							      </div>
							    @endforeach
		                        
                        		</div>		                        		
                				</div>
                			</div>
                		</div>
                	</div>
                @endif
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>

<script>

	function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#blah')
                  .attr('src', e.target.result)
                  .removeClass()
                  .height(150);
          };

          reader.readAsDataURL(input.files[0]);
      }
  	}

  	function saveBuyer(id) {
  		var bank  = $("#bank-id-"+id+" option:selected").val();
  		var total = $("#total-id-"+id).val();
  		if(bank == 0) {
            toastr.warning('Harap pilih bank terlebih dahulu');
  		} else {
  			$.ajax({
	            type: 'post',
	            url: '{{asset('addbuy')}}',
	            data: {
	                "_token": "{{ csrf_token() }}",
	                "bank": bank,
	                "total" : total,
	            },
	            beforeSend: function() {
  					$("#btn-buyer-"+id).text('load....');
	            },
	            success: function(data) {
	              	window.location.href = '{{asset('pembayaran')}}';
	            }
	        })
  		}
  	}

	$(document).ready(function () {

		$('#uploads-konfir-{{Auth::user()->id}}').on('submit', function(event){
		  event.preventDefault();
		  console.log('success');

		  $.ajax({
		  	type : 'post',
		  	url  : "{{ asset('addbukti') }}",
		  	data : new FormData(this),
		  	dataType: 'JSON',
		  	contentType: false,
		  	cache: false,
		   	processData: false,
		   	error: function(data) {
		        console.log(data);
		    },
		  	success: function(data) {
		  		// console.log(data);
		  	}
		  });

		//   $.ajax({
		//    type:"POST",
		//    url:"{{ asset('addbukti') }}",
		//    data:new FormData(this),
		//    dataType:'JSON',
		//    contentType: false,
		//    cache: false,
		//    processData: false,
		//    success:function(data)
		//    {
		//     console.log(data);
		//    }
		//   })
		});

		// $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		//     localStorage.setItem('activeTab', $(e.target).attr('href'));
		// });

		// var activeTab = localStorage.getItem('activeTab');
		// if(activeTab){
		//     $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
		// }

	    //Initialize tooltips
	    $('.nav-tabs > li a[title]').tooltip();
	    
	    //Wizard
	    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

	        var $target = $(e.target);
	    
	        if ($target.parent().hasClass('disabled')) {
	            return false;
	        }
	    });

	    $(".next-step").click(function (e) {

	        var $active = $('.wizard .nav-tabs li.active');
	        $active.next().removeClass('disabled');
	        nextTab($active);

	    });

	    $(".prev-step").click(function (e) {

	        var $active = $('.wizard .nav-tabs li.active');
	        prevTab($active);

	    });
	});

	function nextTab(elem) {
	    $(elem).next().find('a[data-toggle="tab"]').click();
	}
	function prevTab(elem) {
	    $(elem).prev().find('a[data-toggle="tab"]').click();
	}

	function confirmPurchase(id) {
		mod = $("input[name='modul_id_cart[]']").map(function() {
			return $(this).val();
		}).get();

		cart = $("input[name='cart_id_cart[]']").map(function() {
			return $(this).val();
		}).get();

		berita = $("#no-berita-cart-"+id).text();

		Swal.fire({
          title: 'Konfirmasi Pembayaran ',
          text: "Harap ingat nomor berita anda "+berita+" ",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Lanjutkan',
      	cancelButtonText: 'Kembali',
        }).then((result) => {
          if (result.value) {
            $.ajax({
	            type: 'post',
	            url: '{{route('cart.cart.store')}}',
	            data: {
	                "_token": "{{ csrf_token() }}",
	                "mod": mod,
	                "berita" : berita,
	                "cart" : cart
	            },
	            success: function(data) {
	              	location.reload();
	              	localStorage.setItem("activeTab", "#step3");
	            }
	        })
          }

        })
    }

    function confirmSubmit(id) {
		mod = $("input[name='modul_id_cart[]']").map(function() {
			return $(this).val();
		}).get();

		cart = $("input[name='cart_id_cart[]']").map(function() {
			return $(this).val();
		}).get();

		berita = $("#no-berita-cart-"+id).text();

		Swal.fire({
          title: 'Konfirmasi Pembayaran ',
          text: "Harap ingat nomor berita anda "+berita+" ",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Lanjutkan',
      	cancelButtonText: 'Kembali',
        }).then((result) => {
          if (result.value) {
            $.ajax({
	            type: 'post',
	            url: '{{route('cart.cart.store')}}',
	            data: {
	                "_token": "{{ csrf_token() }}",
	                "mod": mod,
	                "berita" : berita,
	                "cart" : cart
	            },
	            success: function(data) {
	              	location.reload();
	              	localStorage.setItem("activeTab", "#step3");
	            }
	        })
          }

        })
    }

</script>

@endsection