import { legacy_createStore as createStore } from 'redux';

const reducer = (store = null, action) => {  
  switch (action.type) {
    case 'CHANGE_STATE_CARTS':
      return {
        cartsReducer: action.cartsAfterRemove
      };
    //...other events... 
    default:
      return store;
  }
};

export const store = createStore(reducer);
