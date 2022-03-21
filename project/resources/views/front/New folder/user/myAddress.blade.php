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
                    <h1>My Addresses</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Addresses</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="account-page-section pt-100 pb-70 bg-black">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4 pb-30">
                    <div class="account-sidebar around-border">
                        <ul class="account-sidebar-list">
                            <li><a href="{{route('myAccount')}}">Mon compte</a></li>
                            <li><a href="{{route('myOrder')}}">Mes commandes</a></li>
                            <li class="active"><a href="{{route('myAddress')}}">Mes adresses</a></li>
                            <li><a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a></li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-8 pb-30">
                    <div class="account-info">
                        <div class="my-order">
                            <div class="sub-section-title">
                                <h3 class="color-white">Mes adresses</h3>
                                <p>Les adresses suivantes seront utilisées par défaut sur la page de paiement.</p>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="billing-title">
                                        <h4>adresse de facturation</h4>
                                        <p>Éditer</p>
                                    </div>
                                    <div class="billing-address-input" style="display: revert!important">
                                        <form action="{{route('saveAddress')}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 col-lg-6">
                                                    <div class="form-group mb-20">
                                                        <div class="input-group">
    <input type="text" name="name" id="first_name" class="form-control" required placeholder="Prénom*" value="{{auth()->user()->name}}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="col-sm-12 col-md-6 col-lg-6">
                                                    <div class="form-group mb-20">
                                                        <div class="input-group">
                                                            <input type="text" name="phone_number" id="first_name" class="form-control" required placeholder="Numéro de téléphone
*" value="" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group mb-20">
                                                        <div class="input-group">
                                                            <input type="text" name="address" class="form-control" value="" required placeholder="Adresse*" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <button class="btn full-width" type="submit">Enregistrer l'adresse
 <i class="flaticon-right-chevron"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush