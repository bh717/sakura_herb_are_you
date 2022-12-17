<template>
  <h2 class="mb-3">味の特徴一覧</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>名前</th>
          <th>no</th>
          <th class="text-center">更新</th>
        </tr>
        <tbody>
          <tr v-for="taste in tastes" :key="taste.id">
            <td>{{ taste.name }}</td>
            <td>{{ taste.category_no }}</td>
            <td class="text-center">
              <router-link :to="{ name: 'TasteUpdate', params: { id: taste.id } }" class="btn btn-primary active">
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
import { indexTasteApi } from "@/api/mst-tastes";

export default defineComponent({
  name: "TasteIndex",
  components: {
    ErrorMessage,
    ValidateError,
  },
  data: () => ({
    isShow: false,
    message: "",
    tastes: [] as any[],
  }),
  beforeRouteUpdate: async function (to, from, next) {},
  mounted: async function () {
    const result = await indexTasteApi();
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.tastes = result.data;
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
