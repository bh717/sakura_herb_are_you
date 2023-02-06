<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article v-if="isShow">
        <div class="kv">
          <img src="@/assets/img/trialset/trialBackground.png" class="kv__img" />
          <img src="@/assets/img/trialset/trialBackground1.png" class="kv__img1" />

          <div class="trial-sec-p-section">
            
            <p className="trial-sec-p1">飲み比べができるお試しセット</p>
            <p className="trial-sec-p3">Assorted Trial Pack</p>
            <p className="trial-sec-p2">7種類のブレンド入り</p>
          </div>
        </div>
        <section class="sec">
          <div class="trial-sec-container">
            <p class="sec-container__txt">
              初めてご利用する方や、ハーブティーをあまり飲んだことが<br />
              ない方のために、お試しセットをご用意しました。<br />
              飲みやすいブレンドを7つセレクトしています。<br />
              飲み比べて、ぜひあなたのお気に入りをみつけてください。
            </p>
          </div>

          <div class="trial-sec-container1">
            <p class="trial-p">
              初めてHerb Are You?を知った方や、</p>
            <p class="trial-p">ハーブティーをあまり飲んだことがない方へ、</p>
            <p class="trial-p">アソートパックをご用意しました。</p>
            <p class="trial-p">飲みやすい美味しいブレンドを</p>

            <p class="trial-p">セレクトしています。</p>
            <p class="trial-p">飲み比べて、ぜひあなたの</p>
            <p class="trial-p">お気に入りをみつけてください。</p>

          </div>

        </section>
        <section class="sec">
          <div class="sec-container">
            <ul class="product-list clearfix" v-if="products.length !== 0">
              <li class="product-item" data-anime="fadeup" :data-category="'att-' + String(product.id)"
                v-for="(product, index) in products" v-bind:key="index">
                <router-link :to="'/trialproduct/' + String(product.id)" class="product-item__link">
                  <img :src="product.upload_files[0].url" alt="" />
                </router-link>
                <p class="product-item__sub">
                  {{ product.category.name }}
                </p>
                <p class="product-item__name">{{ product.name1 }}</p>
                <p class="product-item__ttl">
                  <span class="product-item__ttl-num">{{
                      product.product_no
                  }}</span>
                  <span>|</span>
                  <span class="product-item__ttl-main">{{ product.name2 }}　¥{{ product.prices[0].price }}</span>
                </p>
                <div class="a-btn">
                  <router-link :to="'/trialproduct/' + String(product.id)" class="a-btn__link">
                    詳細を見る
                  </router-link>
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
import { CommonScriptService } from "@/services/CommonScriptService";
import { PageService } from "@/services/PageService";
import Footer from "@/components/Footer.vue";
import Header from "@/components/Header.vue";
import ValidateError from "@/components/ValidateError.vue";
import { indexProductApi } from "@/api/trialproducts";
import { indexCategoriesApi } from "@/api/trialproducts";

export default defineComponent({
  name: "TrialSetIndex",
  watch: {},
  data() {
    return {
      isShow: false,
      message: "",
      validateErrors: {} as any,
      tastes: [] as any[],
      materials: [] as any[],
      symptoms: [] as any[],
      products: [] as any[],
      tasteIds: [] as number[],
      materialIds: [] as number[],
      symptomIds: [] as number[],
      sortOrder: "" as string,
      commonScriptService: new CommonScriptService(),
      pageService: new PageService(),
    };
  },
  components: {
    Footer,
    Header,
    ValidateError,
  },
  created: async function () { },
  mounted: async function (): Promise<void> {
    document.body.className = "index";

    // urlのqueryparamから選択されているカテゴリを配列に入れる
    this.setSearch(this.pageService.getQueryObjectForUrl());
    // 選択するカテゴリの取得
    let ProductCategoriesApiresult = await indexCategoriesApi();
    console.log("productCategr",ProductCategoriesApiresult);

    if (!ProductCategoriesApiresult.success) {
      this.commonError(ProductCategoriesApiresult);
      return;
    }
    this.tastes = ProductCategoriesApiresult.data.tastes;
    this.materials = ProductCategoriesApiresult.data.materials;
    this.symptoms = ProductCategoriesApiresult.data.symptoms;
    // alert(1);
    // 商品の検索を行う
    let productApiresult = await indexProductApi(this.getSearchData());
    if (!productApiresult.success) {
      this.commonError(productApiresult);
      return;
    }
    console.log("productApiresult", productApiresult);
    this.products = productApiresult.data;
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
    // urlのqueryparamから選択されているカテゴリを配列に入れる
    setSearch: function (queryParams: any): any {
      this.tasteIds = queryParams.taste_ids
        ? queryParams.taste_ids.split(",")
        : [];
      this.materialIds = queryParams.material_ids
        ? queryParams.material_ids.split(",")
        : [];
      this.symptomIds = queryParams.symptom_ids
        ? queryParams.symptom_ids.split(",")
        : [];
      this.sortOrder = queryParams.order_by ?? "";
    },
    changeSortOrder: function (sortOrder: string): void {
      this.sortOrder = sortOrder;
      this.goToSearch();
    },
    clearAll: function (e: any): void {
      e.preventDefault();
      // location.href = "/product";
      location.href = location.pathname;
    },
    // 商品検索用のデータを取得する
    getSearchData(): any {
      return {
        taste_ids: this.pageService.implode(",", this.tasteIds),
        material_ids: this.pageService.implode(",", this.materialIds),
        symptom_ids: this.pageService.implode(",", this.symptomIds),
        per_page: -1,
        order_by: this.sortOrder,
      };
    },
    toSearch(e: any) {
      e.preventDefault();
      this.goToSearch();
    },
    goToSearch() {
      const query: string =
        "?" +
        "taste_ids=" +
        this.pageService.implode(",", this.tasteIds) +
        "&material_ids=" +
        this.pageService.implode(",", this.materialIds) +
        "&symptom_ids=" +
        this.pageService.implode(",", this.symptomIds) +
        "&order_by=" +
        this.sortOrder;
      location.href = location.pathname + query;
      return;
    },
  },
});
</script>
<style scoped src="@/assets/css/trial.css">

</style>
  