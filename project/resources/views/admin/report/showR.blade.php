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
                    <i class="fa fa-table"></i>Payment With  Report Information
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                                            <table class="table table-borderless table-hover table-sm" >
                                                <tr>
                                                  <th>Payment Methods</th>
                                                  <th>Total</th>
                                                </tr>
                                                <tbody>
                              @foreach($getdaySellsTotal as $vv1)
                              <?php 

$ss = number_format($vv1->sum, 2, '.', '');
                               ?>
                                                <tr>
                                                    <th width="45%">{{$vv1->payment_method}}</th>
                                                    <td width="45%">€ {{ $ss }}
<a href="{{url('/admin/details/day')}}/{{$data['to']}}/{{$data['from']}}/{{$vv1->payment_method}}">({{$vv1->order_count}})</a>
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