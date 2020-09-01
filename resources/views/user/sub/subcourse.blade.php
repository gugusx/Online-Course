@extends('layouts.user')
@section('content')
@php
	$uri = Request::segment(2);

	function rp($angka) {
      $rp = "Rp. " . number_format($angka, 0, ',', '.');
      return $rp;
    }
@endphp

<style>

	.card-filter {
    	transition: 0.3s;
		border-radius: 5px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);
	}

	/*.card-filter:hover {
	    box-shadow: 0 3px 4px -2px rgba(0,0,0,0.2);
	}*/
</style>

<div class="card mb-6">
	<div class="panel-body">
		<ol class="breadcrumb m-0 p-0 bg-white">
		  <li><a href="{{asset('/home')}}" class="text-dark"><i class="fa fa-home"></i></a></li>
		  <li><a class="text-dark" href="{{ asset('course') }}">Course</a></li>
		  <li class="active"><a href="#"></a>{{ $pageName }}</li>
		</ol>	
	</div>
</div>
<div class="row">

	<div class="col-xs-12 col-md-3">
		<div class="card card-filter mb-4">
			<div class="panel-heading pb-0">
				<h5 class="m-0 font-weight-bold">Filter</h5>
			</div>
			<hr class="mt-4 mb-0">
			<div class="panel-body pr-0 pl-0 pt-0">

				{{-- Kategori --}}
				<div class="accordion">
		            <div class="accordion-group panel panel-light mb-0">
		                <div class="panel-heading pt-1 pb-1">
		                        <a class="text-dark font-weight-semibold expand" 
		                        data-toggle="collapse" href="#collapse">
		                            Kategori <span class="fa fa-angle-down float-right mt-2"></span>
		                        </a>
		                </div>
		                <div id="collapse" class="accordion-body collapse {{ (isset($_GET['ktg'])) ? 'in' : '' }}">
		                	<div class="panel-body pt-0 pb-0">

		                		@foreach($kategorimod as $d)
		                		<div class="row">
		                			<div class="col-md-2">
		                				<div class="checkbox mt-0 mb-0">
										  	<input id="ktg{{ $d->id }}" type="checkbox" {{ ($uri == $d->id) ? 'checked' : '' }}>
										  	<label for="ktg{{ $d->id }}"></label>
								  		</div>
		                			</div>
		                			<div class="col-md-10 pl-0">
		                				<span>{{ $d->kategori_mod }}</span>
		                			</div>
		                		</div>
		                		@endforeach
		                		
		                	</div>
		                </div>
		            </div>
		        </div>

		        {{-- Jenis --}}
		        <div class="accordion">
		            <div class="accordion-group panel panel-light mb-0">
		                <div class="panel-heading pt-1 pb-1">
		                        <a class="text-dark font-weight-semibold" data-toggle="collapse" href="#collapse2">
		                            Jenis <span class="fa fa-angle-down float-right mt-2"></span>
		                        </a>
		                </div>
		                <div id="collapse2" class="accordion-body collapse">
		                	<div class="panel-body pt-0 pb-0">

		                		@foreach($jenis as $d)
		                		<div class="row">
		                			<div class="col-md-2">
		                				<div class="checkbox mt-0 mb-0">
										  	<input id="jenis{{ $d->id }}" type="checkbox">
										  	<label for="jenis{{ $d->id }}"></label>
								  		</div>
		                			</div>
		                			<div class="col-md-10 pl-0">
		                				<span>{{ $d->nm_jenis }}</span>
		                			</div>
		                		</div>
		                		@endforeach
		                		
		                	</div>
		                </div>
		            </div>
		        </div>

		        {{-- Jenjang --}}
		        <div class="accordion">
		            <div class="accordion-group panel panel-light mb-0">
		                <div class="panel-heading pt-1 pb-1">
		                        <a class="text-dark font-weight-semibold" data-toggle="collapse" href="#collapse3">
		                            Jenjang <span class="fa fa-angle-down float-right mt-2"></span>
		                        </a>
		                </div>
		                <div id="collapse3" class="accordion-body collapse">
		                	<div class="panel-body pt-0 pb-0">

		                		@foreach($jenjang as $d)
		                		<div class="row">
		                			<div class="col-md-2">
		                				<div class="checkbox mt-0 mb-0">
										  	<input id="jenjang{{ $d->id }}" type="checkbox">
										  	<label for="jenjang{{ $d->id }}"></label>
								  		</div>
		                			</div>
		                			<div class="col-md-10 pl-0">
		                				<span>{{ $d->nm_jenjang }}</span>
		                			</div>
		                		</div>
		                		@endforeach
		                		
		                	</div>
		                </div>
		            </div>
		        </div>

		        {{-- Kelas --}}
		        <div class="accordion">
		            <div class="accordion-group panel panel-light mb-0">
		                <div class="panel-heading pt-1 pb-1">
		                        <a class="text-dark font-weight-semibold" data-toggle="collapse" href="#collapse4">
		                            Kelas <span class="fa fa-angle-down float-right mt-2"></span>
		                        </a>
		                </div>
		                <div id="collapse4" class="accordion-body collapse">
		                	<div class="panel-body pt-0 pb-0 scroll-kelas">

		                			{{-- <div class="col-md-12">
		                				<select name="kelas_id" class="form-control select2">
				                		@foreach($kelas as $d)
				                			<option value="{{ $d->id }}">{{ $d->nm_kelas }}</option>
				                		@endforeach
				                		</select>
		                			</div> --}}

					                @foreach($kelas as $d)
			                		<div class="row">
			                			<div class="col-md-2">
			                				<div class="checkbox mt-0 mb-0">
											  	<input id="kelas{{ $d->id }}" type="checkbox">
											  	<label for="kelas{{ $d->id }}"></label>
									  		</div>
			                			</div>
			                			<div class="col-md-10 pl-0">
			                				<span>{{ $d->nm_kelas }}</span>
			                			</div>
			                		</div>
					                @endforeach
		                		
		                	</div>
		                </div>
		            </div>
		        </div>

				{{-- Mapel --}}
		        <div class="accordion">
		            <div class="accordion-group panel panel-light mb-0">
		                <div class="panel-heading pt-1 pb-1">
		                        <a class="text-dark font-weight-semibold" data-toggle="collapse" href="#collapse5">
		                            Mapel <span class="fa fa-angle-down float-right mt-2"></span>
		                        </a>
		                </div>
		                <div id="collapse5" class="accordion-body collapse {{ (isset($_GET['mapel'])) ? 'in' : '' }}">
		                	<div class="panel-body pt-0 pb-0 scroll-kelas">

		                			{{-- <div class="col-md-12">
		                				<select name="kelas_id" class="form-control select2">
				                		@foreach($mapel as $d)
				                			<option value="{{ $d->id }}">{{ $d->nm_mapel }}</option>
				                		@endforeach
				                		</select>
		                			</div> --}}

				                	@foreach($mapel as $d)
			                		<div class="row">
			                			<div class="col-md-2">
			                				<div class="checkbox mt-0 mb-0">
											  	<input id="mapel{{ $d->id }}" type="checkbox">
											  	<label for="mapel{{ $d->id }}"></label>
									  		</div>
			                			</div>
			                			<div class="col-md-10 pl-0">
			                				<span>{{ $d->nm_mapel }}</span>
			                			</div>
			                		</div>
				                	@endforeach
		                		
		                	</div>
		                </div>
		            </div>
		        </div>

			</div>
		</div>
		<button class="btn btn-hijau btn-block shadow" style="border-radius: 5px;">Telusuri Course</button>

	</div>
	<div class="col-md-9">
		<div class="row">
			@if($modul->count() > 0)

			@foreach($modul as $d)
			@php
				$join = DB::table('cart')->where('stcart', 1)->where('modul_id', $d->id)->count();
			@endphp

				<div class="col-md-4">
				    <div class="card card-other">
				      	<div class="work-box2">
			            	<a href="{{asset('modul/' . $d->id . '/show' )}}">
					          	<div class="work-img">
					            	<img src="{{ asset($d->gambar) }}" class="img-thumbnail br-top-img" />
					          	</div>
					        </a>
				      	</div>
				      	<div class="panel-body" style="height: 145px">
			            	<a class="text-dark" href="{{asset('modul/' . $d->id . '/show' )}}">
					          	<p class="mt-0 mb-0"><b>
					          	@if(strlen($d->judul) > 45)
					          	{{ substr($d->judul, 0, 45) . "..." }}
					          		@else
					          	{{$d->judul}}
					          	@endif
					         	</b></p>
					        </a>
					        <span class="text-smaller">{{$d->nm_trainer}}</span>
						    @if($d->sertifikat == 1)
					        <br>
							@for($i = 1; $i <= 5; $i++)
					        <span class="fa fa-star text-star checked-star mt-2"></span>
					        @endfor
					        <span class="text-secondary">({{$join}})</span>
					        <br>

						    <div class="floating-box mt-2">
						    	<strike>{{rp($d->harga_lama)}}</strike>
						    </div>
					    <div class="floating-box">
						    	<b class="text-large">{{rp($d->harga)}}</b>
						    </div>
						    @endif
				      	</div>
				    </div>
				</div>

			@endforeach

			@else 
				<div class="col-md-12">
					<div class="card">
						<div class="panel-body">
							<h3 class="text-center mt-2">~ Course tidak ditemukan ~</h3>
						</div>
					</div>
				</div>
			@endif
		</div>

		{{ $modul->links() }}
	</div>

</div>

<script>
	$(function() {
	  $(".expand").on( "click", function() {
	    console.log('tes');
	  });
	});
</script>

@endsection