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
.image-position .image-position-lb-50 img{
  width: 160px!important;
  height: 160px!important;
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

    @livewire('banner-v1')

    <section class="personalized-section pt-100 pb-70 position-relative">
        <div class="personalized-bg-shape">
            <div class="personalized-shape-item">
                <img src="{{asset('content/website')}}/assets/images/header-shape-5.png" alt="shape">
            </div>
            <div class="personalized-shape-item">
                <img src="{{asset('content/website')}}/assets/images/header-shape-3.png" alt="shape">
            </div>
            <div class="personalized-shape-item">
                <img src="{{asset('content/website')}}/assets/images/header-shape-4.png" alt="shape">
            </div>
            <div class="personalized-shape-item">
                <img src="{{asset('content/website')}}/assets/images/header-shape-1.png" alt="shape">
            </div>
        </div>

    </section>

<?php
 $sst = \App\Models\setting::find(1);
 ?>


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
