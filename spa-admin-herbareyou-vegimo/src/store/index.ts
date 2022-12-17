import { createStore } from "vuex";
import { showCartApi } from "@/api/carts";

import { getMyDataApi } from "@/api/auth";

export default createStore({
  state: {
    myData: null as any,
    isLogin: false,
    cart: {} as any,
    cart_details: [] as any[],
  },
  mutations: {
    setAuthData(state, payload) {
      state.myData = payload.myData;
      state.isLogin = payload.isLogin;
    },
    deleteAuthData(state) {
      state.myData = null;
      state.isLogin = false;
    },
    setCartData(state, payload) {
      state.cart = payload.cart;
      state.cart_details = payload.cart_details;
    },
  },
  actions: {
    setAuthData: async ({ commit, state }): Promise<void> => {
      if (state.isLogin) {
        return;
      }
      try {
        let getMyDataApiResult = await getMyDataApi();
        if (!getMyDataApiResult.success) {
          commit("setAuthData", {
            myData: null,
            isLogin: false,
          });
          return;
        }
        commit("setAuthData", {
          myData: getMyDataApiResult.data,
          isLogin: true,
        });
        console.log("state.myData", state.myData);
      } catch (error) {
        commit("setAuthData", {
          myData: null,
          isLogin: false,
        });
      }
    },
    deleteAuthData: ({ commit, state }): void => {
      commit("setAuthData", {
        myData: null,
        isLogin: false,
      });
    },
    setCartData: async ({ commit, state }): Promise<void> => {
      if (!state.isLogin) {
        return;
      }
      const resultCartApi = await showCartApi();
      if (!resultCartApi.success) {
        commit("setCartData", {
          cart: {
            total_num: 0,
            total_product_price: 0,
            total_product_include_tax: 0,
            total_delivery_charge: 0,
            fee: 0,
            total_price: 0,
            coupon: null,
          },
          cart_details: [],
        });
        return;
      }
      commit("setCartData", {
        cart: resultCartApi.data.cart,
        cart_details: resultCartApi.data.cart_details,
      });
      console.log(state.cart);
      console.log(state.cart_details);
    },
  },
  modules: {},
});
