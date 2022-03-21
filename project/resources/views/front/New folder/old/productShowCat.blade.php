@extends('layouts.website')
@section('content')
    <section class="page-content section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                     <div class="card order-section">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-left">
                                    <section class="portfolio-area">
                                        <div class="container">
                                            <div class="row">
                                                   <div class="col-lg-12">
                                                <div class="p-section-title">
                                                    <h4>{{$getCategory->name}}</h4>
                                                </div>
                                            </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="portfolio-menu">
                                                        <ul>
                                                            @foreach($subCategory as $v_allcategory)
                                                                <li class="clicked" data-filter=".graphic{{$v_allcategory->id}}"><p style="font-size: 17px;margin: 0px">{{$v_allcategory->name}}</p></li>
                                                            @endforeach

                                                        </ul>
                                                    </div>
                                                </div>
                                           
                                            </div>

                                            <div class="row portfolio-list">
                                                     @foreach($subCategory as $v_allcategory)
                                                    @foreach($v_allcategory->products as $v_getProduct)
                                                        <div
                                                            class="col-lg-3 col-6 col-md-3 col-sm-6 mix single-portfolio-item web graphic{{$v_getProduct->sub_category_id}}">
                                                           <single-product-component
                                        :id="{{ $v_getProduct->id  }}"
                                        image="{{asset('storage/upload/product')}}/{{$v_getProduct->image}}"
                                        name="{{ $v_getProduct->name  }}"
                                        :offer_price="{{ $v_getProduct->offer_price  }}"
                                        description="{{ $v_getProduct->des  }}"
                                    ></single-product-component>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                               
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <hr>


                        </div>
                    </div>
                 </div>
                @include('include.cart')
        </div>
    </section>
@endsection
