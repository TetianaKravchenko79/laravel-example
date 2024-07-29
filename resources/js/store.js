import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    carts: [], //!!!state
  },
  getters:{
    getCarts(state) { //!!!getter
      return state.carts;
    },
  },
  mutations: {
    setCarts: (state, payload) => { //!!!mutation-setter
      state.carts = payload;
    },    
  },
})

