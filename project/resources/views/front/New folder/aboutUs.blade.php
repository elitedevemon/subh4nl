@extends('layouts.website')
@push('css')

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
                  <img src="{{asset('content/website')}}/assets/images/header-shape-4.png" alt="shape">
               </div>
               <div class="header-page-shape-item">
                  <img src="{{asset('content/website')}}/assets/images/header-shape-1.png" alt="shape">
               </div>
               <div class="header-page-shape-item">
                  <img src="{{asset('content/website')}}/assets/images/header-shape-3.png" alt="shape">
               </div>
            </div>
            <div class="container">
               <div class="header-page-content">
                  <h1>About Us</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">About Us</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
      <section class="welcome-section bg-overlay-1 pt-100 pb-70 bg-black">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-sm-12 col-md-5 col-lg-5 pb-30">
                  <div class="section-title section-title-left text-center text-md-start m-0">
                     <small>Welcome To Fafo</small>
                     <h2 class="color-white">We Serve The Best Food Of The Country</h2>
                     <p>We are the country's no.1 Fast food retailer with 15+ years of reputation. Country's best burger and pizza are delivered by us. We gain the satisfaction of our customers with our delicate service and extreme high food quality.</p>
    
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
      <div class="video-section p-tb-100">
         <div class="container">
            <div class="video-button">
               <a href="https://www.youtube.com/watch?v=h_YmYLYi65k" id="video-popup"><i class="flaticon-play-button"></i></a>
            </div>
         </div>
      </div>
      <section class="service-section p-tb-100 bg-black">
         <div class="container-fluid">
            <div class="bg-main bg-overlay-transparent contain-box">
               <div class="container">
                  <div class="section-title">
                     <h2 class="color-white">We Offer 3 Kinds Of Services</h2>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                        <div class="service-item">
                           <div class="service-image">
                              <img src="{{asset('content/website')}}/assets/images/service-1.jpg" alt="service">
                           </div>
                           <div class="service-content">
                              <h3>1. Dine In</h3>
                              <p>Choose Your Best Combos From The Thousands Of Exciting Items.</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                        <div class="service-item">
                           <div class="service-image">
                              <img src="{{asset('content/website')}}/assets/images/service-2.jpg" alt="service">
                           </div>
                           <div class="service-content">
                              <h3>2. Take Away</h3>
                              <p>Choose Your Best Combos From The Thousands Of Exciting Items.</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-4 pb-30 offset-md-3 offset-lg-0">
                        <div class="service-item">
                           <div class="service-image">
                              <img src="{{asset('content/website')}}/assets/images/service-3.jpg" alt="service">
                           </div>
                           <div class="service-content">
                              <h3>3. Home Delivery</h3>
                              <p>Choose Your Best Combos From The Thousands Of Exciting Items.</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

     <!--  <section class="gallery-section p-tb-100 bg-black">
         <div class="container position-relative">
            <div class="section-title">
               <small>Gallery</small>
               <h2 class="color-white">See Our Happy Moments</h2>
            </div>
            <div class="gallery-grid">
               <div class="gallery-grid-item">
                  <a href="{{asset('content/website')}}/assets/images/gallery-lg-1.jpg" title="Gallery 1"><img src="{{asset('content/website')}}/assets/images/gallery-1.jpg" alt="gallery"></a>
               </div>
               <div class="gallery-grid-item">
                  <a href="{{asset('content/website')}}/assets/images/gallery-lg-2.jpg" title="Gallery 2"><img src="{{asset('content/website')}}/assets/images/gallery-2.jpg" alt="gallery"></a>
               </div>
               <div class="gallery-grid-item">
                  <a href="{{asset('content/website')}}/assets/images/gallery-lg-3.jpg" title="Gallery 3"><img src="{{asset('content/website')}}/assets/images/gallery-3.jpg" alt="gallery"></a>
               </div>
               <div class="gallery-grid-item">
                  <a href="{{asset('content/website')}}/assets/images/gallery-lg-4.jpg" title="Gallery 4"><img src="{{asset('content/website')}}/assets/images/gallery-4.jpg" alt="gallery"></a>
               </div>
               <div class="gallery-grid-item">
                  <a href="{{asset('content/website')}}/assets/images/gallery-lg-5.jpg" title="Gallery 5"><img src="{{asset('content/website')}}/assets/images/gallery-5.jpg" alt="gallery"></a>
               </div>
            </div>
            <div class="bg-shape">
               <div class="bg-shape-item">
                  <img src="{{asset('content/website')}}/assets/images/shape-1.png" alt="shape">
               </div>
               <div class="bg-shape-item">
                  <img src="{{asset('content/website')}}/assets/images/shape-3.png" alt="shape">
               </div>
               <div class="bg-shape-item">
                  <img src="{{asset('content/website')}}/assets/images/shape-2.png" alt="shape">
               </div>
            </div>
         </div>
      </section> -->
@endsection

@push('scripts')

@endpush