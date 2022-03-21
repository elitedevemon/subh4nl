@extends('layouts.website')
@section('content')
    <section class="page-content section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="cart-menu">
                        <ul>
                            <li><a href="{{url('/cart')}}">1 My Cart</a></li>
                            <li class="active"><a>2 Payment</a></li>
                            <li><a>3 Confirm </a></li>
                        </ul>

                    </div>

                    <div class="order-section">
                        <!--<div class="user-profile">-->
                        <!--    <div class="row">-->
                        <!--        <div class="col-lg-6">-->
                        <!--            Hello Mr {{ auth()->user()->name  }}-->
                        <!--        </div>-->
                        <!--        <div class="col-lg-6">-->
                        <!--            <form action="{{  route("logout") }}" method="POST">-->
                        <!--                @csrf-->
                        <!--                <button type="submit" class="boxed-btn">Log Out</button>-->
                        <!--            </form>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                                  <div class="row" style="margin-top: 20px">
                                      <div class="col-lg-12 col-md-12 col-sm-12 col-12" style="margin-bottom: 30px">
                            <div class="order-box">
                                <p>Order method: </p>
                                <div class="form-gorups">
                                    <input type="radio" name="order_method" id="pickUp" value="pick_up">
                                    <label>A Emporter</label>
                                </div>
                              @if(!$userCart->get("coupon_code") )
                                <div class="form-gorups">
                                    <input type="radio" name="order_method" id="deliveryPoint" value="delivery">
                                    <label>En Livraison</label>
                                </div>
                                @endif
                            </div>
                        </div>
                            </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-12 pickUpCoupon" style="display: none;">
                          @if(!$userCart->get("coupon_code") )
                                    <div class="order-box">
                                            <form action="{{ route("coupon.check") }}" method="post">
                                        <div class="row">
                                                @csrf
                                                 <div class="form-group col-md-6 col-sm-6">
                                                <label for="">Coupon</label>
                                                <input class="form-control" type="text" name="coupon">
                                            </div> 
                                            <div class="form-group col-md-2 col-sm-2" style="margin-top:31px">
                                                  <button type="submit" class="btn btn-secondary">Apply</button>
                                            </div> 
                                        </div>
                                     </form>    
                                    </div>
                                   @endif
                                   @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
                                </div>
                                <div class="col-4 pickUpCoupon" style="display: none;">
                                        <div class="couponBtn">
                                          <a class="checkStatus" data-toggle="modal" data-target="#checkStatus"><span class="badge badge-pill badge-danger">Promo Code</span></a> 
                                    </div>
                                </div>
                                
                                
                            <form class="order-payment" method="POST"
                              accept="{{ route("checkout.store")  }}" method="post"
                              class="require-validation" data-cc-on-file="false"
                              data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                            @csrf
                  
                        <span class="cart-title">Your Information</span>

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    
                            <input type="hidden" name="order_method" id="order_method">
                            <input type="hidden" name="customer_la">
                            <input type="hidden" name="customer_lo">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="card-element"><!--Stripe.js injects the Card Element--></div>

                                    <div class="form-gorup deliverySection">
                                        <label class="form-contorl">Civility <span style="color: red">*</span></label>
                                        <select class="form-control" name="civility">
                                            <option value="mr" selected>MR.</option>
                                            <option value="mrs">MRs.</option>
                                        </select>
                                    </div>
                                        <input class="form-control" type="hidden" name="society" placeholder="Society"
                                               value="{{ old("society")  }}">
                                    <div class="form-gorup commonInput">
                                        <label class="form-contorl">Full Name</label>
                                        <input class="form-control" type="text" name="customer_name"
                                               placeholder="Full Name"
                                               value="{{ old("customer_name")  }}">
                                    </div>

                                    <div class="form-gorup deliverySection">
                                        <label class="form-contorl">Email Address</label>
                                        <input class="form-control" type="email" name="customer_email"
                                               placeholder="Email Address"
                                               value="{{ old("customer_email")  }}">
                                    </div>


                                </div>
                                <div class="col-lg-6">
                                    <div class="form-gorup commonInput">
                                        <label class="form-contorl">Phone Number</label>
                                        <input class="form-control" type="number" name="customer_phone"
                                               placeholder="Phone Number"
                                               value="{{ old("customer_phone")  }}">
                                    </div>
                                      <div class="form-gorup deliverySection">
                                        <label class="form-contorl">Address</label>
                                        <input type="text" name="customer_address"
                                               value="{{ old("customer_address")  }}" placeholder="Enter Your Address"
                                               class="form-control">
                                    </div>
                                    <div class="form-gorup deliverySection">
                                        <label class="form-contorl">City</label>
                                        <input type="text" name="customer_city"
                                                value="{{ old("customer_city")  }}" placeholder="Enter Your City"
                                               class="form-control">
                                    </div>
                               
                                    <div class="form-gorup deliverySection">
                                        <label class="form-contorl">Post Code</label>
                                        <input type="number" name="customer_zip" value="{{ old("customer_zip")  }}"
                                               placeholder="Enter POst Code"
                                               class="form-control">
                                    </div>
                                  


                                </div>
                            </div>
                             <?php
        $genaralSetting = \App\Models\setting::find(1);

    ?>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12 commonInput">
                                    <div class="order-box">
                                        <p>Payment method: <i class="fab fa-cc-stripe"></i>
                                            <i class="fab fa-cc-paypal"></i></p>
                                @if($genaralSetting->is_paypal == 1)
                                        <div class="form-gorups">
                                            <input type="radio" name="payment_method"
                                                   value="paypal" @if(old("payment_method") == "paypal") checked @endif>
                                            <label>Payment With Paypal</label>
                                        </div>
                                        @endif
                                        @if($genaralSetting->is_stripe == 1)
                                        <div class="form-gorups">
                                            <input type="radio" name="payment_method"
                                                   value="stripe" @if(old("payment_method") == "stripe") checked @endif>
                                            <label>Carte Bancaire en ligne</label>
                                        </div>
                                        @endif
                                        @if($genaralSetting->is_cash == 1)
                                        <div class="form-gorups">
                                            <input type="radio" name="payment_method"
                                                   value="cash_on_delivery"
                                                   @if(old("payment_method") == "cash_on_delivery") checked @endif>
                                            <label>Espèces</label>
                                        </div>
                                        @endif
