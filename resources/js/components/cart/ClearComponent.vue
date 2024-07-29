<template>
      <div class="cart_buttons d-flex flex-row align-items-start justify-content-start">
         <div class="cart_buttons_inner ml-sm-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
            <div class="button button_clear trans_200" @click="clearCart(carts)"><a href="#">clear</a></div>
         </div>                 
      </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['carts'],
        data: function() {
           return {
              //...
           }
        },
        mounted() {
           //...
        },
        methods: {
            clearCart(carts) {
               event.preventDefault();

               let self = this; //!!!self - becouse axios

               axios
               .post('/clearall', {carts: carts})
                  .then(function (resp) {
                     console.log(resp.data);

                     //self.handleCart(resp.data); //!!!self - becouse axios
                     self.$store.commit('setCarts', resp.data);
                  })
                  .catch(function (resp) {
                     console.log(resp);
                     alert("Could not delete cart");
                  });            
            },            

        },
    }
</script>
