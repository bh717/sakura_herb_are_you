<template>
  <h2 class="mb-3">coupon更新</h2>
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
        <tr>
          <th>code</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="items.code" />
            <ValidateError :errorMessages="validateErrors.code" />
          </td>
        </tr>
        <tr>
          <th>値引き額</th>
          <td class="py-2">
            <input
              type="text"
              class="form-control"
              v-model="items.discount_price"
            />
            <ValidateError :errorMessages="validateErrors.discount_price" />
          </td>
        </tr>
        <tr>
          <th>有効期限</th>
          <td class="py-2">
            <input
              type="text"
              class="form-control"
              v-model="items.expired_at"
            />
            <ValidateError :errorMessages="validateErrors.expired_at" />
          </td>
        </tr>
        <!-- <tr>
          <th>使用制限回数</th>
          <td class="py-2">
            <input
              type="text"
              class="form-control"
              v-model="coupon.usage_limit_per_user"
              disabled
            />
            <ValidateError :errorMessages="validateErrors.expired_at" />
          </td>
        </tr> -->
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
  showCouponApi,
  updateCouponApi,
  destroyCouponApi,
} from "@/api/coupons";

export default defineComponent({
  name: "CouponUpdate",
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
    coupon: {} as any,
    categories: [] as any[],
  }),
  mounted: async function () {
    // coupon
    const result = await showCouponApi(this.$route.params.id);
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.coupon = result.data;
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
      this.items.name = this.coupon.name;
      this.items.code = this.coupon.code;
      this.items.discount_price = this.coupon.discount_price;
      this.items.expired_at = this.coupon.expired_at;
    },
    update: async function () {
      this.submitDisable = true;
      const result = await updateCouponApi(this.$route.params.id, this.items);
      this.submitDisable = false;
      if (!result.success) {
        this.commonError(result);
        return;
      }
      alert("更新しました");
    },
    destroy: async function () {
      this.submitDisable = true;
      const result = await destroyCouponApi(this.$route.params.id);
      this.submitDisable = false;
      if (!result.success) {
        this.commonError(result);
        return;
      }
      alert("削除しました");
      this.$router.push({
        name: "CouponIndex",
      });
    },
  },
});
</script>
<style lang="scss" scoped></style>
