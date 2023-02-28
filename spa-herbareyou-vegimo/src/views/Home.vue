<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article>
        <div class="kv">
          <img src="@/assets/img/top/web_top_2_fin.jpg" class="kv__img" />
        </div>
        <section class="sec">
          <div class="sec-container" data-anime="fadeup">
            <h2 class="sec-container__hd2">
              HERB ARE YOU?<br />元気ですか？気分はどう？
            </h2>
            <p class="sec-container__txt">
              体調や気分にあわせてパーソナライズされた<br />
              ハーブティがポストに届きます。<br />
              野菜以上、お薬未満の心づよさで<br />
              それぞれの日々に、植物のエールを。
            </p>
            <div class="a-btn">
              <a class="a-btn__link" href="/about">
                HERB ARE YOUについてもっと詳しく知る
              </a>
            </div>
          </div>
        </section>

        <div class="full-img" data-anime="fadeup">
          <picture>
            <source
              media="(max-width:599px)"
              srcset="@/assets/img/top/top2.png"
            />
            <img src="@/assets/img/top/top2.png" alt="" />
          </picture>
        </div>

        <!-- show theme of product -->
        <section class="sec sec--theme sec--gray" id="detailedSymptomBlock">
          <div class="sec-container">
            <h2
              class="sec-container__hd2 sec-container__hd2--mb5 sec-container__hd2--lh"
              data-anime="fadeup"
            >
              <span class="sec-container__hd2-en">Serching by the symptoms</span>
              <span class="sec-container__hd2-ja"
                >具体的な症状・テーマから探す</span
              >
            </h2>
            <!-- <div class="symptom-section" data-anime="fadeup"> -->
            <div class="symptom-container" data-anime="fadeup">
              <router-link
                class="theme-btn__link"
                :to="'/product/symptom/?symptom_ids=' + String(symptom.id)"
                v-for="(symptom, index) in symptoms"
                >{{ symptom.name }}</router-link
              >
            </div>
            <!-- </div> -->
          </div>
        </section>

        <section class="sec">
          <div class="sec-container">
            <h2
              class="sec-container__hd2 sec-container__hd2--mb5 sec-container__hd2--lh"
              data-anime="fadeup"
            >
              <span class="sec-container__hd2-en"
                >Serching by the category</span
              >
              <span class="sec-container__hd2-ja"
                >今の気分に合わせて探す</span
              >
            </h2>
            <div class="illust-container" data-anime="fadeup">
              <router-link
                class="illust-container__link"
                :to="{
                  name: 'ProductIndexInspiration',
                  params: { kind: 2 },
                }"
              >
                <img src="@/assets/img/index/inspiration.svg" alt="" />
              </router-link>
              <router-link
                class="illust-container__link"
                :to="{
                  name: 'ProductIndexMaintenance',
                  params: { kind: 3 },
                }"
              >
                <img src="@/assets/img/index/maintenance.svg" alt="" />
              </router-link>
              <router-link
                class="illust-container__link"
                :to="{
                  name: 'ProductIndexHealing',
                  params: { kind: 1 },
                }"
                ><img src="@/assets/img/index/healing.svg" alt=""
              /></router-link>
            </div>
          </div>
        </section>

        <!-- show banner -->
        <div class="full-img" data-anime="fadeup">
          <picture>
            <source
              media="(max-width:599px)"
              srcset="@/assets/img/top/banner.jpg"
            />
            <img src="@/assets/img/top/banner.jpg" class="trial-img" alt="" />
          </picture>

          <div class="gift-section">
            <h1 class="p-gift-title">飲み比べができるお試しセット</h1>
            <p class="p-gift-title1">Assorted Trial Pack</p>
            <h1 class="p-gift-main">7種類のブレンド入り</h1>
            <router-link class="gift-btn__link" :to="'/trialset'"
              >もっと詳しく知る</router-link
            >
          </div>
        </div>

        <section class="sec sec--gray">
          <div class="sec-sub-container">
            <p
              class="sec-container__hd2 sec-container__hd2--mb5 sec-container__hd2--lh"
              data-anime="fadeup"
            >
              <h1 class="sec-container__hd2-en1">植物療法士便り</h1>
              <p class="sec-container__hd2-ja1"
                >植物療法士がお届けする暮らしとハーブのコラムです</p>
          </p>
            <ul class="blog-list">
              <li
                class="blog-item is-active"
                data-anime="fadeup"
                v-for="blog in blogs.slice(0, blogcount)"
                v-bind:key="blog.id"
              >
                <router-link
                  :to="{
                    name: 'BlogShow',
                    params: { id: Number(blog.id) },
                  }"
                  class="blog-item-link"
                >
                  <h1 class="blog-item-link__issue"
                    >植物療法士便り #{{
                      pageService.get0Padding(blog.id, 2)
                    }}</h1
                  >
                  <h3 class="blog-item-link__hd3">{{ blog.title }}</h3>
                </router-link>
              </li>
            </ul>
            <div class="btnsection" data-anime="fadeup">
              <div @click="showMore" class="blog-btn">
                <p>もっと見る</p>
              </div>
            </div>
          </div>
        </section>
        <section class="sec">
          <div class="sec-container">
            <h2
              class="sec-container__hd2 sec-container__hd2--mb5 sec-container__hd2--lh"
              data-anime="fadeup"
            >
              <span class="sec-container__hd2-en"
                >RECOMMENDATION FOR {{ monthAlphabet() }}</span
              >
              <span class="sec-container__hd2-ja"
                >季節のおすすめからハーブティを探す</span
              >
            </h2>
            <ul
              class="product-list clearfix"
              v-if="isShow"
              id="this_month_herb_tee"
            >
              <li
                class="product-item"
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
                <p class="product-item__sub">{{ product.category.name }}</p>
                <p class="product-item__name">
                  {{ product.category.series_name }}
                </p>
                <div class="origin-section">
                  <p class="product-item__ttl">
                    <span class="product-item__ttl-num">{{
                      product.product_no
                    }}</span>
                    <span>|</span>
                    <span class="product-item__ttl-main"
                      >{{ product.name2 }}　¥{{ product.prices[0].price }}</span
                    >
                  </p>
                </div>
                <div class="xd-section">
                  <p class="product-item__ttl-xd">
                    <span class="product-item__ttl-num">{{
                      product.product_no
                    }}</span>
                    <span>|</span>
                    <span class="product-item__ttl-main"
                      >{{ product.name2 }}</span
                    >
                  </p>
                  <p class="product-item__ttl">
                    <span class="product-item__ttl-main"
                      >¥{{ product.prices[0].price }}</span
                    >
                  </p>
                </div>
                <p class="product-item__material">
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
                    class="a-btn__link"
                    :to="'/product/' + String(product.id)"
                    >詳細を見る</router-link
                  >
                </div>
                <div class="product_div">
                  <img
                    src="@/assets/img/icon/New.svg"
                    alt=""
                    v-if="product.is_productStatus === 1"
                    class="product_icon1"
                  />
                  
                  <img
                    src="@/assets/img/icon/Recommend.svg"
                    alt=""
                    v-if="product.is_productStatus === 3"
                    class="product_icon2"
                  />
                </div>
                <div class="product_div1">
                  <img
                    src="@/assets/img/icon/SoldOut.svg"
                    alt=""
                    v-if="product.is_productStatus === 2"
                    class="product_icon3"
                  />
                </div>
              </li>
            </ul>
          </div>
        </section>
      </article>
    </main>
    <Footer :isSct="true" />
  </div>
  <a href="/diagnose" class="diagnose-icon">
    <img :src="this.diagnoseimageup" alt="" class="diagnose__img" @mouseover="mouseOver" @mouseleave="mouseDown"/>
  </a>

  <a href="/diagnose" class="diagnose-icon1">
    <img :src="this.spdiagnoseimageup" alt="" class="diagnose__img1" @mouseover="spmouseOver" @mouseleave="spmouseDown"/>
  </a>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { CommonScriptService } from "../services/CommonScriptService";
