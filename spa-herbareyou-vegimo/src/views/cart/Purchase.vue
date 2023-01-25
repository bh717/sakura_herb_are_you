<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article>
        <section class="sec">
          <div class="sec-container">
            <h2 class="sec-container-hd2">ご購入手続き</h2>
            <div
              class="purchase-container"
              v-if="$store.state.cart.total_num !== 0"
            >
              <div
                class="purchase-item clearfix"
                v-for="(cartDetail, index) in $store.state.cart_details"
                v-bind:key="cartDetail.id"
              >
                <div
                  v-bind:class="{
                    'purchase-item__right1': (index + 1) % 2 === 1,
                    'purchase-item__right2': (index + 1) % 2 === 2,
                  }"
                >
                  <p class="purchase-item__sub">
                    {{ cartDetail.product.category.name }}
                  </p>
                  <h3 class="purchase-item__ttl">
                    <span class="purchase-item__ttl-num">{{
                      cartDetail.product.product_no
                    }}</span>
                    <span class="purchase-item__ttl-main"
                      >{{ cartDetail.product.name1 }}　¥{{
                        cartDetail.product_price.price
                      }}<br />
                      <span class="purchase-item__ttl-main-child">{{
                        cartDetail.product.name2
                      }}</span>
                    </span>
                  </h3>
                  <p class="purchase-item__material">
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
                <div class="purchase-item__left">
                  <img :src="cartDetail.product.upload_files[0].url" alt="" />
                </div>
                <div class="purchase-item__right2">
                  <p class="purchase-item__num">{{ cartDetail.num }}</p>
                  <p class="purchase-item__price">
                    {{ cartDetail.product_price.capacity }} ¥{{
                      cartDetail.product_price.price
                    }}
                  </p>
                </div>
              </div>
            </div>
            <div class="payment" v-if="$store.state.cart.total_num !== 0">
              <div class="payment__order-price">
                <p class="payment__order-price-title">ご注文金額</p>
                <p class="payment__order-price-num">
                  ¥{{ $store.state.cart.total_product_price }}
                </p>
              </div>
              <div class="payment__postage">
                <p class="payment__postage-title">送料</p>
                <p class="payment__postage-num">
                  ¥{{ $store.state.cart.total_delivery_charge }}
                </p>
              </div>
              <div class="payment__discout">
                <p class="payment__discout-title">割引</p>
                <p class="payment__discout-num">
                  - ¥{{ $store.state.cart.coupon_discount_price }}
                </p>
              </div>
              <div class="payment__sum">
                <p class="payment__sum-title">合計</p>
                <p class="payment__sum-num">
                  ¥{{ $store.state.cart.total_price }}
                </p>
              </div>
            </div>
            <div
              class="purchaser-info"
              v-if="$store.state.cart.total_num !== 0"
            >
              <h3 class="purchaser-info__hd3">
                <span class="purchaser-info__hd3-title">購入者情報</span>
                <router-link
                  class="purchaser-info__hd3-change"
                  :to="{
                    name: 'MyPageRegistered',
                    query: {
                      redirect_name: 'CartPurchase',
                    },
                  }"
                  >変更</router-link
                >
              </h3>
              <div class="purchaser-info__detail">
                <p class="purchaser-info__detail-name">
                  {{ $store.state.myData.last_name
                  }}{{ $store.state.myData.first_name }}
                </p>
                <p class="purchaser-info__detail-address">
                  {{ $store.state.myData.zip }}
                  {{ $store.state.myData.address1 }}
                </p>
                <p class="purchaser-info__detail-tel">
                  {{ $store.state.myData.tel1 }}
                </p>
                <p class="purchaser-info__nail">
                  {{ $store.state.myData.emil }}
                </p>
              </div>
            </div>
            <div class="address-info" v-if="$store.state.cart.total_num !== 0">
              <h3 class="address-info__hd3">
                <span class="address-info__hd3-title">お届け先情報</span>
                <router-link
                  class="address-info__hd3-change"
                  :to="{
                    name: 'MyPageDeliveryLocation',
                    query: {
                      redirect_name: 'CartPurchase',
                    },
                  }"
                  >変更</router-link
                >
              </h3>
              <div class="address-info__detail">
                <p class="address-info__detail-name">
                  {{ deliveryLocation.last_name
                  }}{{ deliveryLocation.first_name }}
                </p>
                <p class="address-info__detail-address">
                  {{ deliveryLocation.zip }} {{ deliveryLocation.address1 }}
                </p>
                <p class="address-info__detail-tel">
                  {{ deliveryLocation.tel1 }}
                </p>
                <p class="address-info__nail">{{ deliveryLocation.emil }}</p>
              </div>
            </div>
            <div class="delivery-date" v-if="$store.state.cart.total_num !== 0">
              <h3 class="delivery-date__hd3">
                <span class="delivery-date__hd3-title">お届け日</span>
                <span class="delivery-date__hd3-normal"
                  >（ゆうパケットでのポスト投函でのお届けとなります）</span
                >
              </h3>
              <ul class="delivery-date-list">
                <li class="delivery-date-item">
                  <input
                    type="radio"
                    id="delivery-1"
                    name="delivery"
                    class="delivery-date-item__check"
                    checked
                    disabled
                  />
                  <label for="delivery-1" class="delivery-date-item__label"
                    >指定しない</label
                  >
                </li>
                <!-- <li class="delivery-date-item delivery-date-item--flex">
                  <div>
                    <input
                      type="radio"
                      id="delivery-2"
                      name="delivery"
                      class="delivery-date-item__check"
                    />
                    <label for="delivery-2" class="delivery-date-item__label"
                      >指定する</label
                    >
                  </div>
                  <div class="delivery-select">
                    <a class="delivery-select__txt js-deliverySelect-btn">{{
                      selectedDeliveredAt
                    }}</a>
                    <input
                      type="hidden"
                      name="delivery"
                      class="delivery-select__input"
                      value=""
                    />
                    <ul class="delivery-select__list">
                      <li
                        :id="date"
                        class="delivery-select__item"
                        v-for="(date, index) in deliveredAtList"
                        v-bind:key="index"
                        v-on:click="selectDeliveredAt(date)"
                      >
                        {{ date }}
                      </li>
                    </ul>
                  </div>
                </li> -->
              </ul>
            </div>
            <div class="method" v-if="$store.state.cart.total_num !== 0">
              <h3 class="method__hd3">
                <span class="method__hd3-title">お支払い方法</span>
                <span class="method__hd3-img"
                  ><img src="@/assets/img/cart/cards.png" alt=""
                /></span>
              </h3>
              <div class="method__credit">
                <div class="method-content">
                  <input
                    type="checkbox"
                    id="credit"
                    name="credit"
                    class="method-content__check"
                    checked
                    disabled
                  />
                  <label for="credit" class="method-content__label"
                    >クレジットカード</label
                  >
                </div>
              </div>
            </div>
            <div class="btn" v-if="$store.state.cart.total_num !== 0">
              <a
                href=""
                class="btn__inner"
                v-on:click="storeOrder($event)"
                :disabled="submitDisable"
                >決済する</a
              >
            </div>
            <div class="back">
              <router-link :to="{ name: 'CartIndex' }" class="back__inner"
                >カートに戻る</router-link
              >
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

