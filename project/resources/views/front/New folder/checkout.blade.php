@extends('layouts.website')
@push('css')
<style>
    [type="radio"]:checked,
[type="radio"]:not(:checked) {
    position: absolute;
    left: -9999px;
}
[type="radio"]:checked + label,
[type="radio"]:not(:checked) + label
{
    position: relative;
    padding-left: 28px;
    cursor: pointer;
    line-height: 20px;
    display: inline-block;
    color: #666;
    font-size: 14px;
}
[type="radio"]:checked + label:before,
[type="radio"]:not(:checked) + label:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 18px;
    height: 18px;
    border: 1px solid #ddd;
    border-radius: 100%;
    background: #fff;
}
[type="radio"]:checked + label:after,
[type="radio"]:not(:checked) + label:after {
    content: '';
    width: 12px;
    height: 12px;
    background: #F87DA9;
    position: absolute;
    top: 4px;
    left: 4px;
    border-radius: 100%;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
}
[type="radio"]:not(:checked) + label:after {
    opacity: 0;
    -webkit-transform: scale(0);
    transform: scale(0);
}
[type="radio"]:checked + label:after {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
}
label#left1 {
    float: left;
}

img#right1 {
    float: right;
}
.bgAlert{
        background: #750000;
    padding:8px;
    color: #fff;
    font-weight: bold;
}
.form-control:disabled, .form-control[readonly] {
        background-color: #222222!important;
     opacity: 1;
}
</style>
@endpush
@section('content')
<?php 

   $getOrder = session('orderPart');
   $cusTro = session('cusTro');
?>
    <div class="header-bg header-bg-page">
        <div class="header-padding position-relative">
            <div class="header-page-shape">
                <div class="header-page-shape-item">
                    <img src="{{asset('content/website')}}/assets/images/header-shape-1.png" alt="shape">
                </div>
                <div class="header-page-shape-item">
                    <img src="{{asset('content/website')}}/assets/images/header-shape-2.png" alt="shape">
                </div>
                <div class="header-page-shape-item">
                    <img src="{{asset('content/website')}}/assets/images/header-shape-3.png" alt="shape">
                </div>
                <div class="header-page-shape-item">
                    <img src="{{asset('content/website')}}/assets/images/header-shape-1.png" alt="shape">
                </div>
                <div class="header-page-shape-item">
                </div>
                <div class="header-page-shape-item">
                    <img src="{{asset('content/website')}}/assets/images/header-shape-1.png" alt="shape">
                </div>
                <div class="header-page-shape-item">
                </div>
            </div>
            <div class="container">
                <div class="header-page-content">
                    <h1>Checkout</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item"><a href="shops-grid.html">Shops</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <?php 
        $setting = \App\Models\setting::find(1);
     ?>

    <form action="{{route('saveOrder')}}" method="post" class="require-validation validation" data-cc-on-file="false" data-stripe-publishable-key="{!! $setting->stripe_key !!}" id="payment-form">
                    @csrf
      <div class="checkout-section pt-100 pb-70 bg-black">
        <div class="container">

                    <div class="row">
                          <div class="col-sm-12 col-md-5 col-lg-4 pb-30">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                            <diav class="checkout-item">
                                <div class="checkout-details cart-details mb-30">
                                    <h3 class="cart-details-title color-white">Totaux du panier</h3>
                                    <div class="cart-total-box">
                                        <div class="cart-total-item">
                                            <h4>Sub Total</h4>
                                            <p>€ {{$getOrder['total']}}</p>
                                        </div>
                                        <div class="cart-total-item">
                                            <h4>Type de commande </h4>
                                            <p>{{$getOrder['orderType'] == 'takeway' ? 'A Emporter' : 'En Livraison'}}</p>
                                        </div>
                                        @if($getOrder['orderType'] === 'takeway')
                                         <div class="cart-total-item">
                                            <h4>Remise</h4>
                                            <p>€ {{$getOrder['discount']}}</p>
                                        </div>

                                        <div class="cart-total-item cart-total-bold">
                                            <h4 class="color-white">Total</h4>
                                            <p>€ {{$getOrder['grand']}}</p>
                                        </div>
                                        @elseif($getOrder['orderType'] === 'order')
                                        <div>
                                            <div class="cart-total-item">
                                                <h4>Frais de livraison</h4> <!-- shipping -->
                                                <p>€{{$getOrder['shipping']}}</p>
                                            </div>
                                            <div class="cart-total-item cart-total-bold">
                                                <h4 class="color-white">Total</h4>
                                                <p>€{{$getOrder['total'] + $getOrder['shipping']}}</p>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="checkout-payment-area">
                                    <h3 class="color-white cart-details-title">Mode De Paiement</h3>
                                     <div class="checkout-form">
                                        <div class="row">

                                                <div class="cart-check-box">
                                                    <input type="radio" name="ship1" id="checko32" value="Carte_Bancaire_en_Livraison">  <!-- cb -->
                                                    <label id="left1" for="checko32">Carte Bancaire en Livraison
                                                    </label>
                                                        <img id="right1" src="{{asset('content/2.jpeg')}}" width="45px" height="30px" alt="">
                                                </div>
                                                <div class="cart-check-box">
                                                    <input type="radio" name="ship1" id="checko3" value="Espèces"> <!-- cash -->
                                                    <label id="left1" for="checko3">Espèces</label><img id="right1" src="{{asset('content/4.jpeg')}}" width="45px" height="30px" alt="">
                                                </div>
                                                <div class="cart-check-box">
                                                    <input type="radio" name="ship1" id="check21" value="ticket_restrurant">
                                                    <label id="left1" for="check21">Ticket Restrurant</label><img id="right1" src="{{asset('content/1.jpeg')}}" width="45px" height="30px" alt="">
                                                </div>
                                                 <div class="cart-check-box">
                                                    <input type="radio" name="ship1" id="check23" value="Carte_Bancaire_en_Iigne"> <!-- stripe -->
                                                    <label id="left1" for="check23">Carte Bancaire en Iigne</label><img id="right1" src="{{asset('content/3.jpeg')}}" width="45px" height="30px" alt="">
                                                </div>


                                                <div class="error"></div>
                                                <div class="col-sm-12 showStripe" id="showStripe">
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

                                            <!-- <div class="col-sm-12">
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
                                                    <div class="form-group mb-20">
                                                        <div class="input-group">
                                                            <input type="text" name="name" class="form-control"  placeholder="First Name*" />
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

                                            </div>
                                            <div class="col-sm-12">
                                                <div class="cart-check-box">
                                                    <input type="radio" name="ship" id="checkout33" value="ticket">
                                                    <label for="checkout33">Ticket Restrurant</label>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7 col-lg-8 pb-30">
                            <div class="checkout-item">
                                <div class="sub-section-title">
                                    <h3 class="color-white">Détails de la facturation ou Livraison</h3>
                                </div>
                                <div class="checkout-form">

                                        <div class="row">
                                            @if($getOrder['orderType'] === 'order')
                                            <div class="col-sm-6">
                                                <div class="form-group mb-20">
                                                    <div class="input-group">
                                                        <input type="text" name="address" class="form-control" required placeholder="Num de la rue*" value="@isset($cusTro) {{$cusTro['address']}}
                                                        @endisset"
                                                        readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group mb-20">
                                                    <div class="input-group">
                                                        <input type="text" name="customer_city" class="form-control" required placeholder="Nom de la rue*" value="@isset($cusTro) {{$cusTro['city']}}
                                                        @endisset"
                                                        readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12">
                                                <div class="form-group mb-20">
                                                    <div class="input-group">
                                                         <?php 
                                                        $spp = \App\Models\Shipping::where('code', $cusTro['customer_zip'])->first();
                                                         ?>

                                                        <input type="text"class="form-control" value="@isset($cusTro) {{$spp->km}}
                                                        @endisset"
                                                        readonly  />

                                                        <input type="hidden" name="customer_zip" value="@isset($cusTro) {{$cusTro['customer_zip']}}@endisset"/>
                                                    </div>
                                                </div>
                                            </div>

                                            @endif
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group mb-20">
                                                    <div class="input-group">
                                                        <input type="text" name="name" class="form-control" required value="{{auth()->user()->name}}" placeholder="Nom*" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group mb-20">
                                                    <div class="input-group">
                                                        <input type="text" name="phone_number" class="form-control" required  placeholder="Tél.*" value="@isset($cus->phone_number) {{$cus->phone_number}}
                                                        @endisset"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group mb-20">
                                                    <div class="input-group">
                                                        <input type="email" name="email" class="form-control" required value="{{auth()->user()->email}}" placeholder="Email*" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group mb-20">
                                                    <div class="input-group">
                                                        <input type="date" name="date" class="form-control" required placeholder="Date*" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group mb-20">
                                                    <div class="input-group">
                                                        <select name="time" class="form-control">
                                                            <option value="1">--Heure *--</option>
                                                                {!! $setting->select_timeOp !!}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group mb-20">
                                                    <div class="input-group input-group-textarea">
                                                        <input type="text" name="msg" class="form-control" placeholder="Commentaires " value="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

