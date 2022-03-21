@extends('layouts.website')
@section('content')
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
     @foreach($banner as $v_banner)
    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? ' active' : '' }}"></li>
   @endforeach
  </ol>
  <div class="carousel-inner">
       @foreach($banner as $v_banner)
    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
      <img src="{{asset('storage/upload/banner')}}/{{$v_banner->image}}" class="d-block w-100" alt="...">
    </div>
   @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

	<input type="hidden" id="getValu" value="1"> 



<section class="special-section section-padding" style="background-image: url({{asset('content/website')}}/img/bannar-1.png);">
  <div class="container">
    <div class="row justify-content-end">
      <div class="col-lg-5">
        <div class="special-content">
          <h4>Nos Spécialités</h4>
          <h1>INDIENNES</h1>
          <h6>Venez découvrir les saveurs indiennes Chez</h6>
          <span>Le Moghol !</span>
          <p>Nous vous proposons des menus et des plats à la carte avec des spécialités tandoori et une multitude d'autres mets issus de différentes régions d'Inde.Un lieu de rencontre pour les gourmets des cuisines du monde !</p>

          <a href="#" class="boxed-btn">Découvrez La Carte</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="special-section section-padding" style="background-image: url({{asset('content/website')}}/img/section-two.jpg);">
  <div class="container">
    <div class="row justify-content-start">
      <div class="col-lg-5">
        <div class="special-content">
          <h4>Nos Spécialités</h4>
          <h1>INDIENNES</h1>
          <h6>Venez découvrir les saveurs indiennes Chez</h6>
          <span>Le Moghol !</span>
          <p>Nous vous proposons des menus et des plats à la carte avec des spécialités tandoori et une multitude d'autres mets issus de différentes régions d'Inde.Un lieu de rencontre pour les gourmets des cuisines du monde !</p>

          <a href="#" class="boxed-btn">Découvrez La Carte</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="peralax-section section-padding" style="background-image: url({{asset('content/website')}}/img/section-three.jpg);">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="d-table">
          <div class="d-table-cell peralax-text">
            <p>Notre Restaurant Indien, Le Moghol, est un lieu de caractère et atypique qui vous propose la quintessence de la gastronomie indienne et pakistanaise en plein cœur de Nanterre. Nous réalisons une cuisine du monde, avec des mets et des spécialités issus de l'Inde, de la région du Punjab et du nord du Pakistan. Nos plats sont copieux et variés, venez vite les découvrir ! </p>
        
          </div>
        </div>
        
      </div>
    </div>
  </div>
</section>

<section class="item-section section-padding">
  <div class="container">
    <div class="row">
         <div class="col-md-4 col-lg-4 col-sm-12 col-12" style="margin-bottom: 20px">
        <div class="single-item">
          <img src="{{asset('content/website/img/menu.jpeg')}}">
          <div class="item-hover">
            <h6><a href="{{url('setmenu-category')}}">All Set Menu</a></h6>
          </div>
        </div>
      </div>
      @if(isset($categoryPromoted))
      @foreach($categoryPromoted as $v_cat)
      <div class="col-md-4 col-lg-4 col-sm-12 col-12" style="margin-bottom: 20px">
        <div class="single-item">
          <img src="{{asset('storage/upload/category')}}/{{$v_cat->image}}">
          <div class="item-hover">
            <h6><a href="{{url('v-category')}}/{{$v_cat->slug}}">View Products</a></h6>
          </div>
        </div>
      </div>
      @endforeach
      @endif
    </div>
  </div>
</section>

<section class="google-maps">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2789.1827809648785!2d0.1648176149732411!3d45.64715102923906!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47fe3265e32fcff5%3A0xdbfaf138b8f2e8!2sLe%20Moghol!5e0!3m2!1sen!2sbd!4v1616839299445!5m2!1sen!2sbd" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</section>

 <?php
        $genaralSetting = \App\Models\setting::find(1);

    ?>
@if(isset($genaralSetting))
<section class="address-section section-padding" style="background-image: url({{asset('content/website')}}/img/section-six.jpg);">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="singel-address">
          <div class="address-content">
            <h4 class="address-title">Our Address</h4>
            <p>{{$genaralSetting->address}}</p>

          </div>
          <div class="address-content">
            <h4 class="address-title">Our Phone</h4>
            <p>{!!$genaralSetting->phone!!} </p>
            
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="singel-address">
          <div class="address-content">
            <h4 class="address-title">Our Schedules</h4>
            <p>{!!$genaralSetting->schedules!!} </p>
            <hr>
          </div>

          <div class="address-content">

            <p>You have an event to organize: Wedding, Birthday, seminar, the Le Moghol restaurant offers you its catering services. We deliver to you wherever you want! Click here </p>
            
          </div>
        </div>
        
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="singel-address">
          <div class="address-content">
          <p>Le Moghol, restaurant with
          Indo-Pakistani specialties is located in Nanterre.
          With our experience, you will find
          in our restaurant flavors from elsewhere
          to delight your taste buds. </p>
          
          </div>
        </div>
        
      </div>
    </div>
  </div>
</section>
@endif
@endsection