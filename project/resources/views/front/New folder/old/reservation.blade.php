@extends('layouts.website')
@section('content')
<section class="page-content section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="p-section-title text-center">
          <h4>Reservation</h4>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
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
      </div>
      <div class="col-lg-8 col-md-8 col-sm-12 col-12">
        <div class="card order-section">
          <div class="card-body">
            <div class="reservation">
         <form action="{{route('reservation.save')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="row">
            <div class="form-group col-md-6">
              <label for="">Full Name</label>
              <input type="text" name="name" class="form-control" placeholder="Enter you First Name">
            </div>
            <div class="form-group col-md-6">
              <label for="">Number Of Guest</label>
              <input type="number" name="numberOfGuest" class="form-control" placeholder="Enter Number Of Guest">
            </div>
            <div class="form-group col-md-6">
              <label for="">Phone Number</label>
              <input type="text" name="number" class="form-control" placeholder="Enter you Phone Number">
            </div>
            <div class="form-group col-md-6">
              <label for="">Email</label>
              <input type="email" name="email" class="form-control" placeholder="Enter you Email">
            </div>
            <div class="form-group col-md-6">
              <label for="">Date</label>
              <input type="date" name="date" class="form-control" placeholder="Enter date">
            </div>
            <div class="form-group col-md-6">
              <label for="">Time</label>
              <input type="time" name="time" class="form-control" placeholder="Enter you Email">
            </div>
              
              <div class="form-group col-md-12">
              <label for="">Special Requests</label>
              <textarea  class="form-control" name="msg" placeholder="Special Requests"></textarea>
            </div>
            <div class="col-12 text-center">
              <div class="submitBtns">
                <!-- <a type="submit">Take a Reservation</a> -->
                <button type="submit" class="customBtnSubmit">Take a Reservation</button>
              </div>
            </div>
            </div>
          </form>
        </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-8 col-sm-12 col-12">
        <div class="page-sidebar">
          <div class="sidebar-widget">
            <div class="socal-menida">
              <div class="fb-wrap">
  <h1>Responsive Facebook Like Box</h1>
<div class="fb-like-box" data-href="https://www.facebook.com/shellysseafood" data-width="992" data-show-faces="true" data-show-border="false" data-colorscheme="light" data-stream="false" data-header="false"></div>

</div>
            </div>
            <span>Address: Lorem ipsum dolor </span>
            <span>Opening Hours: Lorem ipsum dolor </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection