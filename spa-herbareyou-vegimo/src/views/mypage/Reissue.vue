<template>
  <div class="wrapper">
    <Header />
    <main class="main" v-if="!successSave">
      <article v-if="isShow">
        <section class="sec">
          <div class="sec-container">
            <h2 class="sec-container__hd2">パスワードを再発行する</h2>
            <div action="" class="form">
              <div class="form-parts">
                <label for="mail" class="form-parts__label"
                  >メールアドレス</label
                >
                <input
                  type="text"
                  name="mail"
                  id="mail"
                  class="form-parts__input"
                  v-model="email"
                />
                <ValidateError :errorMessages="validateErrors.email" />
              </div>
              <div class="bc-btn bc-btn--mb50">
                <button
                  class="bc-btn__btn"
                  v-on:click="resetPasswordUrl()"
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
    <main class="main" v-else-if="successSave">
      <article>
        <section class="sec">
          <div class="sec-container">
            <h2 class="sec-container__hd2">送信が完了しました</h2>
            <img
              src="@/assets/img/mypage/re-pass.svg"
              alt=""
              class="success2-img"
            />
            <p class="success2-txt">
              ご登録いただいたメールアドレスに、パスワード再設定ページのURLをお送りいたします。
            </p>
            <router-link class="success2-link" :to="{ name: 'Home' }">
              TOPへ戻る
            </router-link>
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
// import { Messages } from "@/consts/Messages";
import Footer from "@/components/Footer.vue";
import Header from "@/components/Header.vue";
import ValidateError from "@/components/ValidateError.vue";

import { resetPasswordUrlApi } from "@/api/auth";

export default defineComponent({
  name: "MyPageReissue",
  data() {
    return {
      isShow: false,
      isLogined: false,
      submitDisable: false,
      message: "",
      validateErrors: {} as any,
      params: {} as any,
      email: "" as string,
      successSave: false,
      commonScriptService: new CommonScriptService(),
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
      }
      this.submitDisable = false;
    },
    resetPasswordUrl: async function (): Promise<any> {
      this.submitDisable = true;
      this.validateErrors = [];
      let result = await resetPasswordUrlApi(this.email);
      if (!result.success) {
        this.commonError(result);
        this.submitDisable = false;
        return;
      }
      this.successSave = true;
      this.commonScriptService.execute();
    },
  },
});
</script>
<style scoped src="@/assets/css/reissue.css"></style>
