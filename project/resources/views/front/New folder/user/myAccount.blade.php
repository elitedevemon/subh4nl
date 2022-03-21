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
                    <h1>My Account</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Mon compte</li>
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
                            <li class="active"><a href="{{route('myAccount')}}">Mon compte</a></li>
                            <li><a href="{{route('myOrder')}}">Mes commandes</a></li>
                            <li><a href="{{route('myAddress')}}">Mes adresses</a></li>
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
                    <div class="account-info">
                        <form action="{{route('my.info')}}" method="post">
                            @csrf
                            <div class="account-setting-item">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <input type="text" name="name" id="first_name" class="form-control"  value="{{auth()->user()->name}}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <input type="text" name="email" id="email" class="form-control" value="{{auth()->user()->email}}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-setting-item account-setting-button">
                                <button type="submit" class="btn btn-small">Sauvegarder les modifications</button>
                            </div>
                            </div>
                        </form>
                          <form action="{{route('my.pass')}}" method="post">
                            @csrf
                            <div class="account-setting-item account-setting-avatar">
                                <div class="sub-section-title">
                                    <h3 class="color-white">Changer le mot de passe</h3>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="flaticon-login-1"></i></span>
                                                </div>
                                                <input type="password" name="old_password" id="pass1" class="form-control password" placeholder="Mot de passe actuel" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text reveal">
                                                        <i class="flaticon-visibility pass-close"></i>
                                                        <i class="flaticon-eye pass-view"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="flaticon-login-1"></i></span>
                                                </div>
                                                <input type="password" name="password" id="pass2" class="form-control password" placeholder="nouveau mot de passe" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text reveal">
                                                        <i class="flaticon-visibility pass-close"></i>
                                                        <i class="flaticon-eye pass-view"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group m-0">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="flaticon-login-1"></i></span>
                                                </div>
                                                <input type="password" name="password_confirmation" id="pass3" class="form-control password" placeholder="Confirmer le nouveau mot de passe" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text reveal">
                                                        <i class="flaticon-visibility pass-close"></i>
                                                        <i class="flaticon-eye pass-view"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="account-setting-item account-setting-button">
                                <button type="submit" class="btn btn-small">Change le mot de passe</button>
                            </div>
                        </form>

                         <form action="{{route('myReview')}}" method="post">
                            @csrf
                            <div class="account-setting-item account-setting-avatar">
                                <div class="sub-section-title">
                                    <h3 class="color-white">Donnez un avis</h3>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="flaticon-login-1"></i></span>
                                                </div>
                                                <input type="text" name="review" id="pass1" class="form-control password" placeholder="Dis quelquechose*" value="@isset($userR->review) {{$userR->review}}@endisset" />
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="flaticon-login-1"></i></span>
                                                </div>
                                                <select name="star"class="form-control" id="">
                                                    <option value="5">5</option>
                                                    <option value="4">4</option>
                                                    <option value="3">3</option>
                                                    <option value="2">2</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <div class="account-setting-item account-setting-button">
                                <button type="submit" class="btn btn-small">Donnez un avis</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush