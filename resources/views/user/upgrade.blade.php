@extends('layouts.user')
@section('content')

<style>
	 br {
        line-height: 150%;
     }
</style>

<div class="row mt-20-xs">
	<div class="col-md-4">
		<div class="card bg-blue-full">
			<div class="panel-body text-center" style="padding-top: 40px;">
				<h2 class="m-0"><b>Gold</b></h2>
				<h3 class="m-0">Rp 399.000</h3><br>
				<p class="fs-13">/ 6 Bulan</p>
			</div>
		</div>
		<div class="stack-card-up">
            <div class="panel-body text-center">
            	<br>
            	<p class="m-6">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae unde dicta facilis porro distinctio quaerat incidunt et mollitia dolorum laborum. Beatae, possimus voluptatem a? Debitis consequuntur corporis, reprehenderit sint assumenda!</p>
            	<br><br><br>
            	<div class="col-md-6">
            		<button class="btn btn-hafecs shadow-lg">Pesan</button>
            	</div>
            	<div class="col-md-6">
            		<button class="btn btn-yellow shadow-lg">12 Bulan <br> Rp 599.000</button>
            	</div>
            </div>
        </div>
	</div>
	<div class="col-md-4">
		<div class="card bg-blue-full">
			<div class="panel-body text-center" style="padding-top: 40px;">
				<h2 class="m-0"><b>Silver</b></h2>
				<h3 class="m-0">Rp 399.000</h3><br>
				<p class="fs-13">/ 6 Bulan</p>
			</div>
		</div>
		<div class="stack-card-up">
            <div class="panel-body text-center">
            	
            </div>
        </div>
	</div>
	<div class="col-md-4"></div>
</div>

@endsection