import { PageService } from "../services/PageService";

import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";

import { indexProductApi } from "@/api/products";
import { indexTerapistBlogApi } from "@/api/terapist_blogs";
import { indexCategoriesApi } from "@/api/products";

export default defineComponent({
  name: "Home",
  components: {
    Header,
    Footer,
  },
  watch: {
    $route: function (n, o) {
      if (n.hash.match(/^#/)) {
        document?.getElementById(n.hash.replace(/^#/, ""))?.scrollIntoView();
      }
      console.log("new, old", [n.hash, o.hash]);
    },
  },
  data() {
    return {
      blogcount: 3,
      blogtotalcount: 0,
      symptoms: [] as any[],
      isShow: false,
      products: [] as any[],
      blogs: [] as any[],
      commonScriptService: new CommonScriptService(),
      pageService: new PageService(),
      dateTime: Date.now(),
      uphere: false,
      downhere: false,
      diagnoseimageup: "/img/index/diagnose.svg",
      diagnoseimagedown: "/img/index/diagnose-hover.svg",

      spuphere: false,
      spdownhere: false,
      spdiagnoseimageup: "/img/index/spdiagnose.svg",
      spdiagnoseimagedown: "/img/index/spdiagnose-hover.svg",
    };
  },
  created: function () {},
  mounted: async function () {
    document.body.className = "index";

    let ProductCategoriesApiresult = await indexCategoriesApi();
    if (!ProductCategoriesApiresult.success) {
      this.commonError(ProductCategoriesApiresult);
      return;
    }
    this.symptoms = ProductCategoriesApiresult.data.symptoms;

    const blogApiResult = await indexTerapistBlogApi();
    if (!blogApiResult.success) {
      alert("失敗");
      return;
    }
    this.blogs = blogApiResult.data;
    this.blogtotalcount = this.blogs.length;
    console.log("blogdata:", this.blogtotalcount);

    let productApiresult = await indexProductApi({
      per_page: -1,
      recommendation_kind: 4,
    });
    console.log("product", productApiresult);
    if (!productApiresult.success) {
      this.commonError(productApiresult);
      this.isShow = true;
      return;
    }
    this.products = productApiresult.data;

    console.log("products:", this.products);

    this.isShow = true;
    this.$nextTick(function () {
      this.commonScriptService.execute();
      if (this.$route.hash.match(/^#/)) {
        console.log(
          document?.getElementById(this.$route.hash.replace(/^#/, ""))
        );
        document
          ?.getElementById(this.$route.hash.replace(/^#/, ""))
          ?.scrollIntoView();
      }
    });
  },
  methods: {

    mouseOver:function(){
      this.uphere = !this.uphere;
      var iconImages: any = document.querySelectorAll(".diagnose__img");

      if(this.uphere === false)
      {
        iconImages[0].setAttribute("src", "/img/index/diagnose.svg");
      }
      else if(this.uphere === true)
      {
        iconImages[0].setAttribute("src", "/img/index/diagnose-hover.svg");
      }
    },

    mouseDown:function(){
      this.uphere = !this.uphere;
      var iconImages: any = document.querySelectorAll(".diagnose__img");

      if(this.uphere === false)
      {
        iconImages[0].setAttribute("src", "/img/index/diagnose.svg");
      }
      else if(this.uphere === true)
      {
        iconImages[0].setAttribute("src", "/img/index/diagnose-hover.svg");

      }
    },


    spmouseOver:function(){
      this.spuphere = !this.spuphere;
      var iconImages: any = document.querySelectorAll(".diagnose__img1");

      if(this.spuphere === false)
      {
        iconImages[0].setAttribute("src", "/img/index/spdiagnose.svg");
      }
      else if(this.spuphere === true)
      {
        iconImages[0].setAttribute("src", "/img/index/spdiagnose-hover.svg");
      }
    },

    spmouseDown:function(){
      this.spuphere = !this.spuphere;
      var iconImages: any = document.querySelectorAll(".diagnose__img1");

      if(this.spuphere === false)
      {
        iconImages[0].setAttribute("src", "/img/index/spdiagnose.svg");
      }
      else if(this.spuphere === true)
      {
        iconImages[0].setAttribute("src", "/img/index/spdiagnose-hover.svg");

      }
    },

    showMore(): void {
      // if (this.blogcount < this.blogtotalcount)
      //   this.blogcount++;
      const query = "blog";
      console.log(location.pathname, location);
      location.href = location.href + query;
    },
    commonError: function (result: any = null): void {
      if (result.status === 422) {
        this.validateErrors = result.data.data;
      }
      if (result.message !== "") {
        this.message = result.message;
      }
    },
    monthAlphabet(): string {
      const months = [
        "JANUARY",
        "FEBRUARY",
        "MARCH",
        "APRIL",
        "MAY",
        "JUNE",
        "JULY",
        "AUGUST",
        "SEPTEMBER",
        "OCTOBER",
        "NOVEMBER",
        "DECEMBER",
      ];
      const dateObj = new Date();
      return months[dateObj.getMonth()];
    },
  },
});
</script>
<style scoped src="@/assets/css/index.css"></style>
