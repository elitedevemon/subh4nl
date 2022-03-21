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
                    <h1>Catering</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Catering</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="service-section pt-100 pb-70 bg-black bg-overlay-1">
        <div class="container">
            <div class="section-title">
                <h2 class="color-white">We Offer 3 Kinds Of Services</h2>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                    <div class="service-item">
                        <div class="service-image">
                            <img src="{{asset('content/website')}}/assets/images/catering-1.jpg" alt="service">
                        </div>
                        <div class="service-content">
                            <h3>1. Private Party</h3>
                            <p>Choose Your Best Combos From The Thousands Of Exciting Items.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                    <div class="service-item">
                        <div class="service-image">
                            <img src="{{asset('content/website')}}/assets/images/catering-2.jpg" alt="service">
                        </div>
                        <div class="service-content">
                            <h3>2. Corporate Event</h3>
                            <p>Choose Your Best Combos From The Thousands Of Exciting Items.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 pb-30 offset-md-3 offset-lg-0">
                    <div class="service-item">
                        <div class="service-image">
                            <img src="{{asset('content/website')}}/assets/images/catering-3.jpg" alt="service">
                        </div>
                        <div class="service-content">
                            <h3>3. Social Event</h3>
                            <p>Choose Your Best Combos From The Thousands Of Exciting Items.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="booking-section p-tb-100 bg-black menu-section">
        <div class="container position-relative">
            <div class="section-title">
                <small>Catering</small>
                <h2 class="color-white">Fill Out Our Catering Form</h2>
            </div>
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="checkout-form m-0">
                        <form action="{{url('catererSave')}}" method=post>
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group mb-20">
                                        <div class="input-group">
                                            <input type="text" name="name" class="form-control" required placeholder="First Name*" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-20">
                                        <div class="input-group">
                                            <input type="text" name="email" class="form-control" required placeholder="Your Email*" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-20">
                                        <div class="input-group">
                                            <input type="text" name="number" class="form-control" required placeholder="Your Phone*" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-20">
                                        <div class="input-group">
                                            <input type="text" name="date" id="datepicker" class="form-control" required placeholder="Select Date*" />
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <i class="flaticon-calendar-1"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-20">
                                        <div class="input-group">
                                            <input type="text" name="place" class="form-control" required placeholder="Location*" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-20">
                                        <div class="input-group">
                                            <input type="text" name="nameOfEvent" class="form-control" required placeholder="Name of event*" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-20">
                                        <div class="input-group">
                                            <input type="text" name="time" class="form-control timepicker" required placeholder="Event Start Time*" />
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <i class="flaticon-clock"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-20">
                                        <div class="input-group">
                                            <input type="text" name="numberOfGuest" class="form-control" required placeholder="Number Of Guest**" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-20">
                                        <div class="input-group">
                                            <input type="text" name="budget" class="form-control" required placeholder="Budget*" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-20">
                                        <div class="input-group input-group-textarea">
                                            <textarea name="msg" class="form-control" rows="5" placeholder="What Kind Of Event It Is?"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button class="btn full-width" type="submit">Send Request</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')

@endpush