@extends('layouts.rider')
@push('css')
<style>
.card-header i{
    margin-right: 5px;
}
.items {
    background: #f7f7f7;
    padding: 0px;
    font-size: 15px;
    box-shadow: -1px 1px 18px 10px rgb(47 47 47 / 8%);
    border-radius: 10px;
}
.items_header.text-center {
    padding: 1px;
    background: #4a4e69;
    font-weight: 700;
    font-style: italic;
    color: #fff;
}
.d-flex.d1 {
    background: #4579b9;
    font-weight: 700;
    font-style: italic;
    color: #fff;
}
.d-flex.d2 {
    background: #9a8c98;
    font-weight: 700;
    font-style: italic;
    color: #fff;
}
.d-flex.d3 {
    background: #22223b;
}
.d-flex.flex-column.bd-highlight {
    background: #c9ada7;
    font-size: 18px;
    font-weight: 700;
    color: #382424;
}

.p-2.bd-highlight ul li {
    margin-left: 12px;
}
.bdr{
   border-left: 1px solid#bbbbbb;
}
.p-2.flex-grow-1.bd-highlight span {
    font-size: 14px;
    color: #252525;
    font-weight: 500;
}
</style>
@endpush
@section('content')
  <!-- /Navigation-->

  <audio id="audioBox">
    <source src="{{asset('content/admin/audio/got-it-done-613.m4r')}}" type="m4r">
    <source src="{{asset('content/admin/audio/got-it-done-613.mp3')}}" type="mpeg">
    <source src="{{asset('content/admin/audio/got-it-done-613.ogg')}}" type="ogg">
  </audio>
  <div class="content-wrapper">
        <div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">New Orders</li>
          </ol>
            <div class="row">
              <div class="col-md-12">
                  <div class="row">
                      @foreach($order as $oo)
                    <div class="col-md-3" style="margin-bottom:20px">
               <div class="items">
                  <div class="items_header text-center">
                    {{($oo->orderType == 'order' ? 'En Livraison' : 'A emporter')}}
                  </div>
                  <div class="d-flex  text-center d1">
                     <div class="p-2 flex-grow-1 bd-highlight" style="width: 70%; font-size: 11px;font-weight: bold">{{$oo->payment_method == 'Carte_Bancaire_en_Iigne' ? 'Stripe' : $oo->payment_method }}</div>
                     <div class="p-2 flex-grow-1 bd-highlight bdr" style="width: 30%">{{$oo->order_number}}</div>
                  </div>
                  <div class="d-flex text-center d2">
                     <div class="p-2 flex-grow-1 bd-highlight" style="width: 100%">
                       <span>Name: {{$oo->customer_name}} </span> <br>
                       @if($oo->orderType == 'takeway')
                       <span>Phone Number:{{$oo->customer_phone}}</span> <br>
                       @else
                       <span>Street Number: {{$oo->customer_address}} </span> <br>
                       <span>Street Name: {{$oo->customer_city}} </span> <br>
                       <?php 
                       $sp = \App\Models\Shipping::where('code', $oo->customer_zip)->first();
                        ?>
                       <span>City And Postal Code: @isset($sp->km) {{$sp->km}} @endisset </span> <br>
                       <span>Phone Number:{{$oo->customer_phone}}</span> <br>
                       @endif


                       <span>Message:{{$oo->msg}}</span> <br>
                       <span style="font-size: 20px;font-weight: bold">Total:{{$oo->pay_amount + $oo->shipping_cost}}</span> <br>
                       <span><b>Date:{{$oo->date}}</b></span> <br>
                       <span><b>Time:{{$oo->time}}</b></span>
                     </div>
                  <!--    <div class="p-2 flex-grow-1 bd-highlight bdr" style="width: 50%">
                        <span class=" badge badge-dark">Processing...</span>
                     </div> -->
                  </div>
                  <div class="d-flex flex-column bd-highlight">
                    @foreach($oo->orderlist as $key => $oP)
                     <div class="p-2 bd-highlight">{{$oP->quantity}} X {{$oP->name}}
                        <ul>
                          @if($oP->is_show == null)

                          @else
                          @foreach($oP->selectOption as $opv)
                           <li>{{$opv}}</li>
                           @endforeach
                           @endif
                        </ul>
                     </div>
                     @endforeach
