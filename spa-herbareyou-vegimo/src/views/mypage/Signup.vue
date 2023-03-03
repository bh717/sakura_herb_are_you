<template>
  <div class="wrapper">
    <Header />
    <main class="main" v-if="!successSignup">
      <article v-if="isShow">
        <section class="sec">
          <div class="sec-container">
            <h2 class="sec-container__hd2">新規登録</h2>
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
                <div class="form-parts form-parts--w19" >
                  <label for="post" class="form-parts__label">郵便番号</label>
                  <input
                    type="text"
                    name="post"
                    v-model="params.zip"
                    @blur="findAddresses($event)"
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
                  class="bc-btn__btn"
                  v-on:click="regist()"
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

    <main class="main" v-else-if="successSignup">
      <article>
        <section class="sec">
          <div class="sec-container">
            <h2 class="sec-container__hd2">登録が完了しました</h2>
            <img
              class="success-img"
              src="@/assets/img/success/success.svg"
              alt=""
            />
            <p class="success-txt">
              入力いただいたメールアドレスに<br />登録確認メールがとどきます。
            </p>
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
import Footer from "@/components/Footer.vue";
import Header from "@/components/Header.vue";
import ValidateError from "@/components/ValidateError.vue";
import axios from 'axios';

import axiosJsonpAdapter from 'axios-jsonp'

import { registAuthApi } from "@/api/auth";

const ZIPCODE_API_URL = 'https://zipcloud.ibsnet.co.jp/api/search'

export default defineComponent({
  name: "MyPageSignup",
  data() {
    return {
      isShow: false,
      isLogined: false,
      submitDisable: false,
      message: "",
      validateErrors: {} as any,
      params: {
        is_mail_magazine: false,
        zip:"",
      } as any,
      successSignup: false,
      commonScriptService: new CommonScriptService(),
      // post:"",
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
    }
  },
  mounted: async function (): Promise<void> {
    document.body.className = "seccess";

    this.isShow = true;
    this.$nextTick(function () {
      this.commonScriptService.execute();
    });
  },
  methods: {
    findAddresses : async function(e) : Promise<any> {
      if (this.params.zip != '') {
        const res = await axios.get(ZIPCODE_API_URL, {
          adapter: axiosJsonpAdapter,
          params: {
            zipcode: this.params.zip
          }
        })
        if (res.status !== 200) {
          this.params.address1 = "Invalid PostCode";
        }
        else{
          if(res && res.data && res.data.results[0])
            {
              this.params.address1 = res.data.results[0].address2 + res.data.results[0].address3
            }
        }
      }
    },
    commonError: function (result: any = null): void {
      if (result.status === 422) {
        this.validateErrors = result.data;
      }
      if (result.message !== "") {
        this.message = result.message;
      }
      this.submitDisable = false;
    },
    regist: async function (): Promise<any> {
      this.submitDisable = true;
      let result = await registAuthApi(this.params);
      if (!result.success) {
        this.commonError(result);
        this.submitDisable = false;
        return;
      }
      this.successSignup = true;
      this.commonScriptService.execute();

      this.$nextTick(function () {
        this.commonScriptService.execute();
      });
    },
  },
});


</script>
<style scoped src="@/assets/css/signup.css"></style>