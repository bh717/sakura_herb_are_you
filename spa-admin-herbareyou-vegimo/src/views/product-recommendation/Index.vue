<template>
  <h2 class="mb-3" v-if="$route.params.kind === '1'">HEALING(具体的な症状・不調に)</h2>
  <h2 class="mb-3" v-else-if="$route.params.kind === '2'">INSPIRATION(前向きな今日に)</h2>
  <h2 class="mb-3" v-else-if="$route.params.kind === '3'">MAINTENANCE(なんとなくのもやもやに)</h2>
  <h2 class="mb-3" v-else-if="$route.params.kind === '4'">今月のおすすめハーブティー</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>商品名</th>
          <th class="text-center">削除</th>
        </tr>
        <tbody>
          <tr v-for="(selectedProductId, index) in selectedProductIds" :key="index">
            <td>
              <select class="form-select" v-model="selectedProductIds[index]">
                <option :value="null">選択する</option>
                <option v-for="product in products" :key="product.id" :value="product.id">
                  {{ product.name2 }}
                </option>
              </select>
              <ValidateError :errorMessages="
                  `product_ids.${index}` in validateErrors
                    ? validateErrors[`product_ids.${index}`]
                    : []
                " />
            </td>
            <td class="text-center">
              <button type="button" class="btn btn-danger" v-on:click="deleteSelected(index)">
                削除
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="d-flex justify-content-center">
        <div class="px-2">
          <button type="button" class="btn btn-primary" v-on:click="add()" :disabled="submitDisable">
            追加する
          </button>
        </div>
        <div class="px-2">
          <button type="button" class="btn btn-primary" v-on:click="create()" :disabled="submitDisable">
            更新する
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import ErrorMessage from "@/components/ErrorMessage.vue";

import ValidateError from "@/components/ValidateError.vue";
import { indexProductApi } from "@/api/products";
import {
  indexProductRecommendationApi,
  createProductRecommendationApi,
} from "@/api/product-recommendations";
import { PageService } from "@/services/PageService";

export default defineComponent({
  name: "ProductRecommendationIndex",
  components: {
    ErrorMessage,
    ValidateError,
  },
  data: () => ({
    isShow: false,
    message: "",
    validateErrors: {} as any,
    products: [] as any[],
    selectedProductIds: [] as number[],
    productRecommendations: [] as any[],
    kind: 0 as number,
    pageService: new PageService(),
    submitDisable: false,
  }),
  beforeRouteUpdate: async function (to, from, next) {
    next();
    this.kind = Number(to.params.kind);
    this.init();
  },
  mounted: async function () {
    const productResult = await indexProductApi({ per_page: -1, is_public: 1, });
    if (!productResult.success) {
      this.commonError(productResult);
      return;
    }
    this.products = productResult.data;
    this.kind = Number(this.$route.params.kind);
    this.init();
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
    init: async function () {
      this.isShow = false;
      this.productRecommendations = [];
      this.selectedProductIds = [];
      const recommendationResult = await indexProductRecommendationApi({
        kind: this.kind,
      });
      if (!recommendationResult.success) {
        this.commonError(recommendationResult);
        return;
      }
      this.productRecommendations = recommendationResult.data;
      console.log(this.productRecommendations.length === 0);
      if (this.productRecommendations.length === 0) {
        this.selectedProductIds.push(0);
        this.isShow = true;
        return;
      }
      for (const productRecommendation of this.productRecommendations) {
        this.selectedProductIds.push(productRecommendation.product_id);
      }
      this.isShow = true;
    },
    deleteSelected: function (index: number) {
      this.selectedProductIds.splice(index, 1);
      this.validateErrors = {};
    },
    create: async function () {
      this.submitDisable = true;
      const recommendationResult = await createProductRecommendationApi(
        this.selectedProductIds,
        Number(this.kind)
      );
      this.submitDisable = false;
      if (!recommendationResult.success) {
        this.commonError(recommendationResult);
        return;
      }
      alert("更新しました");
    },
    add: function () {
      this.selectedProductIds.push(0);
    },
  },
});
</script>
<style lang="scss" scoped></style>
