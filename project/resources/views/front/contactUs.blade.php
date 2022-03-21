@extends('layouts.website')
@push('css')

@endpush

@section('content')
<section class="page-banner" style="background: #121619 url({{asset('content/website/images/blog-8.jpg')}}) no-repeat center / cover;">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12">
					<div class="page-title">
						<h1 class="page-headding">contact Us</h1>
						<ul>
							<li><a href="index.html" class="page-name">Home</a></li>
							<li>Contact Us</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
</section>

<section class="contact ptb">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12">
					<div class="headding-part text-center">
						<p class="headding-sub">Get in touch</p>
						<h2 class="headding-title text-uppercase font-weight-bold">contact us</h2>
					</div>
				</div>
			</div>
			<div class="contact-in">
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-5">
						<div class="contact-detail">
							<h3 class="contact-head">Contact Details</h3>
							<p class="contact-desc">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. </p>
							<ul>
								<li><i class="fa fa-home" aria-hidden="true"></i><a href="javascript:void(0)">{{$st->address}}</a></li>
								<li><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:1234567890">{{$st->phone}}</a></li>
								<li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:support@pizzon.com">{{$st->email}}</a></li>
								<li>
									<i class="fa fa-clock-o" aria-hidden="true"></i>
									<ul class="footer-details footer-time">
			                           {!! $st->schedules !!}
			                        </ul>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-7">
						<div class="leave">
							<form>
								<div class="form-group">
									<input type="text" name="Email" class="form-control" placeholder="Email" required="">
								</div>
								<div class="form-group">
									<input type="text" name="Subject" class="form-control" placeholder="Subject" required="">
								</div>
								<div class="form-group">
									<input type="text" name="Phone" class="form-control" placeholder="Phone" required="">
								</div>
								<div class="form-group">
									<textarea class="form-control" placeholder="Message"></textarea>
								</div>
								<input type="submit" name="submit" value="Send Message" class="post-com">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
</section>

<section class="contact-map">
		 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d45266.000826238465!2d-0.6554710603930157!3d44.83938661150566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd54d99f49627e4f%3A0x8bf868a7c67943df!2sRestaurant%20Raj%20Mahal!5e0!3m2!1sen!2sbd!4v1641261517817!5m2!1sen!2sbd" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</section>

@endsection
@push('js')



@endpush