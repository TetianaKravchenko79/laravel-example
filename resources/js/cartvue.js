window.Vue = require("vue");

import CartComponent from "./components/cart/CartComponent.vue"; //!!!
import store from "./store";
const app = new Vue({
    el: ".cart_block", //+ in cart.blade.php root-element <div class="cart_block">
    store,
    components: { CartComponent },
    template: "<CartComponent />",
});
