<template>
    <div class="page-sidebar">
        <div class="sidebar-widget">
            <h4 class="my-cart-title">My Cart</h4>

            <table class="table">
                <tbody>
                <tr class="cartTable" v-for="(cartItem, key) in  cartItems" :key="key">
                    <td>
                        <img :src="cartItem.image" width="20px" height="20px"/>
                    </td>
                    <td>
                        <p class="pro_name">{{ cartItem.name }}</p>

                        <ul v-if="cartItem.hasOwnProperty('items')">
                            <li v-for="item in Object.values(cartItem.items)" :key="item.categoryId">
                                <h5><b>{{ item.categoryName }}:</b> {{ item.productName }}</h5>
                            </li>
                        </ul>
                        <p class="price"><b>{{ cartItem.offer_price | currency }}</b></p>
                    </td>
                    <td class="align-middle"><input min="0" class="customInput form-control"
                                                    @change="changeItemQuantity(key, $event)"
                                                    type="number"
                                                    :value="cartItem.quantity"/></td>
                    <td class="text-right align-middle">
                        <button class="btn btn-sm btn-danger" @click="removeFromCart(key)"><i
                            class="fa fa-trash"></i></button>
                    </td>
                </tr>

                <tr>
                    <td colspan="4">
                        <div class="subtotal">
                            <p class="text-left"><b>Total</b></p>
                            <p class="text-right"><b>{{ totalPrice | currency }}</b></p>
                        </div>
                    </td>
                </tr>

                <tr class="text-center">
                    <td colspan="4">
                        <div class="placeOrder">
                            <a :href="cartRoute">I VALIDATE MY ORDER</a>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>


        </div>
<!--         <div class="sidebar-widget">
            <img src="">
            <span>Address: Lorem ipsum dolor </span>
            <span>Opening Hours: Lorem ipsum dolor </span>
        </div> -->
    </div>
</template>

<script>
    export default {
        data() {
            return {
                cartItems: {},
                totalPrice: 0,
            }
        },
        props: {
            cartRoute: {
                type: String,
                required: true
            }
        },
        watch: {
            cartItems: function (val) {
                const items = _.values(val)
                _.set(this, "totalPrice", _.sumBy(items, item => item.offer_price * item.quantity))
                // _.set(this, "totalPrice", _.sumBy(items, item => item.itemTotal))
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
                _.set(this, "cartItems", this.getCartItems())
            },
            removeFromCart(id) {
                delete this.cartItems[id]
                this.setCartItems()
                this.loadItemsFromStorage()
                bus.$emit("removed-from-cart", id)
            },
            changeItemQuantity(itemId, event) {
                const quantity = +event.target.value

                if (quantity === 0) {
                    this.removeFromCart(itemId)
                } else {
                    const offer_price = _.get(this.cartItems, [itemId, "offer_price"], 0)
                    _.update(this.cartItems, `${itemId}.quantity`, () => +event.target.value)
                    _.update(this.cartItems, `${itemId}.itemTotal`, (total) => offer_price * (+event.target.value))
                    this.setCartItems()
                }
                bus.$emit("changed-cart-item", itemId, quantity)
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
