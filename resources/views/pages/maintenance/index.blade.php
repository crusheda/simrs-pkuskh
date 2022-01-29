<!DOCTYPE html>
<html lang="en">
<head>
	<title>Comming Soon!!</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('css-maintenance/images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css-maintenance/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css-maintenance/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css-maintenance/vendor/animate/animate.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css-maintenance/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css-maintenance/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css-maintenance/css/main.css') }}">
<!--===============================================================================================-->
	<link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
</head>
<body>
	
	
	<div class="bg-img1 size1 flex-w flex-c-m p-t-55 p-b-55 p-l-15 p-r-15" style="background-image: url({{ asset('css-maintenance/images/bg01.jpg') }});">
		<div class="wsize1 bor1 bg1 p-t-45 p-b-45 p-l-15 p-r-15 respon1">
			<div class="wrappic1 p-b-18">
				{{-- <img src="{{ asset('css-maintenance/images/icons/logo.png') }}" alt="LOGO"> --}}
				<img src="{{ asset('img/pku_brand.png') }}" alt="LOGO">
				{{-- <img src="{{ asset('css-landing/img/landing-logotext.png') }}" alt="LOGO"> --}}
			</div>
			<hr>
			<p class="txt-center p-t-15 p-b-45">
				Mohon Maaf, website <strong>simrsku.com</strong> saat ini sedang dilakukan perbaikan dan migrasi ke sistem yang baru<br>
				Mulai tgl 29 Januari 2022, website SIMRSKU (<strong>simrsku.com</strong>) akan berganti menjadi SIMRSMU (<strong>simrsmu.com</strong>)<br>
				Terima Kasih atas kerjasamanya
			</p>

			<div class="wsize2 flex-w flex-c cd100 p-t-10 p-b-15">
				<div class="flex-col-c-m size2 how-countdown">
					<span class="l1-txt1 p-b-9 days"></span>
					<span class="s1-txt1">Hari</span>
				</div>

				<div class="flex-col-c-m size2 how-countdown">
					<span class="l1-txt1 p-b-9 hours"></span>
					<span class="s1-txt1">Jam</span>
				</div>

				<div class="flex-col-c-m size2 how-countdown">
					<span class="l1-txt1 p-b-9 minutes"></span>
					<span class="s1-txt1">Menit</span>
				</div>

				<div class="flex-col-c-m size2 how-countdown">
					<span class="l1-txt1 p-b-9 seconds"></span>
					<span class="s1-txt1">Detik</span>
				</div>
			</div>

			<center>
				<button class="flex-c-m s1-txt3 size3 how-btn trans-04 where1" style="background-color:aquamarine">
					Lihat Sekarang &nbsp;&nbsp; <i class="fa fa-caret-right"></i>
				</button>
				<br><hr><br>
				<img src="{{ asset('img/logo-admin.png') }}" alt="LOGO" width="100">
			</center>

			{{-- <form class="flex-w flex-c-m contact100-form validate-form p-t-5">
				
				<button class="flex-c-m s1-txt3 size3 how-btn trans-04 where1">
					Buka Simrsmu Sekarang
				</button>
				
			</form> --}}
			{{-- <p class="s1-txt4 txt-center p-t-10">
				I promise to <span class="bor2">never</span> spam
			</p> --}}
			
		</div>
	</div>



	

<!--===============================================================================================-->	
	<script src="{{ asset('css-maintenance/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('css-maintenance/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('css-maintenance/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('css-maintenance/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('css-maintenance/vendor/countdowntime/moment.min.js') }}"></script>
	<script src="{{ asset('css-maintenance/vendor/countdowntime/moment-timezone.min.js') }}"></script>
	<script src="{{ asset('css-maintenance/vendor/countdowntime/moment-timezone-with-data.min.js') }}"></script>
	<script src="{{ asset('css-maintenance/vendor/countdowntime/countdowntime.js') }}"></script>
	<script>
		$('.cd100').countdown100({
			/*Set Endtime here*/
			/*Endtime must be > current time*/
			endtimeYear: 0,
			endtimeMonth: 0,
			endtimeDate: 35,
			endtimeHours: 18,
			endtimeMinutes: 0,
			endtimeSeconds: 0,
			timeZone: "" 
			// ex:  timeZone: "America/New_York"
			//go to " http://momentjs.com/timezone/ " to get timezone
		});
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('css-maintenance/vendor/tilt/tilt.jquery.min.js') }}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('css-maintenance/js/main.js') }}"></script>

</body>
</html>