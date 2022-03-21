<?php $sst = \App\Models\setting::find(1);

 $dd = $_SERVER['REQUEST_URI'];
                              $dd = str_replace('/', '', $dd);
 ?>

 
 @if(Auth::guard('web'))
 
<!--dd('hey');  -->
 
 @endif
<!DOCTYPE html>
<html lang="zxx">
   <!-- Mirrored from templates.hibootstrap.com/fafo/default/index-1-without-revolution.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 Aug 2021 07:05:33 GMT -->
   <head>
      <meta charset="utf-8">
      <meta name="description" content="Fafo">
      <meta name="keywords" content="HTML,CSS,JavaScript">
      <meta name="author" content="HiBootstrap">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
      <title>{{$sst->title}}</title>

      <link rel="icon" href="{{asset('storage/upload/logo')}}/{{$sst->favicon}}" type="image/png" sizes="16x16">
      {!! $sst->header_part !!}
          <link rel="stylesheet" href="{{asset('content/website')}}/assets/css/bootstrap.min.css" type="text/css" media="all" />
          <link rel="stylesheet" href="{{asset('content/website')}}/assets/css/all.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('content/website')}}/assets/css/bootstrap-reboot.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('content/website')}}/assets/css/animate.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('content/website')}}/assets/css/owl.carousel.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('content/website')}}/assets/css/owl.theme.default.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('content/website')}}/assets/css/slick.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('content/website')}}/assets/css/slick-theme.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('content/website')}}/assets/css/jquery-ui.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('content/website')}}/assets/css/jquery.timepicker.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('content/website')}}/assets/css/meanmenu.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('content/website')}}/assets/css/magnific-popup.min.css" type="text/css" media="all" />
    <link rel='stylesheet' href="{{asset('content/website')}}/assets/css/icofont.min.css" type="text/css" media="all" />
    <link rel='stylesheet' href="{{asset('content/website')}}/assets/css/flaticon.css" type="text/css" media="all" />
    <link rel='stylesheet' href="{{asset('content/website')}}/assets/css/settings.css" type="text/css" media="all" />
    <link rel='stylesheet' href="{{asset('content/website')}}/assets/css/layers.css" type="text/css" media="all" />
    <link rel='stylesheet' href="{{asset('content/website')}}/assets/css/navigation.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('content/website')}}/assets/css/style.css" type="text/css" media="all" />
    
    <link rel="stylesheet" href="{{asset('content/website')}}/assets/css/responsive.css" type="text/css" media="all" />
      <!--[if IE]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
      @stack('css')
      @livewireStyles

      <style>
      body{
        padding: 0px!important;
        margin: 0px!important;
      }

      body:not(.modal-open){
  padding-right: 0px !important;
}
.header-carousel-text h1 {
    font-weight: 700!important;
    font-style: italic!important;
    font-family: serif!important;
}
.swal-button {
    background-color: #c10000!important;
}
      .fixed-top{
  padding-right: 0px !important;
}
      .mobile-bottom-nav{
        display: none;
      }
      .phoneNumber{
        display: none;
      }
    @media only screen and (max-width: 767px){

#cartButtomBtn {
    bottom: 95px!important;
}
      .phoneNumber {
          padding: 20px;
          background: #e7272d;
          font-size: 16px;
          display: block;
      }
      .topbar.bg-main{
        display: none;
      }
        .header-carousel-text {
    padding-top: 0px!important;
    padding-bottom: 0px!important;
    margin-bottom: 0px!important;
  }

  .mobile-bottom-nav{
        display: block;
      }
  .mobile-bottom-nav{
    background-color: #222;
    /*overflow: hidden;*/
    position: fixed;
    bottom: 0;
    width: 100%;
    z-index: 100;
}


.mobile-bottom-nav ul {
    margin: 0;
    padding: 0;
    list-style: none;
    width: 100%;
}
.mobile-bottom-nav ul li {

    display: inline-block;
    width: 24%;
    text-align: center;
}

