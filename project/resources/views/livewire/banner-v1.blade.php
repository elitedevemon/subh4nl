<div>
    <div class="header-bg-three header-bg-three-height">
        <div class="container-fluid">
            <div class="header-container position-relative">
                <div class="header-page-shape">
                    <div class="header-page-shape-item wow animate__rollIn" data-wow-duration="1s" data-wow-delay="0.5s">
                        <img src="{{asset('content/website')}}/assets/images/header-shape-7.png" alt="shape">
                    </div>
                    <div class="header-page-shape-item wow animate__slideInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                        <img src="{{asset('content/website')}}/assets/images/header-shape-6.png" alt="shape">
                    </div>
                </div>
                <div class="header-carousel-three owl-carousel owl-theme">
                    @foreach($banner as $key => $ba)
                    <div class="item">
                        <div class="row align-items-center">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="header-carousel-text header-carousel-text-three text-center text-lg-start max-555 me-lg-0 mx-auto">
                                    <h1>{{$ba->name}}</h1>
                                    <p>{{$ba->des}}</p>
                                    <div class="header-content-subtitle">
                                        <p class="header-subtitle-name">
                                            {{$ba->sp_des}} <span>=</span>
                                        </p>
                                        <p class="header-subtitle-price">
                                            Only
                                            @if($ba->is_promo == 1)
                                            <span><small>€</small>{{$ba->offer_price}}</span>
                                            @elseif($ba->is_promo == 0)
                                            <span><small>€</small>{{$ba->regular_price}}</span>
                                            @endif

                                        </p>

                                        @if($ba->product_option == null)
                                        <div class="header-content-cart">
                                            <div class="header-cart-button" style="cursor: pointer;">
                                                <a wire:click="$emit('addToCart', {{$ba->id}})"><i class="icofont-plus"></i></a>
                                            </div>
                                            <div class="header-cart-text">Ajouter</div>
                                        </div>
                                        @else
                                        <div class="header-content-cart">
                                            <div class="header-cart-button" style="cursor: pointer;">
                                                <a wire:click="$emit('getModelDataOp', {{$ba->id}})" class="clicked"><i class="icofont-plus"></i></a>
                                            </div>
                                            <div class="header-cart-text">Ajouter</div>
                                        </div>
                                        @endif


                                        <div class="header-carousel-control">
                                            <div class="header-control-item">
                                                <button class="header-control-prev"><i class="flaticon-left-arrow-1"></i>Previous</button>
                                            </div>
                                            <div class="header-control-item">
                                                <button class="header-control-next">Next<i class="flaticon-next"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="header-carousel-image wow animate__zoomIn" data-wow-duration="1s" data-wow-delay="0.5s">
                                    <img src="{{asset('storage/upload/product')}}/{{$ba->banner}}" alt="header">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
   </div>


    <div class="combined-section pt-100 bg-white mobile-pt-0">
        <div class="container position-relative">
            <div class="row">
            	@foreach($deal->slice(0, 2) as $d)
                <div class="col-sm-12 col-md-12 col-lg-6 pb-30">
                    <div class="quick-item bg-black">
                        <div class="quick-item-image">
                            <div class="quick-item-image-shape bg-yellow translatey-min-10"></div>
                            <div class="image-position image-position-lb-50">
                                <img src="{{asset('storage/upload/product')}}/{{$d->image}}" alt="quick-item">
                            </div>
                        </div>
                        <div class="quick-item-text">
                            <h3 class="color-white">{{$d->name}}</h3>
                            <h4 class="color-white">Start At 
                	 			@if($d->is_promo == 1)
                                <span>€{{$d->offer_price}}</span>
                                @elseif($d->is_promo == 0)
                                <span>€{{$d->regular_price}}</span>
                                @endif
                            </h4>
                            @if($d->product_option == null)
                            <a wire:click="$emit('addToCart', {{$d->id}})" class="btn btn-white btn-small">Order Now <i class="flaticon-shopping-cart-black-shape"></i></a>
                            @else
                            <a wire:click="$emit('getModelDataOp', {{$d->id}})" class="clicked btn btn-white btn-small">Order Now <i class="flaticon-shopping-cart-black-shape"></i></a>
                            @endif

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="pricing-area-full mt-70 pt-100 pb-70 bg-skew-black">
            <div class="container position-relative">
                <div class="section-title section-title-detault">
                    <small>Combos</small>
                    <h2 class="color-white">Our Best Combos To Choose</h2>
                </div>
                <div class="pricing-grid">
                	@foreach($deal  as $key => $dv)
                    <div class="pricing-grid-item wow animate__slideInUp" data-wow-duration="1s" data-wow-delay="0.1s">
                        <div class="pricing-grid-item-inner">
                            <div class="combo-offer-shape combo-offer-shape-red">
                                <div class="combo-shape-inner">
                                    <small>Only At</small>
                                    @if($dv->is_promo == 1)
	                                <p>€{{$dv->offer_price}}</p>
	                                @elseif($dv->is_promo == 0)
	                                <p>€{{$dv->regular_price}}</p>
	                                @endif
                                </div>
                            </div>
                            <div class="pricing-item-content">
                                <h3>Combo{{$key+1}}</h3>
                                <ul class="pricing-list">
                                    <li>{{$dv->des}}</li>
                                </ul>
                                @if($dv->product_option == null)
                                <a wire:click="$emit('addToCart', {{$dv->id}})" class="btn btn-white">Order Now <i class="flaticon-shopping-cart-black-shape"></i></a>
                                @else
                                <a wire:click="$emit('getModelDataOp', {{$dv->id}})" class="clicked btn btn-white">Order Now <i class="flaticon-shopping-cart-black-shape"></i></a>
                                @endif
                                <div class="pricing-item-thumb">
                                    <img src="{{asset('storage/upload/product')}}/{{$dv->image}}" alt="combo">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <section class="menu-section menu-section-light pt-100 pb-70">
        <div class="container position-relative">
            <div class="section-title section-title-default">
                <small>Menu</small>
                <h2>Just Choose From The Best</h2>
            </div>
            <?php
            $ne = \App\Models\SubCategory::where('is_promo', 1)->orderBy('id', 'DESC')->get();
             ?>
            <div class="menu-main-carousel-area">
                <div class="menu-main-thumb-nav">
                    @foreach($ne as $key => $nn)
                    <div class="menu-main-thumb-item menu-main-thumb-item-two">
                        <div class="menu-main-thumb-inner">
                            <img src="{{asset('content/website')}}/assets/images/menu-1.png" alt="menu">
                            <p>{{$nn->name}}/{{$nn->id}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="menu-main-details-for">
                @foreach($ne as $key1 => $nn)
                    <div class="menu-main-details-item">
                        <div class="menu-details-carousel">
                                <?php  $count = 0; 
                        foreach($nn->products as $key => $ni){
                      ?>

{{-- {{ $key ? 'newStyle' : '' }} --}}
{{-- {{ $loop->first > $key ? 'newStyle' : '' }}

  @if(0 > $key)
                            newStyle
                          @elseif($key > 0 && $loop->first > 1)
                          @endif

 --}}

<?php
  $c = $count++;
  $k = $key++;
  $l = $loop->first;

 ?>

                            <div class="{{ 0 > $key ? 'newStyle' : '' }} {{  $key == 1 && $loop->first < 1 ? 'newStyle' : '' }} menu-details-carousel-item menu-main-center-black getACustom">

                                <h3>{{$ni->name}}</h3>
                                <p>{{$ni->des}}</p>
                                 @if($ni->is_promo == 1)
                                   <h4 class="menu-price">€{{$ni->offer_price}}</h4>
                                   @else 
                                   <h4 class="menu-price">€{{$ni->regular_price}}</h4>
                                @endif

                                @if($ni->product_option == null)
                                <a wire:click="$emit('addToCart', {{$ni->id}})" class="btn btn-white">
                                    Ajouter <i class="flaticon-shopping-cart-black-shape"></i>
                                </a>
                                @else
                                <a wire:click="$emit('getModelDataOp', {{$ni->id}})" class="btn btn-white clicked">
                                    Ajouter <i class="flaticon-shopping-cart-black-shape"></i>
                                </a>
                                @endif

                                <div class="menu-details-carousel-image menu-details-carousel-image-two">
                                    <img src="{{asset('storage/upload/product')}}/{{$ni->image}}" alt="menu">
                                </div>
                            </div>
                             <?php 
                                }
                         ?>
                        </div>
                    </div>
                     @endforeach

                </div>

            </div>
        </div>
    </section>
     @livewire('product-option')
      @livewire('add-to-cart')
</div>
