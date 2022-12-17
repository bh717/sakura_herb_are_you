<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article v-if="isShow">
        <section class="sec">
          <div class="sec-container">
            <h2 class="sec-container__hd2">お届け先情報</h2>
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
              <div class="bc-btn bc-btn--mb50">
                <button
                  type="submit"
                  class="bc-btn__btn"
                  v-on:click="updateUserDeliveryLocation()"
                  :disabled="submitDisable"
                >
                  登録する
                </button>
              </div>
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
// import { Messages } from "@/consts/Messages";
import Footer from "@/components/Footer.vue";
import Header from "@/components/Header.vue";
import ValidateError from "@/components/ValidateError.vue";

import { updateUserDeliveryLocationApi } from "@/api/users";
import { showUserDeliveryLocationApi } from "@/api/users";

export default defineComponent({
  name: "MyPageDeliveryLocation",
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

    // 自分の情報取得
    const deliveryLocationApiResult = await showUserDeliveryLocationApi();

    if (deliveryLocationApiResult.success) {
      this.params = deliveryLocationApiResult.data;
      if (this.params.birthday) {
        this.params.birthday = this.params.birthday.replace(/-/g, "/");
      }
    }
    this.isShow = true;
    this.$nextTick(function () {
      this.commonScriptService.execute();
    });
  },
  methods: {
    commonError: function (result: any = null): void {
      if (result.status === 422) {
        this.validateErrors = result.data;
      }
      if (result.message !== "") {
        this.message = result.message;
      }
      this.submitDisable = false;
    },
    updateUserDeliveryLocation: async function (): Promise<void> {
      this.submitDisable = true;
      const apiRegist = await updateUserDeliveryLocationApi(this.params);
      if (!apiRegist.success) {
        this.submitDisable = false;
        this.commonError(apiRegist);
        return;
      }
      this.submitDisable = false;

      const query = this.pageService.getQueryObjectForUrl();
      if (query.redirect_name) {
        this.$router.push({
          name: query.redirect_name,
        });
        return;
      }
      this.$router.push({
        name: "Home",
      });
    },
  },
});
</script>
<style scoped src="@/assets/css/registered.css"></style>