.mobile-bottom-nav ul li a {
    font-size: 15px;
    display: inline-block;
    padding: 10px;
    color: #e7272d;
}

}



.orfferText {
    padding: 10px;
    background: #e43e43;
    color: #fff;
    font-weight: 800;
    border-radius: 3px;
}

.p-2.bd-highlight.newBD {
    text-align: center;
    color: #000;
    border-bottom: 1px solid#ececec;
}

.promoImg p {
    font-size: 15px;
    color: #000;
    font-style: italic;
}
span.offerInfo {
    background: #ffcc00;
    padding: 0px 6px 1px;
    /* width: 10px; */
    /* height: 20px; */
    border-radius: 11px;
    font-size: 10px;
    color: #000;
}

label img {
  height: 135px;
  width: 135px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

#cartButtomBtn {
    display: inline-block;
    background-color: #e7272d;
    width: 50px;
    height: 50px;
    text-align: center;
    border-radius: 25px;
    position: fixed;
    bottom: 30px;
    right: 30px;
    transition: background-color .3s, opacity .5s, visibility .5s;
    z-index: 1000;
    padding: 5px 9px 50px 3px;
    font-size: 13px;
}
#cartButtomBtn::after {
  content: "\f07a";
  font-family: FontAwesome;
  font-weight: normal;
  font-style: normal;
  font-size: 2em;
  line-height: 50px;
  color: #fff;
}
#cartButtomBtn:hover {
  cursor: pointer;
  background-color: #333;
}
#cartButtomBtn:active {
  background-color: #555;
}
.modal-backdrop.show {
    opacity: 0!important;
}
ul.social-list i {
    font-size: 36px;
}
      </style>
   </head>
   <body style="padding-right: 0!important">

    @if($sst->is_delivery == 2)
<div class="alert alert-danger">
    <b>nous ne livrons pas de nourriture aujourd'hui !</b>
  </div>
  @endif
<!--       <div class="preloader bg-main">
         <div class="preloader-wrapper">
            <div class="preloader-grid">
               <div class="preloader-grid-item preloader-grid-item-1"></div>
               <div class="preloader-grid-item preloader-grid-item-2"></div>
               <div class="preloader-grid-item preloader-grid-item-3"></div>
               <div class="preloader-grid-item preloader-grid-item-4"></div>
               <div class="preloader-grid-item preloader-grid-item-5"></div>
               <div class="preloader-grid-item preloader-grid-item-6"></div>
               <div class="preloader-grid-item preloader-grid-item-7"></div>
               <div class="preloader-grid-item preloader-grid-item-8"></div>
               <div class="preloader-grid-item preloader-grid-item-9"></div>
            </div>
         </div>
      </div> -->
      <div class="topbar bg-main">
         <div class="container">
            <div class="topbar-inner">

               <div class="topbar-item">
                  <div class="topbar-right d-flex flex-wrap topbar-right justify-content-center justify-content-md-start full-height">


                     <div class="topbar-right-item topbar-padding color-white">
                        <i class="flaticon-smartphone-call"></i>
                        <a href="tel:{!! $sst->phone !!}" class="color-white">{!! $sst->phone !!}</a>
                     </div>
                     <!-- <div class="topbar-right-item topbar-padding language-button language-option">
                        <button class="dropdown-toggle color-white lang-compo" type="button" id="language1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                        <img src="assets/images/uk.png" alt="flag">
                        English
                        </button>
                        <div class="dropdown-menu language-dropdown-menu" aria-labelledby="language1"> 
                           <a class="dropdown-item" href="#">
                           <img src="assets/images/uk.png" alt="flag">
                           English
                           </a>
                           <a class="dropdown-item" href="#">
                           <img src="assets/images/germany.png" alt="flag">
                           Deutsch
                           </a>
                           <a class="dropdown-item" href="#">
                           <img src="assets/images/china.png" alt="flag">
                           简体中文
                           </a>
                           <a class="dropdown-item" href="#">
                           <img src="assets/images/arab.png" alt="flag">
                           العربيّة
                           </a>
                        </div>
                     </div> -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      <header>
         <div class="fixed-top">
            <div class="navbar-area navbar-dark">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

              @if (count($errors) > 0)
                 <div class = "alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                 </div>
              @endif
