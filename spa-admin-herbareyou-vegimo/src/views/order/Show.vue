<template>
  <h2 class="mb-3">注文詳細</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div class="row">
      <div class="col-6">
        <select
          class="form-select"
          v-model="status"
          v-on:change="updateStatus()"
        >
          <option :value="0" :selected="status === 0">仮購入</option>
          <option :value="1" :selected="status === 1">
            発送待ち(支払い済み)
          </option>
          <option :value="2" :selected="status === 2">発送済み</option>
          <option :value="3" :selected="status === 3">
            完了(アフターメール送信完了)
          </option>
          <option :value="8" :selected="status === 8">購入失敗</option>
          <option :value="9" :selected="status === 9">キャンセル</option>
        </select>
        <ValidateError :errorMessages="validateErrors['status'] ?? []" />
      </div>
    </div>

    <div class="mt-2">
      <h4>注文情報</h4>
      <table class="table table-striped">
        <tr>
          <th>id</th>
          <td>{{ order.id }}</td>
        </tr>
        <tr>
          <th>注文no</th>
          <td>{{ order.order_no }}</td>
        </tr>
        <tr>
          <th>購入ステータス</th>
          <td>{{ order.status_text }}</td>
        </tr>
        <tr>
          <th>購入日</th>
          <td>{{ order.created_at }}</td>
        </tr>
      </table>
    </div>

    <div class="mt-2">
      <h4>お客様情報</h4>
      <table class="table table-striped">
        <tr>
          <th>ユーザーID</th>
          <td>{{ order.user_id }}</td>
        </tr>
        <tr>
          <th>Email</th>
          <td>{{ order.user_email }}</td>
        </tr>
        <tr>
          <th>ユーザー名</th>
          <td>{{ order.user_last_name }} {{ order.user_first_name }}</td>
        </tr>
        <tr>
          <th>ユーザー名(英語表記)</th>
          <td>
            {{ order.user_last_name_kana }}{{ order.user_first_name_kana }}
          </td>
        </tr>
        <tr>
          <th>誕生日</th>
          <td>{{ order.user_birthday }}</td>
        </tr>
        <tr>
          <th>郵便番号</th>
          <td>{{ order.user_zip }}</td>
        </tr>
        <tr>
          <th>住所</th>
          <td>{{ order.user_address1 }}</td>
        </tr>
        <tr>
          <th>電話番号</th>
          <td>{{ order.user_tel1 }}</td>
        </tr>
      </table>
    </div>

    <div class="mt-2">
      <h4>配送先情報</h4>
      <table class="table table-striped">
        <tr>
          <th>配送先名(苗字)</th>
          <td>
            <input
              type="text"
              class="form-control"
              v-model="deliveryLocation.user_delivery_location_last_name"
            />
            <ValidateError
              :errorMessages="
                deliveryLocationValidateErrors.user_delivery_location_last_name
              "
            />
          </td>
        </tr>
        <tr>
          <th>配送先名(名前)</th>
          <td>
            <input
              type="text"
              class="form-control"
              v-model="deliveryLocation.user_delivery_location_first_name"
            />
            <ValidateError
              :errorMessages="
                deliveryLocationValidateErrors.user_delivery_location_first_name
              "
            />
          </td>
        </tr>
        <tr>
          <th>配送先名(苗字)(英語表記)</th>
          <td>
            <input
              type="text"
              class="form-control"
              v-model="deliveryLocation.user_delivery_location_last_name_kana"
            />
            <ValidateError
              :errorMessages="
                deliveryLocationValidateErrors.user_delivery_location_last_name_kana
              "
            />
          </td>
        </tr>
        <tr>
          <th>配送先名(名前)(英語表記)</th>
          <td>
            <input
              type="text"
              class="form-control"
              v-model="deliveryLocation.user_delivery_location_first_name_kana"
            />
            <ValidateError
              :errorMessages="
                deliveryLocationValidateErrors.user_delivery_location_first_name_kana
              "
            />
          </td>
        </tr>
        <tr>
          <th>配送先郵便番号</th>
          <td>
            <input
              type="text"
              class="form-control"
              v-model="deliveryLocation.user_delivery_location_zip"
            />
            <ValidateError
              :errorMessages="
                deliveryLocationValidateErrors.user_delivery_location_zip
              "
            />
          </td>
        </tr>
        <tr>
          <th>配送先住所</th>
          <td>
            <input
              type="text"
              class="form-control"
              v-model="deliveryLocation.user_delivery_location_address1"
            />
            <ValidateError
              :errorMessages="
                deliveryLocationValidateErrors.user_delivery_location_address1
              "
            />
          </td>
        </tr>
        <tr>
          <th>配送先電話番号</th>
          <td>
            <input
              type="text"
              class="form-control"
              v-model="deliveryLocation.user_delivery_location_tel1"
            />
            <ValidateError
              :errorMessages="
                deliveryLocationValidateErrors.user_delivery_location_tel1
              "
            />
          </td>
        </tr>
      </table>

      <div class="d-flex justify-content-center">
        <div class="px-2">
          <button
            type="button"
            class="btn btn-primary"
            v-on:click="updateDeliveryLocation()"
          >
            更新する
          </button>
        </div>
      </div>
    </div>
    <div class="mt-2">
      <h4>商品詳細</h4>
      <table
        class="table table-striped"
        v-for="detail in order.details"
        :key="detail.id"
      >
        <tr>
          <th>商品id</th>
          <td>{{ detail.product_id }}</td>
        </tr>
        <tr>
          <th>品番</th>
          <td>{{ detail.product_no }}</td>
        </tr>
        <tr>
          <th>シリーズ名</th>
          <td>{{ detail.product_name1 }}</td>
        </tr>
        <tr>
          <th>商品名</th>
          <td>{{ detail.product_name2 }}</td>
        </tr>
        <tr>
          <th>サイズ</th>
          <td>{{ detail.product_price_capacity }}</td>
        </tr>
        <tr>
          <th>価格</th>
          <td>{{ detail.product_price }}円</td>
        </tr>

        <tr>
          <th>数量</th>
          <td>{{ detail.num }}個</td>
        </tr>
        <tr>
          <th>小計</th>
          <td>{{ detail.sub_total }}円</td>
        </tr>
      </table>
    </div>

    <div class="mt-2">
      <h4>総合計</h4>
      <table class="table table-striped">
        <tr>
          <th>購入数合計</th>
          <td>{{ order.total_num }}個</td>
        </tr>
        <tr>
          <th>合計(消費税)</th>
          <td>
            {{ order.total_product_price }}({{
              order.total_product_include_tax
            }})円
          </td>
        </tr>
        <tr>
          <th>送料合計</th>
          <td>{{ order.total_delivery_charge }}円</td>
        </tr>
        <tr>
          <th>決済手数料</th>
          <td>{{ order.fee }}円</td>
        </tr>
        <tr>
          <th>割引合計</th>
          <td>{{ order.coupon_discount_price }}円</td>
        </tr>
        <tr>
          <th>総合計</th>
          <td>{{ order.total_price }}円</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import ErrorMessage from "@/components/ErrorMessage.vue";
