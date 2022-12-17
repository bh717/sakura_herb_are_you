<template>
  <div class="">
    <section class="sec">
      <div class="sec-container">
        <h2 class="sec-container__hd2">全商品一覧</h2>
        <div class="sort">
          <a href="" class="sp-filer-btn sp">フィルター</a>
          <div class="sort-left">
            <div class="accordion" id="js-filter">
              <div class="accordion__container">
                <a class="accordion__title js-accordion-title">症状で探す</a>
                <div class="accordion__content">
                  <ul class="sort-inner-list">
                    <li
                      class="sort-inner-item"
                      v-for="symptom in symptoms"
                      v-bind:key="symptom.id"
                    >
                      <input
                        type="checkbox"
                        :id="'symptom-' + String(symptom.id)"
                        name="categories"
                        :value="symptom.id"
                        v-model="symptomIds"
                        class="sort-inner-item__check"
                        v-on:change="goToSerch()"
                        :checked="symptomIds.includes(symptom.id)"
                      />
                      <label
                        :for="'symptom-' + String(symptom.id)"
                        class="sort-inner-item__label"
                        >{{ symptom.name }}</label
                      >
                    </li>
                  </ul>
                </div>
              </div>
              <div class="accordion__container">
                <a class="accordion__title js-accordion-title">味で探す</a>
                <div class="accordion__content">
                  <ul class="sort-inner-list">
                    <li
                      class="sort-inner-item"
                      v-for="taste in tastes"
                      v-bind:key="taste.id"
                    >
                      <input
                        type="checkbox"
                        :id="'taste-' + String(taste.id)"
                        name="categories"
                        :value="taste.id"
                        v-model="tasteIds"
                        class="sort-inner-item__check"
                        v-on:change="goToSerch()"
                        :checked="tasteIds.includes(taste.id)"
                      />
                      <label
                        :for="'taste-' + String(taste.id)"
                        class="sort-inner-item__label"
                        >{{ taste.name }}</label
                      >
                    </li>
                  </ul>
                </div>
              </div>
              <div class="accordion__container">
                <a class="accordion__title js-accordion-title">ハーブで探す</a>
                <div class="accordion__content">
                  <ul class="sort-inner-list">
                    <li
                      class="sort-inner-item"
                      v-for="material in materials"
                      v-bind:key="material.id"
                    >
                      <input
                        type="checkbox"
                        :id="'material-' + String(material.id)"
                        name="categories"
                        :value="material.id"
                        v-model="materialIds"
                        class="sort-inner-item__check"
                        v-on:change="goToSerch()"
                        :checked="materialIds.includes(material.id)"
                      />
                      <label
                        :for="'material-' + String(material.id)"
                        class="sort-inner-item__label"
                        >{{ material.name }}</label
                      >
                    </li>
                  </ul>
                </div>
              </div>
              <a class="clearall pc" v-on:click="clerAll()">CLEAR ALL</a>
              <a class="backBtn sp" href="">一覧へ</a>
              <div class="btn-container sp">
                <a href="" class="btn-container__clear">クリア</a>
                <a href="" class="btn-container__search">検索</a>
              </div>
            </div>
          </div>
          <div class="clearfix">
            <div class="sort-right">
              <div class="accordion">
                <div class="accordion__container accordion__container--pr0">
                  <a
                    class="accordion__title accordion__title--exc js-accordion-title"
                    >並び替え</a
                  >
                  <div class="accordion__content">
                    <ul class="sort-inner-list">
                      <li
                        class="sort-inner-item"
                        v-on:click="changeSortOrder('popularity_asc')"
                      >
                        人気順
                      </li>
                      <li
                        class="sort-inner-item"
                        v-on:click="changeSortOrder('price_asc')"
                      >
                        値段順
                      </li>
                      <li
                        class="sort-inner-item"
                        v-on:click="changeSortOrder('product_id_asc')"
                      >
                        商品番号
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <ul class="product-list clearfix" v-if="products.length !== 0">
          <li
            class="product-item"
            data-anime="fadeup"
            :data-category="'att-' + String(product.id)"
            v-for="(product, index) in products"
            v-bind:key="index"
          >
            <router-link
              :to="'/product/' + String(product.id)"
              class="product-item__link"
            >
              <img
                src="@/assets/img/product/detail/detail01/sample.jpg"
                alt=""
              />
            </router-link>
            <p class="product-item__sub">
              {{ product.category.name }}
            </p>
            <h3 class="product-item__ttl">
              <span class="product-item__ttl-num">{{
                product.product_no
              }}</span>
              <span class="product-item__ttl-main"
                >{{ product.name1 }}　¥{{ product.prices[0].price }}</span
              >
            </h3>
            <p class="product-item__name">{{ product.name2 }}</p>
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
                :to="'/product/' + String(product.id)"
                class="a-btn__link"
              >
                詳細を見る
              </router-link>
            </div>
          </li>
        </ul>
      </div>
    </section>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { CommonScriptService } from "@/services/CommonScriptService";
import { PageService } from "@/services/PageService";
import ValidateError from "@/components/ValidateError.vue";
import { indexProductApi } from "@/api/products";
import { indexCategoriesApi } from "@/api/products";

export default defineComponent({
  name: "ProductIndex",
  props: ["query"],
  watch: {
    query: {
      handler: async function ($newData, oldData) {
        if ($newData) {
          alert("");
          this.setSearch($newData);
          // 商品の検索を行う
          let productApiresult = await indexProductApi(this.getSerchData());
          if (!productApiresult.success) {
            this.commonError(productApiresult);
            return;
          }
          this.products = productApiresult.data;
        }
      },
      deep: true,
    },
  },
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
    ValidateError,
  },
  created: async function () {},
  mounted: async function (): Promise<void> {
    // urlのqueryparamから選択されているカテゴリを配列に入れる
    this.setSearch(this.pageService.getQueryObjectForUrl());
    // 選択するカテゴリの取得
    let ProductCategoriesApiresult = await indexCategoriesApi();
    if (!ProductCategoriesApiresult.success) {
      this.commonError(ProductCategoriesApiresult);
      return;
    }
    this.tastes = ProductCategoriesApiresult.data.tastes;
    this.materials = ProductCategoriesApiresult.data.materials;
    this.symptoms = ProductCategoriesApiresult.data.symptoms;
    // 商品の検索を行う
    let productApiresult = await indexProductApi(this.getSerchData());
    if (!productApiresult.success) {
      this.commonError(productApiresult);
      return;
    }
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
    },
    changeSortOrder: function (sortOrder: string): void {
      this.sortOrder = sortOrder;
      this.goToSerch();
    },
    clerAll: function (): void {
      location.href = "/product";
    },
    // 商品検索用のデータを取得する
    getSerchData(): any {
      return {
        taste_ids: this.pageService.implode(",", this.tasteIds),
        material_ids: this.pageService.implode(",", this.materialIds),
        symptom_ids: this.pageService.implode(",", this.symptomIds),
        per_page: -1,
      };
    },
    goToSerch() {
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
      this.$router.push("/product" + query);
    },
  },
});
</script>
<style scoped src="@/assets/css/product.css"></style>
