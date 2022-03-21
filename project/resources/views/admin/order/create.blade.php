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
          <div class="card mb-3" ">
            <div class="card-header">
              <i class="fa fa-table"></i> Order  Information
            </div>


          <div class="card-body" style="padding: 20px">
              <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header bg-info" style="color: #fff;font-weight: 700">
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
                                                    <th width="45%">{{ __('Ordered Date') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$getOrder->date}}</td>
                                                </tr>
                                                <tr>
                                                    <th width="45%">{{ __('Ordered Time') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$getOrder->time}}</td>
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
                                                      @if($getOrder->payment_status == 1)
                                                      <span class='badge badge-danger'>Unpaid</span>
                                                      @elseif($getOrder->payment_status == 0)
                                                      <span class='badge badge-success'>Paid</span>
                                                      @endif
                                                      <span class='badge badge-dark checkStatus' style="margin-left: 10px">+ Update</span>
                                                    </td>
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
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                  <div class="card-header bg-info" style="color: #fff;font-weight: 700">
                    <i class="fa fa-table"></i>Customer Information
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                                            <table class="table table-borderless table-hover table-sm" >
                                                <tbody>
                                                <tr>
                                                    <th class="45%" width="45%">{{ __('Customer Name') }}</th>
                                                    <td width="10%">:</td>
                                                    <td class="45%" width="45%">{{$getOrder->customer_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th width="45%">{{ __('Customer Number') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$getOrder->customer_phone}}</td>
                                                </tr>
                                                <tr>
                                                    <th width="45%">{{ __('Customer Email') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">
              @isset($getOrder->user->email)
              {{$getOrder->user->email}}
              @endisset
                                                    </td>
                                                </tr>

                                                  <tr>
                                        <th width="45%">{{ __('Customer Address') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$getOrder->customer_address}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                  </div>
                </div>
                  </div>
                    <div class="col-md-12">
                    <div class="card">
                  <div class="card-header bg-info" style="color: #fff;font-weight: 700">
                    <i class="fa fa-table"></i>Order Pick or Delivery Information
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                                            <table class="table table-borderless table-hover table-sm" >
                                                <tbody>
                                                <tr>
                                                    <th class="45%" width="45%">{{ __('Order Type') }}</th>
                                                    <td width="10%">:</td>
                                                    <td class="45%" width="45%">
                                                      <h4>

                                                <span class="badge badge-pill badge-danger">{{$getOrder->orderType == 'order' ? 'Delivery' : 'Takeway'}}

                                                </span>
                                                      </h4>
                                                    </td>
                                                </tr>
                                                @if($getOrder->orderType == 'order')
                                                <tr>
                                                    <th class="45%" width="45%">{{ __('Sub Total') }}</th>
                                                    <td width="10%">:</td>
                                                    <td class="45%" width="45%">
                                                      <h4>
                                                      <span class="badge badge-pill badge-danger">
                                                        €{{$getOrder->pay_amount  }}
                                                    </span>
                                                      </h4>
                                                  </td>
                                                </tr>
                                                <tr>
                                                    <th class="45%" width="45%">{{ __('Shipping Cost') }}</th>
                                                    <td width="10%">:</td>
                                                    <td class="45%" width="45%">
                                                      <h4>
                                                        <span class="badge badge-pill badge-danger">€{{$getOrder->shipping_cost}}</span>
                                                      </h4>
                                                    </td>
                                                </tr>
                                             <tr>
                                                    <th class="45%" width="45%">{{ __('Total Cost') }}</th>
                                                    <td width="10%">:</td>
                                                    <td class="45%" width="45%">
                                                      <h4>
                                                        <span class="badge badge-pill badge-danger">€{{$getOrder->pay_amount + $getOrder->shipping_cost}}</span>
                                                      </h4>
                                                    </td>
                                                </tr>
                                                @elseif($getOrder->orderType == 'takeway')
                                                 <tr>
                                                    <th class="45%" width="45%">{{ __('Sub Total') }}</th>
                                                    <td width="10%">:</td>
                                                    <td class="45%" width="45%">
                                                      <h4>
                                                        <span class="badge badge-pill badge-danger">€{{$getOrder->pay_amount }}</span>
                                                      </h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="45%" width="45%">{{ __('Discount Cost') }}</th>
                                                    <td width="10%">:</td>
                                                    <td class="45%" width="45%">
                                                      <h4>
                                                        <span class="badge badge-pill badge-danger">€{{$getOrder->discount}}</span>
                                                      </h4>
                                                    </td>
                                                </tr>
                                               <tr>
                                                    <th class="45%" width="45%">{{ __('Total Cost') }}</th>
                                                    <td width="10%">:</td>
                                                    <td class="45%" width="45%">
                                                      <h4>
                                                        <span class="badge badge-pill badge-danger">€{{$getOrder->pay_amount - $getOrder->discount}}</span>
                                                      </h4>
                                                    </td>
                                                </tr>
                                                @endif
         

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
                  <div class="card-header bg-info" style="color: #fff;font-weight: 700">
                    <i class="fa fa-table"></i>Orders Products Information
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                                            <table class="table  table-hover" >
                                              <thead>
                                                <th>No.</th>
                                                <th>Product Name</th>
                                                <th>Product Qty</th>
                                                <th>Product Price</th>
                                                <th>Product Details</th>
                                              </thead>
                                                <tbody>
                                             @foreach($getOrder->orderlist as $key=> $v_g)

                                                 <tr>
                                                  <td>{{$key+1}}</td>
                                                   <td>
                                                {{$v_g->name}}

                                                   </td>
                                                   <td>
                                                  {{$v_g->quantity}}
                                                   </td>
                                                   <td>
                                                  @if($v_g->extraPrice == 0)
                                                  {{$v_g->price}}
                                                  @else
                                                  {{$v_g->price - $v_g->extraPrice}} + {{$v_g->extraPrice}}
                                                  @endif
                                                   </td>
                                                    <td>
                                                      @if($v_g->selectOption == null)
                                                   
                                                      @else
                                                    <?php 
                                                      $getdata = $v_g->selectOption;
                                                      ?>
                                                       @foreach($getdata as $key => $getID)

                                                         @if($getID == false)
                                                          @else
                                                          {{$getID}}</br>
                                                          @endif
                                                          
                                                       @endforeach
                                                      @endif
                                                      

                                                   </td>

                                                 </tr>
                                                  @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

           
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
        <label for="">Payment Status</label>
        <select name="status" class="form-control" id="">
          <option value="1">Unpaid</option>
          <option value="0">Paid</option>
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

            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
          <!-- /tables-->
          </div>
          <!-- /container-fluid-->
           </div>
        <!-- /container-wrapper-->






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
@endpush