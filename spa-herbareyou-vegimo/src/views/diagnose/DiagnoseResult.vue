<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article id="app" v-if="isShow">
        <section class="sec">
          <div class="sec-container">
            <h2 class="sec-container__hd2">
              診断が完了しました！<br />山田太郎さんにおすすめの<br
                class="sp"
              />ハーブティはこちらです。
            </h2>
            <div class="detail-container clearfix">
              <div class="detail-container__right1" v-if="product.id">
                <h2 class="detail-container__hd2">
                  <span class="detail-container__hd2-sub">美白</span>
                  <span class="detail-container__hd2-ttl">
                    <span class="detail-container__hd2-ttl-num">{{
                      product.product_no
                    }}</span>
                    <span class="detail-container__hd2-ttl-main"
                      >{{ product.name1 }} {{ product.name2 }}</span
                    >
                  </span>
                </h2>
                <p class="detail-container__txt">
                  {{ product.description }}
                </p>
              </div>

              <div class="detail-container__left">
                <vueper-slides
                  fixed-height="500px"
                  v-if="imageUrls.length !== 1"
                >
                  <vueper-slide
                    v-for="(imageUrl, i) in imageUrls"
                    :key="i"
                    :image="'https://content.herbareyou.jp/' + imageUrl"
                  >
                  </vueper-slide>
                </vueper-slides>
                <img
                  v-if="imageUrls.length === 1"
                  :src="'https://content.herbareyou.jp/' + imageUrls[0]"
                  alt=""
                />
              </div>

              <div class="detail-container__right2">
                <dl class="detail-container__table clearfix">
                  <dt class="detail-container__dt">こんな症状に</dt>
                  <div class="customDiv">
                    <dd
                      class="detail-container__dd"
                      v-for="(keyword, index) in product.keywords"
                      v-bind:key="index"
                    >
                      {{ keyword.keyword }}
                    </dd>
                  </div>
                  <br />
                  
                  <dt class="detail-container__dt">味の特徴</dt>
                  <div class="customDiv">
                    <dd
                      class="detail-container__dd"
                      v-for="(taste, index) in product.tastes"
                      v-bind:key="index"
                    >
                      {{ taste.name }}
                    </dd>
                  </div>

                  <br />
                  <dt class="detail-container__dt">配合</dt>
                  <div class="customDiv">
                    <dd
                      class="detail-container__dd"
                      v-for="(material, index) in product.materials"
                      v-on:click="tomaterialSearch(material.id)"
                    >
                      <span>#{{ material.name }}</span>
                      <span v-if="product.materials.length - 1 !== index"
                        >、
                      </span>
                    </dd>
                  </div>
                  <div class="detail-sub-container">
                    <dt class="detail-container__dt">内容量:</dt>
                    <dd class="detail-container__dd">{{ product.capacity }}</dd>
                  </div>
                  <dd class="detail-container__dd"></dd>
                </dl>
                <div class="counter-exc">
                  <div
                    class="counter-exc__left js-counter-down-exc"
                    v-on:click="countDown()"
                  >
                    −
                  </div>
                  <input
                    type="text"
                    name="amount"
                    v-model="num"
                    class="counter-exc__amount"
                  />
                  <div
                    class="counter-exc__right js-counter-up-exc"
                    v-on:click="countUp()"
                  >
                    ＋
                  </div>
                </div>
                <div class="acd-select-exc">
                  <div class="acd-select-exc__head">
                    <p class="acd-select-exc__txt" v-if="product.prices">
                      {{ product.prices[0].capacity }} ¥{{
                        product.prices[0].price
                      }}
                    </p>
                    <div class="acd-select-exc__taxin js-acdSelectExc-btn">
                      Tax in
                    </div>
                  </div>
                  <input
                    type="hidden"
                    name="amount"
                    class="acd-select-exc__input"
                    value=""
                  />
                  <ul class="acd-select-exc__list">
                    <li
                      id=""
                      class="acd-select-exc__item"
                      v-for="price in product.prices"
                      v-bind:key="price.id"
                      v-on:click="changePrice(price.id)"
                    >
                      {{ price.capacity }} ¥{{ price.price }}
                    </li>
                  </ul>
                </div>
                <div class="c-btn">
                  <button
                    type="submit"
                    class="c-btn__btn"
                    v-on:click="inCart()"
                  >
                    カートに入れる
                  </button>
                </div>
              </div>
            </div>
          </div>
        </section>
      </article>

      <article id="app" v-if="isSecondShow">
        <section class="sec">
          <div class="sec-container">
            <h2 class="sec-container__hd2">
              診断が完了しました！<br />山田太郎さんにおすすめの<br
                class="sp"
              />ハーブティはこちらです。
            </h2>
            <ul class="product-list clearfix">
              <li
                class="product-item is-active"
                data-anime="fadeup"
                :data-category="'att-' + index"
                v-for="(product, index) in products"
                v-bind:key="product.id"
              >
                <router-link
                  class="product-item__link"
                  :to="{ name: 'ProductShow', params: { id: product.id } }"
                >
                  <img
                    :src="product.upload_files[0].url"
                    alt=""
                    class="product_img"
                  />
                </router-link>
                <p class="product-item__sub1">{{ product.category.name }}</p>
                <p class="product-item__name1">{{ product.name2 }}</p>
                <p class="product-item__ttl1">
                  <span class="product-item__ttl-num1">{{
                    product.product_no
                  }}</span>
                  <span>|</span>
                  <span class="product-item__ttl-main1"
                    >{{ product.name1 }}　¥{{ product.prices.price }}</span
                  >
                </p>
                <p class="product-item__material1">
                  {{
                    pageService.cutText(
                      20,
                      "…",
                      pageService.implode(
                        "、",
                        pageService.pluck("name", product.materials)
                      )
                    )
                  }}
                </p>
                <div class="a-btn">
                  <router-link
                    class="a-btn__link1"
                    :to="'/product/' + String(product.id)"
                    >詳細を見る</router-link
                  >
                </div>
              </li>
            </ul>
          </div>
        </section>
      </article>
      <!-- <div class="deco">
        <img src="@/assets/img/diagnose/dogtor.gif" alt="" class="deco__img" />
      </div> -->
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
import { VueperSlides, VueperSlide } from "vueperslides";
import "vueperslides/dist/vueperslides.css";
import { PageService } from "../../services/PageService";
// import { showProductApi } from "@/api/products";
import { addProductPriceData } from "@/utils/cart";
import { showProductApi } from "@/api/products";
import { indexProductApi } from "@/api/products";

