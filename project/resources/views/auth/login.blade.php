@extends('layouts.website')
@section('content')

    <section class="page-content section-padding">
        <div class="container">

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
                                <div class="col-md-8 col-sm-12 col-12">
                                    <div class="p-section-title text-center">
                                        <h4>Create A new Account / Login </h4>
                                    </div>d
                                    <form action="{{ route("login") }}" method="POST">
                                        @csrf
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                            </div>
                                            <input name="email" class="form-control" placeholder="Email address"
                                                   type="email">
                                        </div> <!-- form-group// -->


                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                            </div>
                                            <input name="password" class="form-control" placeholder="Create password" type="password">
                                        </div> <!-- form-group// -->

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block"> Login Account
                                            </button>
                                            <a href="{{ route("register")  }}" class="btn btn-danger btn-block"> Create Account
                                            </a>
                                        </div> <!-- form-group// -->
                                    </form>
                                </div>

                                <div class="col-lg-4 col-md-8 col-sm-12 col-12">
                                    <div class="page-sidebar">
                                        <div class="sidebar-widget">
                                            <img src="">
                                            <span>Address: Lorem ipsum dolor </span>
                                            <span>Opening Hours: Lorem ipsum dolor </span>
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