@if($genaralSetting->is_ticket == 1)
                                        <div class="form-gorups">
                                            <input type="radio" name="payment_method"
                                                   value="ticket_restaurant"
                                                   @if(old("payment_method") == "ticket_restaurant") checked @endif>
                                            <label>Ticket restaurant</label>
                                        </div>
                                        @endif
@if($genaralSetting->is_cb == 1)
                                        <div class="form-gorups">
                                            <input type="radio" name="payment_method"
                                                   value="payment_with_cb"
                                                   @if(old("payment_method") == "ticket_restaurant") checked @endif>
                                            <label>CB</label>
<img src="{{asset('content')}}/cb.jpeg" height="30px" alt="">
                                        </div>
                                        @endif

                                    </div>
                                </div>
                                
                                
<?php

  $newSchedule = \App\Models\Schedule::all();
 ?>
                                
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12 commonInput">
                                    <div class="order-box">
                                        <p>Delivery Time And Date:</p>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-sm-6">
                                                <label for="">Day</label>
                                                <input class="form-control" type="date" name="date"
                                                       value="{{ old("date")  }}">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6">
                                                <label for="">Hours</label>
                                                <select class="form-control" name="time">
@isset($newSchedule)
@foreach($newSchedule as $sche)
<option value="{{$sche->name}}">{{$sche->name}}</option>
@endforeach
@endisset
</select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12  pickUpCoupon" style="display: none;">
                                    <div class="order-box">
                                       
               @if($userCart->get("coupon_code") )   
               
               <?php
               $coo = $userCart->get("discount_c");
               $cT = $userCart->get("pay_amount");
                $gt = $cT-$coo;
               ?>
