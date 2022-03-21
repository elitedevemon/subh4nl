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
                  <div class="card-header bg-dark" style="color: #fff;font-weight: 700">
                    <i class="fa fa-table"></i>Day Report Information
                  </div>
                  <div class="card-body">
                     <form action="{{url('/admin/report-for-day')}}" method="get">
                      @csrf
                        <div class="form-group">
                         <label for="">Starting Date</label>
                     <input type="date" class="form-control" name="to" placeholder="Enter Your Date">
                       </div>
                       <div class="form-group">
                         <label for="">Ending Date</label>
                     <input type="date" class="form-control" name="from" placeholder="Enter Your Date">
                       </div>
                       <div class="form-group">
                         <button type="submit" class="btn btn-secondary">Search</button>
                       </div>
                     </form>
                  </div>
                </div>
              </div>   

             <!--    <div class="col-md-6">
                 <div class="card">
                  <div class="card-header bg-info" style="color: #fff;font-weight: 700">
                    <i class="fa fa-table"></i>Month Report Information
                  </div>
                  <div class="card-body">
                      <form action="{{url('/admin/report-for-month')}}" method="get">
                        @csrf
     
                        <div class="form-group">
                          <label for="">Month</label>
                         <select name="month" id="" class="form-control">
                         <option value="01">January</option>   
                         <option value="02">February</option>   
                         <option value="03">March</option>   
                         <option value="04">April</option>   
                         <option value="05">May</option>   
                         <option value="06">June</option>   
                         <option value="07">July</option>   
                         <option value="08">August</option>   
                         <option value="09">September</option>   
                         <option value="10">October</option>   
                         <option value="11">November</option>   
                         <option value="12">December</option>   
                         </select>
                       </div>
                       <div class="form-group">
                         <button type="submit" class="btn btn-secondary">Search</button>
                       </div>
                     </form>
                  </div>
                </div>
              </div> -->
  <!--             <div class="col-md-4">
                 <div class="card">
                  <div class="card-header bg-info" style="color: #fff;font-weight: 700">
                    <i class="fa fa-table"></i>Year Report Information
                  </div>
                  <div class="card-body">
                      <form action="{{url('/admin/report-for-year')}}" method="get">
                        @csrf
                       <div class="form-group">
                         <label for="">Payment Methods</label>
                         <select name="payment_method" id="" class="form-control">
                           <option value="cash_on_delivery">Cash On Delivery</option>
                           <option value="ticket_restaurant">Ticket Restrurant</option>
                           <option value="payment_with_cb">CB</option>
                           <option value="stripe">Stripe</option>
                           <option value="paypal">Paypal</option>
                         </select>
                       </div> 
                        <div class="form-group">
                          <label for="">Year</label>
                         <select name="year" id="" class="form-control">
                           <option value="2021">2021</option>   
                         <option value="2022">2022</option>   
                         <option value="2023">2023</option>   
                         <option value="2024">2024</option>  
                         </select>
                       </div>
                       <div class="form-group">
                         <button type="submit" class="btn btn-secondary">Search</button>
                       </div>
                     </form>
                  </div>
                </div>
              </div> -->
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