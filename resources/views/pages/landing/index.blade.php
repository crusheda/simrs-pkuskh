@extends('layouts.landing')

@section('content')
	<!-- Hero Section -->
	<section class="hero-section">
		<div class="hero-social-warp">
			<div class="hero-social">
				<a href="https://www.facebook.com/rspkuskh/"><i class="fa fa-facebook"></i></a>
				<a href="https://www.instagram.com/pku.sukoharjo/"><i class="fa fa-instagram"></i></a>
				<a href="https://twitter.com/pku_sukoharjo/"><i class="fa fa-twitter"></i></a>
			</div>
		</div>
		<div class="arrow-buttom">
			<img src="{{ asset('css-landing/img/icons/arrows-buttom.png') }}" alt="">
		</div>
		<div class="hero-slider owl-carousel">
			<div class="hs-item">
				<div class="hs-style-1 text-center">
					<img src="{{ asset('img/slider3.png') }}" alt="">
				</div>
			</div>
			<div class="hs-item">
				<div class="hs-style-3 text-center">
					{{-- <div class="container-fluid h-100">
						<div class="row h-100">
							<div class="col-lg-6 h-100 d-none d-lg-flex align-items-xl-end align-items-lg-center">
								<div class="hs-img">
									<img src="{{ asset('css-landing/img/hero-slider/2.png') }}" alt="">
								</div>
							</div>
							<div class="col-lg-6 d-flex align-items-center">
								<div class="hs-text-warp">
									<div class="hs-text">
										<h2>Lorem ipsum dolor sit amet consectetur adipisicing elit</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nos-trud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
										<div class="site-btn sb-white">X</div>
									</div>
								</div>
							</div>
						</div>
					</div> --}}
					<div class="container">
						<div class="hs-text">
							<h2>Lapor Kesalahan Sistem</h2>
							<p>Bug (Kesalahan Sistem) bisa saja terjadi kapanpun, maka dari itu diperlukan pengaduan kesalahan dengan mengisi form yang sudah disediakan.</p>
							<a type="button" class="site-btn sb-white js-scroll-trigger" href="#laporbug">Isi Form Sekarang</a>
						</div>
					</div>
					<div class="hs-img">
						{{-- <img src="{{ asset('css-landing/img/hero-slider/3.png') }}" alt=""> --}}
					</div>
				</div>
			</div>
			<div class="hs-item">
				<div class="hs-style-3 text-center">
					<div class="container">
						<div class="hs-text">
							<h2>Data Kunjungan Pasien</h2>
							<p>Rekapan jumlah pasien pada hari kemarin beserta jumlah pasien rawat inap hari ini.</p>
							<a type="button" class="site-btn sb-white" href="{{ route('landing.kunjungan') }}">Lihat Sekarang</a>
						</div>
					</div>
					<div class="hs-img">
						{{-- <img src="{{ asset('css-landing/img/hero-slider/3.png') }}" alt=""> --}}
					</div>
				</div>
			</div>
			<div class="hs-item">
				<div class="hs-style-3 text-center">
					<div class="container">
						<div class="hs-text">
							<h2>Sorotan Terbaru</h2>
							<p>Lihat sorotan terbaru di Rumah Sakit PKU Muhammadiyah Sukoharjo tercinta.</p>
							<a type="button" class="site-btn sb-white js-scroll-trigger" href="#sorotan">Lihat Sekarang</a>
						</div>
					</div>
					<div class="hs-img">
						{{-- <img src="{{ asset('css-landing/img/hero-slider/3.png') }}" alt=""> --}}
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero Section end -->	

	{{-- <!-- About Section -->
	<section class="about-section spad">
		<div class="container">
			<div class="section-title text-center">
				<img src="{{ asset('css-landing/img/icons/logo-icon.png') }}" alt="">
				<h2>Welcome to Ahana</h2>
				<p>Practice Yoga to perfect physical beauty, take care of your soul and enjoy life more fully!</p>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="about-img">
						<img src="{{ asset('css-landing/img/about.png') }}" alt="">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="about-item">
						<div class="ai-icon">
							<img src="{{ asset('css-landing/img/icons/about-1.png') }}" alt="">
						</div>
						<div class="ai-text">
							<h4>Full Rejuvenation</h4>
							<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
						</div>
					</div>
					<div class="about-item">
						<div class="ai-icon">
							<img src="{{ asset('css-landing/img/icons/about-2.png') }}" alt="">
						</div>
						<div class="ai-text">
							<h4>Extension of Spring</h4>
							<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem a cusantium doloremque.</p>
						</div>
					</div>
					<div class="about-item">
						<div class="ai-icon">
							<img src="{{ asset('css-landing/img/icons/about-3.png') }}" alt="">
						</div>
						<div class="ai-text">
							<h4>Against Aging</h4>
							<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.</p>
						</div>
					</div>
					<a href="" class="site-btn sb-gradient mt-5">explore more</a>
				</div>
			</div>
		</div>
	</section>
	<!-- About Section end -->

	<!-- Classes Section -->
	<section class="classes-section spad">
		<div class="container">
			<div class="section-title text-center">
				<img src="{{ asset('css-landing/img/icons/logo-icon.png') }}" alt="">
				<h2>Popular Classes</h2>
				<p>Practice Yoga to perfect physical beauty, take care of your soul and enjoy life more fully!</p>
			</div>
			<div class="classes-slider owl-carousel">
				<div class="classes-item">
					<div class="ci-img">
						<img src="{{ asset('css-landing/img/classes/1.jpg') }}" alt="">
					</div>
					<div class="ci-text">
						<h4><a href="classes-details.html">Artistic Yoga</a></h4>
						<div class="ci-metas">
							<div class="ci-meta"><i class="material-icons">event_available</i>Mon, Wed, Fri</div>
							<div class="ci-meta"><i class="material-icons">alarm_on</i>06:30pm - 07:45pm</div>
						</div>
						<p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis</p>
					</div>
					<div class="ci-bottom">
						<div class="ci-author">
							<img src="{{ asset('css-landing/img/classes/author/1.jpg') }}" alt="">
							<div class="author-text">
								<h6>Victoria Webb</h6>
								<p>Yoga Trainer</p>
							</div>
						</div>
						<a href="" class="site-btn sb-gradient">book now</a>
					</div>
				</div>
				<div class="classes-item">
					<div class="ci-img">
						<img src="{{ asset('css-landing/img/classes/2.jpg') }}" alt="">
					</div>
					<div class="ci-text">
						<h4>Traditional Hatha</h4>
						<div class="ci-metas">
							<div class="ci-meta"><i class="material-icons">event_available</i>Mon, Wed, Fri</div>
							<div class="ci-meta"><i class="material-icons">alarm_on</i>06:30pm - 07:45pm</div>
						</div>
						<p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis</p>
					</div>
					<div class="ci-bottom">
						<div class="ci-author">
							<img src="{{ asset('css-landing/img/classes/author/2.jpg') }}" alt="">
							<div class="author-text">
								<h6>Victoria Webb</h6>
								<p>Yoga Trainer</p>
							</div>
						</div>
						<a href="" class="site-btn sb-gradient">book now</a>
					</div>
				</div>
				<div class="classes-item">
					<div class="ci-img">
						<img src="{{ asset('css-landing/img/classes/3.jpg') }}" alt="">
					</div>
					<div class="ci-text">
						<h4>Yoga Therapy</h4>
						<div class="ci-metas">
							<div class="ci-meta"><i class="material-icons">event_available</i>Mon, Wed, Fri</div>
							<div class="ci-meta"><i class="material-icons">alarm_on</i>06:30pm - 07:45pm</div>
						</div>
						<p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis</p>
					</div>
					<div class="ci-bottom">
						<div class="ci-author">
							<img src="{{ asset('css-landing/img/classes/author/3.jpg') }}" alt="">
							<div class="author-text">
								<h6>Victoria Webb</h6>
								<p>Yoga Trainer</p>
							</div>
						</div>
						<a href="" class="site-btn sb-gradient">book now</a>
					</div>
				</div>
				<div class="classes-item">
					<div class="ci-img">
						<img src="{{ asset('css-landing/img/classes/2.jpg') }}" alt="">
					</div>
					<div class="ci-text">
						<h4>Traditional Hatha</h4>
						<div class="ci-metas">
							<div class="ci-meta"><i class="material-icons">event_available</i>Mon, Wed, Fri</div>
							<div class="ci-meta"><i class="material-icons">alarm_on</i>06:30pm - 07:45pm</div>
						</div>
						<p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis</p>
					</div>
					<div class="ci-bottom">
						<div class="ci-author">
							<img src="{{ asset('css-landing/img/classes/author/2.jpg') }}" alt="">
							<div class="author-text">
								<h6>Victoria Webb</h6>
								<p>Yoga Trainer</p>
							</div>
						</div>
						<a href="" class="site-btn sb-gradient">book now</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Classes Section end -->

	<!-- Trainer Section -->
	<section class="trainer-section overflow-hidden spad">
		<div class="container">
			<div class="section-title text-center">
				<img src="{{ asset('css-landing/img/icons/logo-icon.png') }}" alt="">
				<h2>Our Trainer Yoga</h2>
				<p>Practice Yoga to perfect physical beauty, take care of your soul and enjoy life more fully!</p>
			</div>
			<div class="trainer-slider owl-carousel">
				<div class="ts-item">
					<div class="trainer-item">
						<div class="ti-img">
							<img src="{{ asset('css-landing/img/trainer/1.png') }}" alt="">
						</div>
						<div class="ti-text">
							<h4>Lori Kennedy</h4>
							<h6>Yoga Trainer</h6>
							<p>Yoga & Therapy Certificate of Uttarakhand University Sanskrit</p>
							<div class="ti-social">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-instagram"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-linkedin"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="ts-item">
					<div class="trainer-item">
						<div class="ti-img">
							<img src="{{ asset('css-landing/img/trainer/2.png') }}" alt="">
						</div>
						<div class="ti-text">
							<h4>Lori Kennedy</h4>
							<h6>Yoga Trainer</h6>
							<p>Yoga & Therapy Certificate of Uttarakhand University Sanskrit</p>
							<div class="ti-social">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-instagram"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-linkedin"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="ts-item">
					<div class="trainer-item">
						<div class="ti-img">
							<img src="{{ asset('css-landing/img/trainer/3.png') }}" alt="">
						</div>
						<div class="ti-text">
							<h4>Rebecca James</h4>
							<h6>Yoga Trainer</h6>
							<p>Yoga & Therapy Certificate of Uttarakhand University Sanskrit</p>
							<div class="ti-social">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-instagram"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-linkedin"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Trainer Section end -->

	<!-- Review Section -->
	<section class="review-section spad set-bg" data-setbg="{{ asset('css-landing/img/review-bg.jpg') }}">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 m-auto">
					<div class="review-slider owl-carousel">
						<div class="review-item">
							<div class="ri-img">
								<img src="{{ asset('css-landing/img/classes/author/1.jpg') }}" alt="">
							</div>
							<div class="ri-text text-white">
								<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness.</p>
								<h4>Denise Thomas</h4>
								<h6>Designer</h6>
							</div>
						</div>
						<div class="review-item">
							<div class="ri-img">
								<img src="{{ asset('css-landing/img/classes/author/2.jpg') }}" alt="">
							</div>
							<div class="ri-text text-white">
								<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness.</p>
								<h4>Denise Thomas</h4>
								<h6>Designer</h6>
							</div>
						</div>
						<div class="review-item">
							<div class="ri-img">
								<img src="{{ asset('css-landing/img/classes/author/3.jpg') }}" alt="">
							</div>
							<div class="ri-text text-white">
								<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness.</p>
								<h4>Denise Thomas</h4>
								<h6>Designer</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Review Section end --> --}}

	<!-- Pricing Section -->
	{{--
	<section class="pricing-section spad">
		<div class="container">
			<div class="section-title text-center">
				<img src="{{ asset('css-landing/img/icons/logo-icon.png') }}" alt="">
				<h2>Pricing plans</h2>
				<p>Practice Yoga to perfect physical beauty, take care of your soul and enjoy life more fully!</p>
			</div>
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="pricing-item begginer">
						<div class="pi-top">
							<h4>Begginer</h4>
						</div>
						<div class="pi-price">
							<h3>$59</h3>
							<p>Per month</p>
						</div>
						<ul>
							<li>Take Up To 7 Classes</li>
							<li>Available To Anyone</li>
							<li>Towels Included</li>
							<li>Never Expires</li>
						</ul>
						<a href="#" class="site-btn sb-line-gradient">Get started</a>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="pricing-item entermediate">
						<div class="pi-top">
							<h4>Entermediate</h4>
						</div>
						<div class="pi-price">
							<h3>$99</h3>
							<p>Per month</p>
						</div>
						<ul>
							<li>Take Up To 7 Classes</li>
							<li>Available To Anyone</li>
							<li>Towels Included</li>
							<li>Never Expires</li>
						</ul>
						<a href="#" class="site-btn sb-line-gradient">Get started</a>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="pricing-item advanced">
						<div class="pi-top">
							<h4>Advanced</h4>
						</div>
						<div class="pi-price">
							<h3>$159</h3>
							<p>Per month</p>
						</div>
						<ul>
							<li>Take Up To 7 Classes</li>
							<li>Available To Anyone</li>
							<li>Towels Included</li>
							<li>Never Expires</li>
						</ul>
						<a href="#" class="site-btn sb-line-gradient">Get started</a>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="pricing-item professional">
						<div class="pi-top">
							<h4>Professional</h4>
						</div>
						<div class="pi-price">
							<h3>$199</h3>
							<p>Per month</p>
						</div>
						<ul>
							<li>Take Up To 7 Classes</li>
							<li>Available To Anyone</li>
							<li>Towels Included</li>
							<li>Never Expires</li>
						</ul>
						<a href="#" class="site-btn sb-line-gradient">Get started</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Pricing Section end --> --}}

	<!-- Event Section -->
	<section class="event-section spad" id="sorotan">
		<div class="container">
			<div class="section-title text-center">
				<img src="{{ asset('css-landing/img/icons/logo-icon.png') }}" alt="">
				<h2>Sorotan Terbaru</h2>
				<p></p>
			</div>
			<div class="row">
				<div class="col-md-7">
					<div class="event-video">
						<center><iframe width="100%" height="400" src="https://www.youtube.com/embed/npGh9FtWx2o" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></center>
					</div>
				</div>
				<div class="col-md-5">
					<div class="event-video">
						<center><iframe width="100%" height="190" src="https://www.youtube.com/embed/oCFG1dAgWl8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></center>
					</div>
					<div class="event-video">
						<center><iframe width="100%" height="190" src="https://www.youtube.com/embed/Ti6dHJ_qoac" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></center>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Event Section end -->
	<hr>
	<!-- Sign up Section -->
	<section class="signup-section spad" id="laporbug">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="signup-map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2919.7254309755876!2d110.83855862414768!3d-7.6772790290092505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a3c6e50a61891%3A0xda883f7a08b44f3e!2sRumah%20Sakit%20PKU%20Muhammadiyah%20Sukoharjo!5e0!3m2!1sid!2sid!4v1605092058810!5m2!1sid!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>
				</div>
				<div class="col-lg-6">
					<div class="singup-text">
						<h3>Lapor Permasalahan Sistem</h3>
						<p>Kami, Unit IT akan menanggapi permasalahan tersebut dalam <b>1x24 Jam</b> tergantung tingkat permasalahan yang terjadi. Terima Kasih</p>
					</div>
					<form class="singup-form" action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-6">
								<input type="text" placeholder="Nama Lengkap" name="nama" required>
							</div>
							<div class="col-md-6">
								{{-- <input type="text" placeholder="Unit" name="unit" required> --}}
								<select class="circle-select" name="unit" id="unit" required>
                                    <option selected hidden>Pilih Unit...</option>
                                    @foreach($list['unit'] as $name => $item)
                                        <option value="{{ $name }}">{{ $name }}</option>
                                    @endforeach
                                </select>
							</div>
							<div class="col-md-12">
								<textarea placeholder="Keluhan Anda..." name="pesan" required></textarea>
								<center><button class="site-btn sb-gradient">Laporkan</button></center>
								{{-- <a type="button" class="site-btn sb-gradient" id="submit">Laporkan</a> --}}
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		@if(session()->has('message'))
			<div class="alert alert-success">
				{{ session()->get('message') }}
			</div>
		@endif
	</section>
	<!-- Sign up Section end -->

	{{-- <!-- Gallery Section -->
	<div class="gallery-section">
		<div class="gallery-slider owl-carousel">
			<div class="gs-item">
				<img src="{{ asset('css-landing/img/gallery/1.jpg') }}" alt="">
				<div class="gs-hover">
					<i class="fa fa-instagram"></i>
					<p>ahana.yoga</p>
				</div>
			</div>
			<div class="gs-item">
				<img src="{{ asset('css-landing/img/gallery/2.jpg') }}" alt="">
				<div class="gs-hover">
					<i class="fa fa-instagram"></i>
					<p>ahana.yoga</p>
				</div>
			</div>
			<div class="gs-item">
				<img src="{{ asset('css-landing/img/gallery/3.jpg') }}" alt="">
				<div class="gs-hover">
					<i class="fa fa-instagram"></i>
					<p>ahana.yoga</p>
				</div>
			</div>
			<div class="gs-item">
				<img src="{{ asset('css-landing/img/gallery/4.jpg') }}" alt="">
				<div class="gs-hover">
					<i class="fa fa-instagram"></i>
					<p>ahana.yoga</p>
				</div>
			</div>
			<div class="gs-item">
				<img src="{{ asset('css-landing/img/gallery/5.jpg') }}" alt="">
				<div class="gs-hover">
					<i class="fa fa-instagram"></i>
					<p>ahana.yoga</p>
				</div>
			</div>
			<div class="gs-item">
				<img src="{{ asset('css-landing/img/gallery/6.jpg') }}" alt="">
				<div class="gs-hover">
					<i class="fa fa-instagram"></i>
					<p>ahana.yoga</p>
				</div>
			</div>
		</div>
	</div>
	<!-- Gallery Section end --> --}}

@endsection