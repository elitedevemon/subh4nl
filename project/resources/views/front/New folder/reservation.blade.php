@extends('layouts.website')
@push('css')
<style>
  .r .form-group {
    margin-bottom: 15px;
}
</style>
@endpush
@section('content')
<?php

   $ssts = \App\Models\setting::find(1);

 ?>
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
                </div>
                <div class="header-page-shape-item">
                </div>
            </div>
            <div class="container">
                <div class="header-page-content">
                    <h1>Reservation</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reservation</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
</div>
    <div class="booking-section pt-100 pb-70 bg-black">
        <div class="container">
            <div class="row align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-5 pb-30">
                    <div class="reservation-item text-center text-lg-start">
                        <img src="{{asset('storage/upload/logo')}}/{{$ssts->img_re}}" alt="food">
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-7 pb-30">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="reservation-form-area reservation-item">
                        <form method="post" action="{{url('reservationSave')}}">
                            @csrf
                            <div class="r">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" placeholder="Nome et prénom" name="name" class="form-control">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="flaticon-user-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="email" placeholder="Votre mail" name="email" class="form-control">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="flaticon-email-1"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" placeholder="Téléphone" name="number" class="form-control">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="flaticon-smartphone-call"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="numberOfGuest" placeholder="Nombre de personnes" class="form-control">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="flaticon-add-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="date" placeholder="Sélectionner Date" class="form-control" id="datepicker">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="flaticon-calendar-1"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
            
                                    <div class="input-group">
                                 <!--        <input type="text" name="time" class="form-control timepicker" placeholder="Sélectionner Heure" />
 -->                                        <select name="time" class="form-control">
                                                <option value="1">--Heure *--</option>
                                                    {!! $ssts->select_timeOp !!}
                                            </select>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="flaticon-clock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" placeholder="
Message spécial" name="msg" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <button  class="btn full-width" type="submit">Réserver Une Table</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush