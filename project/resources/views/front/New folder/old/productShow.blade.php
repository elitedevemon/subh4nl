@extends('layouts.website')
@push('css')
<style>
    li.clicked a {
    text-decoration: none;
    color: #fff;
    padding: 0px 18px 0px 18px;
}
</style>
@endpush
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
                                            <div class="row" style="margin-bottom: 26px">
                                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                                <div class="p-section-title text-center">
                                                    <h4>{{$getCategory->name}}</h4>
                                                </div>
                                            </div>
                                                
                                            <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                                                 @if($getCategory->promo_image !== null)
                                                <div class="p-section-img">
                                                   <img src="{{asset('storage/upload/category')}}/{{$getCategory->promo_image}}">
                                                    
                                                </div>
                                                @else
                                           
                                                @endif
                                            </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="portfolio-menu">
                                                        <ul>
                                                            <li class="clicked" data-filter=".all"><p style="font-size: 17px;margin: 0px"><a href="{{ request()->fullUrl() }}">{{$getCategory->name}}</a></p></li>
                                                            @foreach($subCategory as $v_allcategory)
                                                                <li class="clicked" data-filter=".graphic{{$v_allcategory->id}}"><p style="font-size: 17px;margin: 0px">{{$v_allcategory->name}}</p></li>
                                                            @endforeach

                                                        </ul>
                                                    </div>
                                                </div>
                                           
                                            </div>

                                            <div class="row portfolio-list"> 
                                                    @foreach($subCategory as $v_getProduct)
                                                    @foreach($v_getProduct->products as $v_getProduct)
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

                                              
                                                    @foreach($getCategoryProduct as $v_getProduct)
                                                        <div
                                                            class="col-lg-3 col-6 col-md-3 col-sm-6 mix single-portfolio-item web all">
                                                           <single-product-component
                                        :id="{{ $v_getProduct->id  }}"
                                        image="{{asset('storage/upload/product')}}/{{$v_getProduct->image}}"
                                        name="{{ $v_getProduct->name  }}"
                                        :offer_price="{{ $v_getProduct->offer_price  }}"
                                        description="{{ $v_getProduct->des  }}"
                                    ></single-product-component>
                                                        </div>
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

@push('scripts')
<script>
     $('.add-to-cart').on('click',function(e){
              e.preventDefault();

swal("Produit ajouté avec succès!");
            });
</script>
@endpush
