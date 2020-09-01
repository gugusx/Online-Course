<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<!--===============================================================================================-->
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="{{asset('assets/materialize/css/materialize.css')}}">
</head>

<style>
	body {
		background-color: #F9FAFD;
	}

	@media (min-width:767px) {
		.mr-5-lg {
			margin-right: 5%;
		}

		.mt-6-lg {
			margin-top: 6%;
		}
	}
</style>
<body>
	<div class="row mt-6-lg">
		<div class="col m8 center-align">
			<img height="500" src="{{asset('assets/icon-login.png')}}" alt="">
		</div>
		<div class="col m3">
			<h5>Welcome To HAFECS Online Course</h5>
			<div class="card mt-3">
				<div class="card-content">

					<div class="input-field">
						<i class="material-icons prefix">email</i>
			          	<input id="email" type="email" name="email" class="validate">
			          	<label for="email">Email Address</label>
			        </div>

			        <div class="input-field">
						<i class="material-icons prefix">lock_outline</i>
			          	<input id="pass" type="password" name="password" class="validate">
			          	<label for="pass">Password</label>
			        </div>

		        </div>
			</div>
			<button class="btn btn-primary waves-effect">Login</button>
			<a href="#" class="btn btn-red waves-effect">Daftar</a>
		</div>
		<div class="col m1"></div>
	</div>
	
	<!-- Compiled and minified JavaScript -->
    <script src="{{asset('assets/materialize/js/materialize.min.js')}}"></script>

</body>
</html>