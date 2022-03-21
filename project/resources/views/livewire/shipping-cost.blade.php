<div>
	<div class="cart-total-item">
		<h4>Frais de livraison</h4> <!-- shipping -->
		<p>€{{$shippingCost}}</p>
	</div>
	<div class="cart-total-item cart-total-bold">
		<h4 class="color-white">Total</h4>
		<p>€{{$getOrder['grand'] + $shippingCost}}</p>
	</div>
</div>