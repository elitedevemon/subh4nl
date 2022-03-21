@extends('layouts.website')
@section('content')

    <section class="page-content section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-section-title text-center">
                        <h4>Set Menu Items</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Example DataTables Card-->
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card order-section">
                        <div class="card-body">
                            <div class="row">

                                @if(isset($setMenu))
                                    @foreach($setMenu as $v_setMenu)
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                                            <div class="single-p-item">
                                                <div class="p-item-img">
                                                    <img
                                                        src="{{asset('storage/upload/setmenu')}}/{{$v_setMenu->image}}">
                                                    <div class="p-item-share d-table">
                                                        <div class="d-table-cell">
                                                            <ul>
                                                                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                                                <li><a href="#"><i class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="p-item-content">
                                                    <h4>{{$v_setMenu->name}}</h4>

                                                    <div><span class="sale-price">{{$v_setMenu->price}}€</span></div>


                                                    <div class="p-item-content-hover">
                                                        <p>{{$v_setMenu->des}}</p>
                                                        <a href="{{url('set-v-category')}}/{{$v_setMenu->id}}"
                                                           class="add-to-cart"><span><i
                                                                    class="fas fa-cart-arrow-down"></i></span> Select
                                                            Menu</a>
                                                        <!-- <button class="add-to-cart"></button> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection



