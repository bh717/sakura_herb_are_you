<template>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>id</th>
          <th>名前</th>
          <th>email</th>
          <th class="text-center">編集</th>
        </tr>
        <tr v-for="adminer in adminers" :key="adminer.id">
          <td>{{ adminer.id }}</td>
          <td>{{ adminer.name }}</td>
          <td>{{ adminer.email }}</td>
          <td class="text-center">
            <router-link
              :to="{ name: 'AdminerUpdate', params: { id: adminer.id } }"
              class="btn btn-primary active btn-sm"
            >
              編集
            </router-link>
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import ErrorMessage from "@/components/ErrorMessage.vue";
import ValidateError from "@/components/ValidateError.vue";
import { AdminerService } from "@/services/AdminerService";

export default defineComponent({
  name: "ProductIndex",
  components: {
    ErrorMessage,
    ValidateError,
  },
  data: () => ({
    isShow: false,
    message: "",
    items: {} as any,
    adminers: [] as any[],
    adminerService: new AdminerService(),
  }),
  // beforeRouteUpdate: async function (to, from, next): Promise<void> {
  // },
  mounted: async function () {
    this.items.per_page = -1;
    const result = await this.adminerService.indexApi(this.items);
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.adminers = result.data;
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
