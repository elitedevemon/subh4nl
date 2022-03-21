@extends('layouts.admin')
@push('css')
<style>
.card-header i{
    margin-right: 5px;
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
            <li class="breadcrumb-item active">Tables</li>
          </ol>
            <!-- Example DataTables Card-->
               @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

              @if (count($errors) > 0)
                 <div class = "alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                 </div>
              @endif
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i> All Order Information
       
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Order Number.</th>
                      <th>Name</th>
                      <th>Number</th>
                      <th>Total</th>
                      <th>Order Type</th>
                      <th>Payment Methods</th>
                      <th>Order Status</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($order  as $key => $v_order)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$v_order->order_number}}</td>
                  <td>{{$v_order->customer_name}}</td>
                  <td>{{$v_order->customer_phone}}</td>
                  <td>{{$v_order->pay_amount}}</td>
                  <td>
                    <span class="badge badge-pill badge-danger">{{$v_order->orderType}}</span>
                  </td>
                  <td>
                    <span class="badge badge-pill badge-info">{{$v_order->payment_method}}</span>
                    
                  </td>
                   <td>
                    @if($v_order->pageView == 0)
                    <span class="badge badge-pill badge-danger">New Order</span>
                    @else
                    <span class="badge badge-pill badge-primary">Seen</span>

                    @endif
                  </td>

                  <td>
                      <a href="{{url('/admin/order-view')}}/{{$v_order->id}}" class="btn btn-dark">
                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a> 
                  </td>
                </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted"> <button id="play">wer</button>  Updated yesterday at 11:59 PM</div>
          </div>
          <!-- /tables-->
          </div>
          <!-- /container-fluid-->
           </div> Alert-2.mp3
        <!-- /container-wrapper-->
        <!-- <audio  loop="loop" src="https://soundbible.com/grab.php?id=2218&type=mp3"  id="my_audio"></audio> -->

        <audio  loop="loop" src="{{asset('content/Alert-2.mp3')}}"  id="my_audio"></audio>
@endsection
@push('js')
        <script src="{{asset('content/admin')}}/js/admin-datatables.js"></script>



<!--         <script>
   

          

                  $(document).ready(function() {

  
    
    
// function getdata 
    
    // $('#play').click(function() {
    //     audioElement.play();
    //     // $("#status").text("Status: Playing");
    // });
    
    //ai khane theke suru


            setTimeout(function() {
         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

             $.ajax({  //create an ajax request to display.php
              type: "GET",
              url: "/admin/getOrderTone",
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
                  }
              },
              error: function(e){
               console.log(e);
              }
            });


          }, 5000);
           });
        </script> -->
@endpush