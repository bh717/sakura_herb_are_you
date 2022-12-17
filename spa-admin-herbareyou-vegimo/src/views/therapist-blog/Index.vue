<template>
  <h2 class="mb-3">ブログ一覧</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>タイトル</th>
          <th>セラピスト名</th>
          <th>公開/非公開</th>
          <th class="text-center">更新</th>
        </tr>
        <tbody>
          <tr v-for="blog in blogs" :key="blog.id">
            <td>{{ blog.title }}</td>
            <td>{{ blog.therapist.name }}</td>
            <td>{{ blog.is_public_text }}</td>
            <td class="text-center">
              <router-link :to="{ name: 'TherapistBlogUpdate', params: { id: blog.id } }"
                class="btn btn-primary active">
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
import { indexTherapistBlogApi } from "@/api/therapist-blogs";

export default defineComponent({
  name: "TherapistIndex",
  components: {
    ErrorMessage,
    ValidateError,
  },
  data: () => ({
    isShow: false,
    message: "",
    blogs: [] as any[],
  }),
  beforeRouteUpdate: async function (to, from, next) {},
  mounted: async function () {
    const result = await indexTherapistBlogApi();
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.blogs = result.data;
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
