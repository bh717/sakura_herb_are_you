<template>
  <h2 class="mb-3">inspiration</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>内容</th>
          <td class="py-2">
            <textarea class="form-control" placeholder="内容" id="floatingTextarea" v-model="items.content"></textarea>
            <ValidateError :errorMessages="validateErrors.content" />
          </td>
        </tr>
      </table>

      <div class="d-flex justify-content-center">
        <div class="px-2">
          <button type="button" class="btn btn-primary" v-on:click="create()" :disabled="submitDisable">
            登録する
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
import { storeContentAPi, firstContentApi } from "@/api/contents";

export default defineComponent({
  name: "pageInspiration",
  components: {
    ErrorMessage,
    ValidateError,
  },
  data: () => ({
    isShow: false,
    message: "",
    items: {} as any,
    submitDisable: false,
    kind: 'inspiration',
    validateErrors: {} as any,
  }),
  beforeRouteUpdate: async function (to, from, next) {},
  mounted: async function () {
    const result = await firstContentApi(this.kind);
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.items.content = result.data.content ?? '';
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
      this.validateErrors = {};
      this.message = '';
      this.submitDisable = true;
      const result = await storeContentAPi(
        this.kind,
        this.items.content
      );
      if (!result.success) {
        this.commonError(result);
        this.submitDisable = false;
        return;
      }
      alert("更新しました");
      this.submitDisable = false;
    },
  },
});
</script>
<style lang="scss" scoped></style>
