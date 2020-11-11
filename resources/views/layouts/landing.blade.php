<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>SIMRS | RS PKU MUHAMMADIYAH SUKOHARJO</title>
	<meta charset="UTF-8">
	<meta name="description" content="SIMRS">
	<meta name="keywords" content="RS PKU MUHAMMADIYAH SUKOHARJO">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{ asset('css-landing/css/bootstrap.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css-landing/css/font-awesome.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css-landing/css/owl.carousel.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css-landing/css/nice-select.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css-landing/css/magnific-popup.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css-landing/css/slicknav.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css-landing/css/animate.css') }}"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="{{ asset('css-landing/css/style.css') }}"/>


	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header Section -->
	<header class="header-section">
		<div class="header-top">
			<div class="row m-0">
				<div class="col-md-6 d-none d-md-block p-0">
					<div class="header-info">
						<i class="material-icons">home</i>
						<p>Jl.Mayor Sunaryo No.37 Sukoharjo (57512)</p>
					</div>
					<div class="header-info">
						<i class="material-icons">phone</i>
						<p>(0271) 593979</p>
					</div>
				</div>
				<div class="col-md-6 text-left text-md-right p-0">
					<div class="header-info d-none d-md-inline-flex">
						<i class="material-icons">alarm_on</i>
						<p>IGD 24 JAM</p>
                    </div>
				</div>
			</div>
		</div>
		<div class="header-bottom">
			<a href="{{ route('index') }}" class="site-logo">
				<img src="{{ asset('css-landing/img/Logo Clear PKU.png') }}" alt="">
			</a>
			<div class="hb-right">
				{{-- <div class="hb-switch" id="search-switch">
					<img src="{{ asset('css-landing/img/icons/search.png') }}" alt="">
				</div> --}}
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('admin/home') }}" class="tooltip-test text-white" title="Hai, {{ Auth::user()->name }}"><i class="material-icons">people</i></a>
                    @else
                        <div class="hb-switch" id="infor-switch">
                            <a class="text-white"><img src="{{ asset('css-landing/img/icons/bars.png') }}" alt=""> LOGIN</a>
                        </div>
                    @endauth
                @endif
            </div>

            <!-- MENU BAR -->
			{{-- <div class="container">
				<ul class="main-menu">
					<li><a href="{{ route('index') }}" align="left">Home</a></li>
					<li><a href="{{ route('landing.kunjungan') }}">Kunjungan</a></li>
					<li><a href="classes.html">Classes</a>
						<ul class="sub-menu">
							<li><a href="classes.html">Our Claasses</a></li>
							<li><a href="classes-details.html">Claasses Details</a></li>
						</ul>
					</li>
					<li><a href="trainer.html">trainers</a>
						<ul class="sub-menu">
							<li><a href="trainer.html">Our Trainers</a></li>
							<li><a href="trainer-details.html">Trainers Details</a></li>
						</ul>
					</li>
					<li><a href="events.html">events</a>
						<ul class="sub-menu">
							<li><a href="events.html">Our Events</a></li>
							<li><a href="event-details.html">Events Details</a></li>
						</ul>
					</li>
					<li><a href="blog.html">Blog</a>
						<ul class="sub-menu">
							<li><a href="blog.html">Our Blog</a></li>
							<li><a href="single-blog.html">Blog Details</a></li>
						</ul>
					</li>
					<li><a href="contact.html">Contact</a></li>
				</ul>
            </div> --}}
            <!-- END MENU BAR -->
        
        </div>
	</header>
	<!-- Header Section end -->

	<!-- LOGIN -->
	<div class="infor-model-warp">
		<div class="infor-model d-flex align-items-center">
			<div class="infor-close">
				<i class="material-icons">close</i>
			</div>
			<div class="infor-middle">
				<a href="#" class="infor-logo">
					<img src="{{ asset('css-landing/img/landing-bottom-xsm.png') }}" alt="">
				</a>
                <p>Login ke Beranda<br>SIMRS (Sistem Informasi Managemen Rumah Sakit)</p>
                
                <form class="singup-form contact-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="">
                        <div class="">
                            <input id="email" type="email" placeholder="Email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="">
                        <div class="">
                            <input id="password" type="password" placeholder="Password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
					</div>
					<div class="classes-filter">
						<div class="cf-cal">
							<div class="cf-radio">
								<input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
								<label for="remember">Remember</label>
							</div>
						</div>
					</div>
                    <button type="submit" class="site-btn sb-gradient mt-5">
                        {{ __('Login') }}
                    </button>
                </form><br>
				{{-- <form class="infor-form">
					<input type="text" placeholder="Your Email">
					<button><img src="{{ asset('css-landing/img/icons/send.png') }}" alt=""></button>
				</form> --}}
				<div class="insta-social">
					<a href="https://www.facebook.com/rspkuskh/"><i class="fa fa-facebook"></i></a>
					<a href="https://www.instagram.com/pku.sukoharjo/"><i class="fa fa-instagram"></i></a>
					<a href="https://twitter.com/pku_sukoharjo/"><i class="fa fa-twitter"></i></a>
				</div>
			</div>
		</div>
	</div>
	<!-- Infor Model end -->
    
    @yield('content')

    <!-- Footer Section -->
	<footer class="footer-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget">
						<div class="about-widget">
							<h2 class="fw-title"></h2>
							<img src="{{ asset('css-landing/img/landing-logotext.png') }}" alt="">
							<img src="{{ asset('img/KARS Bintang 2.png') }}" alt="">
							{{-- <p>Lorem ipsum dolor sit amet, consec-tetur adipiscing elit sed.</p> --}}
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-sm-6">
					<div class="footer-widget pl-0 pl-lg-5">
						<h2 class="fw-title">Menu</h2>
						<ul>
							<li><a href="{{ route('index') }}">Home</a></li>
							<li><a href="{{ route('landing.kunjungan') }}">Kunjungan</a></li>
							{{-- <li><a href="#">sit</a></li>
							<li><a href="#">amet</a></li>
							<li><a href="#">lorem</a></li> --}}
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget">
						<h2 class="fw-title">Plugin Page</h2>
						<div class="fb-page" data-href="https://www.facebook.com/rspkuskh" data-width="380" data-hide-cover="false" data-show-facepile="false"></div>
					</div>
				</div>
				<div class="col-lg-4 col-sm-6">
					<div class="footer-widget pl-0 pl-lg-5">
						<h2 class="fw-title">Kontak</h2>
						{{-- <ul>
							<li><i class="material-icons">alarm_on</i>Mon - Fri:  6:30am - 07:45pm</li>
							<li><i class="material-icons">alarm_on</i>Sat - Sun:  8:30am - 05:45pm</li>
							<li><i class="material-icons">alarm_on</i>IGD 24 JAM</li>
						</ul> --}}
						{{-- <form class="infor-form">
							<input type="text" placeholder="Lapor">
							<button><img src="{{ asset('css-landing/img/icons/send.png') }}" alt=""></button>
						</form> --}}
						<ul>
							<li><i class="material-icons">phone</i>(0271) 593979</li>
							<li><i class="material-icons">email</i>pku.sukoharjo@gmail.com</li>
							<li><i class="material-icons">map</i>Jl.Mayor Sunaryo No.37 Sukoharjo (57512)</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="row">
					<div class="col-md-4">
						<div class="footer-social">
							<a href="https://www.facebook.com/rspkuskh/"><i class="fa fa-facebook"></i></a>
							<a href="https://www.instagram.com/pku.sukoharjo/"><i class="fa fa-instagram"></i></a>
							<a href="https://twitter.com/pku_sukoharjo/"><i class="fa fa-twitter"></i></a>
						</div>
					</div>
					<div class="col-md-8 text-md-right">
						<div class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights RS PKU Muhammadiyah Sukoharjo
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer Section end -->

	<div class="back-to-top"><img src="{{ asset('css-landing/img/icons/up-arrow.png') }}" alt=""></div>

	<!-- Search model -->
	<div class="search-model set-bg" data-setbg="{{ asset('css-landing/img/search-bg.jpg') }}">
		<div class="h-100 d-flex align-items-center justify-content-center">
			<div class="search-close-switch"><i class="material-icons">close</i></div>
			<form class="search-moderl-form">
				<input type="text" id="search-input" placeholder="Search">
				<button><img src="{{ asset('css-landing/img/icons/search-2.png') }}" alt=""></button>
			</form>
		</div>
	</div>
	<!-- Search model end -->

	<!--====== Javascripts & Jquery ======-->
	<script src="{{ asset('css-landing/js/vendor/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('css-landing/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('css-landing/js/jquery.slicknav.min.js') }}"></script>
	<script src="{{ asset('css-landing/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('css-landing/js/jquery.nice-select.min.js') }}"></script>
	<script src="{{ asset('css-landing/js/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('css-landing/js/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('css-landing/js/main.js') }}"></script>
	<script src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&amp;version=v2.5"></script>

	</body>
</html>