<input type="hidden" name="pay_amount" value="{{ 
$gt}}">
@else
<input type="hidden" name="pay_amount" value="{{ $userCart->get("pay_amount") 
}}">

@endif
                                        <input type="hidden" name="totalQty" id="getPriceTotal" 
                                               value="{{ $userCart->get("total_quantity")  }}">
                                               
                                               <span class="cart-title">SubTotal: <span
                                                class="text-right">{{ $userCart->get("pay_amount")  }}€ </span></span>
                                                
                                         @if($userCart->get("coupon_code") )    
                                                <span class="cart-title">Discount: <span
                                                class="text-right">{{ $userCart->get("discount_c")  }}€ </span></span>
                                                @else
                                                
                                                  <span class="cart-title">Discount: <span class="text-right">
                                                     
                                                   00.00 €
                                                      
                                                      </span></span>
                                                
                                                @endif
                                                
                                        <span class="cart-title">Total: <span
                                                class="text-right">{{ $userCart->get("pay_amount")  }}€ </span></span>
                                    </div>
                                </div>
                              <?php 

                              $getShipping = \App\Models\ShippingCost::all();
                               ?>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12 deliverySection ">
                                    <div class="order-box getShippingCOst">
                                        <p>Shipping method:</p>
                                        @foreach($getShipping as $key => $v)
                                        <div class="form-gorups">
                                            <input type="radio" name="shipping_cost" data-id="{{$v->cost}}" class="shippingCost" id="myFormID" value="{{$v->cost}}">
                                            <label>{{$v->name}} : {{$v->cost}}€</label>
                                        </div>
                                        @endforeach
                                       

                                        <input type="hidden" name="pay_amount"
                                               value="{{ $userCart->get("pay_amount")  }}">
                                        <input type="hidden" name="totalQty" id="getPriceTotal" 
                                               value="{{ $userCart->get("total_quantity")  }}">
                                        <span class="cart-title">Sub Total: <span
                                                class="text-right finaCartTotalT" id="finaCartTotal">{{ $userCart->get("pay_amount")  }}€ </span></span>
                 <span class="cart-title afterShipping" style="display:none">Shipping Cost: <span
                    class="text-right" id="finaCartTotalShipping"> </span></span>
                                        
                                        
                      <span class="cart-title afterShipping" style="display:none">Total: <span id="finalTaka" class="finalTaka"></span>  </span>
                                                
                                                
                                                
                                                
                        <span id="finalTaka" class="finalTaka"></span>    
                                    </div>
                                </div>
                            </div>
                  <!--here -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="order-validate text-center" style="margin-top: 20px">
                                     
                                        @if($genaralSetting->is_accept_order == 1)
                                        @if($genaralSetting->limit_min <=  $userCart->get("pay_amount") && $genaralSetting->limit_max >=  $userCart->get("pay_amount"))
                                        
                                              <button type="submit" class="boxed-btn" id="submit">
                                            <span id="button-text">VALIDATE</span>
                                        </button> 
                                        @else
                                        
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>your maximum and minimum order limit {{$genaralSetting->limit_max}}€ to {{$genaralSetting->limit_min}}€</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
                                        @endif
                                        
                                        @endif
                                        
                                        
                                        
                                        
                                 
                                   
                                        <!--<button type="button" class="boxed-btn">-->
                                        <!--    <span id="button-text">VALIDATE</span>-->
                                        <!--</button>-->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
 $(document).ready(function(){
       var $colors = $('input:radio[name=order_method]');
        if($colors.is(':checked') === false) {
            var ami = $colors.filter('[value=pick_up]').attr('checked', true);
         
        if(ami){
 $('#order_method').val('pickUp');
            $('.pickUpCoupon').show();
            $('.commonInput').show();
            $('.deliverySection').hide();

        }
            
        }
        
        
        
        
        
        
   
        
        
        
        
 });
