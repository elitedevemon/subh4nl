@extends('layouts.rider')
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
                <div class="col-md-4">
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
                                                      <td width="45%">
                                                        <a href="tel:{{$getOrder->customer_phone}}">
                                                        <span style="cursor: pointer;" class="badge badge-pill badge-dark" >Phone Call</span>
                                                        </a>
                                                      </td>
                                                  </tr>

                                                  <tr>
                                                      <th width="45%">{{ __('Customer Addresss') }}</th>
                                                      <td width="10%">:</td>
                                                      <td width="45%">{{$getOrder->customer_address}}</td>
                                                  </tr>
                                                  </tbody>
                                              </table>
                                          </div>
                    </div>
                  </div>
                  </div>
                    <div class="col-md-8">
                    <div class="card">
                <!--   <div class="card-header bg-info" style="color: #fff;font-weight: 700">
                    <i class="fa fa-table"></i>Order Pick or Delivery Information
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                                            <table class="table table-borderless table-hover table-sm" >
                                                <tbody>
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
                                                </tbody>
                                            </table>
                                        </div>
                  </div>
                </div> -->
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
                                                       {{$getID}} <br>
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
@endpush