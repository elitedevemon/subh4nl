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
           <div class="addBtn" style="float:right">
             <button class="btn btn-info addItems" data-toggle="modal" data-target="#addItems">
                            Add

             </button>
            </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Coupon Name</th>
                      <th>Coupon Type</th>
                      <th>Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                @foreach($coupon as $key => $v_coupon)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$v_coupon->name}}</td>
                <td> 
                  @if($v_coupon->type == 1)
                  <span class="badge badge-pill badge-info">Percenties</span>
                  @else
                  <span class="badge badge-pill badge-danger">Amount</span>
                  @endif
                 </td>
                <td>{{$v_coupon->content}}</td>
  
             
                     <td>
                      <button data-id="{{$v_coupon->id}}" class="itemDelete btn btn-danger">
                                              <i class="fa fa-trash"></i>
                                            </button>
                     </td>

                   </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
           <!-- Button trigger modal -->


<!-- Modal Add items-->
<div class="modal fade" id="addItems" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Coupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('admin/couponStatus')}}" method="POST">
        @csrf
        <div class="modal-body">
      <div class="form-group">
        <label for="">Coupon Name</label>
      <input type="text" name="name" class="form-control" value="">
  
      </div>
      <div class="form-group">
        <label for="">Coupon Type</label>
        <select name="type" class="form-control" id="">
           <option value="1">Percentage</option>
          <option value="2">Amount</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">Coupon Content</label>
      <input type="text" name="content" class="form-control" value="">
  
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal check status-->
<div class="modal fade" id="checkStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reservation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('admin/catererStatus')}}" method="POST">
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

            $('.addItems').on('click', function(){
          $('#addItems').modal('show');

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

       $('body').on('click', '.checkStatus', function () {
        var id = $(this).data("id");

        $('#reserID').val(id);

       });
});
 

  </script>
   <script>
           ////////////deelete data
 $(document).on('click', '.itemDelete', function(){
 // $(".itemDelete").click(function(){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
swal({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
// console.log(willDelete);
  if (willDelete) {
         $.ajax(
            {
                url: "{{url('admin/couponDelete')}}"+'/'+id,
                type: 'DELETE',
                data: {
                    "id": id,
                    "_token": token,
                },
                
                     // dataType:'JSON',
                     // // contentType: false,
                     // // cache: false,
                     // // processData: false,
                     success: function (response) {
                          swal({
                            title: "Deleted!",
                            text: "You File Was Deleted Successfully",
                            icon: "success",
                            button: "Close!",
                          });
                          console.log(response);
               // $('#zero_config').load(location.href + ' #zero_config');
                location.reload();

                    },
                    error: function (response) {
                    console.log('form erro ',response);
                    var errors = response.responseText;
                    console.log('form erro ',errors);
                    
                    }
            });
         }
      });

 });
</script>
@endpush