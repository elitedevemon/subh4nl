<div>
    <div class="row">
        @foreach($catPro as $key => $ni)
          <div class="col-6 col-md-3 pt-20">
                        <div class="item">
                            <div class="img_area">
                                <img src="{{asset('storage/upload/product')}}/{{$ni->image}}" alt="Shakshuka">
                            </div>
                            <div class="item_content">
                               <div class="text-center">
                                    <span class="top_side click1" wire:click="$emit('getDetails', {{$ni->id}})">i</span>
                                    @if($ni->is_pro == 2)
                                    <span class="wdp-ribbon wdp-ribbon-two">Sale</span>
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
                            <div class="cartBtns" wire:click="$emit('addToCart', {{$ni->id}})">
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

            @livewire('product-option')
            @livewire('add-to-cart')
            @livewire('product-details')

</div>
