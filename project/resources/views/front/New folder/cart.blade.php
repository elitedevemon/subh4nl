@extends('layouts.website')
@push('css')
<style>
        p.categoryN {
    background: #e7272d;
    padding: 5px;
    color: #fff;
}
.item-img {
        border-radius: 10px;
    background: #ffffff;
    transition: .5s;
    box-shadow: 0 4px 20px 0px rgb(0 0 0 / 12%), 0 2px 2px rgb(0 0 0 / 12%), 0 4px 4px rgb(0 0 0 / 12%), 0 8px 8px rgb(0 0 0 / 12%), 0 16px 16px rgb(0 0 0 / 12%);
}
.item-img:hover {
    /*background: #232323;*/
    position: relative;
}
.item-img p {
    background: #121213;
}
/*.item-img:hover:after {
    content: "✓";
    background-color: grey;
    transform: scale(1);
    position: absolute;
    z-index: 10000;
    font-size:14px;
   top: 7px;
  left: 1px;
  width: 25px;
  height: 25px;
     border-radius: 50%;
  border: 1px solid grey;
padding:3px 1px;
cursor: pointer;
color: white;

}*/


input[type="checkbox"][id^="myCheckbox"] {
  display: none;
}
input[type="radio"][id^="myCheckboxSingle"] {
  display: none;
}
input[type="radio"][id^="myCheckboxPaid"] {
  display: none;
}

.offer {
  /*border: 1px solid #fff;*/
  padding: 10px;
  display: block;
  position: relative;
  /*margin: 10px;*/
  cursor: pointer;
}

.offer:before {
  background-color: white;
  color: white;
  content: " ";
  display: block;
  border-radius: 50%;
  border: 1px solid grey;
  position: absolute;
  top: 4px;
  left: -3px;
  width: 25px;
  height: 25px;
  text-align: center;
  line-height: 28px;
  transition-duration: 0.4s;
  transform: scale(0);
}

.offer img {
  height: 135px;
  width: 135px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

:checked + .offer {
  border-color: #ddd;
}

:checked + .offer:before {
  content: "✓";
  background-color: grey;
  transform: scale(1);
}

:checked + .offer img {
  transform: scale(0.9);
  /* box-shadow: 0 0 5px #333; */
  z-index: -1;
}



</style>
@endpush
@section('content')


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
                    <h1>Cart</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item"><a href="shops-grid.html">Shops</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                             <input type="hidden" id="lat" name="lat">
                              <input type="hidden" id="lon" name="lon">
                          
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="cart-section pt-100 pb-70 bg-black">
        <div class="container">
            @livewire('cart')
        </div>
    </section>


@endsection

@push('js')

    <script>





$(document).ready(function(){



    $("select").change(function(){
        if($(this).val() == "takeway" || $(this).val() == "de"){
             $('#shippingRate').hide();
             $('#orderDiscount').show();
            // alert($(this).val());
        }else if ($(this).val() == "order" ) {
             $('#shippingRate').show();
             $('#orderDiscount').hide();
        }
    });
});
    </script>
    <script>

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