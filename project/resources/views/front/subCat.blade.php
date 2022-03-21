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

	<section class="special-menu ptb pt-140">
		<div class="container">
			<div class="menu-top-bg">
				<!-- <img src="{{asset('content/website')}}/images/menu-top-bg.png" alt="meu-bg"> -->
			</div>
			<div class="row text-center">
				<div class="col-xl-12 col-lg-12 col-md-12">
					<div class="headding-part text-center pb-50">
						<h2 class="headding-title text-uppercase font-weight-bold">Our Special Menu</h2>
					</div>
                	<div class="promoImage mb-5">
                    	<img class="img-fluid" src="{{asset('storage/upload/category')}}/{{$category->promo_image}}" alt="">
            		</div>
				</div>
			</div>
			 @if($onlyMenu > $onlyCat )
                    @livewire('menu', ['catId' => $category->id])

                    @if($onlyCat > 0)
                    <!--<p style="color: #fff">1</p>-->
                       @livewire('cat-product', ['catPro' => $category->products])
                    @endif
            @endif
            @if($onlyCat >= $onlyMenu)
                @if($subCount > 0)
               <!--<p style="color: #fff">2</p>-->
                    @livewire('menu', ['catId' => $category->id])
                @endif
                <!--<p style="color: #fff">3</p>-->
                    @livewire('cat-product', ['catPro' => $category->products])
            @endif
		

		</div>
	</section>


@endsection
@push('js')



@endpush