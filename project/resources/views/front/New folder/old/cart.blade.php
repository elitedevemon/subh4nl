@extends('layouts.website')
@section('content')
    <form action="{{ route("cart.store") }}" method="POST">
        @csrf
        <cart-list-component logout-route="{{ route("logout")  }}"
                             auth-name="{{ auth()->check() ? auth()->user()->name : ""  }}"></cart-list-component>
    </form>
@endsection
