@extends('layouts.website')
@push('css')

@endpush
@section('content')

<section class="page-banner" style="background: #121619 url({{asset('content/website/images/blog-1.jpg')}}) no-repeat center / cover;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="page-title">
                        <h1 class="page-headding">My Addresses</h1>
                        <ul>
                            <li><a href="index.html" class="page-name">Home</a></li>
                            <li>My Addresses</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="shopping-cart" style="background: #333">
        <div class="container">
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
                                                    <button class="about-more-z com-btn" type="submit">Enregistrer l'adresse
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
</div>
</section>
@endsection

@push('scripts')

@endpush