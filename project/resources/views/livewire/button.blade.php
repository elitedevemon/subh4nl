<div>
	 <?php 
          $sett = \App\Models\setting::find(1);

                                     ?>
	<div wire:poll  class="main-button-area">
		    @if($getOrder['grand'] < $sett->limit_min || $getOrder['grand'] > $sett->limit_max)
                                    <div class="alert alert-danger">
                                        <b>Order Limit Minimum {{$sett->limit_min}} & Maximum {{$sett->limit_max}}</b>
                                    </div>
                                @else
                                    <div>
                                        @if($getOrder['orderType'] == null)
                                        <div class="alert alert-danger">
                                            <b>Veuillez vous rendre sur la page du panier pour définir votre type de commande, sauf si vous ne serez pas commandé</b>
                                        </div>
                                        @else

                                            @if(isset($getOrder['km']))
                                                @if(10 >= $getOrder['km'])
                                                 <a href="/checkout" class="btn">JE VALIDE MA COMMANDE</a>
                                                @else
                                                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                      <strong>
                                                      nous ne prenons pas de commandes En dehors de 10 km
                                                  </strong>
                                                </div>
                                                @endif
                                            @else

                                            @if($alertHide == 'show')
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                      <strong>
                                                      Il faut autoriser la localisation puis recharger la pagecc
                                                  </strong>
                                                </div>
                                            @else
                                              @if(isset($getOrder['km']))
                                                @if(10 >= $getOrder['km'])
                                                 <a href="/checkout" class="btn">JE VALIDE MA COMMANDE</a>
                                                @else
                                                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                      <strong>
                                                      nous ne prenons pas de commandes En dehors de 10 km
                                                  </strong>
                                                </div>
                                                @endif
                                              @endif

                                            @endif

                                        @endif

                                        @endif

                                    @endif
                                    </div>
	</div>
</div>