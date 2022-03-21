<div>
          
  <section class="special-menu ptb pt-140">
    <div class="container">
      <div class="menu-top-bg">
        <img src="{{asset('content/website')}}/images/order-bottom.png" alt="meu-bg">
      </div>
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
          <div class="headding-part text-center pb-50">
            <p  class="headding-sub">Fresh From Jardin</p>
            <h2 class="headding-title text-uppercase font-weight-bold">Our Special Menu</h2>
          </div>
        </div>
      </div>
      <div class="row">
         @foreach($deal as $ni)
             <div class="col-6 col-md-3 pt-20">
                        <div class="item">
                            <div class="img_area">
                                <img src="{{asset('storage/upload/product')}}/{{$ni->image}}" alt="Shakshuka">
                            </div>
                            <div class="item_content">
                               <div class="text-center">
                                    <span class="top_side click1" wire:click="$emit('getDetails', {{$ni->id}})">i</span>
                                    @if($ni->is_pro == 2)
                                    <span class="wdp-ribbon wdp-ribbon-two">OFFRE</span>
                                    @endif
                                    <a href="" class="item_name">{{$ni->name}}</a>
                                    <p>
                                        @if($ni->is_promo == 1)
                                                        €{{$ni->offer_price}}
                                                    <del>
                                                        €{{$ni->regular_price}}
                                                    </del>
                                                @elseif($ni->is_promo == 0)
                                                   €{{$ni->regular_price}}
                                                @endif
                                    </p>
                               </div>
                            </div>
                             @if($ni->product_option == null)
                            <div class="cartBtns" wire:click="$emit('addToCart', {{$ni->id}})" style="cursor: pointer;">
                                    <span class="cartBtnn"> Ajouter au panier </span>
                                    <span class="cartBtnIcon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </span>
                            </div>
                            @else
                            <div class="cartBtns" wire:click="$emit('getModelDataOp', {{$ni->id}})">
                                    <span class="cartBtnn"> Ajouter au panier </span>
                                    <span class="cartBtnIcon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </span>
                            </div>
                            @endif


                        </div>
          </div>
         @endforeach
      </div>
    </div>
  </section>














            @livewire('product-option')
            @livewire('add-to-cart')
            @livewire('product-details')
</div>
