<template>
  <h2 class="mb-3">クーポン一覧</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>カテゴリ</th>
          <th>タイトル</th>
          <th>内容</th>
          <th class="text-center">更新</th>
        </tr>
        <tbody>
          <tr v-for="faq in faqs" :key="faq.id">
            <td>{{ faq.category.name }}</td>
            <td>{{ faq.name }}</td>
            <td>{{ faq.body }}</td>
            <td class="text-center">
              <router-link
                :to="{
                  name: 'FaqUpdate',
                  params: { id: faq.id },
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
import { indexFaqApi } from "@/api/faqs";

export default defineComponent({
  name: "FaqIndex",
  components: {
    ErrorMessage,
    ValidateError,
  },
  data: () => ({
    isShow: false,
    message: "",
    faqs: [] as any[],
  }),
  beforeRouteUpdate: async function (to, from, next) {},
  mounted: async function () {
    const result = await indexFaqApi();
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.faqs = result.data;
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
