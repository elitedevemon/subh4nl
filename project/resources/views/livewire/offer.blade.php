<div>
<!-- <button class="btn btn-secondary" wire:click="openOffer" >Open</button> -->
<!-- <button class="btn btn-secondary" data-toggle="modal" data-target="#offerDetails">Open</button> -->
<div wire:ignore.self class="modal fade" id="offerDetails" tabindex="-1" >
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
          <div class="col-12 text-center">
                <div class="proOptionTitle">
                    <h6>
                      Félicitations, vous avez de la nourriture gratuite pour une commande de € {{$offer_limit}}
                    </h6>
                </div>
                @error('singleV')
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                  </div>
                @enderror
        </div>
        @foreach($offerP as $key => $v)
          <div class="col-md-3 col-6 mb-2">
            <div class="pro_option text-center">
              <span class="top_side click3" wire:click="$emit('getOfferDetails', {{$v->id}})">i</span>
              <div class="img_pro">
                <img src="{{asset('storage/upload/product')}}/{{$v->image}}" class="
                img-fluid" alt=""> 
              </div>
                <span class="title_pro">{{$v->name}}</span>
              <div class="btn_pro text-center">
                 <input type="radio" id="check{{$v->id}}" wire:model="singleV" class="myCheckbox" value="{{$v->id}}" />

                <label for="check{{$v->id}}" class="customBtnPro1" style="margin:0px">Add</label>
                <!-- <button class="customBtnPro">Add</button> -->
              </div>
            </div>
          </div>
        @endforeach
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" wire:click="notTake" class="btn btn-secondary btn-sm" data-dismiss="modal">No Merci</button>
        <button wire:click="addToCart" type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Ajouter</button>
      </div>
    </div>
  </div>
</div>


@livewire('option-details')


</div>