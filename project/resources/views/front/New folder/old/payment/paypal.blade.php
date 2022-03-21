@extends('layouts.website')
@section('content')
    <section class="page-content section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="cart-menu">
                        <ul>
                            <li><a href="cart.html">1 My Cart</a></li>
                            <li class="active"><a href="payment.html">2 Payment</a></li>
                            <li><a href="confirm.html">3 Confirm </a></li>
                        </ul>

                    </div>

                    <div class="order-section">
                        <div class="user-profile">
                            <div class="row">
                                <div class="col-lg-6">
                                    Hello Mr {{ auth()->user()->name  }}
                                </div>
                                <div class="col-lg-6">
                                    <form action="{{  route("logout") }}" method="POST">
                                        @csrf
                                        <button type="submit" class="boxed-btn">Log Out</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12" style="margin-bottom: 30px">
                            <div class="order-box">
                                <p>Order method: </p>
                                <div class="form-gorups">
                                    <input type="radio" name="order_method" id="pickUp" value="pick_up">
                                    <label>Pick Up Point</label>
                                </div>
                                <div class="form-gorups">
                                    <input type="radio" name="order_method" id="deliveryPoint" value="delivery">
                                    <label>Order Delivery</label>
                                </div>
                            </div>
                        </div>
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

                        <form class="order-payment" method="POST"
                              accept="{{ route("payment.store")  }}" method="post"
                              class="require-validation" data-cc-on-file="false"
                              data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                            @csrf
                            <input type="hidden" name="customer_la">
                            <input type="hidden" name="customer_lo">
                            <div class='form-row row'>
                                <div class='col-xs-12 col-md-6 form-group required'>
                                    <label class='control-label'>Name on Card</label>
                                    <input class='form-control' size='4' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-6 form-group required'>
                                    <label class='control-label'>Card Number</label>
                                    <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                                </div>
                            </div>
                            <div class='form-row row'>
                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                    <label class='control-label'>CVC</label>
                                    <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311'
                                           size='4' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Month</label>
                                    <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Year</label>
                                    <input class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                           type='text'>
                                </div>
                            </div>
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
                                    <div class="form-gorup deliverySection">
                                        <label class="form-contorl">Society </label>
                                        <input class="form-control" type="text" name="society" placeholder="Society"
                                               value="{{ old("society")  }}">
                                    </div>
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
                                        <label class="form-contorl">City</label>
                                        <select class="form-control" name="customer_city"
                                                value="{{ old("customer_city")  }}">
                                            <option @if( old("customer_city") == "Argenteuil 95100") selected
                                                    @endif value="Argenteuil 95100">Argenteuil 95100
                                            </option>
                                            <option @if( old("customer_city") == "Bezons 95870") selected
                                                    @endif value="Bezons 95870">Bezons 95870
                                            </option>
                                            <option @if( old("customer_city") == "Carrieres-sur-Seine 78420") selected
                                                    @endif value="Carrieres-sur-Seine 78420">Carrieres-sur-Seine 78420
                                            </option>
                                            <option @if( old("customer_city") == "Chatou 78400") selected
                                                    @endif value="Chatou 78400">Chatou 78400
                                            </option>
                                            <option @if( old("customer_city") == "Doves 92700") selected
                                                    @endif value="Doves 92700">Doves 92700
                                            </option>
                                            <option @if( old("customer_city") == "Courbevoie 92400") selected
                                                    @endif value="Courbevoie 92400">Courbevoie 92400
                                            </option>
                                            <option @if( old("customer_city") == "La Defense 92400") selected
                                                    @endif value="La Defense 92400">La Defense 92400
                                            </option>
                                            <option @if( old("customer_city") == "Le Vesinet 78110") selected
                                                    @endif value="Le Vesinet 78110">Le Vesinet 78110
                                            </option>
                                            <option @if( old("customer_city") == "Nanterre 92000") selected
                                                    @endif value="Nanterre 92000">Nanterre 92000
                                            </option>
                                            <option @if( old("customer_city") == "Puteaux 92800") selected
                                                    @endif value="Puteaux 92800">Puteaux 92800
                                            </option>
                                            <option @if( old("customer_city") == "Rueil-Malmaison 92500") selected
                                                    @endif value="Rueil-Malmaison 92500">Rueil-Malmaison 92500
                                            </option>
                                            <option @if( old("customer_city") == "Suresnes 92150") selected
                                                    @endif value="Suresnes 92150">Suresnes 92150
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-gorup deliverySection">
                                        <label class="form-contorl">Post Code</label>
                                        <input type="number" name="customer_zip" value="{{ old("customer_zip")  }}"
                                               placeholder="Enter POst Code"
                                               class="form-control">
                                    </div>
                                    <div class="form-gorup deliverySection">
                                        <label class="form-contorl">Address</label>
                                        <input type="text" name="customer_address"
                                               value="{{ old("customer_address")  }}" placeholder="Enter Your Address"
                                               class="form-control">
                                    </div>


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12 commonInput">
                                    <div class="order-box">
                                        <p>Payment method: <i class="fab fa-cc-stripe"></i>
                                            <i class="fab fa-cc-paypal"></i></p>
                                        <div class="form-gorups">
                                            <input type="radio" name="payment_method"
                                                   value="paypal" @if(old("payment_method") == "paypal") checked @endif>
                                            <label>Payment With Paypal</label>
                                        </div>
                                        <div class="form-gorups">
                                            <input type="radio" name="payment_method"
                                                   value="stripe" @if(old("payment_method") == "stripe") checked @endif>
                                            <label>Payment With Stripe</label>
                                        </div>
                                        <div class="form-gorups">
                                            <input type="radio" name="payment_method"
                                                   value="cash_on_delivery"
                                                   @if(old("payment_method") == "cash_on_delivery") checked @endif>
                                            <label>Cash On Delivery</label>
                                        </div>
                                        <div class="form-gorups">
                                            <input type="radio" name="payment_method"
                                                   value="ticket_restaurant"
                                                   @if(old("payment_method") == "ticket_restaurant") checked @endif>
                                            <label>Ticket restaurant</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12 commonInput">
                                    <div class="order-box">
                                        <p>Delivery Time And Date:</p>

                                        <p>We are on sunday 21 February 2021 at 12:55:47</p>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-sm-6">
                                                <label for="">Day</label>
                                                <input class="form-control" type="date" name="date"
                                                       value="{{ old("date")  }}">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6">
                                                <label for="">Hours</label>
                                                <input class="form-control" type="time" name="time"
                                                       value="{{ old("time")  }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12 deliverySection">
                                    <div class="order-box">
                                        <p>Shipping method:</p>
                                        <div class="form-gorups">
                                            <input type="radio" name="shipping_cost" value="10"
                                                   @if(old("shipping_cost") == 10) checked @endif>
                                            <label>Flat rate : 10$</label>
                                        </div>
                                        <div class="form-gorups">
                                            <input type="radio" name="shipping_cost" value="10"
                                                   @if(old("shipping_cost") == 11) checked @endif>
                                            <label>Expedited Shipping : 11$</label>
                                        </div>
                                        <input type="hidden" name="totalQty"
                                               value="{{ $userCart->get("total_quantity")  }}">
                                        <span class="cart-title">Total: <span
                                                class="text-right">{{ $userCart->get("total_price")  }} </span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="order-validate text-center" style="margin-top: 20px">
                                        <button type="submit" class="boxed-btn" id="submit">
                                            <span id="button-text">VALIDATE</span>
                                        </button>
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
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script>
        $(function () {
            if ('geolocation' in navigator) {
                navigator.geolocation.getCurrentPosition((position) => {
                    $("input[name='customer_la']").val(position.coords.latitude)
                    $("input[name='customer_lo']").val(position.coords.longitude)
                })
            }

            var $form = $("#payment-form");

            $form.bind('submit', function (e) {
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, function (status, response) {
                        stripeResponseHandler(status, response)
                    });
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    var token = response['id'];
                    $form.data('cc-on-file', true)
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.find(':submit').click()
                }
            }
        })
    </script>
@endpush
