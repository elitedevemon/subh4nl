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
          <div class="card mb-3">
        <div class="card-header">
              <i class="fa fa-table"></i> All Payment Information
          
            </div>
            <div class="card-body">
                @if(isset($setting))
    <form action="{{url('/admin/paymentSave')}}" method="post" enctype="multipart/form-data">
        @csrf
         <!--        <div class="form-group">
                  <label for="">STRIPE_SECRET</label>
                  <input type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">STRIPE_KEY</label>
                  <input type="text" class="form-control">
                </div>  

                  <div class="form-group">
                  <button class="btn btn-dark">Update</button>
                </div> -->
              <div class="row">
                  <div class="col-4 form-group">
                  <label for="">Paypal Active</label>
                  <select class="form-control" name="is_paypal">
                    <option value="0" {{ $setting->is_paypal == 0 ? 'selected' : '' }}>Deactivate</option>
                    <option value="1" {{ $setting->is_paypal == 1 ? 'selected' : '' }}>Active</option>
                  </select>
                </div> 
                <div class="col-4 form-group">
                  <label for="">Stripe Active</label>
                  <select class="form-control" name="is_stripe">
                  <option value="0" {{ $setting->is_stripe == 0 ? 'selected' : '' }}>Deactivate</option>
                    <option value="1" {{ $setting->is_stripe == 1 ? 'selected' : '' }}>Active</option>
                  </select>
                </div>  
                 <div class="col-4 form-group">
                  <label for="">Cash On Delivery Active</label>
                  <select class="form-control" name="is_cash">
                    <option value="0" {{ $setting->is_cash == 0 ? 'selected' : '' }}>Deactivate</option>
                    <option value="1" {{ $setting->is_cash == 1 ? 'selected' : '' }}>Active</option>
                  </select>
                </div>  
                 <div class="col-4 form-group">
                  <label for="">Ticket Active</label>
                  <select class="form-control" name="is_ticket">
                    <option value="0" {{ $setting->is_ticket == 0 ? 'selected' : '' }}>Deactivate</option>
                    <option value="1" {{ $setting->is_ticket == 1 ? 'selected' : '' }}>Active</option>
                  </select>
                </div> 
                 <div class="col-4 form-group">
                  <label for="">CB Active</label>
                  <select class="form-control" name="is_cb">
                   <option value="0" {{ $setting->is_cb == 0 ? 'selected' : '' }}>Deactivate</option>
                    <option value="1" {{ $setting->is_cb == 1 ? 'selected' : '' }}>Active</option>
                  </select>
                </div>  
              </div>
  <div class="form-group">
                  <button class="btn btn-dark">Update</button>
                </div>


              </form>
              @endif
            </div>
           <!-- Button trigger modal -->






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