<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article v-if="isShow">
        <section class="sec">
          <div class="kv-container">
            <picture>
              <source
                media="(max-width:599px)"
                :srcset="
                  cloudFrontBaseurl + 'assets/img/faq/top-sp.jpg?' + dateTime
                "
              />
              <img
                :src="cloudFrontBaseurl + 'assets/img/faq/top.jpg?' + dateTime"
                class="kv-container__img"
                alt=""
              />
            </picture>
            <h2 class="kv-container__hd2">FAQ よくある質問</h2>
          </div>
        </section>
        <section class="sec">
          <div class="sec-container">
            <ul class="faq">
              <li
                class="faq-item faq__container"
                data-anime="fadeup"
                v-for="faqCategory in faqCategories"
              >
                <h3 class="faq__title js-accordion-title-faq">
                  {{ faqCategory.name }}
                </h3>
                <div class="faq__content faq__content">
                  <ul class="child-content-list">
                    <li
                      class="child-content-list__item"
                      v-for="faq in faqCategory.faqs"
                    >
                      <h4 class="child-content-list__title">
                        Q.{{ faq.title }}
                      </h4>
                      <p class="child-content-list__txt br">
                        {{ faq.body }}
                      </p>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </section>
      </article>
    </main>
    <Footer />
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import Footer from "@/components/Footer.vue";
import Header from "@/components/Header.vue";
import { CommonScriptService } from "@/services/CommonScriptService";
import { indexFaqCategoryApi } from "@/api/faq-categories";

export default defineComponent({
  name: "SiteFaq",
  watch: {},
  data() {
    return {
      isShow: false,
      commonScriptService: new CommonScriptService(),
      cloudFrontBaseurl: process.env.VUE_APP_CLOUD_FRONT_BASE_URL,
      dateTime: Date.now(),
      faqCategories: [] as any[],
    };
  },
  components: {
    Footer,
    Header,
  },
  created: async function () {},
  mounted: async function (): Promise<void> {
    document.body.className = "index";

    let result = await indexFaqCategoryApi();
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.faqCategories = result.data;
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
    },
  },
});
</script>
<style scoped src="@/assets/css/faq.css"></style>
