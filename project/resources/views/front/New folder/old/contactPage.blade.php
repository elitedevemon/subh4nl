@extends('layouts.website')
@section('content')
<section class="page-content section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="p-section-title text-center">
          <h4>Contact Our Restrurant</h4>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        
        <div class="order-section">
          <div class="page-content-wrap">
            <div class="google-maps">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2789.1827809648785!2d0.1648176149732411!3d45.64715102923906!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47fe3265e32fcff5%3A0xdbfaf138b8f2e8!2sLe%20Moghol!5e0!3m2!1sen!2sbd!4v1616839299445!5m2!1sen!2sbd" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>

            {!!$ourPage->des!!}

        </div>
        
      </div>
    </div>
  </div>
</section>
@endsection