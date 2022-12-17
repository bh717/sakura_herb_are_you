<template>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>会社</th>
          <td class="py-2">
            <select class="form-select" v-model="items.company_id">
              <option :value="null">選択する</option>
              <option
                v-for="company in companies"
                :key="company.id"
                :value="company.id"
              >
                {{ company.name }}
              </option>
            </select>
            <ValidateError :errorMessages="validateErrors.company_id" />
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
import { CompanyService } from "@/services/CompanyService";
import { AdminerService } from "@/services/AdminerService";

export default defineComponent({
  name: "AdminerStore",
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
    items: {
      company_id: null,
    } as any,

    selectCategoryGroupId: null as null | number,
    companies: [] as any[],

    adminerService: new AdminerService(),
    companyService: new CompanyService(),
  }),
  mounted: async function () {
    const campanyResult = await this.companyService.indexApi({
      per_page: -1,
    });
    if (!campanyResult.success) {
      this.commonError(campanyResult);
      return;
    }
    this.companies = campanyResult.data;
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
    save: async function () {
      this.validateErrors = {};
      this.message = "";
      this.submitDisable = true;
      const result = await this.adminerService.storeApi(this.items);
      this.submitDisable = false;
      if (!result.success) {
        this.commonError(result);
        return;
      }
      alert("作成しました");
      this.$router.push({
        name: "AdminerUpdate",
        params: {
          id: result.data.id,
        },
      });
    },
  },
});
</script>
<style lang="scss" scoped></style>
