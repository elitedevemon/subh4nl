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

            <div class="cutomBtn" style="margin-left: 10px">
               <button class="btn btn-info checkStatus" data-toggle="modal" data-target="#checkStatus">
                            add</i>
                </button>
            </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Shpping Code Name</th>
                      <th>Postal Code</th>
                      <th>Cost</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
        @foreach($shipping as $key=> $v)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$v->km}}</td>
          <td>{{$v->code}}</td>
          <td>{{$v->cost}}€</td>
          <td>
            @if($v->status == 1)
            <span class="badge badge-primary">Active</span>
            @elseif($v->status == 2)
            <span class="badge badge-danger">Inactive</span>
            @endif
          </td>
          <td>
 <a class="btn btn-info btn-sm" href="{{route('show.shipping', $v->id)}}">
                            
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
</a>
<button class="btn btn-primary checkStatus1 btn-sm" data-id="{{$v->id}}" data-toggle="modal" data-target="#checkStatus1">
                           <i class="fa fa-outdent" aria-hidden="true"></i>
                          </button>
<button data-id="{{$v->id}}" class="itemDelete btn btn-danger btn-sm">
                                              <i class="fa fa-trash"></i>
</button>
        </tr>
        @endforeach
                  </tbody>
                </table>
              </div>
            </div>
           <!-- Button trigger modal -->




<!-- Modal check status-->
<div class="modal fade" id="checkStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Shipping Cost</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('admin/shippingSave')}}" method="POST">
        @csrf
        <div class="modal-body">
      <div class="form-group">
        <label for="">Shipping Code Name</label>
    <input type="number" name="km" class="form-control" placeholder="Enter Post Code Name">
    <input type="hidden" name="status" class="form-control" value="1">
      </div>
      <div class="form-group">
        <label for="">Postal Code</label>
    <input type="text" name="code" class="form-control" placeholder="Enter Postal Code">
      </div>
       <div class="form-group">
        <label for="">Cost</label>
          <input type="text" name="cost" class="form-control" placeholder="Cost Of Kilometer">
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

        <div class="modal fade" id="checkStatus1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Shipping Cost</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('status.shipping')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
      <div class="form-group">
        <label for="">Active Status</label>
        <select name="status" class="form-control" id="">
          <option value="0">--Select--</option>
          <option value="1">Promote</option>
          <option value="2">Not Promote</option>
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
             $('.checkStatus1').on('click', function(){
          $('#checkStatus1').modal('show');

            });

             $('body').on('click', '.checkStatus1', function () {
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
                url: "{{url('admin/shippingDelete')}}"+'/'+id,
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