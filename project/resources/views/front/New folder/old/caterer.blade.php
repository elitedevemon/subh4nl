@extends('layouts.website')
@section('content')
<section class="page-content section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="p-section-title text-center">
          <h4>Caterer</h4>
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
           <form action="{{route('caterer.save')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="form-group col-md-6">
              <label for="">Nature of the Event:</label>
              <input type="text" name="nameOfEvent" class="form-control" placeholder="Enter you First Name">
            </div>
            <div class="form-group col-md-6">
              <label for="">Full Name:</label>
              <input type="text" name="name" class="form-control" placeholder="Enter you Full Name">
            </div>
            <div class="form-group col-md-6">
              <label for="">Email Address:</label>
              <input type="email" name="email" class="form-control" placeholder="Enter you Email Address">
            </div>
            <div class="form-group col-md-6">
              <label for="">Phone Number:</label>
              <input type="number" name="number" class="form-control" placeholder="Enter you phone Number">
            </div>
            <div class="form-group col-md-6">
              <label for="">Date of the event</label>
              <input type="date" name="date" class="form-control" placeholder="Enter Date of the Event">
            </div>
            <div class="form-group col-md-6">
              <label for="">Hours</label>
              <input type="time" name="time" class="form-control" placeholder="Enter you Event Hours">
            </div>
            <div class="form-group col-md-6">
              <label for="">Place </label>
              <input type="text" name="place" class="form-control" placeholder="Enter you  Place Location">
            </div>
            <div class="form-group col-md-6">
              <label for="">PostCode </label>
              <input type="text" name="postcode" class="form-control" placeholder="Enter you  PostCode">
            </div>
            <div class="form-group col-md-6">
              <label for="">Number of persons:</label>
              <input type="number" name="numberOfGuest" class="form-control" placeholder="Enter Number of persons">
            </div>
            <div class="form-group col-md-6">
              <label for="">Type of service</label>
              <input type="text" name="service" class="form-control" placeholder="Enter you Type of service">
            </div>
            <div class="form-group col-md-6">
              <label for="">Global budget </label>
              <input type="text" name="budget" class="form-control" placeholder="Enter you Global budget ">
            </div><div class="form-group col-md-6">
              <label for="">Society</label>
              <input type="text" name="society" class="form-control" placeholder="Enter you Society">
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
            <img src="">
            <span>Address: Lorem ipsum dolor </span>
            <span>Opening Hours: Lorem ipsum dolor </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection