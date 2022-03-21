<template>
    <div class="single-p-item1" id="single-content">
        <div class="row">
            <div class=" col-md-6 col-lg-6 col-sm-6 col-12">
                <img :src="menuSummary.image" alt="" class="img-fluid">
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-12">
                <h3> {{ menuSummary.name }} </h3>

                <ul>
                    <li v-for="item in menuItems" :key="item.productId">
                        <h6>{{ item.productName }}</h6>
                    </li>
                </ul>

        <button class="add-to-cart " @click="addToCart"> Ajouter</button>
        <button class="add-to-cart " @click="done">done</button>
                
            </div>
        </div>

    </div>
</template>


<script>
    export default {
        data() {
            return {
                menuSummary: {},
                menuItems: [],
                cartItems: {},
            }
        },
        props: {
            menuData: Object,
        },
        computed: {},
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
            loadMenuData: function () {
                const {menuData} = this;
                const menuId = _.get(menuData, "id", 0)
                const stagingData = JSON.parse(localStorage.getItem("setmenu")) ?? {}
                const menuSummary = _.get(stagingData, [menuId], {})
                const menuItems = _.values(_.get(menuSummary, "items", {}))
                this.menuSummary = menuSummary
                this.menuItems = menuItems
            },
            addToCart: function () {
                const {menuData, menuSummary, cartItems} = this;
                const menuId = _.get(menuData, "id", 0)
                const menuItems = _.values(_.get(menuSummary, "items", {}))
                const cartKey = _.reduce(menuItems, function (acc, curr) {
                    return `${acc}-${curr.categoryId}-${curr.productId}`
                }, menuId);

                if (_.has(cartItems, cartKey)) {
                    const previousSetmenu = _.get(cartItems, cartKey, {})
                    const previousQuantity = _.get(previousSetmenu, "quantity", 0)
                    const offerPrice = _.get(previousSetmenu, "offer_price", 0)
                    const newQuantity = previousQuantity + 1;

                    _.set(previousSetmenu, "quantity", newQuantity)
                    _.set(previousSetmenu, "itemTotal", newQuantity * offerPrice)
                } else {
                    _.set(cartItems, cartKey, menuSummary)
                }

                this.setCartItems()
                bus.$emit("added-to-cart", menuSummary)
            },
            done: function () {
                localStorage.removeItem("setmenu")
                window.location.replace("/");
            }
        },
        mounted() {
            this.loadMenuData()
            this.loadItemsFromStorage()
        },
        created() {
            bus.$on("added-to-setmenu", product => {
                this.loadMenuData()
            })

            bus.$on("added-to-cart", product => {
                this.loadItemsFromStorage()
            })

            bus.$on("removed-from-cart", product => {
                this.loadItemsFromStorage()
            })

            bus.$on("changed-cart-item", (itemId, quantity) => {
                this.loadItemsFromStorage()
            })
        },

    }
</script>
