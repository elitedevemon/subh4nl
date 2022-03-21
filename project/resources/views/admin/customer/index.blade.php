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
              <i class="fa fa-table"></i> All Customer Information
              <div class="addBtn" style="float:right">
            <a href="{{url('/csv')}}" class="btn btn-dark btn-sm">CSV</a>
            </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Customer Name</th>
                      <th>Phone Number</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                @foreach($customer as $key => $cus)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$cus->name}}</td>
                <td>{{$cus->phone_number}}</td>
                <td>{{$cus->email}}</td>
                     <td>

                            <button class="btn btn-info checkStatus" data-id="{{$cus->id}}" data-toggle="modal" data-target="#checkStatus">
                            <i class="fa fa-envelope" aria-hidden="true"></i>

                          </button>
                   </td>
                   </tr>

<div class="modal fade" id="checkStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send A Mail To Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('sendMail')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
      <div class="form-group">
        <label for="">Email Body</label>
        <textarea class="form-control" name="body"></textarea>
      </div>
      <input type="hidden" name="reserID" id="reserID" value="">
            <div class="form-group">
        <label for="">File</label>
        <input type="file" name="img" class="form-control">
      </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send Mail</button>
      </div>
      </form>
    </div>
  </div>
</div>








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
  <script type="text/javascript">
          $(document).ready(function(){

   
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
             $('body').on('click', '.checkStatus', function () {
        var id = $(this).data("id");

        $('#reserID').val(id);

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
                url: "{{url('admin/category')}}"+'/'+id,
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