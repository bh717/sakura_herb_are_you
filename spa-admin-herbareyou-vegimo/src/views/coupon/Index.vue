<template>
  <h2 class="mb-3">coupon一覧</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>名前</th>
          <th>code</th>
          <th>値引き額</th>
          <th>有効期限</th>
          <!-- <th>使用制限回数</th> -->
          <th class="text-center">更新</th>
        </tr>
        <tbody>
          <tr v-for="coupon in coupons" :key="coupon.id">
            <td>{{ coupon.name }}</td>
            <td>{{ coupon.code }}</td>
            <td>{{ coupon.discount_price }}</td>
            <td>{{ coupon.expired_at }}</td>
            <!-- <td>{{ coupon.usage_limit_per_user }}</td> -->
            <td class="text-center">
              <router-link
                :to="{
                  name: 'CouponUpdate',
                  params: { id: coupon.id },
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
import { indexCouponApi } from "@/api/coupons";

export default defineComponent({
  name: "CouponIndex",
  components: {
    ErrorMessage,
    ValidateError,
  },
  data: () => ({
    isShow: false,
    message: "",
    coupons: [] as any[],
  }),
  beforeRouteUpdate: async function (to, from, next) {},
  mounted: async function () {
    const result = await indexCouponApi();
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.coupons = result.data;
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
