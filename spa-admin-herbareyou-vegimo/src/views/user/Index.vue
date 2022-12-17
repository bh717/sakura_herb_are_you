<template>
  <h2 class="mb-3">ユーザー一覧</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>id</th>
          <th>Email</th>
          <th>苗字</th>
          <th>名前</th>
          <th>苗字(英語表記)</th>
          <th>名前(英語表記)</th>
          <th>ユーザー誕生日</th>
          <th>郵便番号</th>
          <th>住所</th>
          <th>電話番号</th>
          <th></th>
        </tr>
        <tr v-for="user in users" :key="user.id">
          <td>{{ user.id }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.last_name }}</td>
          <td>{{ user.first_name }}</td>
          <td>{{ user.last_name_kana }}</td>
          <td>{{ user.first_name_kana }}</td>
          <td>{{ user.birthday }}</td>
          <td>{{ user.zip }}</td>
          <td>{{ user.address1 }}</td>
          <td>{{ user.tel1 }}</td>
          <td class="text-center">
            <router-link
              :to="{ name: 'UserShow', params: { id: user.id } }"
              class="btn btn-primary active btn-sm"
            >
              詳細
            </router-link>
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import ErrorMessage from "@/components/ErrorMessage.vue";
import { indexUserApi } from "@/api/users";

export default defineComponent({
  name: "UserIndex",
  components: {
    ErrorMessage,
  },
  data: () => ({
    isShow: false,
    message: "",
    query: {} as any,
    users: [] as any[],
  }),
  // beforeRouteUpdate: async function (to, from, next): Promise<void> {
  // },
  mounted: async function () {
    this.query.per_page = -1;
    const result = await indexUserApi(this.query);
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.users = result.data;
    this.isShow = true;
  },
});
</script>
<style lang="scss" scoped></style>
