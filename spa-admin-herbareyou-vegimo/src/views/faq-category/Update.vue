<template>
  <h2 class="mb-3">faqカテゴリ更新</h2>
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
      </table>
      <div class="d-flex justify-content-center">
        <div class="px-2">
          <button
            type="button"
            class="btn btn-primary"
            v-on:click="update()"
            :disabled="submitDisable"
          >
            編集する
          </button>
        </div>
        <div class="px-2">
          <button
            type="button"
            class="btn btn-danger"
            v-on:click="destroy()"
            :disabled="submitDisable"
          >
            削除する
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
import {
  showFaqCategoryApi,
  updateFaqCategoryApi,
  destroyFaqCategoryApi,
} from "@/api/faq-categories";

import UploadFile from "@/components/UploadFile.vue";

export default defineComponent({
  name: "FaqCategoryUpdate",
  components: {
    ErrorMessage,
    ValidateError,
    UploadFile,
  },
  data: () => ({
    isShow: false,
    message: "",
    submitDisable: false,
    validateErrors: {} as any,
    items: {} as any,
    faqCategory: {} as any,
  }),
  mounted: async function () {
    // カテゴリ
    const result = await showFaqCategoryApi(this.$route.params.id);
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.faqCategory = result.data;
    this.setInitData();
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
    setInitData: function () {
      this.items.name = this.faqCategory.name;
    },
    update: async function () {
      this.submitDisable = true;
      const result = await updateFaqCategoryApi(
        this.$route.params.id,
        this.items.name
      );
      this.submitDisable = false;
      if (!result.success) {
        this.commonError(result);
        return;
      }
      alert("更新しました");
    },
    destroy: async function () {
      this.submitDisable = true;
      const result = await destroyFaqCategoryApi(this.$route.params.id);
      this.submitDisable = false;
      if (!result.success) {
        this.commonError(result);
        return;
      }
      alert("削除しました");
      this.$router.push({
        name: "FaqCategoryIndex",
      });
    },
  },
});
</script>
<style lang="scss" scoped></style>
