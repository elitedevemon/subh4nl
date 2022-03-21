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

    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />

<style>
  .img_pro img {
    height: 121px;
}

span.title_pro {
    color: #e3e3e3;
    float: left !important;
}

.wrap {
   /* height: 100%; */
   /*overflow: auto;*/
   /* padding: 1em 2.5em; */
   text-align: center;
   width: 100%;
   z-index: 10000;
   /* background: #04bd51; */
   display: block;
   font-weight: bold;
   border-radius: 16px;
   /* width: 25px; */
   position: relative;
   bottom: 2px;
   /* right: -18px; */
   left: 0%;
   /* text-align: center; */
   font-weight: bold;
   color: #fff;
   height: 25px;
}




/*== start of code for tooltips ==*/
.tool {
    cursor: help;
    position: relative;
    /* bottom: 23px; */
    background: red;
    padding: 2px 9px;
    margin-left: 5px;
    border-radius: 10px;
}


/*== common styles for both parts of tool tip ==*/
.tool::before,
.tool::after {
    /* left: 100%; */
    opacity: 0;
    position: absolute;
    z-index: -100;
    /* right: 51%; */
    /* right: 100%; */
}

.tool:hover::before,
.tool:focus::before,
.tool:hover::after,
.tool:focus::after {
    opacity: 1;
    transform: scale(1) translateY(0);
    z-index: 1000000;
}


/*== pointer tip ==*/
.tool::before {
    /* border-style: solid; */
    /* border-width: 1em 0.75em 0 0.75em; */
    /* border-color: #3E474F transparent transparent transparent; */
    /* bottom: 100%; */
    /* content: ""; */
    /* margin-left: -0.5em; */
    /* transition: all .65s cubic-bezier(.84,-0.18,.31,1.26), opacity .65s .5s; */
    /* transform:  scale(.6) translateY(-90%); */
} 

.tool:hover::before,
.tool:focus::before {
    transition: all .65s cubic-bezier(.84,-0.18,.31,1.26) .2s;
}


/*== speech bubble ==*/
.tool::after {
    background: #3E474F;
    border-radius: .25em;
    bottom: 151%;
    color: #EDEFF0;
    content: attr(data-tip);
    margin-left: -8.75em;
    padding: 2px;
    transition: all .65s cubic-bezier(.84,-0.18,.31,1.26) .2s;
    transform:  scale(.6) translateY(50%);
    width: 17.5em;
    z-index: 100000;
    /* left: 22%; */
    /* right: 100%; */
}

.tool:hover::after,
.tool:focus::after  {
    transition: all .65s cubic-bezier(.84,-0.18,.31,1.26);
    left: -24px;
}

@media (max-width: 760px) {
  .tool::after {
        font-size: .75em;
        margin-left: -5em;
        width: 10em;
        right: 100%;
        /* top: 67%; */
  }
}


a.btn.btn-secondary.btn-sm {
    padding: 3px;
}

</style>
      @stack('css')
      @livewireStyles


   </head>
   <body>
      <header id="header">
    <div class="container">
      <div class="row m-0">
        <div class="col-2 p-0 text-center customCo">

        </div>
        <div class="col-8 col-md-2 p-0 text-center">
                <div class="navbar-header forMobileversion">
                      <a class="navbar-brand page-scroll" href="/">
                        <img alt="pizzon" src="{{asset('storage/upload/logo')}}/{{$sst->logo}}">
                      </a> 
                </div>
          </div>
          <div class="col-2 col-md-12 p-0 text-center">
              <div id="menu" class="navbar-collapse collapse" >
                  <ul class="nav navbar-nav">
                    <li class="level">
                        <a href="/" class="page-scroll">Home</a>
                    </li>
                    <li class="level dropdown set"> 
                        <a href="{{route('menu.index')}}" class="page-scroll">Menu</a>
                    </li>
                    <li class="level">
                        <a href="/reservation" class="page-scroll">Reservation</a>
                    </li>
                     <li class="level" id="forDesktopVersion">
                        <div class="navbar-header">
                              <a class="navbar-brand page-scroll" href="/">
                                <img alt="pizzon" src="{{asset('storage/upload/logo')}}/{{$sst->logo}}">
                              </a> 
                        </div>
                    </li>
                    <li class="level dropdown set"> 
                        <a href="#" class="page-scroll">Pages</a>
                        <span class="opener plus"></span> 
                        <div class="megamenu mobile-sub-menu content">
                            <div class="megamenu-inner-top">
                                <ul class="sub-menu-level1">
                                    <li class="level2">
                                      <ul class="sub-menu-level2 ">
                                          <li class="level3"><a href="/about-us"><span>■</span>À propos de nous</a></li>
                                          <li class="level3"><a href="/contact-us"><span>■</span>Nous contacter</a></li>
                                      </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                  </ul>
              </div>
              <div class=" header-right-link">
                  <ul>
                      <li class="call-icon">
                        <a href="tel:{!! $sst->phone !!}">
                          <!-- <span class="icon"></span> -->
                          <i class="icon fas fa-phone"></i>
                          <div class="link-text">{!! $sst->phone !!}</div>
                        </a>
                      </li>
                 
                      <li class="cart-icon"> 
                        <a href="#"> 
                          <!-- <span class="icon"></span> -->
                          <i class="icon fas fa-shopping-cart"></i>
                          <div class="link-text"></div>
                        </a>
                      @livewire('cart-side-bar')
                      </li>
                      <li class="call-icon">
                        @guest
                          <a href="#" data-toggle="modal" data-target="#loginFF">
                            <i class="icon fas fa-user"></i>
                          </a>
                        @else
                          <a href="/my-account">
                            <i class="icon fas fa-user"></i>
                          </a>
                        @endguest

                      </li>
                     <!--  <li class="order-online">
                        <a href="shop-categories.html" class="btn btn-green">Order online</a>
                      </li> -->
                      <li class="side-toggle">
                          <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"><span></span></button>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
    </div>
  </header>




