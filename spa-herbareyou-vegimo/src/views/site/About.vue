<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article v-if="isShow">
        <section
          class="sec"
          v-for="num in [1, 2, 3, 4, 5]"
          v-if="isFirstShow"
          id="my-section"
        >
          <div
            :class="
              'sec-container' +
              String(Number(num) % 2 === 1 ? 1 : 2) +
              ' ' +
              (num === 3
                ? 'sec-container1--pt0'
                : num === 5
                ? 'sec-container1--pt0 sec-container1--bb'
                : '')
            "
            data-anime="fadeup"
            v-if="
              aboutContents[`about${num}_title`] &&
              aboutContents[`about${num}_body`] &&
              aboutContents[`about${num}_file_path`]
            "
          >
            <div class="sec-container-right">
              <h2 class="sec-container-right__hd2">
                {{ aboutContents[`about${num}_title`].content }}
              </h2>
              <p class="sec-container-right__txt br">
                {{ aboutContents[`about${num}_body`].content }}
              </p>
            </div>
            <div class="sec-container-left">
              <img
                :src="
                  cloudFrontUrl +
                  aboutContents[`about${num}_file_path`].content +
                  '?' +
                  dateTime
                "
                alt=""
              />
            </div>
          </div>
        </section>

        <section class="sec" id="my-section2" v-if="isSecondShow">
          <div
            class="sec-container-form"
            data-anime="fadeup"
            v-if="isSecondShow"
            id="targetMoveElement"
          >
            <h2 class="sec-container-form__hd2">お問い合わせフォーム</h2>
            <div class="form-container">
              <form action="" class="form">
                <div class="form-parts">
                  <label for="" class="form-parts__label">お名前※必須*</label>
                  <input
                    type="text"
                    class="form-parts__input"
                    placeholder="山田花子"
                    v-model="params.name"
                  />
                  <ValidateError :errorMessages="validateErrors.name" />
                </div>
                <div class="form-parts">
                  <label for="" class="form-parts__label"
                    >メールアドレス※必須*</label
                  >
                  <input
                    type="text"
                    class="form-parts__input"
                    placeholder="herbareyou@contact.com"
                    required
                    v-model="params.email"
                  />
                  <ValidateError :errorMessages="validateErrors.email" />
                </div>
                <div class="form-parts">
                  <label for="" class="form-parts__label">ご注文番号</label>
                  <input
                    type="text"
                    class="form-parts__input"
                    placeholder="000000000000"
                    v-model="params.order_no"
                  />
                  <ValidateError :errorMessages="validateErrors.order_no" />
                </div>
                <div class="form-parts form-parts--txtarea">
                  <label
                    for=""
                    class="form-parts__label form-parts__label--bbnone"
                    >お問い合わせ</label
                  >
                  <textarea
                    name=""
                    id=""
                    cols="40"
                    rows="10"
                    class="form-parts__textarea"
                    v-model="params.inquiry"
                  ></textarea>
                  <ValidateError :errorMessages="validateErrors.inquiry" />
                </div>
                <div class="bc-btn">
                  <button
                    type="button"
                    class="b-btn__btn"
                    v-on:click="storeInquiry"
                    :disabled="submitDisable"
                  >
                    送信
                  </button>
                </div>
              </form>
            </div>
          </div>
        </section>
      </article>
    </main>

    <Footer :isSct="true" />
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { CommonScriptService } from "@/services/CommonScriptService";
import { storeInquiryApi } from "@/api/inquiries";
import Footer from "@/components/Footer.vue";
import Header from "@/components/Header.vue";
import ValidateError from "@/components/ValidateError.vue";
import { indexContentAboutApi } from "@/api/contents";
// import scroll from "smooth-scroll";
import SmoothScroll from "smooth-scroll";

export default defineComponent({
  name: "SiteAbout",
  watch: {
    '$route' (to, from) {
      // perform actions to refresh the component here
      console.log('Route changed, refreshing component...')

      if (this.$route.params.id) {
        const sectionEl = document.getElementById(this.$route.params.id);
        if (sectionEl) {
          const top =
            sectionEl.getBoundingClientRect().top + window.pageYOffset;
          window.scrollTo({ top, behavior: "smooth" });
        }
      }

    }
  },
  data() {
    return {
      isShow: false,
      isFirstShow: false,
      isSecondShow: false,
      submitDisable: false,
      message: "",
      validateErrors: {} as any,
      params: {} as any,
      contents: [] as any[],
      commonScriptService: new CommonScriptService(),
      dateTime: Date.now(),
      aboutContents: {} as any,
      cloudFrontUrl: process.env.VUE_APP_CLOUD_FRONT_URL,
    };
  },
  components: {
    Footer,
    Header,
    ValidateError,
  },
  created: function (): void {
    // console.log("asdf");
    this.init();
  },
  mounted: async function (): Promise<void> {
    document.body.className = "about";

    const result = await indexContentAboutApi();
    if (!result.success) {
      if (result.message !== "") {
        this.message = result.message;
      }
      return;
    }
    this.aboutContents = result.data;

    this.isShow = true;

    this.isFirstShow = true;

    this.isSecondShow = true;

    this.$nextTick(function () {
      this.commonScriptService.execute();

      console.log(this.$route.params.id);

      


      // this.init();

      // if (this.$route.params.id === "1") {
      //   const targetElement = this.$refs.beforeTargetElement;
      //   if (targetElement) {
      //     window.scrollTo({ top: 0, behavior: "smooth" });
      //     // targetElement.scrollIntoView({ behavior: "smooth" });
      //   }
      // }
      // if (this.$route.params.id === "2") {
      //   // alert(23434);
      //   const targetElement = this.$refs.targetMoveElement;
      //   if (targetElement) {
      //     targetElement.scrollIntoView({ behavior: "smooth", block: "start" });
      //   }
      // }
    });
  },

  methods: {
    init: async function (): Promise<any> {
      this.isFirstShow = true;
      this.isSecondShow = true;
      if (this.$route.params.id === "my-section") {
        this.isFirstShow = true;
        this.isSecondShow = true;

        if (this.$route.params.id) {
        const sectionEl = document.getElementById(this.$route.params.id);
        if (sectionEl) {
          const top =
            sectionEl.getBoundingClientRect().top + window.pageYOffset;
          window.scrollTo({ top, behavior: "smooth" });
        }
      }
      }
      else if (this.$route.params.id === "my-section2") {
        this.isFirstShow = false;
        this.isSecondShow = true;
      }
    },
    commonError: function (result: any = null): void {
      if (result.status === 422) {
        this.validateErrors = result.data;
      }
      if (result.message !== "") {
        this.message = result.message;
      }
    },
    storeInquiry: async function (): Promise<any> {
      this.submitDisable = true;
      let result = await storeInquiryApi(this.params);
      this.submitDisable = false;
      if (!result.success) {
        this.commonError(result);
        return;
      }
      alert("お問合せを送信しました。");
      this.params = {};
    },
  },
});
</script>
<style scoped src="@/assets/css/about.css"></style>
