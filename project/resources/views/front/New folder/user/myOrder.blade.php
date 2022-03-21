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
                    <h1>My Orders</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Orders</li>
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
                            <div class="product-list-form m-0">
                                <form>
                                    <select>
                                        <option value="all">All</option>
                                        <option value="pending">Pending</option>
                                        <option value="confirmed">Confirmed</option>
                                        <option value="shipped">Shipped</option>
                                        <option value="delivered">Delivered</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </form>
                            </div>
                            <div class="cart-table cart-table-dark mt-20">
                                <table>
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
                                            <td><a href="{{route('download', $v->id)}}" target="_blank" class="btn btn-sm">View</a></td>
                                            <td>{{$v->order_number}}</td>
                                            @if($v->orderType == 'order')
                                            <td> €{{$v->pay_amount + $v->shipping_cost}}</td>
                                            @else
                                            <td> €{{$v->pay_amount}}</td>
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
@endsection

@push('scripts')

@endpush