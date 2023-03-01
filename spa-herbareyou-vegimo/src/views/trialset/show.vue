<template>
  <div class="wrapper">
    <Header :isUpdate="isUpdateHeader" />
    <main class="main">
      <article v-if="isShow">
        <a href="/trialset/" class="to-product">一覧へ</a>
        <section class="sec">
          <div class="detail-container clearfix">
            <div class="detail-container__right1">
              <p class="detail-container__hd2">
                <span class="detail-container__hd2-ttl1">
                  <span class="detail-container__hd2-sub">{{
                    product.category.name
                  }}</span>
                  <span class="detail-container__hd2-ttl-main1">{{
                    product.name1
                  }}</span>
                </span>
                <span class="detail-container__hd2-ttl">
                  <span class="detail-container__hd2-ttl-num">{{
                    product.product_no
                  }}</span>
                  <span class="vertical-section">|</span>
                  <span class="detail-container__hd2-ttl-main">{{
                    product.name2
                  }}</span>
                </span>
              </p>
              <p class="detail-container__txt">
                {{ product.description }}
              </p>
              <!-- <div class="subproduct-container">
                <div
                  class="subproduct-subcontainer"
                  v-for="(subproduct, index) in subProducts"
                  v-bind:key="index"
                >
                  <p class="detail-container__hd2">
                    <span class="subdetail-container__hd2-ttl">
                      <span class="detail-container__hd2-ttl-num">{{
                        subproduct.product_no
                      }}</span>
                      <span class="vertical-section">|</span>
                      <span class="detail-container__hd2-ttl-main">{{
                        subproduct.name2
                      }}</span>
                        &emsp;&ensp;

                        <span v-if="this.subproductdata[index].sub_product_count !== 1">X</span>
                      <span class="detail-container__hd2-ttl-main" v-if="this.subproductdata[index].sub_product_count !== 1">
                        {{
                        this.subproductdata[index].sub_product_count
                      }}</span>
                    </span>
                  </p>

                  <p class="detail-container__txt">
                    #{{ subproduct.category.name }}
                  </p>
                </div>
              </div> -->
            </div>

            <div class="detail-container__left">
              <vueper-slides
                fixed-height="500px"
                v-if="product.upload_files.length !== 1"
              >
                <vueper-slide
                  v-for="(uploadfile, i) in product.upload_files"
                  :key="i"
                  :image="
                    'https://d1jw4m1s7z1xyc.cloudfront.net/' +
                    uploadfile.file_path
                  "
                >
                </vueper-slide>
              </vueper-slides>
              <img
                v-if="product.upload_files.length === 1"
                :src="product.upload_files[0].url"
                alt=""
              />
            </div>

            <div class="detail-container__right2">
              <dl class="detail-container__table clearfix">
                <dt class="detail-container__dt">キーワード</dt>
                <div class="customDiv">
                  <dd
                    class="detail-container__dd1"
                    v-for="(keyword, index) in product.keywords"
                  >
                    <span>{{ keyword.keyword }}</span>
                  </dd>
                </div>
                
                <dt class="detail-container__dt">味の特徴</dt>
                <div class="customDiv">
                  <dd
                    class="detail-container__dd"
                    v-for="(taste, index) in product.tastes"
                    v-on:click="totasteSearch(taste.id)"
                  >
                    <span class="namestyle">#{{ taste.name }}</span>
                    <span v-if="product.tastes.length - 1 !== index">、 </span>
                  </dd>
                </div>

                <dt class="detail-container__dt">香りの特徴</dt>
                <div class="customDiv">
                  <dd
                    class="detail-container__dd"
                    v-for="(flavor, index) in product.flavors"
                    v-on:click="toflavorSearch(flavor.id)"
                  >
                    <span class="namestyle">#{{ flavor.name }}</span>
                    <span v-if="product.tastes.length - 1 !== index">、 </span>
                  </dd>
                </div>

                <dt class="detail-container__dt">配合</dt>
                <div class="customDiv">
                  <dd
                    class="detail-container__dd"
                    v-for="(material, index) in product.materials"
                    v-on:click="tomaterialSearch(material.id)"
                  >
                    <span class="namestyle">#{{ material.name }}</span>
                    <span v-if="product.materials.length - 1 !== index"
                      >、
                    </span>
                  </dd>
                </div>

                <div class="detail-sub-container">
                  <dt class="detail-container__dt">内容量:</dt>
                  <dd class="detail-container__dd">{{ product.capacity }}</dd>

                  <div class="counter">
                    <div
                      class="counter__left js-counter-down"
                      v-on:click="countDown()"
                    >
                      −
                    </div>
                    <input
                      type="text"
                      name="amount"
                      v-model="num"
                      class="counter__amount"
                    />
                    <div
                      class="counter__right js-counter-up"
                      v-on:click="countUp()"
                    >
                      ＋
                    </div>
                  </div>
                  <div class="acd-select">
                    <div class="acd-select__head">
                      <p class="acd-select__txt">
                        {{ product.prices[0].capacity }} ¥{{
                          product.prices[0].price
                        }}
                      </p>
                      <div class="acd-select__taxin js-acdSelect-btn">
                        Tax in
                      </div>
                    </div>
                    <input
                      type="hidden"
                      name="amount"
                      class="acd-select__input"
                      value=""
                    />
                    <ul class="acd-select__list">
                      <li
                        id=""
                        class="acd-select__item"
                        v-for="price in product.prices"
                        v-bind:key="price.id"
                        v-on:click="changePrice(price.id)"
                      >
                        {{ price.capacity }} ¥{{ price.price }}
                      </li>
                    </ul>
                  </div>

                  <div class="b-btn">
                    <button
                      type="submit"
                      class="b-btn__btn"
                      v-on:click="inCart()"
                    >
                      カートに入れる
                    </button>
                  </div>
                </div>
              </dl>
            </div>
          </div>
        </section>
        <!-- <section class="sec">
          <div class="sec-container">
            <h3 class="sec-container__hd3">おすすめ</h3>
            <ul
              class="product-list clearfix"
              v-if="recommendProducts.length !== 0"
            >
              <li
                class="product-item"
                data-anime="fadeup"
                :data-category="'att-' + String(recommendProduct.id)"
                v-for="recommendProduct in recommendProducts"
                :key="recommendProduct.id"
              >
                <router-link
                  :to="{
                    name: 'ProductShow',
                    params: { id: recommendProduct.id },
                  }"
                  class="product-item__link"
                >
                  <img :src="recommendProduct.upload_files[0].url" alt="" />
                </router-link>
                <p class="product-item__sub">
                  {{ recommendProduct.category.name }}
                </p>
                <p class="product-item__name">
                  {{ recommendProduct.name2 }}
                </p>
                <p class="product-item__ttl">
                  <span class="product-item__ttl-num">{{
                    recommendProduct.product_no
                  }}</span>
                  <span class="product-item__ttl-main"
                    >{{ recommendProduct.name1 }}　¥{{
                      recommendProduct.prices[0].price
                    }}</span
                  >
                </p>

                <p class="product-item__material">
                  {{
                    pageService.cutText(
                      20,
                      "…",
                      pageService.implode(
                        "、",
                        pageService.pluck("name", recommendProduct.materials)
                      )
                    )
                  }}
                </p>
                <div class="a-btn">
                  <a
                    :href="`/product/${recommendProduct.id}`"
                    class="a-btn__link"
                    >詳細を見る</a
                  >
                </div>
              </li>
            </ul>
          </div>
        </section> -->
      </article>
    </main>
    <Footer />
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { CommonScriptService } from "@/services/CommonScriptService";
import { PageService } from "@/services/PageService";
import Footer from "@/components/Footer.vue";
import Header from "@/components/Header.vue";
import ValidateError from "@/components/ValidateError.vue";

