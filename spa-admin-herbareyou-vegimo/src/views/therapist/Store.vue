<template>
  <h2 class="mb-3">セラピスト作成</h2>
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
          <th>名前(カナ)</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="items.name_kana" />
            <ValidateError :errorMessages="validateErrors.name_kana" />
          </td>
        </tr>
        <tr>
          <th>プロフィール</th>
          <td class="py-2">
            <textarea
              class="form-control"
              rows=""
              cols=""
              v-model="items.profile"
            ></textarea>
            <ValidateError :errorMessages="validateErrors.profile" />
          </td>
        </tr>
      </table>

      <div class="d-flex justify-content-center">
        <div class="p-2">
          <button
            type="button"
            class="btn btn-primary"
            v-on:click="create()"
            :disabled="submitDisable"
          >
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
import { storeTherapistApi } from "@/api/therapists";

export default defineComponent({
  name: "TherapistUpdate",
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
      const result = await storeTherapistApi(this.items);
      if (!result.success) {
        this.commonError(result);
        this.submitDisable = false;
        return;
      }
      alert("作成しました");
      this.$router.push({
        name: "TherapistUpdate",
        params: {
          id: result.data.id,
        },
      });
    },
  },
});
</script>
<style lang="scss" scoped></style>
