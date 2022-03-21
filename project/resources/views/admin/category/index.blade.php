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
            <a href="{{route('category.create')}}" class="btn btn-primary">Add Product Category</a>
            </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Category Name</th>
                      <th>Image</th>
                      <th>Promote</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                @foreach($categories as $key => $category)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$category->name}}</td>
                <td>
                  <img src="{{asset('storage/upload/category')}}/{{$category->image}}" width="100px" height="80px" alt="">
                </td>
                <td>
                  @if($category->setcat == 1)
                  <span class="badge badge-pill badge-primary">Promoted</span>
                  @else
                  <span class="badge badge-pill badge-danger">Not Promoted</span>
                  @endif
                </td>
                     <td>
                            <a href="{{route('category.show', $category->id)}}" class="btn btn-dark">
                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a> 
                      
                           <button data-id="{{$category->id}}" class="itemDelete btn btn-danger">
                                              <i class="fa fa-trash"></i>
                                            </button>
                            <button class="btn btn-info checkStatus" data-id="{{$category->id}}" data-toggle="modal" data-target="#checkStatus">
                            <i class="fa fa-check-square-o" aria-hidden="true"></i>

                          </button>
                          </td>
                   </tr>

<div class="modal fade" id="checkStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('admin/promoteStatus')}}" method="POST">
        @csrf
        <div class="modal-body">
      <div class="form-group">
        <label for="">Category promoted</label>
        <select name="setCat" class="form-control" id="">
          <option value="0">Not Promote</option>
          <option value="1">Promote</option>
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