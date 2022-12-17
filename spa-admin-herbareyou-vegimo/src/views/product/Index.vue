<template>
  <h2 class="mb-3">商品一覧</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>品番</th>
          <th>材料</th>
          <th>シリーズ名</th>
          <th>商品名</th>
          <th>カテゴリー</th>
          <th>症状</th>
          <th>味の特徴</th>
          <th class="text-center">更新</th>
        </tr>
        <tbody>
          <tr v-for="product in products" :key="product.id">
            <td>{{ product.product_no }}</td>
            <td>{{ product.material_name_text_csv ?? "" }}</td>
            <td>{{ product.name1 }}</td>
            <td>{{ product.name2 }}</td>
            <td>{{ product.category.name }}</td>
            <td>{{ product.symptom_name_text_csv ?? "" }}</td>
            <td>{{ product.taste_name_text_csv ?? "" }}</td>
            <td class="text-center">
              <router-link :to="{ name: 'ProductUpdate', params: { id: product.id } }" class="btn btn-primary active">
                編集
              </router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import ErrorMessage from "@/components/ErrorMessage.vue";

import ValidateError from "@/components/ValidateError.vue";
import { indexProductApi } from "@/api/products";

export default defineComponent({
  name: "ProductIndex",
  components: {
    ErrorMessage,
    ValidateError,
  },
  data: () => ({
    isShow: false,
    message: "",
    products: [] as any[],
  }),
  beforeRouteUpdate: async function (to, from, next) {},
  mounted: async function () {
    const result = await indexProductApi({
      per_page: -1,
      // order_by: 'product_no',
    });
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.products = result.data;
    this.isShow = true;
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
<style lang="scss" scoped></style>
