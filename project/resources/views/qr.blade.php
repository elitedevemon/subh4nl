<?php $sst = \App\Models\setting::find(1);

 $dd = $_SERVER['REQUEST_URI'];
 $dd = str_replace('/', '', $dd);
 ?>

 @if(Auth::guard('web'))

 @endif
<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{$sst->title}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8" />
  <link rel="icon" href="{{asset('storage/upload/logo')}}/{{$sst->favicon}}" type="image/png" sizes="16x16">
  <!-- <link rel="stylesheet" href="css/font-awesome.min.css"> -->
  {!! $sst->header_part !!}
  <link rel="stylesheet" type="text/css" href="{{asset('content/website')}}/css/animate.css">
  <link rel="stylesheet" type="text/css" href="{{asset('content/website')}}/css/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="{{asset('content/website')}}/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="{{asset('content/website')}}/css/style.css">
  <link rel="stylesheet" type="text/css" href="{{asset('content/website')}}/css/responsive.css">
  <link rel="stylesheet" type="text/css" href="{{asset('content/website')}}/css/main.css">

      @stack('css')
      @livewireStyles

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
a.about-more-z.com-btn {
    background: black;
}
</style>
   </head>

   <body style="padding-right: 0!important">
   <?php
 $sst = \App\Models\setting::find(1);
  $homePage = \App\Models\HomePage::find(1);
 $fineName = 'storage/upload/logo/'.$sst->is_menu;
 $fineName1 = 'storage/upload/logo/'.$sst->is_menu_eng;
 ?>


   <section class="order-section ptb">
    <div class="container">
      <div class="row">
        <div class="order-top">
          <img src="{{asset('content/website')}}/images/order-top.png" alt="layer">
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6">
          <div class="max-w-390">
            <div class="headding-part">
              <p class="headding-sub" style="color: #fff!important;">Delicious Restaurant</p>
              <h2 class="headding-title text-uppercase font-weight-bold">about Restaurant</h2>
            </div>
            <p class="online-des">Sit amet, consectetur adipiscing elit quisque eget maximus velit, non eleifend libero curabitur dapibus mauris sed leo cursus aliquetcras suscipit. Sit amet, consectetur adipiscing elit quisque eget maximus velit, non eleifend libero curabitur Sit amet, consectetur adipiscing elit quisque eget maximus velit, non eleifend libero curabitur dapibus mauris sed leo cursus aliquetcras suscipit. Sit amet, consectetur adipiscing elit quisque eget maximus velit, non eleifend libero curabitur </p>
            <a href="{{route('menu.index')}}" class="about-more-z com-btn">Commander</a>
            <a title="file.pdf" href="{{$fineName}}" target="_blank" class="about-more-z com-btn">Voir La Carte</a>
            <a title="file.pdf" href="{{$fineName1}}" target="_blank" class="about-more-z com-btn">Download Menu</a>
          </div> 
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6">
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


        <div class="order-bottom">
          <img src="{{asset('content/website')}}/images/order-bottsom.png" alt="layer">
        </div>
      </div>
    </div>
  </section>

 <script src="{{asset('content/website')}}/js/jquery.min.js"></script>
    <script src="{{asset('content/website')}}/js/owl.carousel.min.js"></script>
    <script src="{{asset('content/website')}}/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://kit.fontawesome.com/36498e936c.js" crossorigin="anonymous"></script>
    <script src="{{asset('content/website')}}/js/main.js"></script>


    @stack('js')

    @livewireScripts

  <!--   <script type="module">
      import * as hotwiredTurbo from "https://cdn.skypack.dev/@hotwired/turbo"
    </script>
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script> -->
 <script>
   $(document).ready(function() {
             $('.cart-modal-close').on('click', function() {
                 // var myModal = new bootstrap.Modal(document.getElementById("modelData"));
                 // myModal.show();
                 $('.cart-modal-wrapper').removeClass('active');
                 $('.cart-modal').removeClass('active');
             });
             var btn = $('#cartButtomBtn');
             btn.addClass('show');
         });

</script>
 <script>
// var btn = $('#cartButtomBtn');

// $(window).scroll(function() {
//   if ($(window).scrollTop() > 50) {
//     btn.addClass('show');
//   } else {
//     btn.removeClass('show');
//   }
// });

// btn.on('click', function(e) {
//   e.preventDefault();
//   $('html, body').animate({scrollTop:0}, '300');
// });


</script>

<script>


window.addEventListener('swal:modal', event => {
    swal({
      title: event.detail.message,
      text: event.detail.text,
      icon: event.detail.type,
    });
});

window.addEventListener('show-modal', event => {
   $('#modelData').modal('show');
});
// window.addEventListener('show-modal1', event => {
//    $('#productDetails').modal('show');
// });

 </script>

      <script>
         $(document).ready(function() {
             $('.clicked').on('click', function() {
                 var myModal = new bootstrap.Modal(document.getElementById("modelData"));
                 myModal.show();
             });
             $('.click1').on('click', function() {
                 var myModal = new bootstrap.Modal(document.getElementById("productDetails"));
                 myModal.show();
             });
         });
      </script> 
      <script>
        $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
      </script>

<!--       <script>
         $(document).ready(function() {
                 var myModal = new bootstrap.Modal(document.getElementById("modelData1"));
                 myModal.show();

         });
      </script> -->
      <script>
         $(document).ready(function() {
                 var myModal = new bootstrap.Modal(document.getElementById("modelData3"));
                 myModal.show();

         });
      </script>  
          <script>
         $(document).ready(function() {
                 var myModal = new bootstrap.Modal(document.getElementById("modelData11"));
                 myModal.show();

         });
      </script>

        <script>
            window.addEventListener('hide-modal', event => { 
               $('#modelData').modal('hide');
            });
       </script> 
       <script>
            window.addEventListener('hide-modal1', event => { 
               $('#modelData11').modal('hide');
            });
       </script>
        <script>
            window.addEventListener('hide-modal1', event => { 
               $('#modelData1').modal('hide');
               $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            });
       </script>
        <script>
      window.addEventListener('offer-modal', event => { 
          var myModal = new bootstrap.Modal(document.getElementById("modelData1"));
                 myModal.show();
      });
 </script>


     <script>
         $(document).ready(function() {
           $(".productCart").on("click", function(e) {
      e.preventDefault();
      $(".cart-modal-wrapper").addClass("active");
      $(".cart-modal").addClass("active");
   })
   $(".cart-modal-close").on('click', function() {
      $(".cart-modal-wrapper").removeClass("active");
      $(".cart-modal").removeClass("active");
      $(".wish-modal").removeClass("active");
   })
         });
</script>
   </body>
   <!-- Mirrored from templates.hibootstrap.com/fafo/default/index-1-without-revolution.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 Aug 2021 07:05:33 GMT -->
</html>