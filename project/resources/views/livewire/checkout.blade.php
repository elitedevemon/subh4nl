<div>
      <div class="checkout-section pt-100 pb-70 bg-black">
        <div class="container">
                <form>
                    <div class="row">
                        <div class="col-sm-12 col-md-7 col-lg-8 pb-30">
                            <div class="checkout-item">
                                <div class="sub-section-title">
                                    <h3 class="color-white">Billing Details</h3>
                                </div>
                                <div class="checkout-form">

                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group mb-20">
                                                    <div class="input-group">
                                                        <input type="text" name="name" class="form-control" required value="{{auth()->user()->name}}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group mb-20">
                                                    <div class="input-group">
                                                        <input type="text" name="phone_number" class="form-control" required value="{{auth()->user()->phone_number}}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group mb-20">
                                                    <div class="input-group">
                                                        <input type="email" name="street" class="form-control" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group mb-20">
                                                    <div class="input-group">
                                                        <input type="email" name="address" class="form-control" required placeholder="Address" value=""/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group mb-20">
                                                    <div class="input-group">
                                                        <input type="email" name="email" class="form-control" required value="{{auth()->user()->email}}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group mb-20">
                                                    <div class="input-group input-group-textarea">
                                                        <textarea name="msg" class="form-control" rows="5" placeholder="Order Notes*"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn full-width">Place Order</button>

                                </div>
                            </div>
                        </div>

                        <?php 

                        $getOrder = session('orderPart');
                         ?>

                        <div class="col-sm-12 col-md-5 col-lg-4 pb-30">
                            <div class="checkout-item">
                                <div class="checkout-details cart-details mb-30">
                                    <h3 class="cart-details-title color-white">Cart Totals</h3>
                                    <div class="cart-total-box">
                                        <div class="cart-total-item">
                                            <h4>Sub Total</h4>
                                            <p>€ {{$getOrder['total']}}</p>
                                        </div>
                                        <div class="cart-total-item">
                                            <h4>Order Type</h4>
                                            <p>{{$getOrder['orderType']}}</p>
                                        </div>
                                        @if($getOrder['orderType'] === 'takeway')
                                         <div class="cart-total-item">
                                            <h4>Discount</h4>
                                            <p>€ {{$getOrder['discount']}}</p>
                                        </div>
                                        @elseif($getOrder['orderType'] === 'order')
                                        <div class="cart-total-item">
                                            <h4>Shipping Cost</h4>
                                            <p>€ {{$getOrder['shipping']}}</p>
                                        </div>
                                        @endif
                                        <div class="cart-total-item cart-total-bold">
                                            <h4 class="color-white">Total</h4>
                                            <p>€ {{$getOrder['grand']}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout-payment-area">
                                    <h3 class="color-white cart-details-title">Payment Method</h3>
                                    <div class="checkout-form">

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="cart-check-box">
                                                        <input type="radio" name="ship" id="checkout2" value="cash">
                                                        <label for="checkout2">Cash On Delivery</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="cart-check-box">
                                                        <input type="radio" name="ship" id="checkout3" value="stripe">
                                                        <label for="checkout3">Stripe</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" id="showStripe" style="display: none;">
                                                    <form action="">
                                                        <div class="form-group mb-20">
                                                            <div class="input-group">
                                                                <input type="text" name="name" class="form-control" required placeholder="First Name*" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-20">
                                                            <div class="input-group">
                                                            <input autocomplete='off' class='form-control card-number' size='20' type='text' placeholder="Card Number">
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-20">
                                                            <div class="input-group">
                                                               <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text' placeholder="CVC">
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-20">
                                                            <div class="input-group">
                                                              <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text' placeholder="Expiration Month">
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-20">
                                                            <div class="input-group">
                                                              <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' placeholder="Expiration Year">
                                                            </div>
                                                            </div>

                                                    </form>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="cart-check-box">
                                                        <input type="radio" name="ship" id="checkout33" value="ticket">
                                                        <label for="checkout33">Ticket Restrurant</label>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
