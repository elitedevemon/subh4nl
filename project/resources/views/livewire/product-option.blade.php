

<div>

    <?php

         if (isset($newValue->product_option)) {
            foreach($newValue->product_option as $f){
              $getProAttrMs = $f;
            }
         }
    ?>
<div wire:ignore.self class="modal fade" id="modelData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content customModal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add-on Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        @isset($newValue->product_option)
            @foreach($newValue->product_option as $pv)
              <?php
               $getOptionName = \App\Models\ProTitle::where('id', $pv)
                                ->where('is_type', 'multiple_selection')
                                ->get();
                ?>

            @foreach($getOptionName as $fc)
            @if(count($fc->productOption) == 0)
            @else
        <div class="col-12 text-center">
                <div class="proOptionTitle">
                    <h6>{{$fc->name}}</h6>
                </div>
        </div>
        @isset($fc->productOption)
            @foreach($fc->productOption as $v)
          <div class="col-md-3 col-6 mb-2">
            <div class="pro_option text-center">

              <div class="img_pro">
                <img src="{{asset('storage/upload/product')}}/{{$v->image}}" class="
                img-fluid" alt=""> 
              </div>
                <div class="wrap">
                <p class="title_pro">
                  {{$v->name}}
                  <span class="tool" data-tip="{{$v->des}}" tabindex="1">i</span>
                </p>

               </div>
              <div class="btn_pro text-center">
                 <input type="checkbox" id="check{{$v->id}}" wire:model="mulpleS"  name="radAnswer" value="{{$v->name}}">
                <label for="check{{$v->id}}" class="customBtnPro1" style="margin:0px">Select</label>
                <!-- <button class="customBtnPro">Add</button> -->
              </div>
            </div>
          </div>
           @endforeach
        @endisset
        @endif
    @endforeach
    @endforeach
    @endisset
    <!-- ENd 1 -->
        </div>
        <!-- start -2 -->

        <div class="row">
        @isset($newValue->product_option)
          @foreach($newValue->product_option as $pvv)
            <?php
            $getOptionName = \App\Models\ProTitle::where('id', $pvv)
                            ->where('is_type', 'single_selection')
                            ->get();
            ?>

          @foreach($getOptionName as $fc)
           @if(count($fc->productOption) == 0)
            @else
        <div class="col-12 text-center">
                <div class="proOptionTitle">
                    <h6>{{$fc->name}}</h6>
                </div>
        </div>
        @isset($fc->productOption)
         @foreach($fc->productOption as $v)
          <div class="col-md-3 col-6 mb-2">
            <div class="pro_option text-center">
              <div class="img_pro">
                <img src="{{asset('storage/upload/product')}}/{{$v->image}}" class="
                img-fluid" alt=""> 
              </div>
                <div class="wrap">
                <p class="title_pro">
                  {{$v->name}}
                  <span class="tool" data-tip="{{$v->des}}" tabindex="1">i</span>
                </p>

               </div>
              <div class="btn_pro text-center">
                 <input type="radio" id="check{{$v->id}}" wire:model="singleV.{{$fc->id}}"  name="radAnswer.{{$v->id}}" value="{{$v->name}}" required="" >

                <label for="check{{$v->id}}" class="customBtnPro1" style="margin:0px">
                 Add
                </label>
                <!-- <button class="customBtnPro">Add</button> -->
              </div>
            </div>
          </div>
           @endforeach
        @endisset
        @endif
    @endforeach
    @endforeach
    @endisset
        </div>
        <!-- End -2 -->


        <!-- start -3 -->

 <div class="row">
          @isset($newValue->product_option)
            @foreach($newValue->product_option as $pv)
              <?php
               $getOptionName = \App\Models\ProTitle::where('id', $pv)
                                ->where('is_type', 'paid_multiple_selection')
                                ->get();
               ?>
            
                                @foreach($getOptionName as $fc)
                                @if(count($fc->productOption) == 0)
                                @else
        <div class="col-12 text-center">
                <div class="proOptionTitle">
                    <h6>{{$fc->name}}</h6>
                </div>
        </div>
        @isset($fc->productOption)
         @foreach($fc->productOption as $v)
          <div class="col-md-3 col-6 mb-2">
            <div class="pro_option text-center">
              <!-- <span class="top_side optionDetailsClick" >i</span> -->


              <div class="img_pro"> 
                <!-- 140x140 -->
                <img src="{{asset('storage/upload/product')}}/{{$v->image}}" class="
                img-fluid" alt=""> 
              </div>
               <div class="wrap">
                <p class="title_pro">
                  {{$v->name}}
                  <span class="tool" data-tip="{{$v->des}}" tabindex="1">i</span>
                </p>

               </div>

           <!--    <div class="wrap">
                <span class="tool" data-tip="{{$v->des}}" tabindex="1">i</span>
              </div> -->
              <div class="btn_pro text-center">
                 <input type="checkbox" id="check{{$v->id}}" wire:model="mulplePaid.{{$v->id}}"
                                           class="myCheckboxPaid"
                                           value="{{$v->name}}" >

                <label for="check{{$v->id}}" class="customBtnPro1" style="margin:0px">
                 Select ({{$v->price}})
                </label>
                <!-- <button class="customBtnPro">Add</button> -->
              </div>
            </div>
          </div>
           @endforeach
        @endisset
        @endif
    @endforeach
    @endforeach
    @endisset
        </div>

        <!-- End -3 -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No Merci</button>
        <button wire:click="addToCartOption" type="button" class="btn btn-primary btn-sm">Ajouter</button>
      </div>
    </div>
  </div>
</div>

@livewire('option-details')


</div>