@yield('content')



  <div class="top-scrolling">
    <a href="#header" class="scrollTo"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
  </div>

  <footer>
    <div class="container">
      <div class="footer">
        <div class="row">
          <div class="col-xl-4 col-lg-4 col-md-4 footer-box">
            <div class="footer-logo">
              <img src="{{asset('storage/upload/logo')}}/{{$sst->logo}}" alt="fooret-logo">
              <p class="footer-des">{!! $sst->address !!}</p>
              <ul>
                <li>phone  - <a href="tel:{!! $sst->phone !!}">{!! $sst->phone !!}</a></li>
              </ul>
            </div>
          </div>


      <!--     <div class="col-xl-4 col-lg-4 col-md-4 footer-box">
            <div class="useful-links">
              <h2>useful links</h2>
              <ul>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Order Tracking</a></li>
                <li><a href="#">Warranty and Services</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact Us</a></li>
              </ul>
            </div>
          </div> -->
        </div>
      </div>
     <div class="copyright" style="margin-bottom: 80px;">
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-6 copyright-box">
            <p class="copy-text">© {{$sst->title}} all Rights Reserved.</p>
          </div>

          <div class="col-xl-6 col-lg-6 col-md-6 copyright-box">
            <ul>
              <li><a href="{{$sst->fb}}" target="_blank"><i style="font-size: 45px" class="fab fa-facebook-square" aria-hidden="true"></i></a></li>
              <li><a href="https://wa.me/+33659971449" target="_blank"><i style="font-size: 45px" class="fab fa-whatsapp-square" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <div class="mobile-bottom-nav">
                    <ul>
                      <li>
                        <a href="/">
                          <i class="fas fa-home" aria-hidden="true"></i>
                          <br>
                          Home
                        </a>
                      </li>
                        <li>
                        <a href="/reservation">
                          <i class="fas fa-book-reader" aria-hidden="true"></i>
                             <br>
                             Réservation
                        </a>
                      </li>
                       <li>
                        <a href="/home/categories">
                          <i class="fas fa-utensils" aria-hidden="true"></i>
                          <br>
                        Le Carte</a>
                      </li>
   
                      <li>
                        <a href="/contact-us">
                          <i class="fas fa-map-signs" aria-hidden="true"></i>
                          <br>
                        Map</a>
                      </li>
                      <li>
                        @guest
                          <a href="#" data-toggle="modal" data-target="#loginFF">
                            <i class="fas fa-user" aria-hidden="true"></i>
                            <br>
                            User
                          </a>
                        @else
                          <a href="/my-account">
                            <i class="fas fa-user"></i>
                            <br>
                             User
                          </a>
                        @endguest
                  
                      </li>
       

                    </ul>
    </div>

@livewire('cart-counter')




<!-- Modal -->


