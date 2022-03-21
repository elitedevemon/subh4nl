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
              <i class="fa fa-table"></i> All Rider Information
            <div class="addBtn" style="float:right">
            <a href="{{route('rider.create')}}" class="btn btn-primary">Add Rider</a>
            </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Rider Name</th>
                      <th>Email</th>
                      <th>Number</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
     @foreach($riders as $key => $rider)
     		<tr>
     			<td>{{$key+1}}</td>
     			<td>{{$rider->name}}</td>
     			<td>{{$rider->email}}</td>
     			<td>{{$rider->phone}}</td>
     			 <td>
                            <a href="{{route('rider.show', $rider->id)}}" class="btn btn-dark">
                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a> 
                      
                            <a href="" class="btn btn-danger">
                              <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                          </td>
     		</tr>
     @endforeach
                  </tbody>
                </table>
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