<?php   $sett = \App\Models\setting::find(1);
        $isSHowALert = false;

?>
                        @if($getOrder['orderType'] == 'takeway')
                            <button type="submit" class="btn full-width" id="submitForm">Payer</button>
                        @else

                            @if($sett->limit_min > $getOrder['total'] || $getOrder['total'] > $sett->limit_max)
                            <div class="alert alert-danger">
                                <b>Order Limit Minimum {{$sett->limit_min}} & Maximum {{$sett->limit_max}}</b>
                            </div>
                            @else
                            <button type="submit" class="btn full-width" id="submitForm">Payer</button>
                            @endif

                        @endif

        </div>
    </div>
    </form>
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

<script>
    $(document).ready(function(){
        // let getGeo = $('#reloadInput').val();
        // if(getGeo == 'reload'){
        //     getLocation();
        // }
    });


  let lal11;
  let lon11;

// $('.getAGeo').on('click', function(){
//     getLocation();
//     // alert();
// });


function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {

      lal11 = position.coords.latitude;
      lon11 = position.coords.longitude;

      let ki = [position.coords.latitude, position.coords.longitude];

  console.log("Longitude: " + ki);


  Livewire.emit('getLat', ki);

  Livewire.emit('getLon', position.coords.longitude);

// document.getElementById("lat").value = position.coords.latitude;
// document.getElementById("lon").value = position.coords.longitude;

}

// getLocation();

  // Livewire.emit('getKmGeo', getKm);

console.log(calcCrow(lal11,lon11,45.650578548411964,0.15513987877330615).toFixed(1))
// let lat1 = 22.827662973544577;
// let lon1 = 91.137449169054;
// let lat2 = 45.650578548411964;
// let lon2 = 0.15513987877330615;
 function calcCrow(lat1, lon1, lat2, lon2) 
    {
      var R = 6371; // km
      var dLat = toRad(lat2-lat1);
      var dLon = toRad(lon2-lon1);
      var lat1 = toRad(lat1);
      var lat2 = toRad(lat2);

      var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
      var d = R * c;
      // console.log(d)
      return d;
    }

    // Converts numeric degrees to radians
    function toRad(Value) 
    {
        return Value * Math.PI / 180;
    }



</script>
@endpush