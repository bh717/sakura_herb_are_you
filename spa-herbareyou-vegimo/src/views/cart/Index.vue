<template>
  <div class="wrapper cart">
    <Header />
    <main class="main">
      <article>
        <section class="sec" v-if="isShow">
          <div class="sec-container" v-if="!$store.state.cart.total_num">
            <h2 class="sec-container-hd2">カート</h2>
            <img
              src="@/assets/img/cart/cart-zero.svg"
              alt=""
              class="vacant-img"
            />
            <p class="vacant-txt">カートはまだ空のようです</p>
            <router-link class="vacant-link" :to="{ name: 'Home' }">
              TOPへ戻る
            </router-link>
          </div>
          <div class="sec-container" v-else>
            <h2 class="sec-container-hd2">カート</h2>
            <div class="cart-container">
              <div
                class="cart-item clearfix"
                v-for="(cartDetail, index) in $store.state.cart_details"
                v-bind:key="index"
              >
                <div class="cart-item__right1">
                  <p class="cart-item__sub">
                    {{ cartDetail.product.category.name }}
                  </p>
                  <h3 class="cart-item__ttl">
                    <span class="cart-item__ttl-num">{{
                      cartDetail.product.product_no
                    }}</span>
                    <span class="cart-item__ttl-main"
                      >{{ cartDetail.product.name1 }}　¥{{
                        cartDetail.product_price.price
                      }}<br />
                      <span class="cart-item__ttl-main-child">{{
                        cartDetail.product.name2
                      }}</span>
                    </span>
                  </h3>
                  <p class="cart-item__material">
                    {{
                      pageService.cutText(
                        20,
                        "…",
                        pageService.implode(
                          "、",
                          pageService.pluck(
                            "name",
                            cartDetail.product.materials
                          )
                        )
                      )
                    }}
                  </p>
                </div>
                <div class="cart-item__left">
                  <img :src="cartDetail.product.upload_files[0].url" alt="" />
                </div>
                <div class="cart-item__right2">
                  <div class="counter">
                    <div
                      class="counter__left js-counter-down"
                      v-on:click="countDown(cartDetail.product_price_id)"
                    >
                      −
                    </div>
                    <input
                      type="text"
                      name="amount"
                      :value="cartDetail.num"
                      class="counter__amount"
                      v-on:change="
                        changeProductNum($event, cartDetail.product_price_id)
                      "
                    />
                    <div
                      class="counter__right js-counter-up"
                      v-on:click="countUp(cartDetail.product_price_id)"
                    >
                      ＋
                    </div>
                  </div>
                  <div class="acd-select">
                    <div class="acd-select__head">
                      <p class="acd-select__txt">
                        {{ cartDetail.product_price.capacity }} ¥{{
                          cartDetail.product_price.price
                        }}
                      </p>
                      <div class="acd-select__taxin js-acdSelect-btn">
                        Tax in
                      </div>
                    </div>
                    <input
                      type="hidden"
                      name="amount"
                      class="acd-select__input"
                      value=""
                    />
                    <ul class="acd-select__list">
                      <li
                        id=""
                        class="acd-select__item"
                        v-for="price in cartDetail.product.prices"
                        v-bind:key="price.id"
                        v-on:click="
                          changeProductPrice(
                            cartDetail.product_price_id,
                            price.id,
                            cartDetail.num
                          )
                        "
                      >
                        {{ price.capacity }} ¥{{ price.price }}
                      </li>
                    </ul>
                  </div>
                </div>
                <a
                  href=""
                  class="cart-item__del"
                  v-on:click="
                    destroyCartDetail(
                      cartDetail.product_price_id,
                      cartDetail.num
                    )
                  "
                ></a>
              </div>
            </div>
            <div class="coupon" v-if="$store.state.cart.total_num !== 0">
              <label for="coupon" class="coupon__label">クーポンコード</label>
              <input
                type="text"
                name="coupon"
                id="coupon"
                placeholder="00000-00-0000000"
                class="coupon__input"
                v-model="couponCode"
                v-on:change="effectivenessCoupon()"
              />
              <ValidateError :errorMessages="validateErrors.coupon_code" />
            </div>
            <div class="payment" v-if="$store.state.cart.total_num !== 0">
              <div class="payment__order-price">
                <p class="payment__order-price-title">ご注文金額</p>
                <p class="payment__order-price-num">
                  ¥{{ $store.state.cart.total_product_price }}
                </p>
              </div>
              <div
                class="payment__postage"
                v-if="$store.state.cart.total_num !== 0"
              >
                <p class="payment__postage-title">送料</p>
                <p class="payment__postage-num">
                  ¥{{ $store.state.cart.total_delivery_charge }}
                </p>
              </div>
              <div
                class="payment__discout"
                v-if="$store.state.cart.total_num !== 0"
              >
                <p class="payment__discout-title">割引</p>
                <p class="payment__discout-num">
                  - ¥{{ $store.state.cart.coupon_discount_price }}
                </p>
              </div>
              <div
                class="payment__sum"
                v-if="$store.state.cart.total_num !== 0"
              >
                <p class="payment__sum-title">合計</p>
                <p class="payment__sum-num">
                  ¥{{ $store.state.cart.total_price }}
                </p>
              </div>
            </div>

            <div class="bc-btn" v-if="$store.state.cart.total_num !== 0">
              <!-- <router-link :to="{ name: 'CartPurchase' }"> -->
              <button
                class="b-btn__btn"
                :disabled="submitDisable"
                v-on:click="toPurchase()"
              >
                購入手続きへ
              </button>
              <!-- </router-link> -->
            </div>
          </div>
        </section>
      </article>
    </main>
    <Footer />
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { CommonScriptService } from "@/services/CommonScriptService";
import { PageService } from "@/services/PageService";
import Footer from "@/components/Footer.vue";
import Header from "@/components/Header.vue";
import ValidateError from "@/components/ValidateError.vue";
import { addProductPriceData, deleteProductPriceData } from "@/utils/cart";
import { effectivenessCouponApi } from "@/api/coupon";
import { setCouponCode, deleteCouponCode } from "@/utils/cart";
import { getCartData } from "@/utils/cart";

