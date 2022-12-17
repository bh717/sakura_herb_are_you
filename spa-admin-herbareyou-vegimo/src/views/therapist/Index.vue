<template>
  <h2 class="mb-3">セラピスト一覧</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>名前</th>
          <th>名前(カナ)</th>
          <th>プロフィール</th>
          <th class="text-center">更新</th>
        </tr>
        <tbody>
          <tr v-for="therapist in therapists" :key="therapist.id">
            <td>{{ therapist.name }}</td>
            <td>{{ therapist.name_kana }}</td>
            <td>{{ therapist.profile }}</td>
            <td class="text-center">
              <router-link
                :to="{ name: 'TherapistUpdate', params: { id: therapist.id } }"
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
import { indexTherapistApi } from "@/api/therapists";

export default defineComponent({
  name: "TherapistIndex",
  components: {
    ErrorMessage,
    ValidateError,
  },
  data: () => ({
    isShow: false,
    message: "",
    therapists: [] as any[],
  }),
  beforeRouteUpdate: async function (to, from, next) {},
  mounted: async function () {
    const result = await indexTherapistApi();
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.therapists = result.data;
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
