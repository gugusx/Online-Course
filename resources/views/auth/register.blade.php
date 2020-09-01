@extends('layouts.auth')
@section('content')

<div class="limiter">
	<div class="container-login100">
		<div class="row">
			<div class="col-md-8 text-center">
				<img height="500" class="hidden-xs" src="{{asset('assets/icon-login.png')}}" alt="">
			</div>
			<div class="col-md-4">
				<h3>Welcome to <br>HAFECS Online Course</h3>
        		<p style="margin: 16px 0;">Bergabunglah menjadi guru inovatif untuk transformasi pendidikan Indonesia. <b>Mulai Sekarang !</b></p>
				<span class="badge badge-danger mb-1 hidden" id="email-alert-text">Email sudah terdaftar</span>
				@if (count($errors) > 0)
			    <div class="alert alert-danger mb-1">
			      <strong>Whoops!</strong> There were some problems with your input.<br>
			      <ul>
			        @foreach ($errors->all() as $error)
			          <li>{{ $error }}</li>
			        @endforeach
			      </ul>
			    </div>
			  	@endif
				<form class="login100-form validate-form mt-1" action="{{route('web.daftarstore')}}" method="post">
					{{ csrf_field() }}
					<div class="wrap-login100 shadow" style="padding-bottom: 0px;">
						<div class="wrap-input100">
							<span class="btn-show-pass icon-form">
								<i class="feather-32" data-feather="user"></i>
							</span>
							<input class="input100" type="text" name="name" value="{{old('name')}}" required="">
							<span class="focus-input100" data-placeholder="Full Name"></span>
						</div>
						<div class="wrap-input100">
							<span class="btn-show-pass icon-form">
								<i class="feather-32" data-feather="mail"></i>
							</span>
							<span class="btn-show-pass">
								<i id="email-alert-icon" class="hidden" data-feather="check" class="feather-16" 
								style="margin-bottom: 21px; color: #4F92F2;"></i>
							</span>
							<input id="form-email" onblur="check_email(this.value)" value="{{old('email')}}" class="input100" type="email" name="email" required="">
							<span class="focus-input100" data-placeholder="Email Address"></span>
						</div>

						<div class="wrap-input100">
							<span class="btn-show-pass icon-form">
								<i class="feather-32" data-feather="lock"></i>
							</span>
							<span class="btn-show-pass">
								<i onclick="open_pass()" id="icon-pass" class="fa fa-eye" style="margin-bottom: 21px;"></i>
							</span>
							<input id="form-pass" class="input100" type="password" name="password" value="{{old('password')}}" required="">
							<span class="focus-input100" data-placeholder="Password"></span>
						</div>
						<div class="wrap-input100" style="border-bottom: unset; margin-bottom: 0">
							<span class="btn-show-pass icon-form">
								<i class="feather-32" data-feather="phone"></i>
							</span>
							<input class="input100" type="text" name="no_hp" value="{{old('no_hp')}}" required="">
							<span class="focus-input100" data-placeholder="Phone Number"></span>
						</div>
					</div>

					<br>
					<div class="right-xs">
						<button class="btn btn-primary shadow-md mr-1">Register</button>
						<a href="{{asset('login')}}" class="btn btn-light shadow-md">Login</a>
						<p class="mb-3 mt-3">Or you can join with</p>
						<a href="{{ url('/auth/google') }}">
				            <img src="{{asset('assets/gmail.png')}}" class="shadow-sm br-50 mr-2" height="40" alt="">
				        </a>
				        <a href="{{ url('/auth/facebook') }}">
				            <img src="{{asset('assets/fb.png')}}" class="shadow-sm br-50" height="39" alt="">
				        </a>
				    </div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection