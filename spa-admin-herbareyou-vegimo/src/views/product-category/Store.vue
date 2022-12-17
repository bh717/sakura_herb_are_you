<template>
  <h2 class="mb-3">カテゴリ作成</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>名前</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="items.name" />
            <ValidateError :errorMessages="validateErrors.name" />
          </td>
        </tr>
        <tr>
          <th>シリーズ名</th>
          <td class="py-2">
            <input
              type="text"
              class="form-control"
              v-model="items.series_name"
            />
            <ValidateError :errorMessages="validateErrors.series_name" />
          </td>
        </tr>
      </table>

      <div class="d-flex justify-content-center">
        <div class="p-2">
          <button
            type="button"
            class="btn btn-primary"
            v-on:click="create()"
            :disabled="submitDisable"
          >
            作成する
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
import { storeProductCategoryApi } from "@/api/product-categories";

export default defineComponent({
  name: "ProductCategoryUpdate",
  components: {
    ErrorMessage,
    ValidateError,
  },
  data: () => ({
    isShow: false,
    message: "",
    submitDisable: false,
    validateErrors: {} as any,
    items: {} as any,
  }),
  mounted: async function () {
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
    create: async function () {
      this.submitDisable = true;
      const result = await storeProductCategoryApi(
        this.items.name,
        this.items.series_name
      );
      if (!result.success) {
        this.commonError(result);
        this.submitDisable = false;
        return;
      }
      alert("作成しました");
      this.$router.push({
        name: "ProductCategoryIndex",
      });
    },
  },
});
</script>
<style lang="scss" scoped></style>
