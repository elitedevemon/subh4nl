@extends('layouts.website')
@push('css')
<style>
    .customUl li a {
    background: #a21e21;
    color: #fff;
    font-weight: 800;
    padding: 4px 20px;
    border-radius: 3px;
    transition: .5s;
}

.customUl li {
    margin-left: 10px;
    border: 0;
}

ul#myTab {
    border: 0;
}

.customUl li a:hover {
    background: #a54346;
    border: 0px;
}

ul#myTab {}

button.cutomNex {
    padding: 4px 20px;
    border: 0px;
    background: #a21e21;
    color: #fff;
    font-weight: 800;
    border-radius: 4px;
}
h4.setTitle {
    font-weight: 700;
    font-style: italic;
    margin-bottom: 17px;
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
                                <div class="col-12">
                                  <div class="row">
                                    <div class="col-6"><h4 class="setTitle">{{$setMenu->name}}</h4></div>
                                    <div class="col-6 text-right"><h4 class="setTitle">€{{$setMenu->price}}</h4></div>
                                  </div>
                                    <section class="portfolio-area">
                                        <div class="container">
                                            <div class="row" id="mainData">
                                                <div class="col-lg-12">
                                                             

                   <!-- Nav tabs -->
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-12 text-center">
        <ul class="nav nav-tabs customUl" id="myTab" role="tablist">
@foreach($allcategory as $v_cate)
  <li class="nav-item">
    <a class="nav-link {{ $v_cate->id == 1 ? 'active' : '' }}" id="home-tab" data-toggle="tab" href="#home{{ $v_cate->id }}" role="tab" aria-controls="home" aria-selected="true">{{$v_cate->name}}</a>
  </li>
   @endforeach
   <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home100" role="tab" aria-controls="home" aria-selected="true">Summery</a>
  </li>
</ul>
    </div>
</div>
<div class="row" style="margin-bottom: 10px">
    <div class="col-6"><button id="back-btn" class="cutomNex">back</button></div>
    <div class="col-6 text-right"><button id="next-btn" class="cutomNex">FOllowing</button></div>
</div>
<!-- Tab panes -->
<div class="tab-content">
     @foreach($allcategory as $v_allcategory)
  <div class="tab-pane {{ $v_allcategory->id == 1 ? 'active' : '' }}" id="home{{ $v_allcategory->id }}" role="tabpanel" aria-labelledby="home-tab">
    <div class="row">
 @foreach($v_allcategory->subproduct as $v)
<div
                                                            class="col-lg-3 col-6 col-md-3 col-sm-6 mix single-portfolio-item">
                                                            <setmenu-product-component
                                                                :product-id="{{ $v->id  }}"
                                                                :menu-data="{{ $setMenu }}"
                                                                product-name="{{ $v->name  }}"
                                                                :category-id="{{  $v_allcategory->id  }}"
                                                                category-name="{{  $v_allcategory->name  }}"
                                                                product-image="{{asset('storage/upload/setmenu')}}/{{$v->image}}"
                                                                menu-image="{{asset('storage/upload/setmenu')}}/{{$setMenu->image}}"
                                                            ></setmenu-product-component>
                                                        </div>

  @endforeach


  </div>
  </div>
  
  @endforeach
   <div class="tab-pane" id="home100" role="tabpanel" aria-labelledby="home-tab">
          <div class="row">
                 <div class="col-lg-12 mix single-portfolio-item web Summary">
                                                    <setmenu-summary-component
                                                        :menu-data="{{ $setMenu }}"
                                                    ></setmenu-summary-component>
                                                </div>
          </div>
          </div>
  
</div>
                                                </div>
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
        </div>
    </section>
@endsection

@push('scripts')
    <script>

            const state = {
                counter: 1
            }

            $(`#myTab li:nth-child(${state.counter}) a`).tab('show') 

             $('.add-to-cart').on('click',function(e){
              e.preventDefault();

              state.counter = state.counter + 1;
              
              if(state.counter > $(`#myTab > li`).length) {
                state.counter = 1;
              }
              // console.log(state.counter);

              $(`#myTab li:nth-child(${state.counter}) a`).tab('show') 

            });
            
            $('#back-btn').on('click', function (e) {
              e.preventDefault();
              state.counter = state.counter - 1;
              
              if(state.counter < 1 ) {
                state.counter = $(`#myTab > li`).length;
              }

              $(`#myTab li:nth-child(${state.counter}) a`).tab('show') 
            })

            $('#next-btn').on('click', function (e) {
              e.preventDefault();
              state.counter = state.counter + 1;
              
              if(state.counter > $(`#myTab > li`).length) {
                state.counter = 1;
              }

              $(`#myTab li:nth-child(${state.counter}) a`).tab('show') 
            })


    </script>
@endpush