<div class="modal fade " id="productOptionDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content customModal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add-on Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-3 col-6 mb-2">
            <div class="pro_option text-center">
              <div class="img_pro">
                <img src="https://dummyimage.com/140x140/000/fff" class="rounded-circle
                img-fluid" alt=""> 
              </div>
                <span class="title_pro">Lorem, ipsum, dolor.</span>
              <div class="btn_pro text-center">
                 <input type="checkbox" id="check1">
                <label for="check1" class="customBtnPro1" style="margin:0px">Add</label>
                <!-- <button class="customBtnPro">Add</button> -->
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 mb-2">
            <div class="pro_option text-center">
              <div class="img_pro">
                <img src="https://dummyimage.com/140x140/000/fff" class="rounded-circle
                img-fluid" alt=""> 
              </div>
                <span class="title_pro">Lorem, ipsum, dolor.</span>

              <div class="btn_pro text-center">
                 <input type="radio" id="check12" name="er" value="34">
                <label for="check12" class="customBtnPro1" style="margin:0px">Add</label>
                <!-- <button class="customBtnPro">Add</button> -->
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 mb-2">
            <div class="pro_option text-center">
              <div class="img_pro">
                <img src="https://dummyimage.com/140x140/000/fff" class="rounded-circle
                img-fluid" alt=""> 
              </div>
                <span class="title_pro">Lorem, ipsum, dolor.</span>

              <div class="btn_pro text-center">
                 <input type="radio" id="check123" name="er" value="34">
                <label for="check123" class="customBtnPro1" style="margin:0px">Add</label>
                <!-- <button class="customBtnPro">Add</button> -->
              </div>
            </div>
          </div>
    


        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm">Ajouter au panier</button>
      </div>
    </div>
  </div>
</div>

<!-- Login -->
<!-- longin -->
<div class="modal fade" id="loginFF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<!--       <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <nav>
  <div class="nav nav-tabs text-center" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Login</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Sign Up</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      <form action="{{ route("login") }}" method="POST" class="main">
                                                @csrf
          <h1>Login Up</h1>

          <div class="em">
            <input type="email" name="email" placeholder="Adresse Email" />
          </div>
          <div class="orp">
            <input type="password" name="password" placeholder="Mot de passe" />
          </div>
          <button class="userLoginBtn" type="submit">Se connecter</button>
          <hr />
          <h5>Mot de passe oublié? <a href="{{route('pass.reset')}}">Reset</a></h5>
          <hr />
          <h4>Or Register With Se connecter avec Google</h4>
          <div class="icons">

            <div class="icon-container">
              <a href="{{ url('auth/google') }}" target="_blank">
                <i class="fab fa-google"></i>
              </a>
            </div>
          </div>
      </form>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
<form action="{{ route("register")  }}" method="POST" class="main">
                                             @csrf
  <h1>Sign Up</h1>
  <div class="un">
    <input type="text" value="{{ old("name")  }}" name="name"  placeholder="Nom et prénom"/>
  </div>
  <div class="em">
    <input type="email" value="{{ old("email")  }}" name="email"  placeholder="Adresse Email" />
  </div>
  <div class="em">
    <input type="text" value="{{ old("phone_number")  }}" name="phone_number"  placeholder="Téléphone" />
  </div>
  <div class="orp">
    <input type="password" value="{{ old("password")  }}" name="password"  placeholder="Mot de passe" />
  </div>
  <div class="confp">
    <input type="password" value="{{ old("password_confirmation")  }}" name="password_confirmation"  placeholder="Confirmez le mot de passe" />
  </div>
  <button class="userLoginBtn" type="submit">S'identifier</button>

</form>
  </div>
</div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- longin -->
<!-- Login End -->
@livewire('offer')

    <script src="{{asset('content/website')}}/js/jquery.min.js"></script>
    <script src="{{asset('content/website')}}/js/owl.carousel.min.js"></script>
    <script src="{{asset('content/website')}}/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://kit.fontawesome.com/36498e936c.js" crossorigin="anonymous"></script>
    <script src="{{asset('content/website')}}/js/main.js"></script>


    @stack('js')

    @livewireScripts

    <script type="module">
      import * as hotwiredTurbo from "https://cdn.skypack.dev/@hotwired/turbo"
    </script>
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>
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


    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>



















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
            $('.optionDetailsClick').on('click', function() {
                 // var myModal = new bootstrap.Modal(document.getElementById("optionDetails"));
                 // myModal.show();
                  alert();
             });
      </script>

      <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
          })
      </script>

      <script>
         $(document).ready(function() {
                 var myModal = new bootstrap.Modal(document.getElementById("modelData1"));
                 myModal.show();

         });
      </script>
      <script>
         $(document).ready(function() {
                 var myModal = new bootstrap.Modal(document.getElementById("modelData3"));
                 myModal.show();

         });
      </script>
       <script>
         $(document).ready(function() {
                 var myModal = new bootstrap.Modal(document.getElementById("modelOffer"));
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
            window.addEventListener('hide-offerDetails', event => { 
               $('#offerDetails').modal('hide');
            });
       </script>
        <script>
            window.addEventListener('hide-offerDetails', event => { 
               $('#offerDetails').modal('hide');
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
      window.addEventListener('offer-product-Model', event => { 
          var myModal = new bootstrap.Modal(document.getElementById("offerDetails"));
                 myModal.show();
      });
 </script>
   </body>
</html>