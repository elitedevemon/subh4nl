@extends('layouts.website')
@push('css')

@endpush
@section('content')
    <section class="page-banner" style="background: #121619 url({{asset('content/website/images/blog-1.jpg')}}) no-repeat center / cover;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="page-title">
                        <h1 class="page-headding">My Account</h1>
                        <ul>
                            <li><a href="index.html" class="page-name">Home</a></li>
                            <li>My Account</li>
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
              @if (count($errors) > 0)
                 <div class = "alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                 </div>
              @endif
              <?php
$po = \App\Models\Point::all();


if (isset(auth()->user()->id)) {
    $ood1 = \App\Models\Order::where('user_id', auth()->user()->id)->sum('pay_amount');
    $amP1 = number_format($ood1);

    foreach ($po as $key => $value) {
        if ($totalPoint > $value->name) {
            $ee = \App\Models\Voucher::where('user_id', auth()->user()->id)
                                     ->where('name', $value->name)
                                     ->exists();
                          if (!$ee) {
                                 $n = \App\Models\Voucher::create([
                                  'name' => $value->name,
                                  'total' => $value->total,
                                  'am' => $value->am,
                                  'user_id' => auth()->user()->id,
                                  'status' => 2,
                               ]);
                          }

                        }
                    }


}
$eeVoucher = \App\Models\Voucher::where('user_id', auth()->user()->id)->where('status', 2)->get();




















?>
                    <div class="account-info">
                        <div class="row mb-3">
                            <div class="col-12 col-md-8 mt-2 mb-2">
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="card">
                                    <div class="card-header">
                                        Points List & 
                                        <h4 class="badge badge-danger">My Total Points : {{ $totalPoint }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                            <th>Points</th>
                                            <th>Get Discount</th>
                                            @foreach($po as $key => $p)
                                            <tr>
                                                <td>{{$p->name}}</td>
                                                <td>{{$p->am}}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        Points List & 
                                        <h4 class="badge badge-danger">My Total Expense : {{ $amP1 }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                            <th>Points</th>
                                            <th>Get Expense</th>
                                            @foreach($listPoint as $key => $p)
                                            <tr>
                                                <td>{{$p->name}}</td>
                                                <td>€ {{$p->total}}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="col-12 col-md-4 mt-2 mb-2">
                                <ul class="list-group">
                                  <li class="list-group-item bg-primary"><b>My Voucher</b></li>
                                  @foreach($eeVoucher as $s)

                                  <li class="list-group-item"> 
<a href="{{url('get-discount')}}/{{$s->am}}" class="btn btn-secondary btn-sm">Get Voucher - {{$s->am}}</a>
                                  </li>
                                  @endforeach
                                </ul>
                            </div>
                        </div>
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
                                <button type="submit" class="about-more-z com-btn">Sauvegarder les modifications</button>
                            </div>
                            </div>
                        </form>
                          <form action="{{route('my.pass')}}" method="post">
                            @csrf
                            <div class="account-setting-item account-setting-avatar">
                                <div class="sub-section-title mt-5">
                                    <h3 class="color-white">Changer le mot de passe</h3>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mb-20">
                                            <label for="">Ancien mot de passe</label>
                                            <div class="input-group">
                                                <input type="password" name="old_password" id="pass1" class="form-control password" placeholder="Mot de passe actuel" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mb-20">
                                            <label for="">Nouveau mot de passe</label>
                                            <div class="input-group">
                                                <input type="password" name="password" id="pass2" class="form-control" placeholder="nouveau mot de passe" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group m-0">
                                                <label for="">Confirmer mot de passe</label>
                                            <div class="input-group">
                                                <input type="password" name="password_confirmation" id="pass3" class="form-control" placeholder="Confirmer le nouveau mot de passe" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="account-setting-item account-setting-button">
                                <button type="submit" class="about-more-z com-btn">Change le mot de passe</button>
                            </div>
                        </form>

                  <!--        <form action="{{route('myReview')}}" method="post">
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
                        </form> -->
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