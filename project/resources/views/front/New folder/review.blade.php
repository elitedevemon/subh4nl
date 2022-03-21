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
               </div>
               <div class="header-page-shape-item">
                  <img src="{{asset('content/website')}}/assets/images/header-shape-1.png" alt="shape">
               </div>
               <div class="header-page-shape-item">
               </div>
            </div>
            <div class="container">
               <div class="header-page-content">
                  <h1>Shop</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reviews</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
      <section class="shop-section pt-100 pb-70 bg-black">
         <div class="container">
            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-12 pb-30">
                  <div class="product-list-header">
                     <div class="product-list-header-item">
                        <div class="product-list-result">
                           <p>Showing 1-6 Of 35 Results</p>
                        </div>
                     </div>
                  </div>
                  <div class="product-content">
                     <div class="row">
                        @foreach($getRe as $r)
                        <div class="col-sm-12 col-md-6 col-lg-6 pb-30">
                             <div class="item">
                              <div class="testimonial-carousel-item bg-main">
                                 <p class="carousel-para">{{$r->review}}</p>
                                 <div class="carousel-info-grid">
                                    <div class="carousel-thumb">
                                       <img src="{{asset('content/website')}}/assets/images/cu.png" alt="client">
                                    </div>
                                    <div class="carousel-info text-end">
                                       <div class="review-star">
                                          <ul class="justify-content-end">
                                          @for( $i = 0; $i < $r->star; $i++)
                                             <li class="full-star"><i class="flaticon-star-1"></i></li>
                                          @endfor
                                          </ul>
                                       </div>
                                       <h3 class="carousel-name">{{$r->user->name}}</h3>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        @endforeach
                     </div>
                  <!--    <div class="page-pagination">
                        <nav aria-label="pagination">
                           <ul class="pagination justify-content-center">
                              <li class="page-item disabled">
                                 <span class="page-link"><i class="flaticon-left-arrow-1"></i></span>
                              </li>
                              <li class="page-item active">
                                 <span class="page-link">
                                 1
                                 <span class="sr-only">(current)</span>
                                 </span>
                              </li>
                              <li class="page-item"><a class="page-link" href="#">2</a></li>
                              <li class="page-item"><a class="page-link" href="#">3</a></li>
                              <li class="page-item">
                                 <a class="page-link" href="#"><i class="flaticon-next"></i></a>
                              </li>
                           </ul>
                        </nav>
                     </div> -->
                  </div>
               </div>
            </div>
         </div>
      </section>
@endsection

@push('scripts')

@endpush