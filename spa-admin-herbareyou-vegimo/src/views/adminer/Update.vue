<template>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>id</th>
          <td class="py-2">
            {{ adminer.id }}
          </td>
        </tr>
        <tr>
          <th>ユーザー名</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="items.name" />
            <ValidateError :errorMessages="validateErrors.name" />
          </td>
        </tr>
        <tr>
          <th>email</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="items.email" />
            <ValidateError :errorMessages="validateErrors.email" />
          </td>
        </tr>
        <tr>
          <th>password</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="items.password" />
            <ValidateError :errorMessages="validateErrors.password" />
          </td>
        </tr>
      </table>
      <div class="d-flex justify-content-center">
        <div class="p-2">
          <button
            type="button"
            class="btn btn-primary"
            v-on:click="save()"
            :disabled="submitDisable"
          >
            編集する
          </button>
        </div>
        <div class="p-2">
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
import { CompanyService } from "@/services/CompanyService";
import { AdminerService } from "@/services/AdminerService";

export default defineComponent({
  name: "AdminerUpdate",
  components: {
    ErrorMessage,
    ValidateError,
  },
  data: () => ({
    isShow: false,
    message: "",
    submitDisable: false,
    validateErrors: {} as any,
    adminer: {} as any,
    items: {} as any,

    campanys: [] as any[],
    selectCategoryGroupId: null as null | number,
    companies: [] as any[],

    adminerService: new AdminerService(),
    companyService: new CompanyService(),
  }),
  mounted: async function () {
    const campanyResult = await this.companyService.indexApi();
    if (!campanyResult.success) {
      this.commonError(campanyResult);
      return;
    }
    this.campanies = campanyResult.data;
    const adminerResult = await this.adminerService.showApi(
      this.$route.params.id
    );
    if (!adminerResult.success) {
      this.commonError(adminerResult);
      return;
    }
    this.adminer = adminerResult.data;
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
    setInitData: async function () {
      this.items.company_id = this.adminer.company_id;
      this.items.name = this.adminer.name;
      this.items.email = this.adminer.email;
    },
    save: async function () {
      this.validateErrors = {};
      this.message = "";
      this.submitDisable = true;
      const result = await this.adminerService.updateApi(
        this.$route.params.id,
        this.items
      );
      this.submitDisable = false;
      if (!result.success) {
        this.commonError(result);
        return;
      }
      alert("編集しました");
    },
    destroy: async function () {
      if (!window.confirm("本当に削除しますか？")) {
        return;
      }
      this.validateErrors = {};
      this.message = "";
      this.submitDisable = true;
      const result = await this.adminerService.destroyApi(
        this.$route.params.id
      );
      this.submitDisable = false;
      if (!result.success) {
        this.commonError(result);
        return;
      }
      alert("削除しました");
      this.$router.push({
        name: "AdminerIndex",
      });
    },
  },
});
</script>
<style lang="scss" scoped></style>
