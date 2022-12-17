<template>
  <h2 class="mb-3">faq更新</h2>
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
import { indexFaqCategoryApi } from "@/api/faq-categories";
import { showFaqApi, updateFaqApi, destroyFaqApi } from "@/api/faqs";

export default defineComponent({
  name: "FaqUpdate",
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
    cfaq: {} as any,
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
    // faq
    result = await showFaqApi(this.$route.params.id);
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.faq = result.data;
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
      this.items.faq_category_id = this.faq.faq_category_id;
      this.items.title = this.faq.title;
      this.items.body = this.faq.body;
    },
    update: async function () {
      this.submitDisable = true;
      const result = await updateFaqApi(this.$route.params.id, this.items);
      this.submitDisable = false;
      if (!result.success) {
        this.commonError(result);
        return;
      }
      alert("更新しました");
    },
    destroy: async function () {
      this.submitDisable = true;
      const result = await destroyFaqApi(this.$route.params.id);
      this.submitDisable = false;
      if (!result.success) {
        this.commonError(result);
        return;
      }
      alert("削除しました");
      this.$router.push({
        name: "FaqIndex",
      });
    },
  },
});
</script>
<style lang="scss" scoped></style>
