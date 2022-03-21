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
              <i class="fa fa-table"></i> All Shipping Cost Information

         <!--    <div class="cutomBtn" style="margin-left: 10px">
               <button class="btn btn-info checkStatus" data-toggle="modal" data-target="#checkStatus">
                            add</i>
                </button>
            </div> -->
            </div>
            <div class="card-body">
              <form action="{{route('edit.shipping')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$shipping->id}}">
                  <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" name="km" class="form-control" value="{{$shipping->km}}">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="">Postal Code</label>
                      <input type="text" name="code" class="form-control" value="{{$shipping->code}}">
                    </div>
                  </div> 
                  <div class="col-6">
                    <div class="form-group">
                      <label for="">Cost</label>
                      <input type="text" name="cost" class="form-control" value="{{$shipping->cost}}">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <button class="btn-secondary btn btn-sm" type="submit">Save</button>
                    </div>
                  </div>

                </div>
              </form>
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
