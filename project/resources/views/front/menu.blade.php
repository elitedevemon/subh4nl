@extends('layouts.website')
@push('css')

@endpush

@section('content')

	<section class="page-banner" style="background: #121619 url({{asset('content/website/images/blog-7.jpg')}}) no-repeat center / cover;">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12">
					<div class="page-title">
						<h1 class="page-headding">Menu Items</h1>
						<ul>
							<li><a href="index.html" class="page-name">Home</a></li>
							<li>Menu</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="about-section" style="background: #1c1c1c">
		<div class="container">
			<div class="row text-center">
				<div class="col-xl-12 col-lg-12 col-md-12">
					<div class="headding-part text-center p-5">
						<!-- <p class="headding-sub" style="font-size: 60px">Le Carte</p> -->
						<h2 class="headding-title text-uppercase font-weight-bold" 
						style="font-style: italic; color: #ffffff!important" 
						>Le Carte </h2>
					</div>
				</div>
				@foreach($category as $cat)
				<div class="col-md-3 col-6 p-0">
					<div class="itemMenu" style="padding:0!important">
		              	<a class="nav-link p-0" href="{{route('sub.cat', $cat->slug)}}">
			                <img class="img-fluid" src="{{asset('storage/upload/category')}}/{{$cat->image}}" alt="">
			                <!-- <h6>{{$cat->name}}</h6> -->
			            </a>
					</div>
				</div>
				@endforeach

			</div>
		</div>
	</section>
@endsection
@push('js')



@endpush