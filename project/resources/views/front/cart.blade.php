@extends('layouts.website')
@push('css')
<style>
    .cart-total-item {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: justify;
  -ms-flex-pack: justify;
  justify-content: space-between;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  padding: 15px 100px;
  margin-top: -5px;
}
</style>
@endpush

@section('content')
    <section class="page-banner" style="background: #121619 url({{asset('content/website/images/blog-1.jpg')}}) no-repeat center / cover;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="page-title">
                        <h1 class="page-headding">SHOPPING CART</h1>
                        <ul>
                            <li><a href="index.html" class="page-name">Home</a></li>
                            <li>SHOPPING CART</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shopping-cart ptb">
        <div class="container">
        @guest
        <div class="row">
        <div class="col-12">
            <div class="alert alert-primary" role="alert">
             pour une meilleure expérience, vous devez d'abord vous connecter  <a href="#" data-toggle="modal" data-target="#loginFF"> <b>Login</b> </a>
            </div>
        </div>
        </div>
        @endguest
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

@endpush