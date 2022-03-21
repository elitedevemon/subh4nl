<div>

  @push('css')
    <style>
      .bg_banner_img.text-center {
    padding: 10px;
    background: black;
}
    </style>
  @endpush



  <section class="banner">
    <div class="banner-carousel owl-carousel owl-loaded owl-drag">

    <div class="owl-stage-outer owl-height" style="height: 800px;">
      <div class="owl-stage" style="transform: translate3d(-5396px, 0px, 0px); transition: all 0.25s ease 0s; width: 9443px;">
 @foreach($banner as $key => $ba)
    <div class="owl-item" style="width: 1349px;"><div class="banner-slide-3">
        <div class="container">
          <div class="banner-box mb-5">
            <div class="banner-images">
              <div class="all-img-banner">
                <img src="{{asset('storage/upload/product')}}/{{$ba->banner}}" alt="banner" class="pizza-img img-fluid">
              </div>
            </div>
            <div class="banner-text mb-3">
              <div class="banner-center">
                <h6 class="banner-headding">{{$ba->name}}</h6>
                <p class="banner-sub-hed mb-2">{{$ba->sp_des}}</p>

                @if($ba->product_option == null)
                <a wire:click="$emit('addToCart', {{$ba->id}})" class="customAddToCart text-center">Commander
                  <i class="fas fa-shopping-cart"></i>
                </a>
                @else
                <a wire:click="$emit('getModelDataOp', {{$ba->id}})" class="customAddToCart text-center">Commander
                  <i class="fas fa-shopping-cart"></i>
                </a>
                @endif
                  <span class="header-product-price color-white">
                       @if($ba->is_promo == 1)
                                                        €{{$ba->offer_price}}
                                                    <del>
                                                        €{{$ba->regular_price}}
                                                    </del>
                                                @elseif($ba->is_promo == 0)
                                                   €{{$ba->regular_price}}
                                                @endif
                  </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endforeach



    </div>
    </div>

    <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div>
    <div class="owl-dots disabled"><button role="button" class="owl-dot active"><span></span></button><button role="button" class="owl-dot"><span></span></button><button role="button" class="owl-dot"><span></span></button></div></div>
       <div class="bg_banner_img text-center">
      <img src="{{asset('content/order.png')}}" class="img-fluid" alt="">
  </div>
  </section>



</div>
@livewire('product-option')
@livewire('add-to-cart')