<div>

<div wire:ignore.self class="modal fade" id="productDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background: #35393e;
    color: #fff;">
      <div class="modal-body">
        @isset($getData->des)
        <ul>
          <li style="list-style-type: disc;margin-left: 19px;">{{$getData->des}}</li>
        </ul>
        @endisset
      </div>
      <div class="modal-footer" style="padding:0!important; border:0!important">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No Merci</button>
      </div>
    </div>
  </div>
</div>



</div>
