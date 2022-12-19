import { createStore } from "vuex";
// import { showCartApi } from "@/api/carts";

import { getMyDataApi } from "@/api/auth";
import { getCartData, setProductPrice, setCouponCode, allDeleteProductPriceData, deleteCouponCode } from "@/utils/cart";
import { showCartMineApi } from "@/api/carts";

// import { getCart } from "@/utils/cart";

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
      try {
        let myDataApiResult = await getMyDataApi();
        if (!myDataApiResult.success) {
          commit("setAuthData", {
            myData: null,
            isLogin: false,
          });
          return;
        }
        commit("setAuthData", {
          myData: myDataApiResult.data,
          isLogin: true,
        });
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
      const productPriceData = getCartData();
      console.log("data",productPriceData);
      const apiResult = await showCartMineApi(productPriceData);
      if (!apiResult.success) {
        // alert('カートの更新に失敗しましたので、カート情報がリセットされました。');
        allDeleteProductPriceData();
        deleteCouponCode();
        return;
      }
      commit("setCartData", apiResult.data);
      setProductPrice(apiResult.data.cart_in_product_prices.product_prices);
      setCouponCode(apiResult.data.cart.coupon_code);
      if (apiResult?.data?.cart?.is_delete_product_price) {
        alert('商品が削除されていたため、カートが更新されました。');
      }
      return apiResult.data;
    },
  },
  modules: {},
});