<?php 
  
  if (isset($sp->km)) {
   $roadName = $oo->customer_city;
  $roadNum = $oo->customer_address;
  // $cityName = $sp->km;
  $finalAddress = $roadNum.'-'.$roadName.'-'.$sp->km;
  $slug = \Str::slug($finalAddress, '-');
  }

  $zip = $oo->customer_zip;
  // $sp1 = \App\Models\Shipping::where('code', $zip)->first();
  // $roadName = $oo->customer_city;
  
 ?>
                  </div>
                  <div class="d-flex text-center d3 text-center">

                    @if($oo->riderView == 0)
                     <div class="p-2 flex-grow-1 bd-highlight">
                        <a href="{{url('/rider/order-view')}}/{{$oo->id}}" class="btn btn-dark btn-sm">Accept</a>
                     </div>
                     @endif
                     <div class="p-2 flex-grow-1 bd-highlight">
                        <a href="tel:{{$oo->customer_phone}}" class="btn btn-info btn-sm">Phone</a>
                     </div>
                     <div class="p-2 flex-grow-1 bd-highlight">
                        <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{$slug}}" class="btn btn-primary btn-sm">Map</a>
                     </div>
                     <div class="p-2 flex-grow-1 bd-highlight">
                       <a href="{{url('rider/deliveryStatus')}}/{{$oo->id}}" class="btn btn-info btn-sm"> Complate

                          </a>
                     </div>




                  </div>
               </div>
            </div>
                      @endforeach
                  </div>
              </div>
            </div>
          </div>
          <!-- /container-fluid-->
           </div>

        <!-- Modal check status-->
<div class="modal fade" id="checkStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Delivery</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('rider/deliveryStatus')}}" method="POST">
        @csrf
        <div class="modal-body">
      <div class="form-group">
        <label for="">Order Delivery Status</label>
        <select name="status" class="form-control" id="">
          <option value="0">On The Way</option>
          <option value="1">Delivery</option>
          <option value="2">cancelled</option>
        </select>
      </div>
      <input type="hidden" name="reserID" id="reserID" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
  <audio  loop="loop" src="{{asset('content/Alert-2.mp3')}}"  id="my_audio"></audio>
@endsection
@push('js')
            <script src="{{asset('content/admin')}}/js/admin-datatables.js"></script>
         <script type="text/javascript">
          $(document).ready(function(){

            $('.details').on('click', function(){
          $('#details').modal('show');

            });  
            $('.checkStatus').on('click', function(){
          $('#checkStatus').modal('show');

            });  

             $('.customModalHide').on('click', function(){
          $('#exampleModal').modal('hide');
          $("#addform")[0].reset();

            });


           });
        </script>

          <script>


       $('body').on('click', '.checkStatus', function () {
        var id = $(this).data("id");

        $('#reserID').val(id);

       });

  </script>

  <script>
     $(document).ready(function() {
            setTimeout(function() {
         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

             $.ajax({  //create an ajax request to display.php
              type: "GET",
              url: "/rider/getOrderToneRider",
              success: function (data) {
                // location.reload();
                  if(data.length == 0){
                    setTimeout(function() {
                      location.reload();
                    },10000);
                    console.log('kicu ney');
                  }else{
                     var myMusic =  document.getElementById("my_audio").play();
                     function play(){
                      myMusic.muted = true;
                      myMusic.play();
                      myMusic.muted = false;
                      MyMusic.play();
                      }
                      console.log('your audio is started just now');
                      setTimeout(function() {
                      location.reload();
                    },10000);
                  }
              },
              error: function(e){
               console.log(e);
              }
            });


          }, 5000);
           });
        </script>
@endpush