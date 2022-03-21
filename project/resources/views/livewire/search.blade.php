<div>
 <div class="header-bg header-bg-page">
         <div class="header-padding position-relative">
            <div class="header-page-shape">
               <div class="header-page-shape-item">
                  <img {{asset('content/website')}}/src="assets/images/header-shape-1.png" alt="shape">
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
                  <h1>Search Products</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Search Products</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
      <section class="shop-section pt-100 pb-70 bg-black">
         <div class="container">
            <div class="row">
               <div class="col-sm-12 col-md-9 col-lg-9 pb-30">
                  <div class="product-list-header">
                     <div class="product-list-header-item">
                        <div class="product-list-result">
                           <p>Showing 1-6 Of 35 Results</p>
                        </div>
                     </div>
                  </div>

                     <div class="product-content">
                     <div class="row">
                        @foreach($categoryProduct as $key => $cp)

                        <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                           <div class="product-card product-card-dark">
                              <div class="product-card-thumb">
                                 <div class="product-card-thumb-inner">
                                    <img src="{{asset('storage/upload/product')}}/{{$cp->image}}" alt="product">
                                    @if($cp->product_option == null)
                                    <div class="product-card-button">
                                       <a wire:click="$emit('addToCart', {{$cp->id}})" class="btn btn-yellow">Ajouter</a>
                                    </div>
                                    @else
                                    <div class="product-card-button">
                                       <a wire:click="$emit('getModelDataOp', {{$cp->id}})" class="btn btn-yellow clicked">Ajouter</a>
                                    </div>
                                    @endif
                                 </div>
                              </div>
                              <div class="product-card-content">
                                 <h3><a href="shop-details.html">{{$cp->name}}</a></h3>
                                 @if ($cp->is_promo == 1)
                                 <h4 class="product-price">€ {{$cp->offer_price}}</h4>
                                 @else
                                 <h4 class="product-price">€ {{$cp->regular_price}}</h4>
                                 @endif

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
                  @livewire('product-option')
                  @livewire('add-to-cart')
               </div>
               <div class="col-sm-12 col-md-3 col-lg-3 pb-30">

                  <div class="sidebar-item">
                     <div class="sidebar-title">
                        <h3 class="color-white">Categories</h3>
                     </div>
                     <ul class="sidebar-list">
                        @foreach($category as $cc)
                        <li>
                           <a href="{{route('cus.pro', $cc->slug)}}">{{$cc->name}} <span>({{$cc->products_count}})</span></a>
                        </li>
                        @endforeach
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>
</div>
