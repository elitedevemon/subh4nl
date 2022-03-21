@extends('layouts.admin')
@push('css')
<style>
.card-header i{
    margin-right: 5px;
}
a.custombtn {
    background: red;
    padding: 2px;
    border-radius: 15%;
    color: #fff;
    font-weight: 700;
}button.custombtnadd {
    background: #212b5d;
    padding: 2px;
    border-radius: 15%;
    color: #fff;
    font-weight: 700;
}
.unreadadd{
background-color: #3c3e88;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    -ms-border-radius: 50px;
    border-radius: 50px;
    font-size: 12px;
    font-size: 0.75rem;
    color: #fff;
    font-style: normal;
    padding: 3px 12px 2px 12px;
    margin-left: 3px;
    position: relative;
    top: -3px;
    line-height: 1;
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
            <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="customModal btn btn-primary"> Add SetMenu</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create SetMenu</h5>
      </div>
      <form action="{{route('setmenuCategory.store')}}" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
       <div class="form-group">
        <label for="">Set Menu Category Name</label>
         <input type="text" name="name" class="form-control" placeholder="Enter Set Menu Name">
       </div>
       
        <input type="hidden" name="set_menu_id" value="{{$id}}">

      </div>
      <div class="modal-footer">
        <button type="button" class="customModalHide btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save </button>
      </div>
</form>
    </div>
  </div>
</div>






            </div>
            </div>
            <div class="card-body">

             <div class="row">
  @if(isset($setmenuCategory))
              @foreach($setmenuCategory as $v_setmenuCategory)
           
              
            <div class="col-md-12">
              <div class="box_general">
                <h4>{{$v_setmenuCategory->name}}</h4>
                      <span class="text-right"><i class="unread" ><a style="color: #fff" href="{{route('setmenuCategory.delete',$v_setmenuCategory->id)}}">delete</a></i></span>
                    <i class="customModal2 unreadadd" data-id="{{$v_setmenuCategory->id}}">add</i>

                    <!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Set Menu Products</h5>
      </div>
      <form action="{{route('setmenuProduct.store')}}" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
       <div class="form-group">
        <label for="">Set Menu Category Name</label>
         <input type="text" name="name" class="form-control" placeholder="Enter Set Menu Name">
       </div>
       <div class="form-group">
        <label for="">Set Menu Category Image</label>
         <input type="file" name="image" class="form-control" placeholder="Enter Set Menu Name">
       </div>
       
        <input type="hidden" name="setmenu_category_id" id="setmenu_category_id" >

      </div>
      <div class="modal-footer">
        <button type="button" class="customModalHide btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save </button>
      </div>
</form>
    </div>
  </div>
</div>










                <div class="list_general">
                  <ul>
                    <li>
                      <div class="row">
                        @if(isset($v_setmenuCategory->subproduct))
                        @foreach($v_setmenuCategory->subproduct as $key => $v_get)
                        <div class="col-md-4">
                          <div class="card">
                            <div class="card-body text-center">
                              <img src="{{asset('storage/upload/setmenu')}}/{{$v_get->image}}" alt="" width="70px" height="50px">
                              <div class="div">
                                {{$v_get->name}}
                              </div>
                              <form action="{{route('setmenuProduct.delete',$v_get->id)}}" method="get">
                          @csrf
                          <button type="submit" class="custombtnAction">Delete</button>
                        </form>
                            </div>
                          </div>
                        </div>

                        @endforeach
                        @endif

                      </div>
                      
                    </li>
                  
                  </ul>
                </div>
              </div>
            </div> 
              @endforeach
               @endif

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

            $('.customModal').on('click', function(){
          $('#exampleModal').modal('show');

            });  
            $('.customModal2').on('click', function(){
          $('#exampleModal2').modal('show');

            });  

             $('.customModalHide').on('click', function(){
          $('#exampleModal').modal('hide');
          $("#addform")[0].reset();

            });


           });
        </script>

<script>
   $('body').on('click', '.unreadadd', function () {
        var id = $(this).data("id");

        $('#setmenu_category_id').val(id);

       });
</script>



@endpush