import { getDeliveredListApi } from "@/api/orders";
import { showUserDeliveryLocationApi } from "@/api/users";
import { storeOrderApi } from "@/api/orders";
import { getCartData } from "@/utils/cart";

export default defineComponent({
  name: "CartPurchase",
  watch: {},
  data() {
    return {
      isShow: false,
      message: "",
      validateErrors: {} as any,
      submitDisable: false,
      carts: [] as any[],
      couponCode: "",
      deliveryLocation: {} as any,
      selectedDeliveredAt: "",
      deliveredAtList: [] as string[],
      commonScriptService: new CommonScriptService(),
      pageService: new PageService(),
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
    document.body.className = "purchase";
    // お届け先
    const deliveryLocationResult = await showUserDeliveryLocationApi();
    if (!deliveryLocationResult.success) {
      return;
    }
    this.deliveryLocation = deliveryLocationResult.data;
    // 日付
    const ordersGetDeliveredAtListApiResult = await getDeliveredListApi();
    if (!deliveryLocationResult.success) {
      return;
    }
    this.deliveredAtList = ordersGetDeliveredAtListApiResult.data;

    this.isShow = true;
    this.$nextTick(function () {
      this.commonScriptService.execute();
    });
  },

  methods: {
    storeOrder: async function (event: any) {
      event.preventDefault();
      if (!this.deliveryLocation.last_name) {
        alert("お届け先情報を登録してください");
        return;
      }
      this.submitDisable = true;
      const cartData = getCartData();
      const storeOrderResult = await storeOrderApi(
        cartData.product_prices,
        cartData.coupon_code
      );
      console.log(storeOrderResult);
      if (storeOrderResult.success === 422) {
        alert("入力に間違いがあります");
        return;
      }
      if (!storeOrderResult.success) {
        alert("購入に失敗しました");
        this.submitDisable = false;
        return;
      }
      window.location.href = storeOrderResult.data.redirect_url;
      return;
    },
    selectDeliveredAt(selectedDeliveredAt: string): void {
      this.selectedDeliveredAt = selectedDeliveredAt;
    },
  },
});
</script>
<style scoped src="@/assets/css/purchase.css"></style>
