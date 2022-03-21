<template>
    <div class="single-p-item">
        <div class="p-item-img">
            <img :src="productImage">
        </div>
        <div class="p-item-content"
             style="height: 50px;padding: 11px;">
            <h4 style="font-size: 15px">{{ productName }}</h4>

            <div class="p-item-content-hover">
                <button class="add-to-cart" @click="addToStaging"><span><i class="fas fa-cart-arrow-down"></i></span>
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
            menuData: Object,
            productId: Number,
            menuImage: String,
            categoryId: Number,
            categoryName: String,
            productName: String,
            productImage: String,
        },
        computed: {},
        methods: {
            addToStaging: function () {
                const {
                    menuData,
                    productId,
                    menuImage,
                    categoryId,
                    productName,
                    categoryName,
                    productImage,
                } = this

                const menuId = _.get(menuData, "id", 0)
                const menuName = _.get(menuData, "name", "")
                const menuDescription = _.get(menuData, "des", "")
                const menuPrice = _.toNumber(_.get(menuData, "price", 0))
                const setmenuData = JSON.parse(localStorage.getItem("setmenu")) || {}
                const menuItems = _.get(setmenuData, [menuId, "items"], {})
                _.set(menuItems, [categoryId], {
                    productId,
                    categoryId,
                    productName,
                    categoryName,
                })
                _.set(setmenuData, [menuId], {
                    id: menuId,
                    quantity: 1,
                    name: menuName,
                    items: menuItems,
                    image: menuImage,
                    itemTotal: menuPrice,
                    offer_price: menuPrice,
                    description: menuDescription,
                })
                localStorage.setItem("setmenu", JSON.stringify(setmenuData))
                bus.$emit("added-to-setmenu")
            }
        },
        mounted() {
        },
        created() {
        }
    }
</script>
