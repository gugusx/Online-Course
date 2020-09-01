<link rel="stylesheet" href="{{asset('css/tabs.css')}}">

@extends('layouts.user')
@section('content')
@include('sweet::alert')
@php
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

	function convertYoutube($string) {
		return preg_replace(
			"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
			"<iframe class='border-0' src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
			$string
		);
	}

	$jk = Auth::user()->gender;
@endphp

<style>
	iframe {
		width: 100%;
		height: -webkit-fill-available;
	}

	.table>tbody>tr>td {
		border-top: unset;
	}

	@media( max-width : 585px ) {
		.mt-pr {
			margin-top: 15px
		}

		.tabs {
			padding: 18px;
		}
	}

	@media (min-width:767px) {
	
	}
</style>
<script src="{{asset('assets/new/js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>

<div class="row">

	<div class="col-xs-12 col-md-3 mt-pr">
		<div class="card" style="position: relative;">
			<div class="panel-body">
				<img src="{{$user->gambar}}" alt="" style="height: 170px;" class="img-responsive m-auto rounded-border">
				<div class="text-center">
					<h5 class="mb-2">{{$user->name}}</h5>
					{{$user->email}}
				</div>
			</div>
		</div>
		<div class="card-help stack-card-help" style="height: 138px;">
            <div class="panel-body">
				<button data-toggle="modal" data-target="#edit_akun" class="btn btn-red mt-5 btn-block border-10 shadow-lg"><i class="fa fa-key mr-2"></i>Ganti Password</button>
				<a href="{{asset('mycourse')}}" class="btn btn-blue mt-5 btn-block border-10 shadow-lg"><i class="fa fa-video-camera mr-2"></i>Kursus Saya</a>
            </div>
        </div>
        
	</div>
	<div class="col-md-9">

	<div class="tabs">
		<input type="radio" id="tab{{ Auth::user()->id }}1" onclick="check({{Auth::user()->id}}, 1)" name="tab-control" checked>
		<input type="radio" id="tab{{ Auth::user()->id }}2" onclick="check({{Auth::user()->id}}, 2)" name="tab-control">
		<input type="radio" id="tab{{ Auth::user()->id }}3" onclick="check({{Auth::user()->id}}, 3)" name="tab-control">  
		
		<input type="hidden" class="user-radio" value="{{Auth::user()->id}}">
		<script>
			var user_id = $(".user-radio").val();

			function check(id, no) {
				sessionStorage.clear();
				sessionStorage.setItem("tab"+id+no, $("#tab"+id+no).prop("checked")); 
				
			}

			for(var i = 2; i <= 3; i++) {
				$("#tab"+user_id+i).val(function () { 
					$("#tab"+user_id+i).attr("checked", sessionStorage.getItem("tab"+user_id+i)); 
				});
			}

			
		</script>
		
		<ul class="nave">
		    <li title="Profil">
		    	<label for="tab{{ Auth::user()->id }}1" role="button">
		    	<svg class="svg-icon" viewBox="0 0 24 24">
					<path d="M12.075,10.812c1.358-0.853,2.242-2.507,2.242-4.037c0-2.181-1.795-4.618-4.198-4.618S5.921,4.594,5.921,6.775c0,1.53,0.884,3.185,2.242,4.037c-3.222,0.865-5.6,3.807-5.6,7.298c0,0.23,0.189,0.42,0.42,0.42h14.273c0.23,0,0.42-0.189,0.42-0.42C17.676,14.619,15.297,11.677,12.075,10.812 M6.761,6.775c0-2.162,1.773-3.778,3.358-3.778s3.359,1.616,3.359,3.778c0,2.162-1.774,3.778-3.359,3.778S6.761,8.937,6.761,6.775 M3.415,17.69c0.218-3.51,3.142-6.297,6.704-6.297c3.562,0,6.486,2.787,6.705,6.297H3.415z"></path>
				</svg>
				<br><span>Profil Saya</span>
			</label>
			</li>
		    <li title="Ubah Profil" id="profil">
		    	<label for="tab{{ Auth::user()->id }}2" role="button">
		    	<svg class="svg-icon" viewBox="0 0 24 24">
					<path d="M17.498,11.697c-0.453-0.453-0.704-1.055-0.704-1.697c0-0.642,0.251-1.244,0.704-1.697c0.069-0.071,0.15-0.141,0.257-0.22c0.127-0.097,0.181-0.262,0.137-0.417c-0.164-0.558-0.388-1.093-0.662-1.597c-0.075-0.141-0.231-0.22-0.391-0.199c-0.13,0.02-0.238,0.027-0.336,0.027c-1.325,0-2.401-1.076-2.401-2.4c0-0.099,0.008-0.207,0.027-0.336c0.021-0.158-0.059-0.316-0.199-0.391c-0.503-0.274-1.039-0.498-1.597-0.662c-0.154-0.044-0.32,0.01-0.416,0.137c-0.079,0.106-0.148,0.188-0.22,0.257C11.244,2.956,10.643,3.207,10,3.207c-0.642,0-1.244-0.25-1.697-0.704c-0.071-0.069-0.141-0.15-0.22-0.257C7.987,2.119,7.821,2.065,7.667,2.109C7.109,2.275,6.571,2.497,6.07,2.771C5.929,2.846,5.85,3.004,5.871,3.162c0.02,0.129,0.027,0.237,0.027,0.336c0,1.325-1.076,2.4-2.401,2.4c-0.098,0-0.206-0.007-0.335-0.027C3.001,5.851,2.845,5.929,2.77,6.07C2.496,6.572,2.274,7.109,2.108,7.667c-0.044,0.154,0.01,0.32,0.137,0.417c0.106,0.079,0.187,0.148,0.256,0.22c0.938,0.936,0.938,2.458,0,3.394c-0.069,0.072-0.15,0.141-0.256,0.221c-0.127,0.096-0.181,0.262-0.137,0.416c0.166,0.557,0.388,1.096,0.662,1.596c0.075,0.143,0.231,0.221,0.392,0.199c0.129-0.02,0.237-0.027,0.335-0.027c1.325,0,2.401,1.076,2.401,2.402c0,0.098-0.007,0.205-0.027,0.334C5.85,16.996,5.929,17.154,6.07,17.23c0.501,0.273,1.04,0.496,1.597,0.66c0.154,0.047,0.32-0.008,0.417-0.137c0.079-0.105,0.148-0.186,0.22-0.256c0.454-0.453,1.055-0.703,1.697-0.703c0.643,0,1.244,0.25,1.697,0.703c0.071,0.07,0.141,0.15,0.22,0.256c0.073,0.098,0.188,0.152,0.307,0.152c0.036,0,0.073-0.004,0.109-0.016c0.558-0.164,1.096-0.387,1.597-0.66c0.141-0.076,0.22-0.234,0.199-0.393c-0.02-0.129-0.027-0.236-0.027-0.334c0-1.326,1.076-2.402,2.401-2.402c0.098,0,0.206,0.008,0.336,0.027c0.159,0.021,0.315-0.057,0.391-0.199c0.274-0.5,0.496-1.039,0.662-1.596c0.044-0.154-0.01-0.32-0.137-0.416C17.648,11.838,17.567,11.77,17.498,11.697 M16.671,13.334c-0.059-0.002-0.114-0.002-0.168-0.002c-1.749,0-3.173,1.422-3.173,3.172c0,0.053,0.002,0.109,0.004,0.166c-0.312,0.158-0.64,0.295-0.976,0.406c-0.039-0.045-0.077-0.086-0.115-0.123c-0.601-0.6-1.396-0.93-2.243-0.93s-1.643,0.33-2.243,0.93c-0.039,0.037-0.077,0.078-0.116,0.123c-0.336-0.111-0.664-0.248-0.976-0.406c0.002-0.057,0.004-0.113,0.004-0.166c0-1.75-1.423-3.172-3.172-3.172c-0.054,0-0.11,0-0.168,0.002c-0.158-0.312-0.293-0.639-0.405-0.975c0.044-0.039,0.085-0.078,0.124-0.115c1.236-1.236,1.236-3.25,0-4.486C3.009,7.719,2.969,7.68,2.924,7.642c0.112-0.336,0.247-0.664,0.405-0.976C3.387,6.668,3.443,6.67,3.497,6.67c1.75,0,3.172-1.423,3.172-3.172c0-0.054-0.002-0.11-0.004-0.168c0.312-0.158,0.64-0.293,0.976-0.405C7.68,2.969,7.719,3.01,7.757,3.048c0.6,0.6,1.396,0.93,2.243,0.93s1.643-0.33,2.243-0.93c0.038-0.039,0.076-0.079,0.115-0.123c0.336,0.112,0.663,0.247,0.976,0.405c-0.002,0.058-0.004,0.114-0.004,0.168c0,1.749,1.424,3.172,3.173,3.172c0.054,0,0.109-0.002,0.168-0.004c0.158,0.312,0.293,0.64,0.405,0.976c-0.045,0.038-0.086,0.077-0.124,0.116c-0.6,0.6-0.93,1.396-0.93,2.242c0,0.847,0.33,1.645,0.93,2.244c0.038,0.037,0.079,0.076,0.124,0.115C16.964,12.695,16.829,13.021,16.671,13.334 M10,5.417c-2.528,0-4.584,2.056-4.584,4.583c0,2.529,2.056,4.584,4.584,4.584s4.584-2.055,4.584-4.584C14.584,7.472,12.528,5.417,10,5.417 M10,13.812c-2.102,0-3.812-1.709-3.812-3.812c0-2.102,1.71-3.812,3.812-3.812c2.102,0,3.812,1.71,3.812,3.812C13.812,12.104,12.102,13.812,10,13.812"></path>
				</svg>
				<br><span>Ubah Profil</span>
			</label>
			</li>
		    <li title="Video"><label for="tab{{ Auth::user()->id }}3" role="button">
		    	<svg class="svg-icon" viewBox="0 0 24 24">
					<path d="M17.919,4.633l-3.833,2.48V6.371c0-1-0.815-1.815-1.816-1.815H3.191c-1.001,0-1.816,0.814-1.816,1.815v7.261c0,1.001,0.815,1.815,1.816,1.815h9.079c1.001,0,1.816-0.814,1.816-1.815v-0.739l3.833,2.478c0.428,0.226,0.706-0.157,0.706-0.377V5.01C18.625,4.787,18.374,4.378,17.919,4.633 M13.178,13.632c0,0.501-0.406,0.907-0.908,0.907H3.191c-0.501,0-0.908-0.406-0.908-0.907V6.371c0-0.501,0.407-0.907,0.908-0.907h9.079c0.502,0,0.908,0.406,0.908,0.907V13.632zM17.717,14.158l-3.631-2.348V8.193l3.631-2.348V14.158z"></path>
				</svg>
				<br><span>Video</span></label>
			</li> 
		</ul>
		  
		<div class="slider">
			<div class="indicator"></div>
		</div>
		  <div class="content">
		    <section>
		      	<div class="alert alert-warning alert-dismissible" role="alert">
                    <i class="fa fa-info"></i>
                    Silahkan lengkapi profil anda 
                </div>
				<div class="row">
					<div class="col-md-6">
						<div class="table-responsive">
							<table class="table">
								<tr>
									<td width="100"><b>Profesi</b></td>
									<td>{{($user->profesi == '') ? '-' :  $user->profesi}}</td>
								</tr>
								<tr>
									<td><b>Instansi/Sekolah</b></td>
									<td>{{($user->instansi == '') ? '-' :  $user->instansi}}</td>
								</tr>
								<tr>
									<td><b>Alamat</b></td>
									<td>{{($user->alamat == '') ? '-' :  $user->alamat}}</td>
								</tr>
								<tr>
									<td><b>No Telepon</b></td>
									<td>{{($user->no_hp == '') ? '-' :  $user->no_hp}}</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="col-md-6">
						<div class="table-responsive">
							<table class="table">
								<tr>
									<td width="100"><b>Bio</b></td>
									<td>{{($user->bio == '') ? '-' :  $user->bio}}</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
		  	</section>
		    <section>
				@foreach($errors->all() as $error)
				<div class='alert alert-danger alert-dismissable mb-0'>
				  	<a href='' class='close' data-dismiss='alert' aria-label='close'> &times; </a>{{$error}}
				</div>
				@endforeach
				@if($msg = Session::get('success'))
                <div class="alert alert-info alert-dismissible mb-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{$msg}}
                </div>
                @endif

				{!! Form::model($user,['method'=>'POST','route'=>['web.updateuser',$user->id],'class'=>'form-horizontal','files'=>true])!!}
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="id" value="{{$user->id}}">
				<div class="row">
					<div class="col-md-6">
						<div class="table-responsive">
							<table class="table mt-4 mb-0">
								<tr>
									<td>Nama</td>
									<td>:</td>
									<td><input type="text" class="form-control" name="name" value="{{$user->name}}" required=""></td>
								</tr>
								<tr>
									<td>Profesi</td>
									<td>:</td>
									<td><input type="text" class="form-control" name="profesi" value="{{$user->profesi}}"></td>
								</tr>
								<tr>
									<td>Instansi/Sekolah</td>
									<td>:</td>
									<td><input type="text" class="form-control" name="instansi" value="{{$user->instansi}}"></td>
								</tr>
								<tr>
									<td>Jenis Kelamin</td>
									<td>:</td>
									<td>
										<div style="display: flex">
										<div class="radio">
										    <input type="radio" name="gender" id="radio1" value="1" {{($jk == '1') ? 'checked' : ''}}>
										    <label for="radio1">Pria</label>
										</div>

										<div class="radio">
										    <input type="radio" name="gender" id="radio2" value="2" {{($jk == '2') ? 'checked' : ''}}>
										    <label for="radio2">Wanita</label>
										</div>
										</div>
									</td>
								</tr>
								<tr>
									<td width="100">Telepon</td>
									<td>:</td>
									<td><input type="text" class="form-control" name="no_hp" value="{{$user->no_hp}}"></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="col-md-6">
						<div class="table-responsive">
							<table class="table mt-4 mb-0">
								<tr>
									<td>Alamat</td>
									<td>:</td>
									<td>
										<textarea name="alamat" class="form-control">{{$user->alamat}}</textarea>
									</td>
								</tr>
								<tr>
									<td>Biografi</td>
									<td>:</td>
									<td>
										<textarea name="bio" class="form-control" rows="3">{{$user->bio}}</textarea>
									</td>
								</tr>
								<tr>
									<td>Gambar</td>
									<td>:</td>
									<td>
										<input type="file" class="form-control" name="image">
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary"><i class="fa fa-save mr-2"></i>Simpan</button>
				</div>
				{!! Form::close()!!}
		   	</section>
		    <section>
				@if($msg = Session::get('sfk'))
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{$msg}}
                </div>
                @endif
				<button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#upload_video"><i class="fa fa-upload mr-2" style="font-size: 16px;"></i>Upload Video</button>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Judul</th>
								<th>Status</th>
								<th>Tanggal</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 1;
							@endphp
							@if($sfk->count() == 0)
							<tr>
								<td colspan="4" align="center">Belum ada video</td>
							</tr>
							@else
							@foreach($sfk as $d)
							<tr>
								<td>{{$no++}}</td>
								<td>{{$d->judul}}</td>
								<td align="center">
									@if($d->approval == 0)
										<span class="badge badge-warning">Waiting for Approval</span>
									@else 
										<span class="badge badge-success">Approved</span>
									@endif
								</td>
								<td width="100">{{tgl($d->created_at)}}</td>
								<td width="160">
									<button onclick="delete_upload({{$d->id}})" class="btn btn-danger btn-sm"><i class="fa fa-close"></i></button>
									<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit_upload_{{$d->id}}"><i class="fa fa-edit"></i></button>
									<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#view_video_{{$d->id}}"><i class="fa fa-video-camera"></i></button>
								</td>
							</tr>
							@endforeach
							@endif
						</tbody>
					</table>	
				</div>
		    </section>
		</div>
	</div>

		<div class="tabbable-panel hidden">
			<div class="tabbable-line">
				<ul class="nav nav-tabs ">
					<li class="active">
						<a href="#biodata" data-toggle="tab">
						Profil </a>
					</li>
					<li>
						<a href="#video" data-toggle="tab">
						Edit Profil </a>
					</li>
					<li>
						<a href="#profile" data-toggle="tab">
						Video </a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="biodata">
						
					</div>
					<div class="tab-pane" id="video">
					</div>
					<div class="tab-pane" id="profile">

					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="modal fade" id="edit_akun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" style="top: 125px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil"></i> Ganti Password</h4>
            </div>
            <div class="modal-body">
            	<div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="pass-lama-form-{{auth()->user()->id}}" name="pass_lama">
                </div>
                {{-- <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" class="form-control" id="pass-baru-form-{{auth()->user()->id}}" name="pass_baru">
                </div>
                <div class="form-group">
                    <label>Ulangi Password</label>
                    <input type="password" class="form-control" id="pass-form-{{auth()->user()->id}}" name="pass">
                </div> --}}
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="editakun({{auth()->user()->id}})">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upload_video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content" style="top: 125px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-upload"></i> Upload Video Anda disini</h4>
      </div>
		<form action="{{asset('add_sfk')}}" method="post">
            {{ csrf_field() }}
	      <div class="modal-body">
	      	<div class="form-group">
	      		<label>Judul</label>
	      		<input type="text" class="form-control" name="judul">
	      		<input type="hidden" name="user_id" value="{{auth()->user()->id}}">
	      		<input type="hidden" name="approval" value="0">
	      	</div>
	      	<div class="form-group">
	      		<label>Copy link video Youtube anda disini <i class="fa fa-arrow-down"></i></label>
	      		<input name="embed" class="form-control" placeholder="https://www.youtube.com/watch?v=GW_n3EThwM0">
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary btn-voucher">Simpan</button>
	      </div>
		</form>
    </div>
  </div>
