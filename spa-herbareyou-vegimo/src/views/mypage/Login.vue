<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article v-if="isShow">
        <section class="sec">
          <div class="sec-container">
            <h2 class="sec-container__hd2">ログイン</h2>
            <div action="" class="form">
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
              <div class="form-parts">
                <label for="pw" class="form-parts__label">パスワード</label>
                <input
                  type="password"
                  name="pw"
                  v-model="params.password"
                  id="pw"
                  class="form-parts__input"
                />
                <ValidateError :errorMessages="validateErrors.password" />
              </div>
              <div class="bc-btn bc-btn--mb50">
                <button
                  class="bc-btn__btn"
                  v-on:click="login()"
                  :disabled="submitDisable"
                >
                  ログイン
                </button>
              </div>
            </div>
            <div class="link-container">
              <router-link to="/mypage/signup/" class="link-container__a"
                >アカウントを作成する（初めてのご利用の方）</router-link
              >
            </div>
            <div class="link-container">
              <router-link
                :to="{
                  name: 'MyPageReissue',
                }"
                class="link-container__a"
                >パスワードを変更する</router-link
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

import { loginApi } from "@/api/auth";

export default defineComponent({
  name: "MyPageLogin",
  data() {
    return {
      isShow: false,
      submitDisable: false,
      message: "",
      validateErrors: {} as any,
      params: {} as any,

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
    if (this.$store.state.isLogin) {
      this.$router.push("/");
      return;
    }
  },
  mounted: async function (): Promise<void> {
    document.body.className = "index";
    // ログアウト処理
    localStorage.removeItem("access_token");
    this.$store.dispatch("deleteAuthData");

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
        alert(result.message);
      }
    },
    login: async function (): Promise<any> {
      this.submitDisable = true;
      let loginApiResult = await loginApi(this.params);
      this.submitDisable = false;
      if (!loginApiResult.success) {
        this.commonError(loginApiResult);
        return;
      }
      localStorage.setItem("access_token", loginApiResult.data.access_token);
      await this.$store.dispatch("setAuthData");

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
<style scoped src="@/assets/css/mypage.css"></style>
