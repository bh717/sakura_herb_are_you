<template>
  <h2 class="mb-3">味の特徴更新</h2>
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
          <th>no</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="items.category_no" />
            <ValidateError :errorMessages="validateErrors.category_no" />
          </td>
        </tr>
      </table>

      <div class="d-flex justify-content-center">
        <div class="p-2">
          <button type="button" class="btn btn-primary" v-on:click="update()" :disabled="submitDisable">
            編集する
          </button>
        </div>
        <div class="p-2">
          <button type="button" class="btn btn-danger" v-on:click="destroy()" :disabled="submitDisable">
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
  showTasteApi,
  updateTasteApi,
  destroyTasteApi,
} from "@/api/mst-tastes";

export default defineComponent({
  name: "TasteUpdate",
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
    taste: {} as any,
  }),
  mounted: async function () {
    const result = await showTasteApi(this.$route.params.id);
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.items = result.data;
    this.taste = result.data;
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
    update: async function () {
      this.submitDisable = true;
      const result = await updateTasteApi(
        this.$route.params.id,
        this.items.name,
        this.items.category_no
      );
      if (!result.success) {
        this.commonError(result);
        this.submitDisable = false;
        return;
      }
      alert("更新しました");
      this.$router.push({
        name: "TasteIndex",
      });
    },
    destroy: async function () {
      if (!window.confirm("本当に削除しますか？")) {
        return;
      }
      this.submitDisable = true;
      const result = await destroyTasteApi(this.$route.params.id);
      this.submitDisable = false;
      if (!result.success) {
        this.commonError(result);
        this.submitDisable = false;
        return;
      }
      alert("削除しました");
      this.$router.push({
        name: "TasteIndex",
      });
    },
  },
});
</script>
<style lang="scss" scoped></style>
