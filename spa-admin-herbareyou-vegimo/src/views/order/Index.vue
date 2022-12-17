<template>
  <h2 class="mb-3">注文一覧</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>id</th>
          <th>order no</th>
          <th>user id</th>
          <th>ユーザー名</th>
          <th>email</th>
          <th>tel1</th>
          <th>ステータス</th>
          <th>購入数</th>
          <th>合計金額</th>
          <th class="text-center">詳細へ</th>
        </tr>
        <tbody>
          <tr v-for="order in orders" :key="order.id">
            <td>{{ order.id }}</td>
            <td>{{ order.order_no }}</td>
            <td>{{ order.user_id }}</td>
            <td>{{ order.user_last_name }} {{ order.user_first_name }}</td>
            <td>{{ order.user_email }}</td>
            <td>{{ order.user_tel1 }}</td>
            <td>{{ orderStatusText(order.status) }}</td>
            <td>{{ order.total_num }}</td>
            <td class="text-end">{{ order.total_price }}円</td>
            <td class="text-center">
              <router-link
                :to="{ name: 'OrderShow', params: { id: order.id } }"
                class="btn btn-primary active"
              >
                詳細
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
import { indexOrderApi } from "@/api/orders";

export default defineComponent({
  name: "OrderIndex",
  components: {
    ErrorMessage,
    ValidateError,
  },
  data: () => ({
    isShow: false,
    message: "",
    orders: [] as any[],
  }),
  beforeRouteUpdate: async function (to, from, next) {},
  mounted: async function () {
    const result = await indexOrderApi({
      per_page: -1,
      order_by: "order_id_desc",
    });
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.orders = result.data;
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
    orderStatusText(status: number): string {
      if (status === 0) return "仮購入";
      if (status === 1) return "発送待ち";
      if (status === 2) return "発送済み";
      if (status === 3) return "完了";
      if (status === 8) return "購入失敗";
      if (status === 9) return "キャンセル";
      return "";
    },
  },
});
</script>
<style lang="scss" scoped></style>
