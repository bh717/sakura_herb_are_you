<template>
  <h2 class="mb-3">faqカテゴリ一覧</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>名前</th>
          <th class="text-center">更新</th>
        </tr>
        <tbody>
          <tr v-for="faqCategory in faqCategories" :key="faqCategory.id">
            <td>{{ faqCategory.name }}</td>
            <td class="text-center">
              <router-link
                :to="{
                  name: 'FaqCategoryUpdate',
                  params: { id: faqCategory.id },
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
import { indexFaqCategoryApi } from "@/api/faq-categories";

export default defineComponent({
  name: "FaqCategoryIndex",
  components: {
    ErrorMessage,
    ValidateError,
  },
  data: () => ({
    isShow: false,
    message: "",
    faqCategories: [] as any[],
  }),
  beforeRouteUpdate: async function (to, from, next) {},
  mounted: async function () {
    const result = await indexFaqCategoryApi();
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.faqCategories = result.data;
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
