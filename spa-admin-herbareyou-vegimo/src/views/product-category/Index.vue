<template>
  <h2 class="mb-3">カテゴリ一覧</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>名前</th>
          <th>シリーズ名</th>
          <th class="text-center">更新</th>
        </tr>
        <tbody>
          <tr v-for="material in materials" :key="material.id">
            <td>{{ material.name }}</td>
            <td>{{ material.series_name }}</td>
            <td class="text-center">
              <router-link
                :to="{
                  name: 'ProductCategoryUpdate',
                  params: { id: material.id },
                }"
                class="btn btn-primary active"
              >
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
import { indexProductCategoryApi } from "@/api/product-categories";

export default defineComponent({
  name: "ProductCategoryIndex",
  components: {
    ErrorMessage,
    ValidateError,
  },
  data: () => ({
    isShow: false,
    message: "",
    materials: [] as any[],
  }),
  beforeRouteUpdate: async function (to, from, next) {},
  mounted: async function () {
    const result = await indexProductCategoryApi();
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.materials = result.data;
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