</script>




    <script>
        $(function () {
            if ('geolocation' in navigator) {
                navigator.geolocation.getCurrentPosition((position) => {
                    $("input[name='customer_la']").val(position.coords.latitude)
                    $("input[name='customer_lo']").val(position.coords.longitude)
                })
            }
        })
    </script>
    <script>
        $(document).ready(function(){
            
               $('input[name="shipping_cost"]').each(function(index, value) {
                   
                   if(index == 0){


var $colors = $('input:radio[name=shipping_cost]:nth(0)').prop('checked', true);
                $('.afterShipping').show();
            
              var dataCost = $(this).attr('value');
                var finaCartTotal = $('#finaCartTotal').text();
         
                 var pardataCost =  parseFloat(dataCost);
                 var parfinaCartTotal  = parseFloat(finaCartTotal);
                 
                 var total =(parseFloat(dataCost) + parseFloat(finaCartTotal));

            //   $('#finaCartTotal').text(total);
              $('#finalTaka').text(total + '€');
              $('#finaCartTotalShipping').text(pardataCost + '€');
            
            
        if($colors.is(':checked') === false) {
        //   var ami = $colors.filter(#myFormID).attr('checked', true);
            

            
            
     
            
            
            
            
                        }
                   }
            //         $('.afterShipping').show();
            //     var dataCost = $(this).attr('value');
            //     var finaCartTotal = $('#finaCartTotal').text();
         
            //      var pardataCost =  parseFloat(dataCost);
            //      var parfinaCartTotal  = parseFloat(finaCartTotal);
                 
            //      var total =(parseFloat(dataCost) + parseFloat(finaCartTotal));

            // //   $('#finaCartTotal').text(total);
            //   $('#finalTaka').text(total + '€');
            //   $('#finaCartTotalShipping').text(pardataCost + '€');
            
            
               });
               
          
         $('.getShippingCOst').on('change','input[name=shipping_cost]',function(){
             
            
               $('input[name="shipping_cost"]:checked').each(function(index, value) {
                   
                   if(index == 0){
                       console.log('hey');
                   }
                    $('.afterShipping').show();
                var dataCost = $(this).attr('value');
                var finaCartTotal = $('#finaCartTotal').text();
         
                 var pardataCost =  parseFloat(dataCost);
                 var parfinaCartTotal  = parseFloat(finaCartTotal);
                 
                 var total =(parseFloat(dataCost) + parseFloat(finaCartTotal));

            //   $('#finaCartTotal').text(total);
              $('#finalTaka').text(total + '€');
              $('#finaCartTotalShipping').text(pardataCost + '€');
               });

         
              });
            
            
            
          
            
            
            
            
            
            
            
            
          
            // $('input:radio[name="shipping_cost"]').change(function(){
            //   var dataCost =  $("input[name='shipping_cost']:checked").val();; 
               
             
               
            //   getTotalv(dataCost);
            // });
            
            // function getTotalv(dataCost){
            // var finaCartTotal = $('#finaCartTotal').text();
            //   var newfinaCartTotal = finaCartTotal.replace("€", "");
            //   var newfinaCartTotalFloat = parseFloat(newfinaCartTotal);
            //   var dataCostFloat = parseFloat(dataCost);
               
            //   var finalTotal = newfinaCartTotalFloat + dataCostFloat;
               
            //   document.getElementById("finaCartTotal").innerHTML = finalTotal;
            // }
            
            function getTk(){
                console.log('total');
            }
            
            
            
            // var totalVal = document.getElementById('getPriceTotal').val();
            // console.log(totalVal);
        });
    </script>
@endpush
