@extends('layouts.website')
@push('css')

@endpush
@section('content')
    <div class="header-bg header-bg-page">
         <div class="header-padding position-relative">
            <div class="header-page-shape">
               <div class="header-page-shape-item">
                  <img src="{{asset('content/website')}}/assets/images/header-shape-1.png" alt="shape">
               </div>
               <div class="header-page-shape-item">
                  <img src="{{asset('content/website')}}/assets/images/header-shape-2.png" alt="shape">
               </div>
               <div class="header-page-shape-item">
                  <img src="{{asset('content/website')}}/assets/images/header-shape-3.png" alt="shape">
               </div>
               <div class="header-page-shape-item">
                  <img src="{{asset('content/website')}}/assets/images/header-shape-1.png" alt="shape">
               </div>
               <div class="header-page-shape-item">
               </div>
               <div class="header-page-shape-item">
                  <img src="{{asset('content/website')}}/assets/images/header-shape-1.png" alt="shape">
               </div>
            </div>
            <div class="container">
               <div class="header-page-content">
                  <h1>Contact Us</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
      <div class="contact-us-section pt-100 pb-70 bg-black">
         <div class="container">
            <div class="row">
		      <div class="map-section p-tb-100 bg-black">
		         <div class="container">
		            <div class="google-map-content">
		               <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d5578.031744926599!2d0.155109!3d45.650503!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe3aa1435a1961a30!2sJardin%20de%20Kashmir%20Angoul%C3%AAme!5e0!3m2!1sen!2sus!4v1634754828492!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
		            </div>
		         </div>
		      </div>

               <div class="col-sm-12 col-md-12 col-lg-8 order-5 order-lg-0 pb-30">
                  <div class="comment-area">
                     <div class="sub-section-title">
                        <h3 class="color-white">Leave A Message</h3>
                        <p>Your email address will not be published. Required fields are marked *</p>
                     </div>
                     <div class="comment-form mt-30">
                        <form id="contactForm">
                           <div class="row">
                              <div class="col-sm-12 col-md-6">
                                 <div class="form-group mb-20">
                                    <div class="input-group">
                                       <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name" placeholder="Name*" />
                                    </div>
                                    <div class="help-block with-errors"></div>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6">
                                 <div class="form-group mb-20">
                                    <div class="input-group">
                                       <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email" placeholder="Email*" />
                                    </div>
                                    <div class="help-block with-errors"></div>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6">
                                 <div class="form-group mb-20">
                                    <div class="input-group">
                                       <input type="text" name="phone_number" id="phone_number" required data-error="Please enter your phone number" class="form-control" placeholder="Phone*" />
                                    </div>
                                    <div class="help-block with-errors"></div>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6">
                                 <div class="form-group mb-20">
                                    <div class="input-group">
                                       <input type="text" name="msg_subject" id="msg_subject" class="form-control" required data-error="Please enter your subject" placeholder="Subject*" />
                                    </div>
                                    <div class="help-block with-errors"></div>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-12">
                                 <div class="form-group mb-20">
                                    <div class="input-group">
                                       <textarea name="message" class="form-control" id="message" rows="8" placeholder="Your Message*"></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                 <button class="btn full-width" type="submit">
                                 Send A Message
                                 </button>
                                 <div id="msgSubmit"></div>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 col-md-6 col-lg-4 order-4 order-lg-0 pb-30">
                  <div class="contact-item">
                     <div class="contact-item-title text-center">
                        <h3 class="color-white">Main Head Office</h3>
                     </div>
                     <div class="contact-item-info">
                        <div class="contact-info-list">
                           <h3>Address</h3>
                           <p>{{$st->address}}</p>
                        </div>
                        <div class="contact-info-list">
                           <h3>E-mail</h3>
                           <p><span class="__cf_email__" data-cfemail="cba3aea7a7a48badaaada4e5a8a4a6">{{$st->email}}</span></p>
                        </div>
                        <div class="contact-info-list">
                           <h3>Phone</h3>
                           <p><a href="tel:001-964-565-87652">{{$st->phone}}</a></p>
                        </div>
                     </div>
                  </div>
                  <div class="contact-item">
                     <div class="contact-item-title text-center">
                        <h3 class="color-white">Open Hours</h3>
                     </div>
                     <div class="contact-item-info">
                        <ul class="footer-details footer-time">
                           {!! $st->schedules !!}
                        </ul>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>
@endsection

@push('scripts')

@endpush