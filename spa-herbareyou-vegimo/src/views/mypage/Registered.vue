<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article v-if="isShow">
        <section class="sec">
          <div class="sec-container">
            <h2 class="sec-container__hd2">登録情報</h2>
            <div action="" class="form">
              <div class="form-parts-outer form-parts-outer--flex-sb">
                <div class="form-parts">
                  <label for="familyname" class="form-parts__label"
                    >姓（例：山田）</label
                  >
                  <input
                    type="text"
                    name="familyname"
                    v-model="params.last_name"
                    id="familyname"
                    class="form-parts__input"
                  />
                  <ValidateError :errorMessages="validateErrors.last_name" />
                </div>
                <div class="form-parts">
                  <label for="firstname" class="form-parts__label"
                    >名（例：花子）</label
                  >
                  <input
                    type="text"
                    name="firstname"
                    v-model="params.first_name"
                    id="firstname"
                    class="form-parts__input"
                  />
                  <ValidateError :errorMessages="validateErrors.first_name" />
                </div>
              </div>
              <div class="form-parts-outer form-parts-outer--flex-sb">
                <div class="form-parts">
                  <label for="familyname-en" class="form-parts__label"
                    >姓ローマ字（例：Yamada）</label
                  >
                  <input
                    type="text"
                    name="familyname-en"
                    v-model="params.last_name_kana"
                    id="familyname-en"
                    class="form-parts__input"
                  />
                  <ValidateError
                    :errorMessages="validateErrors.last_name_kana"
                  />
                </div>
                <div class="form-parts">
                  <label for="firstname-en" class="form-parts__label"
                    >名ローマ字（例：Hanako）</label
                  >
                  <input
                    type="text"
                    name="firstname-en"
                    v-model="params.first_name_kana"
                    id="firstname-en"
                    class="form-parts__input"
                  />
                  <ValidateError
                    :errorMessages="validateErrors.first_name_kana"
                  />
                </div>
              </div>
              <div class="form-parts-outer form-parts-outer--flex-center">
                <div class="form-parts">
                  <label for="mail" class="form-parts__label"
                    >メールアドレス</label
                  >
                  <input
                    type="text"
                    name="mail"
                    v-model="params.email"
                    id="mail"
                    class="form-parts__input"
                  />
                  <ValidateError :errorMessages="validateErrors.email" />
                </div>
              </div>
              <div class="form-parts-outer form-parts-outer--flex-center">
                <div class="form-parts">
                  <label for="pw" class="form-parts__label"
                    >パスワード(変更する場合記入)</label
                  >
                  <input
                    type="password"
                    name="pw"
                    v-model="params.password"
                    id="pw"
                    class="form-parts__input"
                  />
                  <ValidateError :errorMessages="validateErrors.password" />
                </div>
              </div>
              <div class="form-parts-outer form-parts-outer--flex-center">
                <div class="form-parts">
                  <label for="birthday" class="form-parts__label"
                    >お誕生日(例 1990/01/01)</label
                  >
                  <input
                    type="text"
                    name="birthday"
                    v-model="params.birthday"
                    id="birthday"
                    class="form-parts__input"
                  />
                  <ValidateError :errorMessages="validateErrors.birthday" />
                </div>
              </div>
              <div class="form-parts-outer form-parts-outer--flex-sb">
                <div class="form-parts form-parts--w19">
                  <label for="post" class="form-parts__label">郵便番号</label>
                  <input
                    type="text"
                    name="post"
                    v-model="params.zip"
                    id="post"
                    class="form-parts__input"
                  />
                  <ValidateError :errorMessages="validateErrors.zip" />
                </div>
                <div class="form-parts form-parts--w79">
                  <label for="address" class="form-parts__label">住所</label>
                  <input
                    type="text"
                    name="address"
                    v-model="params.address1"
                    id="address"
                    class="form-parts__input"
                  />
                  <ValidateError :errorMessages="validateErrors.address1" />
                </div>
              </div>
              <div class="form-parts-outer form-parts-outer--flex-center">
                <div class="form-parts">
                  <label for="tel" class="form-parts__label">電話番号</label>
                  <input
                    type="text"
                    name="tel"
                    v-model="params.tel1"
                    id="tel"
                    class="form-parts__input"
                  />
                  <ValidateError :errorMessages="validateErrors.tel1" />
                </div>
              </div>
              <div
                class="form-parts-outer form-parts-outer--flex-center magazine"
              >
                <div class="form-parts form-parts--nb magazine-content">
                  <input
                    type="checkbox"
                    id="magazine"
                    name="magazine"
                    class="magazine-content__input"
                    v-model="params.is_mail_magazine"
                  />
                  <label for="magazine" class="magazine-content__label"
                    >メールマガジンを希望する</label
                  >
                  <ValidateError
                    :errorMessages="validateErrors.is_mail_magazine"
                  />
                </div>
              </div>
              <div class="bc-btn bc-btn--mb50">
                <button
                  type="submit"
                  class="bc-btn__btn"
                  v-on:click="updateAuth()"
                  :disabled="submitDisable"
                >
                  登録する
                </button>
              </div>
            </div>
          </div>
        </section>
        <section class="sec">
          <div class="sec-container sec-container--exc">
            <h3 class="sec-container__hd3">購入履歴</h3>
            <ul class="procuct-list">
              <ul
                class="product-list clearfix"
                v-if="orderDetails.length !== 0"
              >
                <li
                  class="product-item"
                  data-anime="fadeup"
                  data-category="att-1"
                  v-for="orderDetail in orderDetails"
                  v-bind:key="orderDetail.id"
                >
                  <p class="product-item__date">
                    {{
                      pageService.dateFormmat1(orderDetail.order.created_at)
                    }}購入　購入数：{{ orderDetail.num }}
                  </p>

                  <router-link
                    class="product-item__link"
                    :to="{
                      name: 'ProductShow',
                      params: { id: orderDetail.product_id },
                    }"
                  >
                    <img :src="orderDetail.product.upload_files[0].url" alt=""
                  /></router-link>
                  <p class="product-item__sub">
                    {{ orderDetail.product_category_name }}
                  </p>
                  <h3 class="product-item__ttl">
                    <span class="product-item__ttl-num">{{
                      orderDetail.product.product_no
                    }}</span>
                    <span class="product-item__ttl-main"
                      >{{ orderDetail.product_name1 }}　¥{{
                        orderDetail.product_price
                      }}<br />
                      <span class="product-item__ttl-main-child">{{
                        orderDetail.product_name2
                      }}</span></span
                    >
                  </h3>
                  <p class="product-item__material">
                    {{
                      pageService.cutText(
                        20,
                        "…",
                        orderDetail.material_name_csv.replace(",", "、")
                      )
                    }}
                  </p>
                  <div class="a-btn">
                    <router-link
                      class="a-btn__link"
                      :to="{
                        name: 'ProductShow',
                        params: { id: orderDetail.product_id },
                      }"
                      v-if="orderDetail.product !== null"
                      >商品詳細</router-link
                    >
                  </div>
                </li>
              </ul>
            </ul>
          </div>
          <div class="link-container">
            <span
              class="link-container__a"
              v-on:click="logout()"
              id="logout_btn"
              >ログアウト</span
            >
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