<!--     <div class="topbar-mb bg-main">
         <div class="container">
            <div class="topbar-inner">

               <div class="topbar-item">
                  <div class="topbar-right d-flex flex-wrap topbar-right justify-content-center justify-content-md-start full-height">


                     <div class="topbar-right-item topbar-padding color-white">
                        <i class="flaticon-smartphone-call"></i>
                        <a href="tel:{!! $sst->phone !!}" class="color-white">{!! $sst->phone !!}</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div> -->
              <div class="phoneNumber">
                 <i class="flaticon-smartphone-call"></i>
                        <a href="tel:{!! $sst->phone !!}" class="color-white">{!! $sst->phone !!}</a>
              </div>
               <div class="mobile-nav">

                  <a href="/" class="mobile-brand">
                  <img src="{{asset('storage/upload/logo')}}/{{$sst->logo}}" alt="logo" class="blue-logo">
                  </a>
                  <div class="navbar-option d-flex align-items-center">
                     <div class="navbar-option-item navbar-option-dots mobile-hide">
                        <button class="dropdown-toggle" type="button" id="mobileOptionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon-menu-1"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="mobileOptionDropdown">
                           <div class="navbar-option-item navbar-option-cart">
                              <a href="#" class="productCart"><i class="flaticon-supermarket-basket"></i></a>
                           </div>
                           <div class="navbar-option-item navbar-option-order">
                              <a href="/main-menu" class="btn">
                              <i class="flaticon-shopping-cart-black-shape"></i>
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="navbar-option-item navbar-option-authentication">

                         @guest
                              <button class="navbar-authentication-button" type="button" id="auth2" data-bs-toggle="dropdown" aria-haspopup="true">
                                 <i class="flaticon-add-user"></i>
                              </button>
                              @else
                               <a href="/my-account" class="navbar-authentication-button" >
                                 <i class="flaticon-add-user"></i>
                              </a>
                        @endguest


                        @if($dd == 'cart')
                                  @guest
                              <div class="authentication-box dropdown-menu show" aria-labelledby="auth1">
                                  @else
                              <div class="authentication-box dropdown-menu" aria-labelledby="auth1">
                                  @endguest
                              @else
                              <div class="authentication-box dropdown-menu" aria-labelledby="auth1">
                              @endif
                           <div class="authentication-close"><i class="flaticon-cancel"></i></div>
                           <div class="authentication-body">
                                    @guest
                                    <ul class="authentication-tab">
                                       <li class="authentication-tab-item active" data-authentication-tab="1">Se connecter</li>
                                       <li class="authentication-tab-item" data-authentication-tab="2">Créer un Compet</li>
                                    </ul>

                                    <div class="authentication-details">
                                       <div class="authentication-details-item active" data-authentication-details="1">
                                           <form action="{{ route("login") }}" method="POST">
                                                @csrf
                                             <div class="form-group mb-20">
                                                <div class="input-group">
                                                   <input type="email" name="email" class="form-control" placeholder="Adresse Email" />
                                                </div>
                                             </div>
                                             <div class="form-group mb-20">
                                                <div class="input-group">
                                                   <input type="password" name="password" class="form-control" placeholder="Mot de passe" />
                                                </div>
                                             </div>

                                      <div class="authentication-action mb-20">
                                          <div class="authentication-action-item">
                                             <a href="{{route('pass.reset')}}">Mot de passe oublié?</a>
                                          </div>
                                       </div>
                                             <div class="authentication-btn">
                                                <button type="submit" class="btn full-width btn-border mb-20">Se connecter</button>
                                               <a href="{{ url('auth/google') }}" class="btn full-width"><i class="icofont-google-plus"></i>Se connecter avec Google</a>
                                             </div>
                                          </form>
                                       </div>
                                       <!-- End login -->
                                       <!-- start register -->
                                       <div class="authentication-details-item" data-authentication-details="2">
                                          <form action="{{ route("register")  }}" method="POST">
                                             @csrf
                                             <!-- <input type="hidden" name="getApath" value="{{request()->path()}}"> -->
                                             <div class="form-group mb-20">
                                                <div class="input-group">
                                                   <input type="text" value="{{ old("name")  }}" name="name" class="form-control" placeholder="Nom et prénom" />
                                                </div>
                                             </div>
                                             <div class="form-group mb-20">
                                                <div class="input-group">
                                                   <input type="email" value="{{ old("email")  }}" name="email" class="form-control" placeholder="Adresse Email" />
                                                </div>
                                             </div>
                                             <div class="form-group mb-20">
                                                <div class="input-group">
                                                   <input type="text" value="{{ old("phone_number")  }}" name="phone_number" class="form-control" placeholder="Téléphone" />
                                                </div>
                                             </div>
                                             <div class="form-group mb-20">
                                                <div class="input-group">
                                                   <input type="password" value="{{ old("password")  }}" name="password" class="form-control" placeholder="Mot de passe" />
                                                </div>
                                             </div>
                                             <div class="form-group mb-20">
                                                <div class="input-group">
                                                   <input type="password" value="{{ old("password_confirmation")  }}" name="password_confirmation" class="form-control" placeholder="Confirmez le mot de passe" />
                                                </div>
                                             </div>
                                             <div class="authentication-btn">
                                                <button type="submit" class="btn full-width btn-border mb-20">S'identifier</button>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                    @endguest
                                 </div>
                        </div>
                     </div>
                     <div class="navbar-option-item navbar-option-search">
                        <button class="dropdown-toggle" type="button" id="search2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon-loupe"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="search2">
                          <form action="{{route('searchProduct')}}" method="get">
                                    @csrf
                                    <div class="form-group">
                                       <input type="text" name="querySe" class="form-control" placeholder="Search">
                                       <button type="submit"><i class="flaticon-loupe"></i></button>
                                    </div>
                                 </form>
                        </div>
                     </div>
                     <div class="navbar-option-item navbar-option-cart mobile-block">
                        <a href="#" class="productCart"><i class="flaticon-supermarket-basket"></i></a>
                        <!-- <span class="option-badge">2</span> -->
                     </div>
                     <div class="navbar-option-item navbar-option-order mobile-block">
                        <a href="shops-grid.html" class="btn">
                        <i class="flaticon-shopping-cart-black-shape"></i>
                        </a>
                     </div>
                  </div>
               </div>