export default defineComponent({
  name: "CartIndex",
  watch: {},
  data() {
    return {
      isShow: false,
      message: "",
      validateErrors: {} as any,
      submitDisable: false,
      carts: [] as any[],
      couponCode: "",
      pageService: new PageService(),
      commonScriptService: new CommonScriptService(),
      $store: this.$store as any,
    };
  },
  components: {
    Footer,
    Header,
    ValidateError,
  },
  created: async function () {},
  mounted: async function (): Promise<void> {
    document.body.className = "cart";
    this.couponCode = this.$store.state.cart?.coupon_code ?? "";
    this.isShow = true;
    this.$nextTick(function () {
      this.commonScriptService.execute();
    });
  },
  methods: {
    countUp: async function (
      cartDetailId: number
      // nowNum: number
    ): Promise<void> {
      addProductPriceData(cartDetailId, 1);
      await this.$store.dispatch("setCartData");
      this.couponCode = this.$store.state.cart?.coupon_code ?? "";
    },
    countDown: async function (
      cartDetailId: number
      // nowNum: number
    ): Promise<void> {
      addProductPriceData(cartDetailId, -1);
      await this.$store.dispatch("setCartData");
      if (this.couponCode !== this.$store.state.cart?.coupon_code ?? "") {
        this.couponCode = "";
        alert(
          "購入金額がクーポンの使用ができない金額のためクーポンは削除されました"
        );
      }
    },
    // 個数はそのままで商品を交換する
    changeProductPrice: async function (
      oldPriceId: number,
      selectPriceId: number,
      num: number
    ): Promise<void> {
      addProductPriceData(oldPriceId, -1 * num);
      addProductPriceData(selectPriceId, num);
      await this.$store.dispatch("setCartData");
      if (this.couponCode !== this.$store.state.cart?.coupon_code ?? "") {
        this.couponCode = this.$store.state.cart?.coupon_code ?? "";
        alert(
          "購入金額がクーポンの使用ができない金額のためクーポンは削除されました"
        );
      }
    },
    // 直接入力された個数の変更
    changeProductNum: async function (
      event: any,
      cartDetailId: number
    ): Promise<void> {
      const num = Number(event.target.value);
      if (isNaN(num) || num < 0) {
        alert("正の整数を入力してください");
        return;
      }
      deleteProductPriceData(cartDetailId);
      addProductPriceData(cartDetailId, num);
      await this.$store.dispatch("setCartData");
    },
    destroyCartDetail: async function (
      selectPriceId: number,
      num: number
    ): Promise<void> {
      addProductPriceData(selectPriceId, -1 * num);
      await this.$store.dispatch("setCartData");
    },
    effectivenessCoupon: async function (): Promise<void> {
      if (!this.couponCode || !this.couponCode.match(/\S/g)) {
        this.couponCode = "";
        return;
      }
      const cartData = getCartData();
      const couponCodeResult = await effectivenessCouponApi(
        cartData.product_prices,
        this.couponCode
      );
      if (!couponCodeResult.success) {
        deleteCouponCode();
        await this.$store.dispatch("setCartData");
        if (couponCodeResult.status === 422) {
          alert(couponCodeResult.data.coupon_code[0]);
        } else {
          alert("サーバーエラーです");
        }
        return;
      }
      setCouponCode(this.couponCode);
      await this.$store.dispatch("setCartData");
    },
    toPurchase() {
      if (this.$store.state.isLogin) {
        this.$router.push({
          name: "CartPurchase",
        });
        return;
      }
      this.$router.push({
        name: "MyPageLogin",
        query: {
          redirect_name: "CartPurchase",
        },
      });
    },
  },
});
</script>

<style scoped src="@/assets/css/cart.css"></style>
