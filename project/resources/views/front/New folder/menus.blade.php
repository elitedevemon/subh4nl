@extends('layouts.website')
@push('css')
<link rel="stylesheet" href="{{asset('content/website')}}/assets/css/main.css" type="text/css" media="all" />
<style>
@media only screen and (max-width:767px) {
    .menu-main-thumb-item.menu-main-thumb-black img {
        width: 80px;
        height: 80px;
    }
    .menu-main-thumb-nav .slick-arrow {
        top: 37%;
    }
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
                <small  style="font-size: 55px">{{$category->name}}</small>
                <br>
                <div class="promoImage">
                    <img src="{{asset('storage/upload/category')}}/{{$category->promo_image}}" alt="">
                </div>
            </div>
            <div class="row">
                <!-- <p style="color: #fff">{{$onlyCat}}/{{$onlyMenu}}/{{$subCount}}</p> -->


<!--<p style="color: #fff">{{$onlyCat}}/{{$onlyMenu}}/{{$subCount}}</p>-->
            
            @if($onlyMenu > $onlyCat )
                    @livewire('menu', ['catId' => $category->id])

                    @if($onlyCat > 0)
                    <!--<p style="color: #fff">1</p>-->
                       @livewire('cat-product', ['catPro' => $category->products])
                    @endif
            @endif
            @if($onlyCat >= $onlyMenu)
                @if($subCount > 0)
               <!--<p style="color: #fff">2</p>-->
                    @livewire('menu', ['catId' => $category->id])
                @endif
                <!--<p style="color: #fff">3</p>-->
                    @livewire('cat-product', ['catPro' => $category->products])
            @endif

            </div>
        </div>
    </section>
@endsection

@push('js')

@endpush