</div>

@foreach($sfk as $d)
<div class="modal fade" id="edit_upload_{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content" style="top: 125px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit mr-2"></i>Edit Video</h4>
      </div>
		<form action="{{asset('edit_sfk/' . $d->id)}}" method="post">
            {{ csrf_field() }}
	      <div class="modal-body">
	      	<div class="form-group">
	      		<label>Judul</label>
	      		<input type="text" class="form-control" name="judul" value="{{$d->judul}}">
	      	</div>
	      	<div class="form-group">
	      		<label>Copy link video Youtube anda disini <i class="fa fa-arrow-down"></i></label>
	      		<input name="embed" class="form-control" placeholder="https://www.youtube.com/watch?v=GW_n3EThwM0" value="{{$d->embed}}">
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary btn-voucher">Submit</button>
	      </div>
		</form>
    </div>
  </div>
</div>

<div class="modal fade" id="view_video_{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
		{!!html_entity_decode(convertYoutube($d->embed))!!}
      </div>
    </div>
  </div>
</div>
@endforeach

<script>

	function editakun2(id) {
      var lama  = $("#pass-lama-form-" + id).val();
      var baru  = $("#pass-baru-form-" + id).val();
      var pass  = $("#pass-form-" + id).val();

      if(lama == '' | baru == '' | pass == '') {
      	Swal.fire(
            'Kolom wajib diisi',
            '',
            'error'
        )
      } else {
	      if(pass.length > 8) {
	            $.ajax({
	                type: "POST",
	                url: "{{url('editakun')}}",
	                data: {
	                    "_token": "{{ csrf_token() }}",
	                    "id": id,
	                    "lama": lama,
	                    "baru": baru,
	                    "pass": pass,
	                },
	                success: function(res) {
	                	if(res == 0) {
	                		Swal.fire(
					            'Password lama tidak sesuai',
					            '',
					            'error'
					        )
	                	} else if(res == 1) {
	                		Swal.fire(
					            'Password baru yang anda masukan tidak cocok',
					            '',
					            'error'
					        )
	                	} else if(res == 2){
	                		Swal.fire(
		                        'Berhasil mengedit password',
		                        '',
		                        'success'
		                    ).then(function() {
		                      location.reload()
		                    })
	                	}
	                }
	            })
	        } else {
	            Swal.fire(
	                'Minimal 8 karakter',
	                '',
	                'error'
	            )
	        }
	    }
    }

    function editakun(id) {
      var password  = $("#pass-lama-form-" + id).val();
      if(password.length > 8) {
            $.ajax({
                type: "POST",
                url: "{{url('editakun')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "password": password,
                },
                success: function(res) {
                    Swal.fire(
                        'Berhasil Mengedit akun',
                        '',
                        'success'
                    ).then(function() {
                      location.reload()
                    })
                }
            })
        } else {
            Swal.fire(
                'Minimal 8 karakter',
                '',
                'error'
            )
        }
    }
	
	function delete_upload(id) {
        Swal.fire({
          title: 'Yakin ingin menghapus video ini ? ',
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Hapus',
      	cancelButtonText: 'Kembali',
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: 'post',
                url: '{{url('delete_sfk')}}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function() {
                    Swal.fire(
                      'Berhasil Menghapus Video',
                      '',
                      'success'
                    ).then(function() {
                    	location.reload();
                    })
                }
            })
          }

        })
    }

</script>

@endsection