import { VueperSlides, VueperSlide } from "vueperslides";
import "vueperslides/dist/vueperslides.css";
// import { storeCartDetailApi } from "@/api/carts";

import { indexProductApi } from "@/api/trialproducts";
import { indexKindApi } from "@/api/trialproducts";
import { indexSubItem } from "@/api/trialproducts";

import { showSubProductApi } from "@/api/trialproducts";

import { showTrialProductApi } from "@/api/trialproducts";
import { showProductApi } from "@/api/products";

import { addProductPriceData } from "@/utils/cart";

export default defineComponent({
  name: "TrialProductShow",
  data() {
    return {
      isShow: false,
      message: "",
      validateErrors: {} as any,

      product: {} as any,
      kind: "" as string,
      recommendProducts: [] as any[],
      subProducts: [] as any[],
      subproductdata: [] as any[],
      num: 1 as number,
      selectPriceId: 0 as number,
      isUpdateHeader: false,
      commonScriptService: new CommonScriptService(),
      pageService: new PageService(),
    };
  },
  components: {
    Footer,
    Header,
    ValidateError,
    VueperSlides,
    VueperSlide,
  },
  created: async function () {},
  mounted: async function (): Promise<void> {
    document.body.className = "index";

    if (!(await this.setPageData())) {
      return;
    }
    this.isShow = true;
    this.$nextTick(function () {
      this.commonScriptService.execute();
    });
  },

  methods: {
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
    commonError: function (result: any = null): void {
      if (result.status === 422) {
        this.validateErrors = result.data;
      }
      if (result.message !== "") {
        this.message = result.message;
      }
    },
    setPageData: async function (): Promise<boolean> {
      // 詳細
      // let searchId = Number(this.$route.params.id) + 1000;
      let productShowApiresult = await showTrialProductApi(
        Number(this.$route.params.id)
      );
      if (!productShowApiresult.success) {
        this.commonError(productShowApiresult);
        return false;
      }
      console.log("product:", productShowApiresult.data);

      this.product = productShowApiresult.data;

      let testproductShowApiresult = await showProductApi(
        Number(this.product.category.id)
      );

      if (!testproductShowApiresult.success) {
        this.commonError(testproductShowApiresult);
        return false;
      }

      this.product = testproductShowApiresult.data;

      // let productkind = await indexKindApi(this.product.product_category_id-1000);

      // let productkinddata = productkind.data;
      // console.log("productkind:", productkind);

      // if (productkinddata[0].kind === 2) {
      //   this.kind = "INSPIRATION";
      // }

      // if (productkinddata[0].kind === 1) {
      //   this.kind = "HEALING";
      // }

      // if (productkinddata[0].kind === 3) {
      //   this.kind = "MAINTENANCE";
      // }

      // let subproduct = await indexSubItem(this.product.product_category_id);
      // console.log("subproduct:", subproduct);

      // this.subproductdata = subproduct.data;

      // for (let i = 0; i < this.subproductdata.length; i++) {
      //   let apiresult = await showSubProductApi(
      //     this.subproductdata[i].sub_product_id
      //   );
      //   this.subProducts.push(apiresult.data);
      //   console.log("apiresult", apiresult);
      // }

      // console.log("totalSubProducts", this.subProducts);

      // this.selectPriceId = this.product.prices[0].id + 316;
      // おすすめ一覧
      // let productIndexApiResult = await indexProductApi({
      //   // not_product_ids: this.product.id,
      //   recommendation_kind: productkinddata[0].kind,
      //   per_page: -1,
      // });

      // console.log(productIndexApiResult);

      // if (!productIndexApiResult.success) {
      //   this.commonError(productIndexApiResult);
      //   return false;
      // }
      // this.recommendProducts = productIndexApiResult.data;
      console.log("recommendProduct:", this.recommendProducts);
      return true;
    },
    inCart: async function (): Promise<void> {
      this.isUpdateHeader = false;
      addProductPriceData(this.selectPriceId, this.num);
      await this.$store.dispatch("setCartData");
      this.isUpdateHeader = true;
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
  },
});
</script>
<style scoped src="@/assets/css/trialdetail.css"></style>
