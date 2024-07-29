<template>
    <div>
        <div class="cart_items">
            <ul class="cart_items_list">
                <!-- Cart Item -->
                <li
                    v-for="(cart, index) in carts"
                    class="cart_item item_list d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-end justify-content-start"
                    style="width: 50%"
                >
                    <div
                        class="product d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start mr-auto"
                    >
                        <RemoveComponent
                            :cartId="cart.id"
                            :productId="cart.product.id"
                            :sizeId="cart.size.id"
                            :qty="cart.qty"
                        />
                        <div>
                            <div class="product_image">
                                <img
                                    :src="'images/' + cart.product.image"
                                    alt=""
                                />
                            </div>
                        </div>
                        <div class="product_name_container">
                            <div class="product_name">
                                <a :href="'/product/' + cart.product.id">{{
                                    cart.product.name
                                }}</a>
                            </div>
                            <div class="product_text">
                                Second line for additional info
                            </div>
                        </div>
                    </div>
                    <div class="product_price product_text">
                        {{ cart.product.price }}
                    </div>
                    <div class="product_size product_text">
                        {{ cart.size.name }}
                    </div>
                    <div class="product_size product_text">{{ cart.qty }}</div>
                    <!-- NEW -->
                </li>
                <!-- Cart Item -->
            </ul>
        </div>
        <ClearComponent :carts="carts" />
    </div>
</template>

<script>
import axios from "axios";
import { cartNativeJsObj } from "../cartNative";
import RemoveComponent from "./RemoveComponent.vue";
import ClearComponent from "./ClearComponent.vue";

export default {
    data: function () {
        return {
            carts: window.carts,
        };
    },
    components: {
        RemoveComponent,
        ClearComponent,
    },
    mounted() {
        console.log(window.carts);

        this.$store.subscribe((mutation, state) => {
            console.log(mutation.type);

            if (mutation.type == "setCarts")
                this.handleCart(this.$store.getters.getCarts); //!!!getter
        });
    },
    methods: {
        handleCart(carts) {
            this.carts = carts;

            cartNativeJsObj.selector = "#lblCartCount";

            cartNativeJsObj.changeValueSelector(carts.length);
        },
    },
};
</script>
