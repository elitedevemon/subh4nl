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
 <?php 

  $general = App\Models\setting::find(1)->first();
  $sk = $general->stripe_key;
 
   ?>
                        <form class="order-payment" method="POST"
                              action="{{ route("payment.store.stripe", $order->id)  }}"
                              method="POST"
                              class="require-validation" data-cc-on-file="false"
                              data-stripe-publishable-key="{!!$sk!!}" id="payment-form">
                            @csrf
                            <div class='form-row row'>
                                <div class='col-xs-12 col-md-6 form-group required'>
                                    <label class='control-label'>Name on Card</label>
                                    <input class='form-control' size='4' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-6 form-group required'>
                                    <label class='control-label'>Card Number</label>
                                    <input autocomplete='off' class='form-control card-number' size='20' type='text' required="">
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
                                    <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text' required="">
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Year</label>
                                    <input class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                           type='text' required="">
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
