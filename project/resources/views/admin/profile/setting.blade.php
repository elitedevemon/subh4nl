@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
        <div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">My Dashboard</li>
          </ol>
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
    <div class="box_general padding_bottom">
      <div class="header_box version_2">
        <h2><i class="fa fa-user"></i>Profile details</h2>
      </div>
      <div class="row">
      
        <div class="col-md-12 add_top_30">
          <form action="{{url('/admin/change-info')}}" method="post">
            @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{AUTH::user()->name}}">
              </div>
            </div>
              <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{AUTH::user()->email}}">

                <input type="hidden" name="id" value="{{AUTH::user()->id}}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </div>
          </div>
          <!-- /row-->
          </form>
        </div>
      </div>
    </div>
    <!-- /box_general-->
    <div class="row">
      <div class="col-md-12">
      <form action="{{url('/admin/change-password')}}" method="post">
        @csrf
        <div class="box_general padding_bottom">
          <div class="header_box version_2">
            <h2><i class="fa fa-lock"></i>Change password</h2>
          </div>
          <div class="form-group">
            <label>Old password</label>
            <input class="form-control" name="old_password" type="password">
          </div>
          <div class="form-group">
            <label>New password</label>
            <input class="form-control" name="password" type="password">
          </div>
          <div class="form-group">
            <label>Confirm new password</label>
            <input class="form-control" name="password_confirmation"  type="password">
          </div>
          <button type="submit" class="btn_1">Save</button>
        </div>
    </form>
      </div>
   <!--    <div class="col-md-6">
        <div class="box_general padding_bottom">
          <div class="header_box version_2">
            <h2><i class="fa fa-envelope"></i>Change email</h2>
          </div>
          <div class="form-group">
            <label>Old email</label>
            <input class="form-control" name="old_email" id="old_email" type="email">
          </div>
          <div class="form-group">
            <label>New email</label>
            <input class="form-control" name="new_email" id="new_email" type="email">
          </div>
          <div class="form-group">
            <label>Confirm new email</label>
            <input class="form-control" name="confirm_new_email" id="confirm_new_email" type="email">
          </div>
        </div>
      </div> -->
    </div>
    <!-- /row-->
           </div>
         </div>
        <!-- /.container-wrapper-->
@endsection