<template>
    <section class="page-content section-padding">
        <div class="container">
            <div class="row">


                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="order-section">
                        <div class="cart-menu">
                            <ul>
                                <li class="active"><a href="cart.html">1 My Cart</a></li>
                                <li><a href="payment.html">2 Payment</a></li>
                                <li><a href="confirm.html">3 Confirm </a></li>
                            </ul>

                        </div>
                        <div class="user-profile">
                            <div class="row">
                                <div class="col-lg-6">
                                    <span v-if="!!authName">
                                        Hello MR. {{ authName }}
                                    </span>
                                </div>
                                <div class="col-lg-6">
                                    <button v-if="!!authName" type="submit" :formaction="logoutRoute" class="boxed-btn">
                                        Log Out
                                    </button>
                                </div>
                            </div>
                        </div>
                        <span class="cart-title">My Cart</span>
                        <span class="order-type">order type: in Delivery</span>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col" class="text-left">Product</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Amount</th>
                                <th scope="col">total Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(cartItem, key) in cartItems">
                                

                                <td>
                                    <input type="hidden" :name="`items[${key}][id]`" :value="cartItem.id">
                                <input type="hidden" :name="`items[${key}][name]`" :value="cartItem.name">
                                <input type="hidden" :name="`items[${key}][image]`" :value="cartItem.image">
                                <input type="hidden" :name="`items[${key}][quantity]`"
                                       :value="cartItem.quantity">
                                <input type="hidden" :name="`items[${key}][itemTotal]`"
                                       :value="cartItem.itemTotal">
                                <input type="hidden" :name="`items[${key}][description]`"
                                       :value="cartItem.description">
                                <input type="hidden" :name="`items[${key}][offer_price]`"
                                       :value="cartItem.offer_price">

                                <span v-if="cartItem.hasOwnProperty('items')">
                                    <input v-for="item in cartItem.items" type="hidden" :name="`items[${key}][products][]`"
                                           :value="item.productId">
                                </span>
                                    <img :src="cartItem.image"> {{ cartItem.name }}
                                </td>
                                <td class="align-middle">{{ cartItem.offer_price | currency }}</td>
                                <td class="align-middle">
                                    <button type="button" class="customBtn" data-decrease
                                            @click="decreaseCartItem(key)">-
                                    </button>
                                    <input data-value type="text" :value="cartItem.quantity" disabled/>
                                    <button type="button" class="customBtn" data-increase
                                            @click="increaseCartItem(key)">+
                                    </button>
                                </td>
                                <td class="align-middle">{{ cartItem.itemTotal | currency }}</td>
                            </tr>
                            </tbody>
                        </table>


                        <span class="cart-title">Total: <span
                            class="text-right">{{ totalPrice | currency }}</span></span>
                        <div class="order-validate">
                            <input type="hidden" name="pay_amount" :value="totalPrice">
                            <input type="hidden" name="total_quantity" :value="totalQuantity">
                            <button type="submit" class="boxed-btn">Order Now</button>
                        </div>

                    </div>
                </div>



            </div>
        </div>
    </section>
</template>


<script>
    export default {
        data() {
            return {
                cartItems: {},
            }
        },
        props: {
            logoutRoute: {
                type: String,
                required: true
            },
            authName: {
                type: String,
                default: ''
            }
        },
        computed: {
            items: function () {
                return _.values(this.cartItems)
            },
            totalPrice: function () {
                return _.sumBy(this.items, item => item.offer_price * item.quantity)
            },
            totalQuantity: function () {
                return _.sumBy(this.items, item => item.quantity)
            }
        },
        methods: {
            getCartItems() {
                return JSON.parse(localStorage.getItem("cart")) ?? {}
            },
            setCartItems() {
                localStorage.setItem("cart", JSON.stringify(this.cartItems))
            },
            loadItemsFromStorage() {
                this.cartItems = this.getCartItems()
            },
            removeFromCart(id) {
                delete this.cartItems[id]
                this.setCartItems()
                this.loadItemsFromStorage()
            },
            increaseCartItem(itemId) {
                const quantity = _.get(this.cartItems, [itemId, "quantity"], 0)

                const newQuantity = quantity + 1;
                const offer_price = _.get(this.cartItems, [itemId, "offer_price"], 0)
                _.update(this.cartItems, `${itemId}.quantity`, () => newQuantity)
                _.update(this.cartItems, `${itemId}.itemTotal`, () => offer_price * newQuantity)
                this.setCartItems()
                bus.$emit("changed-cart-item", itemId, newQuantity)
            },
            decreaseCartItem(itemId) {
                const quantity = _.get(this.cartItems, [itemId, "quantity"], 0)
                const newQuantity = quantity - 1;

                if (newQuantity === 0) {
                    this.removeFromCart(itemId)
                } else {
                    const offer_price = _.get(this.cartItems, [itemId, "offer_price"], 0)
                    _.update(this.cartItems, `${itemId}.quantity`, () => newQuantity)
                    _.update(this.cartItems, `${itemId}.itemTotal`, () => offer_price * newQuantity)
                    this.setCartItems()
                }
                bus.$emit("changed-cart-item", itemId, newQuantity)
            },
            proceedToPayment() {

            }
        },
        mounted() {
            this.loadItemsFromStorage()
        },
        created() {
            bus.$on("added-to-cart", product => {
                this.loadItemsFromStorage()
            })

            bus.$on("changed-cart-item", () => {
                this.loadItemsFromStorage()
            })
        }
    }
</script>