import ValidateError from "@/components/ValidateError.vue";
import {
  showOrderApi,
  updateOrderStatusApi,
  updateDeliveryLocationApi,
} from "@/api/orders";

export default defineComponent({
  name: "OrderIndex",
  components: {
    ErrorMessage,
    ValidateError,
  },
  data: () => ({
    isShow: false,
    message: "",
    order: {} as any,
    validateErrors: [] as any[],
    deliveryLocation: {} as any,
    deliveryLocationValidateErrors: [] as any[],
    status: null as number | null,
    cancelStatus: 9,
  }),
  beforeRouteUpdate: async function (to, from, next) {},
  mounted: async function () {
    const result = await showOrderApi(this.$route.params.id);
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.order = result.data;
    this.status = this.order.status;
    this.deliveryLocation = {
      user_delivery_location_email: this.order.user_delivery_location_email,
      user_delivery_location_last_name:
        this.order.user_delivery_location_last_name,
      user_delivery_location_first_name:
        this.order.user_delivery_location_first_name,
      user_delivery_location_last_name_kana:
        this.order.user_delivery_location_last_name_kana,
      user_delivery_location_first_name_kana:
        this.order.user_delivery_location_first_name_kana,
      user_delivery_location_birthday:
        this.order.user_delivery_location_birthday,
      user_delivery_location_zip: this.order.user_delivery_location_zip,
      user_delivery_location_address1:
        this.order.user_delivery_location_address1,
      user_delivery_location_tel1: this.order.user_delivery_location_tel1,
    };
    this.isShow = true;
  },
  methods: {
    updateStatus: async function () {
      if (
        this.status === this.cancelStatus &&
        !confirm(
          "注文をキャンセルします。よろしいですか？また、EPSILONの管理画面からキャンセルを確実に行なってください。"
        )
      ) {
        return;
      }
      this.validateErrors = [];
      const result = await updateOrderStatusApi(
        this.$route.params.id,
        this.status
      );
      if (!result.success) {
        if (result.status === 422) {
          this.validateErrors = result.data;
        }
        if (result.message !== "") {
          this.message = result.message;
        }
        this.submitDisable = false;
        return;
      }
      alert("更新しました");
    },
    updateDeliveryLocation: async function () {
      this.message = "";
      this.deliveryLocationValidateErrors = [];
      const result = await updateDeliveryLocationApi(
        this.$route.params.id,
        this.deliveryLocation
      );
      if (!result.success) {
        if (result.status === 422) {
          this.deliveryLocationValidateErrors = result.data;
        }
        if (result.message !== "") {
          this.message = result.message;
        }
        this.submitDisable = false;
        return;
      }
      alert("更新しました");
    },
  },
});
</script>
<style lang="scss" scoped>
th {
  width: 300px;
}
</style>
