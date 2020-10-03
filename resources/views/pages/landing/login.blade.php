@extends('layouts.landing')

@section('content')
	<!-- Contact Section -->
	<section class="contact-page-section spad overflow-hidden">
		<div class="container">
			<div class="contact-map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d33245.297803635964!2d-73.76987401620775!3d40.704774398815005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1575866843291!5m2!1sen!2sbd" style="border:0;" allowfullscreen=""></iframe></div>
			<div class="row">
				<div class="col-lg-4">
					<div class="con-info">
						<h3>Visit the Yoga Ahana</h3>
						<ul>
							<li><i class="material-icons">map</i>184 Main Collins Street</li>
						</ul>
					</div>
					<div class="con-info">
						<h3>Message Us</h3>
						<ul>
							<li><i class="material-icons">map</i>(965) 436 3274</li>
							<li><i class="material-icons">map</i>ahana.yoga@gmail.com</li>
						</ul>
					</div>
					<div class="con-info">
						<h3>Opening Hours</h3>
						<ul>
							<li><i class="material-icons">map</i>Mon - Fri:  6:30am - 07:45pm</li>
							<li><i class="material-icons">map</i>Sat - Sun:  8:30am - 05:45pm</li>
						</ul>
					</div>
					<div class="contact-social">
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-instagram"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-linkedin"></i></a>
					</div>
				</div>
				<div class="col-lg-8">
					<form class="singup-form contact-form">
						<div class="row">
							<div class="col-md-6">
								<input type="text" placeholder="First Name">
							</div>
							<div class="col-md-6">
								<input type="text" placeholder="Last Name">
							</div>
							<div class="col-md-6">
								<input type="text" placeholder="Your Email">
							</div>
							<div class="col-md-6">
								<input type="text" placeholder="Phone Number">
							</div>
							<div class="col-md-12">
								<textarea placeholder="Message"></textarea>
								<a href="#" class="site-btn sb-gradient">Send message</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!-- Trainers Section end -->

	<!-- Gallery Section -->
	<div class="gallery-section">
		<div class="gallery-slider owl-carousel">
			<div class="gs-item">
				<img src="img/gallery/1.jpg" alt="">
				<div class="gs-hover">
					<i class="fa fa-instagram"></i>
					<p>ahana.yoga</p>
				</div>
			</div>
			<div class="gs-item">
				<img src="img/gallery/2.jpg" alt="">
				<div class="gs-hover">
					<i class="fa fa-instagram"></i>
					<p>ahana.yoga</p>
				</div>
			</div>
			<div class="gs-item">
				<img src="img/gallery/3.jpg" alt="">
				<div class="gs-hover">
					<i class="fa fa-instagram"></i>
					<p>ahana.yoga</p>
				</div>
			</div>
			<div class="gs-item">
				<img src="img/gallery/4.jpg" alt="">
				<div class="gs-hover">
					<i class="fa fa-instagram"></i>
					<p>ahana.yoga</p>
				</div>
			</div>
			<div class="gs-item">
				<img src="img/gallery/5.jpg" alt="">
				<div class="gs-hover">
					<i class="fa fa-instagram"></i>
					<p>ahana.yoga</p>
				</div>
			</div>
			<div class="gs-item">
				<img src="img/gallery/6.jpg" alt="">
				<div class="gs-hover">
					<i class="fa fa-instagram"></i>
					<p>ahana.yoga</p>
				</div>
			</div>
		</div>
	</div>
	<!-- Gallery Section end -->
@endsection