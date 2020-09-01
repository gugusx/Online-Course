@extends('layouts.user')
@section('content')
<style>
	::placeholder { /* Most modern browsers support this now. */
	   color: black;
	}
</style>
<h3 class="title-type">Talk To Coach</h3>
<div class="row">
	<div class="col-md-3">
		<div class="card-help">
			<div class="panel-body text-center">
				<p class="text-hafecs"><b>Filter</b></p>
				<hr>
				<p class="text-secondary"><b>Jenjang</b></p>
				<input type="text" class="form-control form-filter" placeholder="Sekolah Menangah Atas">
				<p class="text-secondary mt-3"><b>Mata Pelajaran</b></p>
				<input type="text" class="form-control form-filter" placeholder="Bahasa Inggris">
				<p class="text-secondary mt-4 mb-0"><b>Range Harga</b></p>
				<input type="text" id="range_04">
				<p class="text-secondary"><b>Urutkan Berdasarkan</b></p>
				<input type="text" class="form-control form-filter" placeholder="Harga Terendah">
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card card-user">
            <div class="image"></div>
            <div class="content">
                <div class="author">
                	<br>
                    <a href="#">
	                    <img class="avatar" src="{{asset('assets/images/7.jpg')}}" alt="...">
	                    <br><br>
                      	<h5 class="text-dark">Rendy Tamamilang<br>
                         	<small class="text-dark">Coach Bahasa Inggris</small>
                      	</h5>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-help stack-card-ttc">
            <div class="panel-body">
				<a href="#!" class="btn btn-green shadow-green mt-4 btn-block border-10">Rp. 25.000</a>
				<i class="fa fa-thumbs-o-up mr-2 mt-4"></i>200
            </div>
        </div>
	</div>
	<div class="col-md-3">
		<div class="card card-user">
            <div class="image"></div>
            <div class="content">
                <div class="author">
                	<br>
                    <a href="#">
	                    <img class="avatar" src="{{asset('assets/images/25.jpg')}}" alt="...">
	                    <br><br>
                      	<h5 class="text-dark">Anang Maskur<br>
                         	<small class="text-dark">Coach Bahasa Inggris</small>
                      	</h5>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-help stack-card-ttc">
            <div class="panel-body">
				<a href="#!" class="btn btn-green shadow-green mt-4 btn-block border-10">Rp. 75.000</a>
				<i class="fa fa-thumbs-o-up mr-2 mt-4"></i>30
            </div>
        </div>
	</div>
</div>

@endsection