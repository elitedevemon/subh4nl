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
              <div class="row">
                      <div class="col-12">
          <div class="card">
          <div class="card-header">
            <h6>Product Option Edit</h6>
          </div>
            <div class="card-body">
              <form action="{{route('options.edit')}}" method="post">
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control" name="name" value="{{$proTitle->name}}">
                  <input type="hidden" class="form-control" name="id" value="{{$proTitle->id}}">
                </div>
                 <div class="form-group">
                  <button class="btn btn-primary btn-sm" type="submit">Edit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
              </div>
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i> All Post Information
            <div class="addBtn" style="float:right">
         <button class="btn btn-info checkStatus" data-toggle="modal" data-target="#checkStatus">
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
                      <th>Name</th>
                      <th>Option Type</th>
                      <th>Description</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($productOption as $key => $ff)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$ff->name}}</td>
                        <td>
                          @isset($ff->proTitle->name)
                          {{$ff->proTitle->name}}
                          @endisset
                        </td>
                        <td>
                          {{$ff->des}}
                        </td>
                        <td><img src="{{asset('storage/upload/product')}}/{{$ff->image}}" width="100px" height="80px" alt=""></td></td>
                        <td>{{$ff->price}}</td>
                        <td>
                          <a href="{{route('options.delete', $ff->id)}}" class="btn btn-sm btn-danger">Delete</a>
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

        <div class="modal fade" id="checkStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product Option Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
           <form action="{{route('getOptionStore')}}" method="post" enctype="multipart/form-data">
              @csrf
            <div class="modal-body">
              <div class="form-group">
                <label for="">Product Option Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Product Name">
              </div>


              <input type="hidden" name="pro_title_id" value="{{$proTitle->id}}">

              @if($proTitle->is_type == 'paid_multiple_selection')
              <div class="form-group">
                <label for="">Product Price</label>
                <input type="text" name="price" class="form-control" placeholder="Enter Product Price">
              </div>
              @endif

              <div class="form-group">
                <label for="">Product Description</label>
                <input type="text" name="des" class="form-control" placeholder="Enter Product Description">
              </div>
              <div class="form-group">
                <label for="">Product Image</label>
                <input type="file" name="image" class="form-control" placeholder="Enter Product Name">
              </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                url: "{{url('admin/product')}}"+'/'+id,
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