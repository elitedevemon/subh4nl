<template>
    <div class="single-p-item">
        <div class="p-item-img">
            <img :src="image">
            <div class="p-item-share d-table">
                <div class="d-table-cell">
                    <ul>
                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="p-item-content">
            <div>

                <h4 class="title">{{ name }}</h4>
            </div>

            <div><span class="sale-price">{{ offer_price | currency }}</span></div>
            <div></div>

            <div class="p-item-content-hover">
                <p>{{ description }}</p>
                <button class="add-to-cart" @click="addToCart"><span><i class="fas fa-cart-arrow-down"></i></span>
                    Ajouter
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {}
        },
        props: {
            id: {type: Number, required: true},
            image: {type: String, required: true},
            name: {type: String, required: true},
            offer_price: {type: Number, required: true},
            description: {type: String, required: true},
        },
        methods: {
            addToCart: function () {
                const previousCarts = JSON.parse(localStorage.getItem("cart")) ?? {}
                const previousQuantity = _.get(_.get(previousCarts, this.id), "quantity", 0)
                const newQuantity = previousQuantity + 1;
                const {id, name, image, offer_price, description} = this
                const newCartItem = {
                    id,
                    name,
                    image,
                    offer_price,
                    description,
                    quantity: newQuantity,
                    itemTotal: newQuantity * offer_price
                }
                previousCarts[this.id] = newCartItem
                localStorage.setItem("cart", JSON.stringify(previousCarts))
                bus.$emit("added-to-cart", newCartItem)
            }
        }
    }
</script>
