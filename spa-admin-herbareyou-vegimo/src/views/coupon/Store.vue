<template>
  <h2 class="mb-3">coupon作成</h2>
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
            <input type="text" class="form-control" v-model="items.discount_price" />
            <ValidateError :errorMessages="validateErrors.discount_price" />
          </td>
        </tr>
        <tr>
          <th>有効期限</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="items.expired_at" />
            <ValidateError :errorMessages="validateErrors.expired_at" />
          </td>
        </tr>
      </table>
      <div class="d-flex justify-content-center">
        <div class="px-2">
          <button type="button" class="btn btn-primary" v-on:click="create()" :disabled="submitDisable">
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
import { storeCouponApi } from "@/api/coupons";

export default defineComponent({
  name: "CouponStore",
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
    items: {} as any,
    categories: [] as any[],
  }),
  mounted: async function () {
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
      const result = await storeCouponApi(this.items);
      if (!result.success) {
        this.commonError(result);
        this.submitDisable = false;
        return;
      }
      alert("作成しました");
      this.$router.push({
        name: "CouponUpdate",
        params: { id: result.data.id },
      });
    },
  },
});
</script>
<style lang="scss" scoped></style>
