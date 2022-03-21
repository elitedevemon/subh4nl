@extends('layouts.website')
@push('css')
<link rel="stylesheet" href="{{asset('content/website')}}/assets/css/main.css" type="text/css" media="all" />
<style>
    .cateIMage img {
    width: 100%;
    height: 100%;
    border-radius: 16px;
    /*background: #5d2122;*/
    transition: .5s;
    box-shadow: 0 38px 60px rgb(0 0 0 / 95%);
}



.cateIMage {
  position: relative;
  width: 90%;
  max-width: 400px;
  margin: auto;
}

.cateIMage .content-overlay {
  background: rgba(0,0,0,0.7);
  position: absolute;
  height: 99%;
  width: 100%;
  left: 0;
  top: 0;
  bottom: 0;
  right: 0;
  opacity: 0;
  -webkit-transition: all 0.4s ease-in-out 0s;
  -moz-transition: all 0.4s ease-in-out 0s;
  transition: all 0.4s ease-in-out 0s;
}
.cateIMage:hover .content-overlay{
  opacity: .5;
    cursor: pointer;
}





</style>
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
                    <h1>Our Menu</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Our Menu</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="menu-section bg-black p-tb-100">
        <div class="container position-relative">
            <div class="section-title">
                <small style="font-size: 55px">Le Carte</small>
                <!-- <h2 class="color-white">Just Choose From The Best</h2> -->
            </div>
            <div class="row">
                @foreach($category as $cat)
                <div class="col-md-3 col-6" style="margin-bottom: 10px">
                    <div class="items">
                        <a href="{{route('sub.cat', $cat->slug)}}">
                        <div class="cateIMage">
                        <div class="content-overlay"></div>
                            <img src="{{asset('storage/upload/category')}}/{{$cat->image}}" alt="">
                            <!-- <img src="https://dummyimage.com/250/250/332f2e/0011ff.png" alt=""> -->
                        </div>

                    </a>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </section>
@endsection

@push('js')

@endpush