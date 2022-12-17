<template>
  <h2 class="mb-3">faq作成</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>カテゴリ名</th>
          <td class="py-2">
            <select class="form-select" v-model="items.faq_category_id">
              <option v-for="category in categories" :value="category.id">
                {{ category.name }}
              </option>
            </select>
            <ValidateError :errorMessages="validateErrors.faq_category_id" />
          </td>
        </tr>
        <tr>
          <th>タイトル</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="items.title" />
            <ValidateError :errorMessages="validateErrors.title" />
          </td>
        </tr>
        <tr>
          <th>内容</th>
          <td class="py-2">
            <textarea
              name=""
              id=""
              cols="40"
              rows="10"
              class="form-control"
              v-model="items.body"
            ></textarea>
            <ValidateError :errorMessages="validateErrors.body" />
          </td>
        </tr>
      </table>
      <div class="d-flex justify-content-center">
        <div class="px-2">
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
import UploadFile from "@/components/UploadFile.vue";

import { indexFaqCategoryApi } from "@/api/faq-categories";
import { storeFaqApi } from "@/api/faqs";

export default defineComponent({
  name: "FaqStore",
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
    items: {
      faq_category_id: null,
    } as any,
    categories: [] as any[],
  }),
  mounted: async function () {
    // カテゴリ
    let result = await indexFaqCategoryApi();
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.categories = result.data;

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
      const result = await storeFaqApi(this.items);
      if (!result.success) {
        this.commonError(result);
        this.submitDisable = false;
        return;
      }
      alert("作成しました");
      this.$router.push({
        name: "FaqUpdate",
        params: { id: result.data.id },
      });
    },
  },
});
</script>
<style lang="scss" scoped></style>
