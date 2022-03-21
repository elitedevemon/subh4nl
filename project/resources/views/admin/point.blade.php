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
              <i class="fa fa-table"></i> All Post Information
            <div class="addBtn" style="float:right">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#checkStatus">Add Point Vouchers</button>
            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#checkStatus1">Add Point</button>
            </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <div class="table-responsive">
                <table class="table table-bordered"  width="100%">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Point</th>
                      <th>Discount Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach($points as $key => $point)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$point->name}}</td>
                        <td>{{$point->am}}</td>
                  <td>
                    <button data-id="{{$point->id}}" class="itemDelete btn btn-danger btn-sm">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                     </tr>
                     @endforeach
                  </tbody>
                </table>
              </div>
                </div>
                <div class="col-6">
                  <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Point</th>
                      <th>Expense Amount</th>
                      <th>Expense Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach($pls as $key => $val1)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$val1->name}}</td>
                        <td>{{$val1->total}}</td>
                        <td>{{$val1->id}}</td>
                  <td>
                    <a href="{{url('admin/plsDelete')}}/{{$val1->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                 <!--    <form action="{{url('admin/plsDelete')}}/{{$val1->Id}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">
                      <i class="fa fa-trash"></i>
                    </button>
                    </form> -->
                  </td>
                     </tr>
                     @endforeach
                  </tbody>
                </table>
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

<div class="modal fade" id="checkStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product For Deals</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('admin/pointSave')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
      <div class="form-group">
        <label for="">Point</label>
        <input type="text" name="name" class="form-control" placeholder="Point">
      </div>
      <div class="form-group">
        <label for="">Expense Amount</label>
        <input type="hidden" name="total" class="form-control" placeholder="Point Amount" value="2">
      </div>
      <div class="form-group">
        <label for="">Discount Amount</label>
        <input type="text" name="am" class="form-control" placeholder="Point Amount">
      </div>
<!--       <div class="form-group">
        <label for="">Deal Image [600X400]</label>
        <input type="file" name="dealImage" class="form-control">
      </div> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="checkStatus1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('admin/pointlistSave')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
      <div class="form-group">
        <label for="">Point</label>
        <input type="text" name="name" class="form-control" placeholder="Point">
      </div>
      <div class="form-group">
        <label for="">Expense Amount</label>
        <input type="text" name="total" class="form-control" placeholder="Point Amount">
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
                url: "{{url('admin/pointDelete')}}"+'/'+id,
                type: 'get',
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


 $(document).on('click', '.itemDelete1', function(){
 // $(".itemDelete").click(function(){
    var id = $(this).data("id");
    console.log(id);
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
                url: "{{url('admin/point-delete-list')}}"+'/'+id,
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