<!-- modile nav -->


               <div class="main-nav">
                  <div class="container">
                     <nav class="navbar navbar-expand-md navbar-light">
                        <a class="navbar-brand" href="/">
                        <img src="{{asset('storage/upload/logo')}}/{{$sst->logo}}" alt="logo" class="logo">
                        </a>
                        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                           <ul class="navbar-nav ms-auto">
                              <li class="nav-item">
                                 <a href="/" class="nav-link dropdown-toggle active">Accuiel</a>
                              </li>
                              <li class="nav-item">
                                 <a href="{{route('menu.index')}}" class="nav-link">Nos cartes</a>
                              </li>
                              <li class="nav-item">
                                 <a href="{{route('review.index')}}" class="nav-link">Avis </a>
                              </li>  
                              <li class="nav-item">
                                 <a href="{{route('reservation')}}" class="nav-link">Réservation</a>
                              </li>

                              <li class="nav-item">
                                 <a href="#" class="nav-link dropdown-toggle">PAGES</a>
                                 <ul class="dropdown-menu">
                                    <li class="nav-item">
                                       <a href="{{route('about.index')}}" class="nav-link">À propos de nous</a>
                                    </li>
                                    <li class="nav-item">
                                       <a href="{{route('contact.index')}}" class="nav-link">Nous contacter</a>
                                    </li>
                                     <li class="nav-item">
                                       <a href="{{route('catering.index')}}" class="nav-link">Catering</a>
                                    </li>
                                 </ul>
                              </li>
                       <!--        <li class="nav-item">
                                 <a href="contact-us.html" class="nav-link">CONTACT US</a>
                              </li> -->
                           </ul>
                        </div>
                        <div class="navbar-option d-flex align-items-center">
                           <div class="navbar-option-item navbar-option-authentication">
                              @guest
                              <button class="navbar-authentication-button" type="button" id="auth1" data-bs-toggle="dropdown" aria-haspopup="true">
                                 <i class="flaticon-add-user"></i>
                              </button>
                              @else
                               <a href="/my-account" class="navbar-authentication-button" >
                                 <i class="flaticon-add-user"></i>
                              </a>
                              @endguest
                        
                               @if($dd == 'cart')
                                  @guest
                              <div class="authentication-box dropdown-menu show" aria-labelledby="auth1">
                                  @else
                              <div class="authentication-box dropdown-menu" aria-labelledby="auth1">
                                  @endguest
                              @else
                              <div class="authentication-box dropdown-menu" aria-labelledby="auth1">
                              @endif
                                 <div class="authentication-close"><i class="flaticon-cancel"></i></div>
                                 <div class="authentication-body">
                                    @guest
                                    <ul class="authentication-tab" style="font-size: 12px">
                                       <li class="authentication-tab-item active" data-authentication-tab="1">Se connecter</li>
                                       <li class="authentication-tab-item" data-authentication-tab="2">Créer un Compet</li>
                                    </ul>

                                    <div class="authentication-details">
                                       <div class="authentication-details-item active" data-authentication-details="1">
                                           <form action="{{ route("login") }}" method="POST">
                                                @csrf
                                             <div class="form-group mb-20">
                                                <div class="input-group">
                                                   <input type="email" name="email" class="form-control" placeholder="Adresse Email" />
                                                </div>
                                             </div>
                                             <div class="form-group mb-20">
                                                <div class="input-group">
                                                   <input type="password" name="password" class="form-control" placeholder="Mot de passe" />
                                                </div>
                                             </div>
                                             <div class="authentication-action mb-20">
                                          <div class="authentication-action-item">
                                             <a href="{{route('pass.reset')}}">Mot de passe oublié?</a>
                                          </div>
                                       </div>
                                             <div class="authentication-btn">
                                                <button type="submit" class="btn full-width btn-border mb-20">Se connecter</button>

                                             </div>
                                          </form>
                            <a href="{{ url('auth/google') }}" class="btn full-width"><i class="icofont-google-plus"></i>Se connecter avec Google</a>
                                       </div>
                                       <div class="authentication-details-item" data-authentication-details="2">
                                          <form action="{{ route("register")  }}" method="POST">
                                             @csrf
                                             <input type="hidden" name="getApath" value="{{request()->path()}}">
                                             <div class="form-group mb-20">
                                                <div class="input-group">
                                                   <input type="text" value="{{ old("name")  }}" name="name" class="form-control" placeholder="Nom et Prénom" />
                                                </div>
                                             </div>
                                             <div class="form-group mb-20">
                                                <div class="input-group">
                                                   <input type="email" value="{{ old("email")  }}" name="email" class="form-control" placeholder="Adresse Email" />
                                                </div>
                                             </div>
                                             <div class="form-group mb-20">
                                                <div class="input-group">
                                                   <input type="text" value="{{ old("phone_number")  }}" name="phone_number" class="form-control" placeholder="Téléphone" />
                                                </div>
                                             </div>
                                             <div class="form-group mb-20">
                                                <div class="input-group">
                                                   <input type="password" value="{{ old("password")  }}" name="password" class="form-control" placeholder="Mot de passe" />
                                                </div>
                                             </div>
                                             <div class="form-group mb-20">
                                                <div class="input-group">
                                                   <input type="password" value="{{ old("password_confirmation")  }}" name="password_confirmation" class="form-control" placeholder="Confirmez le mot de passe" />
                                                </div>
                                             </div>
                                             <div class="authentication-btn">
                                                <button type="submit" class="btn full-width btn-border mb-20">S'identifier</button>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                    @endguest
                                 </div>
                              </div>
                           </div>
                           <div class="navbar-option-item navbar-option-search">
                              <button class="dropdown-toggle" type="button" id="search1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="flaticon-loupe"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="search1">
                                 <form action="{{route('searchProduct')}}" method="get">
                                    @csrf
                                    <div class="form-group">
                                       <input type="text" name="querySe" class="form-control" placeholder="Search">
                                       <button type="submit"><i class="flaticon-loupe"></i></button>
                                    </div>
                                 </form>
                              </div>
                           </div>


                           @livewire('cart-counter')
                           <div class="navbar-option-item navbar-option-order">
                              <a href="{{route('menu.index')}}" class="btn text-nowrap">
                              Commander <i class="flaticon-shopping-cart-black-shape"></i>
                              </a>
                           </div>
                        </div>
                     </nav>
                  </div>
               </div>
           
            </div>
         </div>
      </header>
