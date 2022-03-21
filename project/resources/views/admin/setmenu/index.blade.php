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
            <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="customModal btn btn-primary"> Add SetMenu</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create SetMenu</h5>
      </div>
      <form action="{{route('setmenu.store')}}" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
       <div class="form-group">
        <label for="">Set Menu Name</label>
         <input type="text" name="name" class="form-control" placeholder="Enter Set Menu Name">
       </div>
       <div class="form-group">
        <label for="">Set Menu Price</label>
         <input type="text" name="price" class="form-control" placeholder="Enter Set Menu Price">
       </div>
       <div class="form-group">
        <label for="">Set Menu Description</label>
         <!-- <input type="text" name="name" class="form-control" placeholder="enter Set Menu Name"> -->
         <textarea name="des" class="form-control" cols="30" rows="10" placeholder="enter Set Menu Description"></textarea>
       </div>
       <div class="form-group">
        <label for="">Set Menu Image</label>
         <input type="file" name="image" class="form-control" placeholder="enter Set Menu Name">
       </div>

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
             <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Set MEnu Items</h2>
        <div class="filter">
          <select name="orderby" class="selectbox">
            <option value="Any time">Any time</option>
            <option value="Latest">Latest</option>
            <option value="Oldest">Oldest</option>
          </select>
        </div>
      </div>
      <div class="list_general">
        <ul>

          @foreach($getData as $v_getData)
          <li>
            <figure><img src="{{asset('storage/upload/setmenu')}}/{{$v_getData->image}}" alt=""></figure>
            <small>€{{$v_getData->price}}</small>
            <h4>{{$v_getData->name}}</h4>
            <p>{{$v_getData->des}}</p>
            <p><a href="{{route('setmenu.show',$v_getData->id)}}" class="btn_1 gray"><i class="fa fa-fw fa-eye"></i> View item</a></p>
            <ul class="buttons">
              <li><a href="{{route('setmenu.delete',$v_getData->id)}}" class="btn_1 gray delete wishlist_close"><i class="fa fa-fw fa-times-circle-o"></i> Delete</a></li>
            </ul>
          </li>
          @endforeach
        
        
        </ul>
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

            $('.customModal').on('click', function(){
          $('#exampleModal').modal('show');

            });  

             $('.customModalHide').on('click', function(){
          $('#exampleModal').modal('hide');
          $("#addform")[0].reset();

            });


           });
        </script>

@endpush