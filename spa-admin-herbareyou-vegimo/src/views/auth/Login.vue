<template>
  <div v-if="isShow" id="main_display">
    <h2 class="text-center" id="title1">
      <!-- <img src="@/assets/icon/logo-l.svg" /> -->
      <!-- <img src="@/assets/icon/V.png" alt="V" width="70" /> -->
      H
    </h2>
    <h3 class="text-center mb-3" id="title2">
      <!-- <img src="@/assets/icon/farmer.png" alt="farmer" width="200" /> -->
      HERB ARE YOU
    </h3>
    <!-- <h4 class="text-center mt-4" id="title3">herbareyou</h4> -->
    <h4 class="text-center mt-4" id="title3">管理画面</h4>

    <ErrorMessage :message="message" />

    <div class="mb-3 mt-4 w-75 mx-auto">
      <input
        type="email"
        class="form-control"
        id="email"
        placeholder="メールアドレス"
        name="email"
        v-model="params.email"
      />
      <ValidateError :errorMessages="validateErrors.email" />
    </div>
    <div class="mb-3 w-75 mx-auto">
      <input
        type="password"
        class="form-control"
        id="password"
        placeholder="パスワード"
        name="password"
        v-model="params.password"
      />
      <ValidateError :errorMessages="validateErrors.password" />
    </div>
    <div class="text-center">
      <button
        type="submit"
        class="btn mb-3 btn-danger btn-lg login-btn"
        v-on:click="login()"
        :disabled="submitDisable"
      >
        ログイン
      </button>
    </div>
  </div>
</template>
<script lang="ts">
import { defineComponent } from "vue";
import { AuthService } from "@/services/AuthService";
// import { TerapistBlogService } from "@/services/TerapistBlogService";
import { PageService } from "@/services/PageService";
// import { Messages } from "@/consts/Messages";
import ErrorMessage from "@/components/ErrorMessage.vue";
import ValidateError from "@/components/ValidateError.vue";

import { loginApi } from "@/api/auth";

export default defineComponent({
  name: "AuthLogin",
  data() {
    return {
      isShow: false,
      submitDisable: false,
      message: "",
      validateErrors: {} as any,
      params: {} as any,
    };
  },
  components: {
    ValidateError,
    ErrorMessage,
  },
  created: function (): void {
    if (this.$store.state.isLogin) {
      this.$router.push("/");
      return;
    }
  },
  mounted: async function (): Promise<void> {
    this.isShow = true;
  },
  methods: {
    commonError: function (result: any = null): void {
      if (result.status === 422) {
        this.validateErrors = result.data;
      }
      if (result.status === 401) {
        this.validateErrors = "emailまたはpasswordが異なります";
      }
      if (result.message !== "") {
        this.message = result.message;
        // alert(result.message);
      }
      this.submitDisable = false;
    },
    login: async function (): Promise<any> {
      this.submitDisable = true;
      let loginApiResult = await loginApi(this.params);
      if (!loginApiResult.success) {
        this.commonError(loginApiResult);
        this.submitDisable = false;
        return;
      }
      localStorage.setItem("access_token", loginApiResult.data.access_token);
      await this.$store.dispatch("setAuthData");
      this.$router.push("/");
    },
  },
});
</script>
<style lang="scss" scoped>
#main_display {
  margin-top: 100px;
}
#title1 {
  font-weight: bold;
  letter-spacing: 4px;
}
#title2 {
}
#title3 {
}
// body {
//   $font-family-base: 3rem !important;
//   $font-size-base: 3rem;
//   $line-height-base: 3rem;
// }
.login-btn {
  width: 200px;
}
</style>
