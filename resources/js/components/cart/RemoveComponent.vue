<template>
   <div><a class="btn btn-danger listbuttonremove" href="#" @click="removeCart(cartId, productId, sizeId, qty)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['cartId', 'productId', 'sizeId', 'qty'],
        data: function() {
           return {
              //...
           }
        },
        mounted() {
           //...
        },
        methods: {
            removeCart(id, productId, sizeId, qty) {
               event.preventDefault();

               let self = this; //!!!self - becouse axios

               axios
               .post('/clearone', {id: id, product_id: productId, size_id: sizeId, qty: qty})
                  .then(function (resp) {
                     console.log(resp.data);

                     //self.carts = resp.data; //!!!self - becouse axios
                     //self.handleCart(resp.data);

                     self.$store.commit('setCarts', resp.data);
                  })
                  .catch(function (resp) {
                     console.log(resp.response);
                     alert("Could not delete cart");
                  });            
            },

        },
    }
</script>
