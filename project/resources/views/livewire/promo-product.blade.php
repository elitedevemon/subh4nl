<div>
          <section class="menu-section menu-section-bg pt-100 pb-70 bg-black">
         <div class="container position-relative">
            <div class="section-title">
               <small>Menu</small>
               <h2 class="color-white">Just Choose From The Best</h2>
            </div>
            <?php
            $ne = \App\Models\SubCategory::where('is_promo', 1)->orderBy('id', 'DESC')->get();
             ?>
            <div class="menu-main-carousel-area">
               <div class="menu-main-thumb-nav">
                  @foreach($ne as $key => $nn)
                <div class="menu-main-thumb-item">
                     <div class="menu-main-thumb-inner">
                        <img src="{{asset('storage/upload/subcategory')}}/{{$nn->image}}" alt="menu">
                        <p>{{$nn->name}}</p>
                     </div>
                  </div>
                  @endforeach
               </div>
               <div class="menu-main-details-for">
                        @foreach($ne as $key1 => $nn)
                  <div class="menu-main-details-item">
                     <div class="menu-details-carousel">
                      <?php  $count = 0; 
                        foreach($nn->products as $key => $ni){
                      ?>

{{-- {{ $key ? 'newStyle' : '' }} --}}
{{-- {{ $loop->first > $key ? 'newStyle' : '' }}

  @if(0 > $key)
                            newStyle
                          @elseif($key > 0 && $loop->first > 1)
                          @endif

 --}}

<?php
  $c = $count++;
  $k = $key++;
  $l = $loop->first;

 ?>

                        <div class="{{ 0 > $key ? 'newStyle' : '' }} {{  $key == 1 && $loop->first < 1 ? 'newStyle' : '' }} menu-details-carousel-item menu-details-carousel-black getACustom">

                           <h3>{{$ni->name}}</h3>
                           <p>{{$ni->des}}</p>
                           @if($ni->is_promo == 1)
                           <h4 class="menu-price">€{{$ni->offer_price}}</h4>
                           @else 
                           <h4 class="menu-price">€{{$ni->regular_price}}</h4>
                           @endif

                            @if($ni->product_option == null)
                            <a wire:click="$emit('addToCart', {{$ni->id}})" class="btn btn-yellow">
                           Commander <i class="flaticon-shopping-cart-black-shape"></i>
                           </a>
                            @else
                            <a wire:click="$emit('getModelDataOp', {{$ni->id}})" class="btn btn-yellow clicked">
                           Commander <i class="flaticon-shopping-cart-black-shape"></i>
                           </a>
                            @endif


                           <div class="menu-details-carousel-image">
                              <img src="{{asset('storage/upload/product')}}/{{$ni->image}}" alt="menu">
                           </div>
                        </div>
                        <?php 
                      }
                         ?>
                     </div>
                  </div>
                        @endforeach

               </div>
            </div>
         </div>
      </section>
      @livewire('product-option')
      @livewire('add-to-cart')
</div>
