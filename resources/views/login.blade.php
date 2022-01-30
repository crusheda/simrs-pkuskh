<!DOCTYPE html>
<html lang="en">
<head>
	<title>Masuk Akun | SIMRSMU</title>
	<meta charset="UTF-8">
	<meta name="title" content="SIMRSKU"/>
	<meta name="description" content="Sistem Informasi Manajemen Rumah Sakit PKU Muhammadiyah Sukoharjo yang dirancang untuk memudahkan kinerja karyawan.">
	<meta name="keywords" content="SIMRSKU RS PKU MUHAMMADIYAH SUKOHARJO">
	<meta name="revisit-after" content="3 days">
	<meta name="coverage" content="Worldwide">
	<meta name="distribution" content="Global">
	<meta name="author" content="Yussuf Faisal, S.Kom">
	<meta name="url" content="simrsku.com">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	{{-- <link rel="icon" type="image/png" href="{{ asset('css-login/images/icons/favicon.ico') }}"/> --}}
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/pku_ico.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/pku_ico.png') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css-login/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css-login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css-login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css-login/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('css-login/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css-login/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css-login/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('css-login/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css-login/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css-login/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
		
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				{{-- <form class="login100-form validate-form flex-sb flex-w"> --}}
				<form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('login') }}">
					@csrf
					<span class="login100-form-title p-b-32">
						
						<a href="#" class="infor-logo">
							<img src="{{ asset('css-landing/img/landing-logotext.png') }}" alt="">
						</a>
						
					</span>

					<span class="txt1 p-b-11">
						Username
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
						<input class="input100 {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name') }}" required autofocus>
						<span class="focus-input100"></span>
						
					</div>
					@if ($errors->has('name'))
							<span class="">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
					@endif
					
					<span class="txt1 p-b-11">
						Password
					</span>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100 {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" id="password">
						<span class="focus-input100"></span>
					</div>
					
					<div class="flex-sb-m w-full p-b-48">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
							<label class="label-checkbox100" for="remember">
								Remember me
							</label>
						</div>

						{{-- <div>
							<a href="#" class="txt3">
								Forgot Password?
							</a>
						</div> --}}
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
						<a class="btn btn-link text-dark" style="margin-top: 8px" href="{{ route('password.request') }}">
							Lupa Password?
						</a>
					</div>

				</form>
			</div>
		</div>
	</div>

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{ asset('css-login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('css-login/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('css-login/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('css-login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('css-login/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('css-login/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('css-login/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('css-login/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('css-login/js/main.js') }}"></script>

</body>
</html>