<div>

  <div class="cart-dropdown header-link-dropdown">
                            <ul class="cart-list link-dropdown-list">
                     @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                                <li>
                                  <div class="media"> <a href="#" class="pull-left"> <img alt="Pizzon" src="{{asset('storage/upload/product')}}/{{$details['img']}}"></a>
                                    <div class="media-body"> <span><a href="shop-detail.html">{{$details['name']}}</a></span>
                                      <p class="cart-price">€ {{$details['price']}}</p>
                                    </div>
                                </div>
                                </li>
                        @endforeach
                     @endif
                            </ul>
                            <p class="cart-sub-totle"> 
                            <span class="pull-left">Cart Subtotal</span> 
                            <span class="pull-right"><strong class="price-box">€{{$total}}</strong></span> </p>
                            <div class="clearfix"></div>
                            <div class="mt-20 text-left"> 
                              <a href="{{route('cart.index')}}" class="btn-color btn">Voir mon panier</a> 
                            <!--  <a href="checkout.html" class="btn-color btn right-side">Checkout</a>  -->
                            </div>
                        </div>



</div>
