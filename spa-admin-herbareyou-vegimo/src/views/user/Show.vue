<template>
  <h2 class="mb-3">ユーザー詳細</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>id</th>
          <td>{{ user.id }}</td>
        </tr>
        <tr>
          <th>配送先Email</th>
          <td>{{ user.email }}</td>
        </tr>
        <tr>
          <th>配送先名(苗字)</th>
          <td>{{ user.last_name }}</td>
        </tr>
        <tr>
          <th>配送先名(名前)</th>
          <td>{{ user.first_name }}</td>
        </tr>
        <tr>
          <th>配送先名(苗字)(英語表記)</th>
          <td>{{ user.last_name_kana }}</td>
        </tr>
        <tr>
          <th>配送先名(名前)(英語表記)</th>
          <td>{{ user.first_name_kana }}</td>
        </tr>
        <tr>
          <th>配送先ユーザー誕生日</th>
          <td>{{ user.birthday }}</td>
        </tr>
        <tr>
          <th>配送先郵便番号</th>
          <td>{{ user.zip }}</td>
        </tr>
        <tr>
          <th>配送先住所</th>
          <td>{{ user.address1 }}</td>
        </tr>
        <tr>
          <th>配送先電話番号</th>
          <td>{{ user.tel1 }}</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import ErrorMessage from "@/components/ErrorMessage.vue";
import ValidateError from "@/components/ValidateError.vue";
import { showUserApi } from "@/api/users";

export default defineComponent({
  name: "UserShow",
  components: {
    ErrorMessage,
    ValidateError,
  },
  data: () => ({
    isShow: false,
    message: "",
    user: {} as any,
  }),
  beforeRouteUpdate: async function (to, from, next) {},
  mounted: async function () {
    const result = await showUserApi(this.$route.params.id);
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.user = result.data;
    this.isShow = true;
  },
  methods: {},
});
</script>
<style lang="scss" scoped>
th {
  width: 300px;
}
</style>
