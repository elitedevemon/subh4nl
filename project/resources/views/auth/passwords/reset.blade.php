@extends('layouts.website')

@section('content')
<section class="booking-section p-tb-100 bg-black menu-section">
        <div class="container position-relative">
            <div class="section-title">
                <h2 class="color-white">Réinitialiser le mot de passe</h2>
            </div>
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="checkout-form m-0">
                        <form action="{{route('varifyPassword')}}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="{{$value}}">
                            <div class="account-setting-item account-setting-avatar">
                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="flaticon-login-1"></i></span>
                                                </div>
                                                <input type="password" name="password" id="pass2" class="form-control password" placeholder="New Password" />
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
                                    <div class="col-sm-12">
                                        <div class="form-group m-0">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="flaticon-login-1"></i></span>
                                                </div>
                                                <input type="password" name="password_confirmation" id="pass3" class="form-control password" placeholder="Confirm New Password" />
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
                                <button type="submit" class="btn btn-small">Changes Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
