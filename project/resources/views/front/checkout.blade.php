@extends('layouts.website')
@push('css')

@endpush
@section('content')
<?php 

   $getOrder = session('orderPart');
   $cusTro = session('cusTro');
   $setting = \App\Models\setting::find(1);
?>
<section class="page-banner" style="background: #121619 url({{asset('content/website/images/blog-1.jpg')}}) no-repeat center / cover;">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12">
					<div class="page-title">
						<h1 class="page-headding">CHECKOUT</h1>
						<ul>
							<li><a href="index.html" class="page-name">Home</a></li>
							<li><a href="cart.html" class="page-name">cart</a></li>
							<li>CHECKOUT</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="checkout-part ptb">
		<div class="container">
			<form class="main-form" action="{{route('saveOrder')}}" method="post" class="require-validation validation" data-cc-on-file="false" data-stripe-publishable-key="{!! $setting->stripe_key !!}" id="payment-form">
                    @csrf
				<div class="row">
					<div class="col-12 col-lg-8">
					
						<div class="mb-md-30">
							<div class="mb-60">
								<div class="row">
									<div class="col-12">
										<div class="heading-part mb-30 mb-sm-20">
								            <h3>Détails de la facturation ou Livraison</h3>
								        </div>
								        	@if ($errors->any())
						                        <div class="alert alert-danger">
						                            <ul>
						                                @foreach ($errors->all() as $error)
						                                    <li>{{ $error }}</li>
						                                @endforeach
						                            </ul>
						                        </div>
						                    @endif
									</div>
								</div>
								<div class="row">
								@if($getOrder['orderType'] === 'order')
									<div class="col-12">
										<div class="form-group">
											<label for="full-name">Num de la rue*</label>
					                        <input id="full-name" type="text" name="address" required placeholder="Num de la rue*" value="@isset($cusTro) {{$cusTro['address']}} @endisset" readonly >
					                    </div>
									</div>

									<div class="col-12">
										<div class="form-group">
											<label for="full-name1">Nom de la rue*</label>
					                        <input id="full-name1" type="text" name="customer_city" required placeholder="Nom de la rue*" value="@isset($cusTro) {{$cusTro['city']}} @endisset" readonly  >
					                    </div>
									</div>
									<div class="col-12">
										<?php $spp = \App\Models\Shipping::where('code', $cusTro['customer_zip'])
										                                   ->first();
										?>
										<div class="form-group">
											<label for="full-name2">Nom*</label>
					                        <input id="full-name2" type="text" class="form-control" value="@isset($cusTro) {{$spp->km}} @endisset" readonly >
					                        <!-- hidden -->
					                        <input type="hidden" name="customer_zip" value="@isset($cusTro) {{$cusTro['customer_zip']}}@endisset"/>
					                    </div>
									</div>

								@endif
									<div class="col-12">
										<div class="form-group">
											<label for="full-name4">Nom*</label>
					                        <input id="full-name4" type="text"  name="name" required value="{{auth()->user()->name}}" placeholder="Nom*" >
					                    </div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label for="company-name">Tél.*</label>
					                        <input id="company-name" type="text" name="phone_number" required  placeholder="Tél.*" value="@isset($cus->phone_number) {{$cus->phone_number}} @endisset">
					                    </div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label for="email">Email*</label>
					                        <input id="email" type="email" name="email" required value="{{auth()->user()->email}}" placeholder="Email*" >
					                    </div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label for="phone-no">Date*</label>
					                        <input id="phone-no" type="date" name="date" class="form-control" required placeholder="Date*" >
					                    </div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label for="conutry">Time*</label>
					                        <select name="time" class="form-control">
                                              <option value="1">--Heure *--</option>
                                               {!! $setting->select_timeOp !!}
                                            </select>
					                    </div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label for="address">Commentaires*</label>
					                        <input id="address" type="text" name="msg" class="form-control" placeholder="Commentaires " value="" >
					                    </div>
									</div>

								</div>
							</div>

						</div>
					</div>

					<div class="col-12 col-lg-4">
						<div class="complete-order-detail commun-table gray-bg mb-30">
							<p class="text-center mb-2">Mode De Paiement</p>
					        <div class="table-responsive">
					            <table class="table m-0">
					                <tbody>
					                    <tr>
					                        <td>
					                        	<b>
					                        		<label id="left1" for="checko32">
					                        			Carte Bancaire en Livraison
                                                    </label>
                                                    <img id="right1" src="{{asset('content/2.jpeg')}}" width="45px" height="30px" alt=""> :
                                                </b>
                                            </td>
					                        <td>
					                        	<input type="radio" name="ship1" class="size" id="checko32" value="Carte_Bancaire_en_Livraison">
					                        </td>
					                    </tr>
					                    <tr>
					                        <td>
					                        	<b>
					                        		<label id="left1" for="checko3">Espèces</label>
                                                    <img id="right1" src="{{asset('content/4.jpeg')}}" width="45px" height="30px" alt=""> :
                                                </b>
                                            </td>
					                        <td>
					                        	<input type="radio" class="size" name="ship1" id="checko3" value="Espèces">
					                        </td>
					                    </tr>
					                    <tr>
					                        <td>
					                        	<b>
					                        		<label id="left1" for="check21">Ticket Restrurant</label>
                                                    <img id="right1" src="{{asset('content/1.jpeg')}}" width="45px" height="30px" alt=""> :
                                                </b>
                                            </td>
					                        <td>
					                        	<input type="radio" name="ship1" class="size" id="check21" value="ticket_restrurant">
					                        </td>
					                    </tr>
					                    <tr>
					                        <td>
					                        	<b>
					                        		<label id="left1" for="check23">Carte Bancaire en Iigne</label>
                                                    <img id="right1" src="{{asset('content/3.jpeg')}}" width="45px" height="30px" alt=""> :
                                                </b>
                                            </td>
					                        <td>
					                        	<input type="radio" name="ship1" id="check23" value="Carte_Bancaire_en_Iigne" class="form-control"> <!-- stripe -->
					                        </td>
					                    </tr>
					                </tbody>
					            </table>
					        </div>
					    </div>
					    <div class="complete-order-detail commun-table gray-bg mb-30 p-2 showStripe" id="showStripe">
					    	<p class="text-center mb-2">Informations sur le panier</p>
					        <div class="error"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group mb-20 required">
                                                        <div class="input-group">
                                                            <input type="text" name="namde" class="form-control"  placeholder="First Name*" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-20 required">
                                                        <div class="input-group">
                                                        <input  name="card" class='form-control card-number' size='20' type='text' placeholder="Card Number">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-20 required">
                                                        <div class="input-group">
                                                           <input  name="cvc" class='form-control card-cvc' placeholder='ex. 311' size='4' type='text' placeholder="CVC">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-20 required">
                                                        <div class="input-group">
                                                          <input class='form-control card-expiry-month' name="month" placeholder='MM' size='2' type='text' placeholder="Expiration Month">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-20 required">
                                                        <div class="input-group">
                                                          <input class='form-control card-expiry-year' name="year" placeholder='YYYY' size='4' type='text' placeholder="Expiration Year">
                                                        </div>
                                                        </div>
                                                </div>
					    </div>




				        <div class="complete-order-detail commun-table gray-bg mb-30">
				        	<p class="text-center mb-2">Totaux du panier</p>
					        <div class="table-responsive">
					            <table class="table m-0">
					                <tbody>
					                    <tr>
					                        <td><b>Sub Total :</b></td>
					                        <td>€ {{$getOrder['total']}}</td>
					                    </tr>
					                    <tr>
					                        <td><b>Type de commande :</b></td>
					                        <td><div class="price-box"> <span class="price">{{$getOrder['orderType'] == 'takeway' ? 'A Emporter' : 'En Livraison'}}</span> </div></td>
					                    </tr>
					                    @if($getOrder['orderType'] === 'takeway')
					                    <tr>
					                        <td><b>Remise :</b></td>
					                        <td>€ {{$getOrder['discount']}}</td>
					                    </tr>
					                    <tr>
					                        <td><b>Total :</b></td>
					                        <td>€ {{$getOrder['total'] - $getOrder['discount']}}</td>
					                    </tr>
					                    @elseif($getOrder['orderType'] === 'order')
					                     <tr>
					                        <td><b>Frais de livraison :</b></td>
					                        <td>€ {{$getOrder['shipping']}}</td>
					                    </tr>
					                    <tr>
					                        <td><b>Total :</b></td>
					                        <td>€ {{$getOrder['total'] + $getOrder['shipping']}}</td>
					                    </tr>
					                    @endif

					                </tbody>
					            </table>
					        </div>
					    </div>
<?php   $sett = \App\Models\setting::find(1);
        $isSHowALert = false;

?>
						@if($getOrder['orderType'] == 'takeway')
                            <button type="submit" class="btn full btn-color" id="submitForm">Payer</button>
                        @else

                            @if($sett->limit_min > $getOrder['total'] || $getOrder['total'] > $sett->limit_max)
                            <div class="alert alert-danger">
                                <b>Order Limit Minimum {{$sett->limit_min}} & Maximum {{$sett->limit_max}}</b>
                            </div>
                            @else
                            <button type="submit" class="btn full btn-color" id="submitForm">Payer</button>
                            @endif

                        @endif
					</div>
				</div>
			</form>
		</div>
	</section>





@endsection
@push('js')

 <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
 <script>


$(document).ready(function(){
$(".showStripe").css("display", "none");

    $('#checko32').on('click', function(){
        $('#showStripe').hide();
    });
     $('#checko3').on('click', function(){
        $('#showStripe').hide();
    });
     $('#check21').on('click', function(){
        $('#showStripe').hide();
    });


     $('#submitForm').on('click', function(){
            var isChange = $("#check23").is(':checked');
            if (isChange) {
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
                console.log('dd');


                if(response.error){
                     $('.error').addClass('bgAlert').text(response.error.message);
                        console.log(response.error.message);
                }else{
                    var token = response['id'];
                    $form.data('cc-on-file', true)
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.find(':submit').click()
                }
            }
        })
            }else{
                console.log('ney');
            }
     });




$('#check23').click(function(){
    // alert();
    $('#showStripe').show();
    var isChange = $("#check23").is(':checked');
        if ($(this).val() == 'Carte_Bancaire_en_Iigne') {
            $('#showStripe').show();
        }else{
          $(".showStripe").css("display", "none");
        }
    });
});
</script>


@endpush