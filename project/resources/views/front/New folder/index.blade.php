@extends('layouts.website')
@push('css')
<link rel="stylesheet" href="{{asset('content/website')}}/assets/css/main.css" type="text/css" media="all" />
<style>
.newStyle{
   position: relative;
}
   .newStyle:before {
    content: "";
    width: 100%;
    height: 85%;
    position: absolute;
    top: 0;
    left: 0;
    background: #e7272d;
    border-radius: 10px;
    z-index: -1;
}
.newStyle .btn {
    font-size: 16px;
    padding: 15px 27px;
    margin-bottom: 25px;
    opacity: 1;
    visibility: visible;
    -webkit-transform: scale(1);
    transform: scale(1);
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
}
.menu-main-thumb-inner {
    width: 100%;
    height: 100%;
}
.menu-main-thumb-inner img {
    width: 36%;
}
@media only screen and (max-width: 767px){

  .menu-details-carousel-item .btn {
     font-size: 18px!important;
    padding: 2px;
  }
  

}
a.customCloseBtn {
    margin-top: 14px;
    background: #cc0000;
    padding: 4px;
    color: #fff;
    font-size: 11px;
    font-weight: bold;
    border-radius: 21px;
    cursor: pointer;
}

</style>
@endpush

@section('content')

<?php
 $sst = \App\Models\setting::find(1);
 $fineName = 'storage/upload/logo/'.$sst->is_menu;
 ?>

      <div class="header-bg">
         <div class="container-fluid">
            <div class="header-container position-relative">
 
               @livewire('banner')
            </div>
         </div>
      </div>

      <section class="welcome-section bg-overlay-1 pt-100 pb-70 bg-black">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-sm-12 col-md-5 col-lg-5 pb-30">
                  <div class="section-title section-title-left text-center text-md-start m-0">

                     <h2 class="color-white">{{$homePage->title}}</h2>
                     <p>{{$homePage->des}}</p>
                     <a href="{{route('menu.index')}}" class="btn">
                     Commander
                     <i class="flaticon-right-arrow-sketch-1"></i>
                     </a>
                     <!-- <a href="{{route('m.download')}}" target="_blank" class="btn"> -->
                 <!--      <a href="#" onclick="window.open('MyPDF.pdf', '_blank', 'fullscreen=yes'); return false;">MyPDF</a> -->
                      <a title="file.pdf" href="{{$fineName}}" target="_blank" class="btn">
                     Voir La Carte
                     <i class="fa fa-download" aria-hidden="true"></i>
                     </a>
                  </div>
               </div>
               <div class="col-sm-12 col-md-7 col-lg-7">
                  <div class="about-image-grid">
                     <div class="about-image-grid-item">
                        <div class="about-image-grid-inner mb-30">
                           <img src="{{asset('storage/upload/aboutImage')}}/{{$homePage->img1}}" alt="welcome">
                        </div>
                        <div class="about-image-grid-inner mb-30">
                           <img src="{{asset('storage/upload/aboutImage')}}/{{$homePage->img2}}" alt="welcome">
                        </div>
                     </div>
                     <div class="about-image-grid-item">
                        <div class="about-image-grid-inner fluid-height">
                           <img src="{{asset('storage/upload/aboutImage')}}/{{$homePage->img3}}" alt="welcome">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

      @livewire('promo-product')


      @livewire('deal')





 <div class="modal fade" id="modelData3" tabindex="-1" aria-labelledby="exampleModalLabela" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content customModal">
                                <div class="modal-body text-center" style="padding:.5rem">
                                    <div class="promoImg" style="margin-bottom:4px ">
                                      <img src="{{asset('storage/upload/logo')}}/{{$sst->promoImgAlert}}" alt="">
                                    </div>
                                    <a class="customCloseBtn" data-bs-dismiss="modal">Close</a>
                                </div>
                            </div>
                        </div>
                  </div>

@endsection
@push('js')

      <script src="{{asset('content/website')}}/assets/js/owl.carousel.min.js"></script>
      <script src="{{asset('content/website')}}/assets/js/slick.min.js"></script>

      <script src="{{asset('content/website')}}/assets/js/jquery.themepunch.revolution.min.js"></script>
      <script src="{{asset('content/website')}}/assets/js/jquery.themepunch.tools.min.js"></script>
      <script src="{{asset('content/website')}}/assets/js/extensions/revolution.extension.actions.min.js"></script>
      <script src="{{asset('content/website')}}/assets/js/extensions/revolution.extension.carousel.min.js"></script>
      <script src="{{asset('content/website')}}/assets/js/extensions/revolution.extension.kenburn.min.js"></script>
      <script src="{{asset('content/website')}}/assets/js/extensions/revolution.extension.layeranimation.min.js"></script>
      <script src="{{asset('content/website')}}/assets/js/extensions/revolution.extension.migration.min.js"></script>
      <script src="{{asset('content/website')}}/assets/js/extensions/revolution.extension.navigation.min.js"></script>
      <script src="{{asset('content/website')}}/assets/js/extensions/revolution.extension.parallax.min.js"></script>
      <script src="{{asset('content/website')}}/assets/js/extensions/revolution.extension.slideanims.min.js"></script>
      <script src="{{asset('content/website')}}/assets/js/extensions/revolution.extension.video.min.js"></script>
      <script src="{{asset('content/website')}}/assets/js/wow.min.js"></script>

<script>
   $(document).ready(function() {
             $('.doriKha').on('click', function() {
                 // var myModal = new bootstrap.Modal(document.getElementById("modelData"));
                 // myModal.show();
                 $('.getACustom').removeClass('newStyle');
             });
             $('.doriKha1').on('click', function() {
                 // var myModal = new bootstrap.Modal(document.getElementById("modelData"));
                 // myModal.show();
                 $('.getACustom').removeClass('newStyle');
             });
         });
//    doriKha
// doriKha1
  // flaticon-left-arrow-2 prev-arrow
</script>


@endpush
