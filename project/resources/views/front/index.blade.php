@extends('layouts.website')
@push('css')
<style>
  .about-image-grid {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: end;
  -ms-flex-pack: end;
  justify-content: flex-end;
  margin-left: -10px;
  margin-right: -10px;
}
.about-image-grid-item {
  padding-left: 10px;
  padding-right: 10px;
}
.about-image-grid-inner {
  border-radius: 10px;
  overflow: hidden;
}
.mb-400{

  margin-bottom: 70px
}



  a.about-more-z.com-btn {
    background: #0d101a;
}
</style>
@endpush

@section('content')
@livewire('banner')
<?php

   $ssts = \App\Models\setting::find(1);
    $fineName = 'storage/upload/logo/'.$ssts->is_menu;

 ?>
  <section class="order-section ptb">
    <div class="container">
      <div class="row">
        <div class="col-12 mb-400">
          <div class="row">
            <div class="col-12 ml-20 col-md-6 mb-2">
              <div class="bg_banner_img">
                <img src="{{asset('storage/upload/logo')}}/{{$ssts->banner1}}" class="img-fluid" alt="">
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="bg_banner_img">
                <img src="{{asset('storage/upload/logo')}}/{{$ssts->banner2}}" class="img-fluid" alt="">
              </div>
            </div>
            <div class="col-12 col-md-6">
                          <a href="{{route('menu.index')}}" class="about-more-z com-btn">Commander</a>
            <a title="file.pdf" href="{{$fineName}}" target="_blank" class="about-more-z com-btn">Voir La Carte</a>
            </div>

          </div>
        </div>
   <!--      <div class="order-top">
          <img src="{{asset('content/website')}}/images/order-top.png" alt="layer">
        </div> -->
        <div class="col-xl-6 col-lg-6 col-md-6">
          <div class="max-w-390">
            <div class="headding-part">
              <p class="headding-sub" style="color: #fff!important;">Delicious Restaurant</p>
              <h2 class="headding-title text-uppercase font-weight-bold">{{$ssts->title}}</h2>
            </div>
            <p class="online-des">
              {{$homePage->des}}
            </p>

          </div> 
        </div>
       <div class="col-xl-6 col-lg-6 col-md-6">
          <div class="about-image-grid">
                     <div class="about-image-grid-item">
                        <div class="about-image-grid-inner mb-30">
                           <img src="{{asset('storage/upload/aboutImage')}}/{{$homePage->img1}}" class="img-fluid" alt="welcome">
                        </div>
                        <div class="about-image-grid-inner mb-30">
                           <img src="{{asset('storage/upload/aboutImage')}}/{{$homePage->img2}}" class="img-fluid" alt="welcome">
                        </div>
                     </div>
                     <div class="about-image-grid-item">
                        <div class="about-image-grid-inner fluid-height">
                           <img src="{{asset('storage/upload/aboutImage')}}/{{$homePage->img3}}" class="img-fluid" alt="welcome">
                        </div>
                     </div>
                  </div>
        </div>


        <div class="order-bottom">
          <img src="{{asset('content/website')}}/images/order-bottsom.png" alt="layer">
        </div>
      </div>
    </div>
  </section>

  @livewire('deal')

<!--   <section class="special-menu" style="padding-bottom: 0px!important ">
    <div class="container">

      <div class="row">
        <div class="col-md-12 text-center">
          <div class="bannnerImage">
            <img src="{{asset('storage/upload/logo')}}/{{$ssts->img_re}}" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </div>
  </section> -->


   <div class="modal fade" id="modelData3" tabindex="-1" aria-labelledby="exampleModalLabela" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content customModal">
                                <div class="modal-body text-center" style="padding:0px">
                                    <div class="promoImg" style="margin-bottom:4px ">
                                      <img src="{{asset('storage/upload/logo')}}/{{$ssts->promoImgAlert}}" class="img-fluid" alt="">
                                    </div>
                                    <a type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</a>
                                </div>
                            </div>
                        </div>
                  </div>

@endsection
@push('js')



@endpush