export default defineComponent({
  name: "DiagnoseResult",
  watch: {},
  data() {
    return {
      isShow: true,
      isSecondShow: false,
      symptoms: [] as any[],
      tastes: [] as any[],
      materials: [] as any[],
      keywords: [] as any[],
      products: [] as any[],
      imageUrls: [] as any[],
      pageService: new PageService(),

      product: {} as any,
      recommendProducts: [] as any[],
      num: 1 as number,
      selectPriceId: 0 as number,
      isUpdateHeader: false,
      commonScriptService: new CommonScriptService(),
    };
  },
  components: {
    Footer,
    Header,
    VueperSlides,
    VueperSlide,
  },
  created: async function () {},
  mounted: async function (): Promise<void> {
    this.init();
    this.$nextTick(function () {
      this.commonScriptService.execute();
    });
  },
  beforeDestroy: function (): void {},
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

      const DetailedSymptomsApiResult = await showDetailedSymptomsProductApi(
        this.diagnoseData.diagnose3.condition,
        this.diagnoseData.diagnose3.id
      );
      console.log("detailedProduct:", DetailedSymptomsApiResult);

      if (!DetailedSymptomsApiResult.success) {
        this.commonError(DetailedSymptomsApiResult);
        return;
      }
      this.symptoms = DetailedSymptomsApiResult.data;

      if (this.symptoms.length === 1) {
        this.isShow = true;
        // console.log("product_id", this.symptoms[0].product_id);
        // let productShowApiresult = await showProductApi(
        //   Number(this.symptoms[0].product_id)
        // );
        // console.log("productShowApiResult:",productShowApiresult);
      } else {
        this.isSecondShow = true;
        this.isShow = false;
      }

      console.log("result:", this.symptoms);

      if (this.symptoms[0].product_id === "all") {
        const query: string =
          "?" + "&symptom_ids=" + this.symptoms[0].symptom_id;
        location.href = location.origin + "/product" + query;
      }

      console.log(this.symptoms[0].product_id);

      if (DetailedSymptomsApiResult.data.length === 1) {
        const SymptomProductApiResult = await showSymptomProduct(
          this.symptoms[0].product_id
        );

        this.products = SymptomProductApiResult.data.product_data;
        this.tastes = SymptomProductApiResult.data.tastes;
        this.keywords = SymptomProductApiResult.data.keywords;
        this.materials = SymptomProductApiResult.data.materials;
        this.imageUrls = SymptomProductApiResult.data.upload_files;

        let productShowApiresult = await showProductApi(
          Number(this.products[0].id)
        );
        console.log("productShowApiResult:", productShowApiresult);
        this.product = productShowApiresult.data;
        console.log("product_no:", this.product.product_no);
        this.selectPriceId = this.product.prices[0].id;
        // おすすめ一覧
        let productIndexApiResult = await indexProductApi({
          // not_product_ids: this.product.id,
          recommendation_kind: 4,
          per_page: -1,
        });
        if (!productIndexApiResult.success) {
          this.commonError(productIndexApiResult);
          return false;
        }
        this.recommendProducts = productIndexApiResult.data;
        console.log("recommendProduct:", this.recommendProducts);

        console.log("SymptomProduct:", SymptomProductApiResult);
      } else {
        for (let i = 0; i < DetailedSymptomsApiResult.data.length; i++) {
          const SymptomProductApiResult = await showSymptomProduct(
            this.symptoms[i].product_id
          );
          console.log(SymptomProductApiResult.data.product_data[0].id);
          let productShowApiresult = await showProductApi(
            Number(SymptomProductApiResult.data.product_data[0].id)
          );
          this.products.push(productShowApiresult.data);
          this.imageUrls.push(SymptomProductApiResult.data.upload_files);
          this.materials.push(SymptomProductApiResult.data.materials);
        }
      }
      console.log("multiproducts", this.products);
      console.log("multiImages", this.imageUrls);
      console.log("multimaterials", this.materials);
    },
    countUp: function (): void {
      this.num += 1;
    },
    countDown: function (): void {
      if (this.num <= 1) {
        return;
      }
      this.num -= 1;
    },
    changePrice: function (priceId: number): void {
      this.selectPriceId = priceId;
    },
    tomaterialSearch: function (index: number): void {
      // const url = Location.pathname;
      const query: string =
        "/product?" +
        "taste_ids=" +
        "" +
        "&flavor_ids=" +
        "" +
        "&material_ids=" +
        index +
        "&symptom_ids=" +
        "" +
        "&order_by=" +
        "" +
        "&recommendation_kind=" +
        "";

      console.log(query);

      location.href = query;
    },
    totasteSearch: function (index: number): void {
      // const url = Location.pathname;
      const query: string =
        "/product?" +
        "taste_ids=" +
        index +
        "&flavor_ids=" +
        "" +
        "&material_ids=" +
        "" +
        "&symptom_ids=" +
        "" +
        "&order_by=" +
        "" +
        "&recommendation_kind=" +
        "";

      console.log(query);

      location.href = query;
    },

    toflavorSearch: function (index: number): void {
      // const url = Location.pathname;
      // alert(1);
      const query: string =
        "/product?" +
        "taste_ids=" +
        "" +
        "&flavor_ids=" +
        index +
        "&material_ids=" +
        "" +
        "&symptom_ids=" +
        "" +
        "&order_by=" +
        "" +
        "&recommendation_kind=" +
        "";

      console.log(query);

      location.href = query;
    },
    inCart: async function (): Promise<void> {
      this.isUpdateHeader = false;
      console.log(this.selectPriceId);
      addProductPriceData(this.selectPriceId, this.num);
      await this.$store.dispatch("setCartData");
      this.isUpdateHeader = true;
    },
  },
});
</script>
<style scoped src="@/assets/css/diagnoseresult.css"></style>