@yield('content')

      <footer class="bg-overlay-1 bg-black">
         <div class="footer-upper pt-100 pb-80">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12 col-md-6 col-lg-4 order-1 order-lg-2 text-center">
                     <div class="footer-content-item text-start text-lg-center">
                        <ul class="footer-details footer-address">
                           <li>{!! $sst->address !!}</li>
                           <li><span>Hotline:</span><a href="tel:001-964-565-87652">{!! $sst->phone !!}</a></li>
                        </ul>
                        <div class="footer-follow">
                           <p>Follow Us:</p>
                           <ul class="social-list social-list-white">
                              <li><a href="{{$sst->fb}}" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
                              <li><a href="https://wa.me/+33652559514" target="_blank"><i class="fab fa-whatsapp-square"></i></a></li>
                           </ul>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
         </div>
         <div class="footer-lower">
            <div class="container">
               <div class="d-flex justify-content-center">
                  <div class="footer-lower-item">
                     <div class="footer-copyright-text footer-copyright-text-red">
                        <p>Copyright ©2021 Developed By <a href="mailto: ifty100148@gmail.com">HiBootstrap</a></p>

   
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
          <div class="mobile-bottom-nav">
                    <ul>
                      <li>
                        <a href="/">
                          <i class="fas fa-home"></i>
                          <br>
                          Home
                        </a>
                      </li>
                       <li>
                        <a href="{{route('menu.index')}}">
                          <i class="fas fa-utensils"></i>
                          <br>
                        Le Carte</a>
                      </li>
                      <li>
                        <a href="/reservation">
                          <i class="fas fa-book-reader"></i>
                             <br>
                             Réservation
                        </a>
                      </li>
                      <li>
                        <a href="/contact-us">
                          <i class="fas fa-map-signs"></i>
                          <br>
                        Map</a>
                      </li>
       

                    </ul>
    </div>

     @livewire('cart-side-bar')


<!--   // <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
                 
   @livewire('offer')

    <script src="{{asset('content/website')}}/assets/js/jquery-3.5.1.min.js"></script>
    <script src="{{asset('content/website')}}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('content/website')}}/assets/js/jquery-ui.js"></script>
    <script src="{{asset('content/website')}}/assets/js/jquery.timepicker.min.js"></script>
    <script src="{{asset('content/website')}}/assets/js/jquery.magnific-popup.min.js"></script>
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
    <script src="{{asset('content/website')}}/assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="{{asset('content/website')}}/assets/js/form-validator.min.js"></script>
    <script src="{{asset('content/website')}}/assets/js/contact-form-script.js"></script>
    <script src="{{asset('content/website')}}/assets/js/jquery.meanmenu.min.js"></script>
    <script src="{{asset('content/website')}}/assets/js/script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://kit.fontawesome.com/36498e936c.js" crossorigin="anonymous"></script>
    {!! $sst->footer_part !!}
@stack('js')

 @livewireScripts
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

 </script>

      <script>
         $(document).ready(function() {
             $('.clicked').on('click', function() {
                 var myModal = new bootstrap.Modal(document.getElementById("modelData"));
                 myModal.show();
             })
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