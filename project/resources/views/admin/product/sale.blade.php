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
                @if(count($productOption) <= 0)
          <div class="col-12">
            <div class="card">
            <div class="card-header">
              <h6>Product Sale Add</h6>
            </div>
              <div class="card-body">
                <form action="{{route('sale.save')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="form-group col-6">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Product Name">
                  </div>
                  <div class="form-group col-6">
                    <label for="">Images</label>
                    <input type="file" class="form-control" name="img" >
                  </div>
                  </div>

                    <input type="hidden" class="form-control" name="id" value="{{$id}}">
                   <div class="form-group">
                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                  </div>
                </form>
              </div>
            </div>
         </div>
         @endif
              </div>
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i> All Sale Products Information
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($productOption as $key => $ff)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$ff->name}}</td>

                        <td><img src="{{asset('storage/upload/product')}}/{{$ff->img}}" width="100px" height="80px" alt=""></td></td>
                        <td>
                          <a href="{{route('saleDelete', $ff->id)}}" class="btn btn-sm btn-danger">Delete</a>
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
                url: "{{url('admin/saleDelete')}}"+'/'+id,
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