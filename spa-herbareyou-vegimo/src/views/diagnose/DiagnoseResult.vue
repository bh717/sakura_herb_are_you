<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article id="app" v-if="isShow">
        <section class="sec">
          <div class="sec-container">
            <h2 class="sec-container__hd2">
              診断が完了しました！<br />山田太郎さんにおすすめの<br class="sp" />ハーブティはこちらです。
            </h2>
            <div class="detail-container clearfix">
              <div class="detail-container__right1" v-if="products.length !== 0">
                <h2 class="detail-container__hd2">
                  <span class="detail-container__hd2-sub">美白</span>
                  <span class="detail-container__hd2-ttl">
                    <span class="detail-container__hd2-ttl-num">{{ symptoms[0].product_id }}</span>
                    <span class="detail-container__hd2-ttl-main">{{ products[0].name1 }} {{ products[0].name2 }}</span>
                  </span>
                </h2>
                <p class="detail-container__txt">
                  {{ products[0].description }}
                </p>
              </div>

              <div class="detail-container__left">
                <vueper-slides fixed-height="500px">
                  <vueper-slide v-for="(imageUrl, i) in imageUrls" :key="i"
                    :image="'https://content.herbareyou.jp/' + imageUrl">
                  </vueper-slide>
                </vueper-slides>
              </div>

              <div class="detail-container__right2">
                <dl class="detail-container__table clearfix">
                  <dt class="detail-container__dt">こんな症状に</dt>
                  <dd class="detail-container__dd" v-for="(keyword, index) in keywords" v-bind:key="index">{{ keyword }}
                  </dd>
                  <br />

                  <dt class="detail-container__dt">味の特徴</dt>
                  <dd class="detail-container__dd" v-for="(taste, index) in tastes" v-bind:key="index">{{ taste }}</dd>

                  <br />
                  <dt class="detail-container__dt">配合</dt>
                  <dd class="detail-container__dd">
                    カモミール / レモンピール
                  </dd>
                  <dt class="detail-container__dt">内容量: 150g</dt>
                  <dd class="detail-container__dd"></dd>
                </dl>
                <div class="counter-exc">
                  <div class="counter-exc__left js-counter-down-exc">−</div>
                  <input type="text" name="amount" value="1" class="counter-exc__amount" />
                  <div class="counter-exc__right js-counter-up-exc">＋</div>
                </div>
                <div class="acd-select-exc">
                  <div class="acd-select-exc__head">
                    <p class="acd-select-exc__txt">7 Packs ¥700</p>
                    <div class="acd-select-exc__taxin js-acdSelectExc-btn">
                      Tax in
                    </div>
                  </div>
                  <input type="hidden" name="amount" class="acd-select-exc__input" value="" />
                  <ul class="acd-select-exc__list">
                    <li id="20g" class="acd-select-exc__item">Leaf 20g ¥700</li>
                    <li id="100g" class="acd-select-exc__item">
                      Leaf 100g ¥1100
                    </li>
                    <li id="200g" class="acd-select-exc__item">
                      Leaf 200g ¥1700
                    </li>
                  </ul>
                </div>
                <div class="c-btn">
                  <button type="submit" class="c-btn__btn">
                    カートに入れる
                  </button>
                </div>
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
import Footer from "@/components/Footer.vue";
import Header from "@/components/Header.vue";
import { CommonScriptService } from "@/services/CommonScriptService";
import { showDetailedSymptomsProductApi } from "@/api/detailed-product";
import { showSymptomProduct } from "@/api/symptom_products";
import ValidateError from "@/components/ValidateError.vue";
import { VueperSlides, VueperSlide } from 'vueperslides';
import 'vueperslides/dist/vueperslides.css';

import { showProductApi } from "@/api/products";
export default defineComponent({
  name: "DiagnoseResult",
  watch: {},
  data() {
    return {
      isShow: true,
      symptoms: [] as any[],
      tastes: [] as any[],
      materials: [] as any[],
      keywords: [] as any[],
      products: [] as any[],
      imageUrls: [] as any[],
    };
  },
  components: {
    Footer,
    Header,
    VueperSlides,
    VueperSlide,
  },
  created: async function () { },
  mounted: async function (): Promise<void> {
    this.init();
    this.$nextTick(function () {
      this.commonScriptService.execute();
    });
  },
  beforeDestroy: function (): void { },
  methods: {
    init: async function () {

      const diagnoseJsonData = localStorage.getItem("diagnoseJsonData");
      if (!diagnoseJsonData) {
        this.$router.push({
          name: "Diagnose0",
        });
        return;
      }
      const diagnoseData = JSON.parse(diagnoseJsonData);
      if (!diagnoseData?.diagnose2) {
        this.$router.push({
          name: this.backPath,
        });
        return;
      }
      this.diagnoseData = diagnoseData;
      console.log("detailedProductID:", this.diagnoseData.diagnose3.condition);

      const DetailedSymptomsApiResult = await showDetailedSymptomsProductApi(this.diagnoseData.diagnose3.condition, this.diagnoseData.diagnose3.id);
      console.log("detailedProduct:", DetailedSymptomsApiResult);
      if (!DetailedSymptomsApiResult.success) {
        this.commonError(DetailedSymptomsApiResult);
        return;
      }
      this.symptoms = DetailedSymptomsApiResult.data

      console.log("result:", this.symptoms);

      if (this.symptoms[0].product_id === 'all') {
        const query: string =
          "?" +
          "&symptom_ids=" +
          this.symptoms[0].symptom_id;
          location.href = location.origin + "/product" + query;
      }

      console.log(this.symptoms[0].product_id);
      const SymptomProductApiResult = await showSymptomProduct(this.symptoms[0].product_id);

      this.products = SymptomProductApiResult.data.product_data;
      this.tastes = SymptomProductApiResult.data.tastes;
      this.keywords = SymptomProductApiResult.data.keywords;
      this.materials = SymptomProductApiResult.data.materials;
      this.imageUrls = SymptomProductApiResult.data.upload_files;

      console.log("SymptomProduct:", SymptomProductApiResult);
    },
  },
});
</script>
<style scoped src="@/assets/css/diagnoseresult.css">

</style>
