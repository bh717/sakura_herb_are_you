<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article v-if="isShow">
        <section class="sec">
          <div class="sec-container">
            <h2 class="sec-container__hd2">
              診断が完了しました！<br />{{ this.name }}さんにおすすめの<br class="sp" />ハーブティはこちらです。
            </h2>

            <ul class="product-list clearfix">
              <li class="product-item is-active" data-anime="fadeup" :data-category="'att-' + index"
                v-for="(product, index) in products" v-bind:key="product.id">
                <router-link class="product-item__link" :to="{ name: 'ProductShow', params: { id: product.id } }">
                  <img :src="product.upload_files[0].url" alt="" class="product_img" />
                </router-link>
                <p class="product-item__sub1">{{ product.category.name }}</p>
                <p class="product-item__name1">{{ product.name1 }}</p>
                <p class="product-item__ttl1">
                  <span class="product-item__ttl-num1">{{
                    product.product_no
                  }}</span>
                  <span>|</span>
                  <span class="product-item__ttl-main1">{{ product.name2 }}　¥{{ product.prices[0].price }}</span>
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
                  <router-link class="a-btn__link1" :to="'/product/' + String(product.id)">詳細を見る</router-link>
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
import { indexProductApi } from "@/api/products";
import { indexCategoriesApi } from "@/api/products";

export default defineComponent({
  name: "DiagnoseIndex",
  watch: {},
  data() {
    return {
      diagnoseData: {} as any,
      name: "" as string,
      isShow: false,
      message: "",
      validateErrors: {} as any,
      tastes: [] as any[],
      flavors: [] as any[],
      materials: [] as any[],
      sortedmaterials: [] as any[],
      symptoms: [] as any[],
      products: [] as any[],
      tasteIds: [] as number[],
      flavorIds: [] as number[],
      materialIds: [] as number[],
      symptomIds: [] as number[],
      searchsymptomIds: [] as number[],
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
    this.init();
    // urlのqueryparamから選択されているカテゴリを配列に入れる
    this.setSearch(this.pageService.getQueryObjectForUrl());
    console.log("pageService:", this.pageService.getQueryObjectForUrl());
    // 選択するカテゴリの取得
    let ProductCategoriesApiresult = await indexCategoriesApi();
    if (!ProductCategoriesApiresult.success) {
      this.commonError(ProductCategoriesApiresult);
      return;
    }
    this.tastes = ProductCategoriesApiresult.data.tastes;
    this.flavors = ProductCategoriesApiresult.data.flavors;

    this.materials = ProductCategoriesApiresult.data.materials;
    console.log("materials", this.materials);

    this.sortedmaterials = this.materials.sort((a, b) => {
      if (a.name < b.name) return -1;
      if (a.name > b.name) return 1;
      return 0;
    });

    console.log("sorted materials", this.sortedmaterials);

    this.symptoms = ProductCategoriesApiresult.data.symptoms;
    // 商品の検索を行う
    console.log("searchData:", this.getSearchData());

    let productApiresult = await indexProductApi(this.getSearchData());
    if (!productApiresult.success) {
      this.commonError(productApiresult);
      return;
    }
    this.products = productApiresult.data;
    console.log("product list:", this.products);
    this.isShow = true;
    this.$nextTick(function () {
      this.commonScriptService.execute();
    });
  },

  methods: {
    init: async function () {
      const diagnoseJsonData = localStorage.getItem("diagnoseJsonData");
      console.log("data:", diagnoseJsonData);
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
      this.searchsymptomIds = diagnoseData.diagnose2.condition;
      console.log(typeof diagnoseData.diagnose2.condition);
      if(diagnoseData.diagnose2.condition === 20){
        this.searchsymptomIds = '';
      }
      this.name = diagnoseData?.diagnose0?.name;
      console.log("name:", this.name);
    },
    sortedItems: function () {
      let searchString = this.searchString;
      const sortedArray = this.materials.sort((a, b) => {
        if (a[this.sortKey].name < b[this.sortKey].name) return -1;
        if (a[this.sortKey].name > b[this.sortKey].name) return 1;
        return 0;
      });
      if (!searchString) {
        return sortedArray;
      } else {
        searchString = searchString.trim().toLowerCase();
        const search_array = sortedArray.filter((item) => {
          if (item.name.toLowerCase().indexOf(searchString) !== -1) {
            return item;
          }
        });
        return search_array;
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

    // urlのqueryparamから選択されているカテゴリを配列に入れる
    setSearch: function (queryParams: any): any {
      console.log("queryParams:", queryParams);
      this.tasteIds = queryParams.taste_ids
        ? queryParams.taste_ids.split(",")
        : [];
      this.flavorIds = queryParams.flavor_ids
        ? queryParams.flavor_ids.split(",")
        : [];
      this.materialIds = queryParams.material_ids
        ? queryParams.material_ids.split(",")
        : [];
      this.symptomIds = queryParams.symptom_ids
        ? queryParams.symptom_ids.split(",")
        : [this.searchsymptomIds];
      this.sortOrder = queryParams.order_by ?? "";
    },

    changeSortOrder: function (sortOrder: string): void {
      this.sortOrder = sortOrder;
      this.goToSearch();
    },

    clearAll: function (e: any): void {
      e.preventDefault();
      location.href = location.pathname;
    },
    // 商品検索用のデータを取得する
    getSearchData(): any {
      console.log("symptomIds:", this.symptomsIds);
      return {
        taste_ids: this.pageService.implode(",", this.tasteIds),
        flavor_ids: this.pageService.implode(",", this.flavorIds),
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
        "&flavor_ids=" +
        this.pageService.implode(",", this.flavorIds) +
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

<style scoped src="@/assets/css/diagnoseresult.css">

</style>
