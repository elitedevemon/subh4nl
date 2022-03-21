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
              <i class="fa fa-table"></i> All Reservation Information
          
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Full Name</th>
                      <th>Email Address</th>
                      <th>Phone Number</th>
                      <th>Number Of Guest</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                @foreach($reservation as $key => $v_reservation)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$v_reservation->name}}</td>
                <td>{{$v_reservation->email}}</td>
                <td>{{$v_reservation->number}}</td>
                <td>{{$v_reservation->numberOfGuest}}</td>
                <td> 
                  @if($v_reservation->status == 0)
                  <span class="badge badge-pill badge-info">Pendding</span>
                  @elseif($v_reservation->status == 1)
                  <span class="badge badge-pill badge-dark">Conform</span>
                  @else
                  <span class="badge badge-pill badge-danger">cancelled</span>
                  @endif
                 </td>
  <!--               <td>{{$v_reservation->date}}</td>
                <td>{{$v_reservation->time}}</td>
                <td>{{$v_reservation->msg}}</td> -->
             
                     <td>
                          <button class="btn btn-secondary details" data-id="{{$v_reservation->id}}" data-toggle="modal" data-target="#details">
                            <i class="fa fa-eye" aria-hidden="true"></i>

                          </button>
                          <button class="btn btn-info checkStatus" data-id="{{$v_reservation->id}}" data-toggle="modal" data-target="#checkStatus">
                            <i class="fa fa-check-square-o" aria-hidden="true"></i>

                          </button>
                     </td>

                   </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
           <!-- Button trigger modal -->


<!-- Modal check details-->
<div class="modal fade" id="details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reservation Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="row">
          <div class="form-group col-12">
          <label for="">Full Name</label>
          <input type="text" id="name" value="" class="form-control" disabled>
        </div>
        <div class="form-group col-12">
          <label for="">Email</label>
          <input type="text" id="email" value="" class="form-control" disabled>
        </div>
         <div class="form-group col-12">
          <label for="">Phone Number</label>
          <input type="text" id="phone" value="" class="form-control" disabled>
        </div>
         <div class="form-group col-12">
          <label for="">Number Of Guest</label>
          <input type="text" id="guest" value="" class="form-control" disabled>
        </div>
        <div class="form-group col-6">
          <label for="">Date</label>
          <input type="text" id="date" value="" class="form-control" disabled>
        </div>
        <div class="form-group col-6">
          <label for="">Time</label>
          <input type="text" id="time" value="" class="form-control" disabled>
        </div>
         <div class="form-group col-12">
          <label for="">Message</label>
          <textarea name="" id="des" class="form-control" cols="20" rows="5" disabled=""></textarea>
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
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('admin/reservationStatus')}}" method="POST">
        @csrf
        <div class="modal-body">
      <div class="form-group">
        <label for="">Reservation Status</label>
        <select name="status" class="form-control" id="">
          <option value="0">Pendding</option>
          <option value="1">Conform</option>
          <option value="2">cancelled</option>
        </select>
      </div>
      <input type="hidden" name="reserID" id="reserID" value="">
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

          <script>
 $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   $('body').on('click', '.details', function () {
    var id = $(this).data("id");
         $.get("/admin/reservationshow/"+id, function (data) {
         $('#name').val(data.name);
         $('#email').val(data.email);
         $('#phone').val(data.number);
         $('#guest').val(data.numberOfGuest);
         $('#date').val(data.date);
         $('#time').val(data.time);
         $('#des').val(data.msg);
         // $('#categoryName').val(data.category_name);
         console.log(data);
      });
      // alert(id);
   });

       $('body').on('click', '.checkStatus', function () {
        var id = $(this).data("id");

        $('#reserID').val(id);

       });
});
 

  </script>
@endpush