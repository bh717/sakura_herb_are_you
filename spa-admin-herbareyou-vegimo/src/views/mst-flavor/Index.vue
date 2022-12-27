<template>
  <h2 class="mb-3">香り一覧</h2>
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
          <tr v-for="flavor in flavors" :key="flavor.id">
            <td>{{ flavor.name }}</td>
            <td>{{ flavor.category_no }}</td>
            <td class="text-center">
              <router-link :to="{ name: 'FlavorUpdate', params: { id: flavor.id } }" class="btn btn-primary active">
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
import { indexFlavorApi } from "@/api/mst-flavors";

export default defineComponent({
  name: "FlavorIndex",
  components: {
    ErrorMessage,
    ValidateError,
  },
  data: () => ({
    isShow: false,
    message: "",
    flavors: [] as any[],
  }),
  beforeRouteUpdate: async function (to, from, next) {},
  mounted: async function () {
    const result = await indexFlavorApi();
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.flavors = result.data;
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
