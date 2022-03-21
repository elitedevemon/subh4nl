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
            <a href="{{route('product.create')}}" class="btn btn-primary btn-sm">Add Product</a>
            <a href="{{route('pro.option')}}" class="btn btn-info btn-sm">Product Options</a>
           <a href="{{route('sale.view')}}" class="btn btn-dark btn-sm">Product Sales</a>
            </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Product Name</th>
                      <th>Is Banner</th>
                      <th>Category Name</th>
                      <th>Sub Category Name</th>
                      <th>Current Price</th>
                      <th>Offer Price</th>
                      <th>Deal Status</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
         @foreach($products as $key => $product)
         <tr>
           <td>{{$key+1}}</td>
           <td>{{$product->name}}</td>

           <td>
             @if($product->is_banner == 1)
                <span class="badge badge-pill badge-primary">for banner</span>
             @else
                <span class="badge badge-pill badge-danger">Not Promoted</span>
             @endif
           </td>
           @isset($product->category->name)
           <td>{{$product->category->name}}</td>
           @else
           <td>Set Category Name</td>
           @endisset
           <td>
                @if(isset($product->subcategory->name))
                {{$product->subcategory->name}}
                @elseif($product->sub_category_id == 0)
                  <span class="badge badge-danger">Only Category</span>
                @endif
           </td>
           <td>{{$product->regular_price}}</td>
           <td>{{$product->offer_price}}</td>
           <td>
             @if($product->is_pro == 1)
             <span class="badge badge-pill badge-primary">Not Promoted</span>
             @else
             <span class="badge badge-pill badge-danger"> Promoted</span>
             @endif

           </td>
              <td>
                  <img src="{{asset('storage/upload/product')}}/{{$product->image}}" width="100px" height="80px" alt="">
                </td>
                     <td>
                            <a href="{{route('product.show', $product->id)}}" class="btn btn-dark btn-sm">
                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                             <button data-id="{{$product->id}}" class="itemDelete btn btn-danger btn-sm">
                                              <i class="fa fa-trash"></i>
                                            </button>
                            <button class="btn btn-info checkStatus btn-sm" data-id="{{$product->id}}" data-toggle="modal" data-target="#checkStatus">
                            <i class="fa fa-outdent" aria-hidden="true"></i>
                          </button>
                          </td>

                   </tr>
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
        <h5 class="modal-title" id="exampleModalLabel">Product For Deals</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('admin/PricePromoteStatus')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
      <div class="form-group">
        <label for="">Product promoted</label>
        <select name="is_pro" class="form-control" id="">
          <option value="0">--Select--</option>
          <option value="1">Not Promote</option>
          <option value="2">Promote</option>
        </select>
      </div>
<!--       <div class="form-group">
        <label for="">Deal Image [600X400]</label>
        <input type="file" name="dealImage" class="form-control">
      </div> -->
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