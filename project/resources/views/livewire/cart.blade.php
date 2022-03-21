<div>
<?php
   $getOrder = session('orderPart');
   $sp = \App\Models\Shipping::where('status', 1)->get();
   $set = \App\Models\setting::where('id', 1)->first();
?>
 <div class="cart-item-table commun-table">
                <div class="table-responsive">
                    <table class="table border mb-0">
                        <thead>
                            <tr>
                                <th class="align-left">Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action/ {{$withoutOfferPrice}}</th>
                            </tr>
                        </thead>
                        <tbody>
                    @if($cartItems)
                        @foreach($cartItems as $id => $details)
                            <tr>
                                <td class="align-left">
                                    <a href="shop-detail.html">
                                        <div class="product-image">
                                            <img alt="Eshoper" src="{{asset('storage/upload/product')}}/{{$details['img']}}">
                                        </div>
                                        <div class="product-title"> 
                                        <a href="shop-detail.html">{{$details['name']}}</a>
                                            @if(isset($details['select']))
                                                <ul>
                                                    @foreach($details['select'] as $ss)
                                                    @if($ss == false)
                                                    @else
                                                    <li style="list-style-type: disc;"><span><b>{{$ss}}</b></span></li>
                                                    @endif
                                                    @endforeach
                                                </ul>
                                            @endif
                                    </div>
                                    </a>
                                </td>
                                <td>
                                @if($details['is_offer'] != 1)
                                    @if($details['is_offer'] != 2)
                                <div class="quantity">
                                    <a  class="quantity__minus"
                                        wire:click="decreament({{$details['id']}})"
                                        @if($details['quantity'] === 1)
                                        disabled=""
                                        @endif>
                                        <span>-</span>
                                    </a>
                                    <input name="quantity" type="text" class="quantity__input" value="{{$details['quantity']}}">

                                    <a class="quantity__plus" wire:click="increament({{$details['id']}})">
                                        <span>+</span>
                                    </a>
                                </div>
                                    @endif
                                @endif

                                </td>
                                <td>
                                    <div class="total-price price-box">
                                        @if(isset($details['is_paid']))
                                         <?php
                                         $mainPrice = $details['price'] -  $details['extraPrice'];
                                          ?>
                                            <span class="price">
                                             €{{$mainPrice * $details['quantity']}}
                                              @if($details['extraPrice'])
                                              + €{{$details['extraPrice']}}
                                              @endif
                                            </span>
                                           @else
                                           <span class="price">€{{$details['price'] * $details['quantity']}}</span>

                                        @endif

                                    </div>
                                </td>
                                <td>
                                    <a wire:click="removeCart({{$id}})" class="btn small btn-color">
                                        <i title="Remove Item From Cart" data-id="100" class="fa fa-trash cart-remove-item"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="mtb-30">
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-6 pb-30 offset-lg-3 offset-md-2 mb-sm-20">
                        <div class="estimate">
                            <div class="heading-part mb-20 text-center">
                                <h3 class="sub-heading text-center-r">Estimate shipping and tax</h3>
                            </div>
 @if(isset($getOrder['orderType']))
                         <div class="row text-center">
                            <div class="col-md-12">
                                <div class="input-box mb-20">
                                    <label class="cusLabel">Order Type</label>
                                   <div class="cart-total-item">
                                    <div class="cart-check-box">
                                        <input type="radio" class="form-control" wire:model="tempOrderType" name="ship1" id="checko32" value="takeway" {{ $getOrder['orderType'] == 'takeway' ? 'checked' : '' }}>
                                         <label id="left1" for="checko32">A Emporter
                                        </label>
                                    </div>
                                    <div class="cart-check-box">
                                        <input type="radio" class="form-control" wire:model="tempOrderType" name="ship1" id="checko322" value="order" {{ $getOrder['orderType'] == 'order' ? 'checked' : '' }}>
                                         <label id="left1" for="checko322"> En Livraison
                                        </label>
                                    </div>
                                    </div>

                                </div>
                            </div>
    @if($getOrder['orderType'] == 'order')
                            <div class="col-md-12">
                                <div class="input-box mb-20">
                                      <select wire:model.lazy="zip" name="customer_zip" class="form-control">
                                                <option value="1">--Code postal*--</option>
                                                   @foreach($sp as $s)
                                                <option value="{{$s->id}}">{{$s->km}}</option>
                                                   @endforeach
                                            </select>
                                    @error('zip') <span class="error" style="color: red">{{ $message }}</span> @enderror
                                </div>
                                <div class="input-box mb-20">
                                   <input type="text" wire:model="address" required placeholder="Num de la rue*" name="address" class="form-control">
                                    @error('address') <span class="error" style="color: red">{{ $message }}</span> @enderror
                                </div>
                                <div class="input-box mb-20">
                                    <input type="text" wire:model="customer_city" name="customer_city" class="form-control" required placeholder="Nom de la rue*">
                                    @error('customer_city') <span class="error" style="color: red">{{ $message }}</span> @enderror
                                </div>

                            </div>

                            <!-- for Deliver -->
                            <div class="col-md-12">
                                <div class="cart-total-table commun-table mt-5">
                                <div class="table-responsive">
                                <table class="table border">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-center-r">Cart Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Item(s) Subtotal</td>
                                            <td>
                                                <div class="price-box">
                                                    <span class="price">€ {{$total + $nn}}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        @if(session()->get('getVoucher') != null)
                                        <tr>
                                            <td>Voucher Discount</td>
                                            <td>
                                                <div class="price-box">
                                                    <span class="price">€ {{$nn}}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td>Frais de livraison</td>
                                            <td>
                                                <div class="price-box"> 
                                                    <span class="price">€ {{$getOrder['shipping']}}</span> 
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Amount Payable</b></td>
                                            <td>
                                                <div class="price-box"> 
                                                    <span class="price"><b>€ {{$total + $getOrder['shipping']}}</b></span> 
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                                </div>
                            </div>

                            <!-- Checkout Button -->
                            <div class="col-12 mt-30">
                                    <div class="right-side float-none-xs text-center-r float-none-sm">
                                        @if($isDeliver == 1)
                                        <a wire:click="getDataFOrmCustomer" class="btn btn-color">
                                            JE VALIDE MA COMMANDE
                                            <span><i class="fa fa-angle-right"></i></span>
                                        </a>
                                        @elseif($isDeliver == 2)
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>nous ne livrons pas de nourriture dans cette zone</strong>
                                            </div>
                                        @elseif($isDeliver == 3)
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>vous devez d'abord ajouter des produits au panier</strong>
                                            </div>
                                        @endif

                                    </div>
                            </div>
    @elseif($getOrder['orderType'] == 'takeway')

                            <!-- for Takeaway -->
                            <div class="col-md-12">
                                <div class="cart-total-table commun-table mt-5">
                                <div class="table-responsive">
                                <table class="table border">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-center-r">Cart Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Item(s) Subtotal</td>
                                            <td>
                                                <div class="price-box">
                                                    <span class="price">€ {{$total + $nn}}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        @if(session()->get('getVoucher') != null)
                                        <tr>
                                            <td>Voucher Discount</td>
                                            <td>
                                                <div class="price-box">
                                                    <span class="price">€ {{$nn}}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td>Remise ({{$set->discount}}%)</td>
                                            <td>
                                                <div class="price-box"> 
                                                    <span class="price">€ {{$getOrder['discount']}}</span> 
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Amount Payable</b></td>
                                            <td>
                                                <div class="price-box"> 
                                                    <span class="price"><b>€ {{$total - $getOrder['discount']}}</b></span> 
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                                </div>
                            </div>
                            <div class="col-12 mt-30">
                                    <div class="right-side float-none-xs text-center-r float-none-sm"> 
                                        <a href="/checkout" class="btn btn-color">JE VALIDE MA COMMANDE
                                            <span><i class="fa fa-angle-right"></i></span>
                                        </a>
                                    </div>
                            </div>
    @endif
                        </div>

@else
 <div class="row text-center">
                            <div class="col-md-12">
                                <div class="input-box mb-20">
                                    <label class="cusLabel">Order Type</label>
                                   <div class="cart-total-item">
                                    <div class="cart-check-box">
                                        <input type="radio" class="form-control" wire:model="tempOrderType" name="ship1" id="checko32" value="takeway">
                                         <label id="left1" for="checko32">A Emporter
                                        </label>
                                    </div>
                                    <div class="cart-check-box">
                                        <input type="radio" class="form-control" wire:model="tempOrderType" class="getAGeo" name="ship1" id="checko322" value="order">
                                         <label id="left1" for="checko322"> En Livraison
                                        </label>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
@endif
                        </div>
                    </div>

                </div>
            </div>

</div>
