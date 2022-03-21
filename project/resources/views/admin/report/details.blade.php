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
              <i class="fa fa-table"></i> Order  Information <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
            </div>


          <div class="card-body" style="padding: 20px">
              <div class="row">


              <div class="col-md-12">
                 <div class="card">
                  <div class="card-header bg-dark" style="color: #fff;font-weight: 700">
                    <i class="fa fa-table"></i>Payment With  Report Information
                  </div>
                  <div class="card-body">
                     <table class="table table-sm table-hover">
                       <tr>
                         <td>No.</td>
                         <td>Name</td>
                         <td>Order Type</td>
                         <td>Order Number</td>
                         <td>Payment Method</td>
                         <td>Customer Phone</td>
                         <td>Order Amount</td>
                       </tr>

               <?php $totalcost1 = 0 ?>
              @foreach($getdaySellsTotal as $key => $v)
                       <tr>
                         <td>{{$key+1}}</td>
                         <td>{{$v->customer_name}}</td>
                         <td>{{$v->orderType}}</td>
                         <td>{{$v->order_number}}</td>
                         <td>{{$v->payment_method}}</td>
                         <td>{{$v->customer_phone}}</td>
                         <td>{{$v->pay_amount}}</td>
                       </tr>
                       <?php $totalcost1 += $v->pay_amount?>
              @endforeach
                      <tr>
                         <td colspan="6"><b>Total:</b></td>
                         <td><b>{{$totalcost1}}</b></td>
                       </tr>

                     </table>
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