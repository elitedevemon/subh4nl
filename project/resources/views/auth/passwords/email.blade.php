@extends('layouts.website')

@section('content')
<section class="booking-section p-tb-100 bg-black menu-section">
        <div class="container position-relative">
            <div class="section-title">
                <h2 class="color-white">réinitialiser le mot de passe</h2>
            </div>
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="checkout-form m-0">
                        <form action="{{route('varifyEmail')}}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group mb-20">
                                        <div class="input-group">
                                            <input type="text" name="email" class="form-control" required placeholder="Adresse e-mail*" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn full-width" type="submit">{{ __('Envoyer le lien de réinitialisation du mot de passe') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
