@extends('layouts.website')
@push('css')
<style>
    .cart-table table{
        color: #fff;
    }
</style>
@endpush
@section('content')
<section class="page-banner" style="background: #121619 url({{asset('content/website/images/blog-1.jpg')}}) no-repeat center / cover;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="page-title">
                        <h1 class="page-headding">My Orders</h1>
                        <ul>
                            <li><a href="index.html" class="page-name">Home</a></li>
                            <li>My Orders</li>
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
                            <li class="active"><a href="{{route('myOrder')}}">Mes commandes</a></li>
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
                    <div class="account-info">
                        <div class="my-order">
                            <div class="sub-section-title">
                                <h3 class="color-white">My Orders</h3>
                            </div>

                            <div class="cart-table cart-table-dark mt-20">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-sm table-hover" style="color: #000!important">
                                    <thead>
                                        <tr>
                                            <th>Actions</th>
                                            <th>Order Id</th>
                                            <th>Total Price</th>
                                            <th>Type</th>
                                            <!-- <th>status</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order as $v)
                                        <tr>
                                            <td><a href="{{route('download', $v->id)}}" target="_blank" class="btn btn-sm badge badge-danger">View</a></td>
                                            <td>{{$v->order_number}}</td>
                                            @if($v->orderType == 'order')
                                            <td> €{{$v->pay_amount + $v->shipping_cost}}</td>
                                            @else
                                            <td> €{{$v->pay_amount - $v->discount}}</td>
                                            @endif
                                            <td>{{$v->orderType}}</td>
                                            <!-- <td class="td-total-price">Pendding</td> -->
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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