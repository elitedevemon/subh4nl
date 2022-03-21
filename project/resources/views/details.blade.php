@extends('layouts.website')
@section('content')

<section class="page-content section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="p-section-title text-center">
                    <h4>Profile Information</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 order-section">
                <div class="backbtn" style="margin-left: 20px">
                  <a href="{{url('/home')}}" class="btn btn-primary">Back</a>
                </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="card-body" style="padding: 20px">
              <div class="row">
              <div class="col-md-6" style="margin-bottom: 20px">
                <div class="card">
                  <div class="card-header bg-dark" style="color: #fff;font-weight: 700">
                    <i class="fa fa-table"></i>Customer Information
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                                            <table class="table table-borderless table-hover table-sm" >
                                                <tbody>
                             
                                                <tr>
                                                    <th width="45%">{{ __('Total Cost') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%"> €{{$getOrder->pay_amount}}</td>
                                                </tr>
                                                <tr>
                                                    <th width="45%">{{ __('Payment Method') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$getOrder->payment_method}}</td>
                                                </tr>
                                      
                                              
                                                <tr>
                                                    <th width="45%">{{ __('Transaction ID') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$getOrder->txnid}}</td>
                                                </tr>                         
                                                

                                                  <tr>
                                                    <th width="45%">{{ __('Payment Status') }}</th>
                                                    <th width="10%">:</th>
                                                    <td width="45%">
                                                      @if($getOrder->payment_status == 0)
                                                      <span class='badge badge-danger'>Unpaid</span>
                                                      @else
                                                      <span class='badge badge-success'>Paid</span>
                                                      @endif
                                                    </td>
                                                    </tr> 
                                                 
                                            
                                           

                                                </tbody>
                                            </table>
                                        </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6" style="margin-bottom: 20px">
                <div class="row">
             
                    <div class="col-md-12">
                    <div class="card">
                  <div class="card-header bg-dark" style="color: #fff;font-weight: 700">
                    <i class="fa fa-table"></i>Order Pick or Delivery Information
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                                            <table class="table table-borderless table-hover table-sm" >
                                                <tbody>
                                                <tr>
                                                    <th class="45%" width="45%">{{ __('Order Type') }}</th>
                                                    <td width="10%">:</td>
                                                    <td class="45%" width="45%"><span class="badge badge-pill badge-danger">{{$getOrder->order_method}}</span></td>
                                                </tr>
                                                <tr>
                                                    <th width="45%">{{ __('Order Pick/Delivery Time') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$getOrder->time}}</td>
                                                </tr>
                                                <tr>
                                                    <th width="45%">{{ __('Order Date') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$getOrder->date}}</td>
                                                    
                                                </tr>
                                                    <tr>
                                                    <th width="45%">{{ __('Delivery Status') }}</th>
                                                    <th width="10%">:</th>
                                                    <td width="45%">
                                                    @if($getOrder->deliveryStatus == 1)
                                                    <span class="badge badge-pill badge-dark">Delivery Order</span>
                                                    @elseif($getOrder->deliveryStatus == 2)
                                                    <span class="badge badge-pill badge-danger">Cancelled Order</span>
                                                    @else
                                                    <span class="badge badge-pill badge-info">On The Way</span>
                                                    @endif
                                                    </td>
                                                    </tr>
                                              
                
                                             
                                              
                                                </tbody>
                                            </table>
                                        </div>
                  </div>
                </div>
                  </div>
                </div>  
              </div>
              <div class="col-md-12">
                 <div class="card">
                  <div class="card-header bg-dark" style="color: #fff;font-weight: 700">
                    <i class="fa fa-table"></i>Orders Products Information
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                                            <table class="table  table-hover" >
                                              <thead>
                                                <th>No.</th>
                                                <th>Product Name</th>
                                                <th>Product Qty</th>
                                                <th>Product Details</th>
                                              </thead>
                                                <tbody>
                                                      @foreach($getOrderProduct as $key=> $v_g)
                                                 
                                                 <tr>
                                                  <td>{{$key+1}}</td>
                                                   <td>
                                                     
                                                     @if($v_g->product == null)
                                                      {{$v_g->setmenu['name']}}
                                                      <span class="badge badge-pill badge-primary">set_menu</span>                                                     @elseif($v_g->setmenu == null)
                                                      {{$v_g->product['name']}}
                                                     @endif

                                                   </td>
                                                   <td>
                                                  {{$v_g->qty}}
                                                   </td>
                                                    <td>
                                                     
                                                     <?php 
                                                      $getdata = $v_g->details;
                                                    $pieces = explode(" ", $getdata);
                                                      ?>
                                                    
                                                       @foreach($pieces as $key => $getID)
                                                       <?php 
                                              $getSetmenu = \App\Models\SetmenuProduct::find($getID);  
                                                // $getSetmenu = ['sdf','sdf','sdf']; 
                                                        ?>

@isset($getSetmenu['name'])
{{$getSetmenu['name']}} <br>
@endisset

                                                     
                                                       @endforeach

                                                   </td>
                                                
                                                 </tr>
                                          


        <!-- Modal check status-->
<div class="modal fade" id="checkStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('admin/OrderpaymentStatus')}}" method="POST">
        @csrf
        <div class="modal-body">
      <div class="form-group">
        <label for="">Reservation Status</label>
        <select name="status" class="form-control" id="">
          <option value="0">Unpaid</option>
          <option value="1">Paid</option>
        </select>
      </div>
      <input type="hidden" name="reserID" id="reserID" value="{{$getOrder->id}}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
















                                                  @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
              </div>
            </div>

    
        </div>
    </div>
</section>



@endsection