<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article v-if="isShow">
        <section class="sec">
          <div class="sec-container">
            <h2 class="sec-container__hd2">パスワードを再設定する</h2>
            <div action="" class="form">
              <div class="form-parts">
                <label for="mail" class="form-parts__label">パスワード</label>
                <input
                  type="password"
                  name="mail"
                  id="mail"
                  class="form-parts__input"
                  v-model="password"
                />
                <ValidateError :errorMessages="validateErrors.password" />
                <ValidateError :errorMessages="validateErrors.code" />
              </div>
              <div class="bc-btn bc-btn--mb50">
                <button
                  class="bc-btn__btn"
                  v-on:click="resetPassword()"
                  :disabled="submitDisable"
                >
                  登録する
                </button>
              </div>
            </div>
            <div class="link-container">
              <router-link
                class="link-container__a"
                :to="{
                  name: 'MyPageLogin',
                }"
                >ログインに戻る</router-link
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
// import { Messages } from "@/consts/Messages";
import Footer from "@/components/Footer.vue";
import Header from "@/components/Header.vue";
import ValidateError from "@/components/ValidateError.vue";

import { resetPasswordApi } from "@/api/auth";

export default defineComponent({
  name: "MyPageResetPassword",
  data() {
    return {
      isShow: false,
      isLogined: false,
      submitDisable: false,
      message: "",
      validateErrors: {} as any,
      params: {} as any,
      password: "" as string,

      commonScriptService: new CommonScriptService(),
      pageService: new PageService(),
    };
  },
  components: {
    Footer,
    Header,
    ValidateError,
  },
  created: function (): void {
    // if (this.$store.state.isLogin) {
    //   this.$router.push("/");
    // }
  },
  mounted: async function (): Promise<void> {
    document.body.className = "index";

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
        // alert(result.message);
      }
      this.submitDisable = false;
    },
    resetPassword: async function (): Promise<any> {
      this.submitDisable = true;
      this.validateErrors = [];
      const queryParams = this.pageService.getQueryObjectForUrl();
      let result = await resetPasswordApi(this.password, queryParams.code);
      if (!result.success) {
        this.commonError(result);
        this.submitDisable = false;
        return;
      }
      this.submitDisable = false;
      this.$router.push("/mypage/login");
    },
  },
});
</script>
<style scoped src="@/assets/css/reissue.css"></style>