import { indexOrderDetailsApi } from "@/api/orders";
import { updateAuthApi } from "@/api/auth";

export default defineComponent({
  name: "MyPageRegistered",
  data() {
    return {
      isShow: false,
      submitDisable: false,
      message: "",
      validateErrors: {} as any,
      params: {} as any,
      orderDetails: [] as any[],

      commonScriptService: new CommonScriptService(),
      pageService: new PageService(),
    };
  },
  components: {
    Footer,
    Header,
    ValidateError,
  },
  // created: function (): void {
  // },
  mounted: async function (): Promise<void> {
    document.body.className = "index";

    // 自分の情報
    this.params = this.$store.state.myData;
    if (this.params.birthday) {
      this.params.birthday = this.params.birthday.replace(/-/g, "/");
    }
    // 注文情報
    const indexOrderDetailsApiResult = await indexOrderDetailsApi();
    if (!indexOrderDetailsApiResult.success) {
      return;
    }
    this.orderDetails = indexOrderDetailsApiResult.data;
    this.isShow = true;
    this.$nextTick(function () {
      this.commonScriptService.execute();
    });
  },
  methods: {
    updateAuth: async function (): Promise<void> {
      this.validateErrors = {};
      this.message = "";
      const result = await updateAuthApi(this.params);
      if (result.status === 422) {
        this.validateErrors = result.data;
        console.log(this.validateErrors);
        return;
      }
      if (result.message !== "") {
        this.message = result.message;
      }
      this.submitDisable = false;
      const query = this.pageService.getQueryObjectForUrl();
      if (query.redirect_name) {
        this.$router.push({
          name: query.redirect_name,
        });
        return;
      }
      alert("登録完了しました");
    },
    logout: function () {
      localStorage.removeItem("access_token");
      this.$store.dispatch("deleteAuthData");
      this.$router.push("/");
    },
  },
});
</script>
<style scoped src="@/assets/css/registered.css"></style>
<style scoped>
#logout_btn {
  cursor: pointer;
}
</style>
