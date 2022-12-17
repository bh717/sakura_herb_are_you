<template>
  <h2 class="mb-3">ブログ更新</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>タイトル</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="items.title" />
            <ValidateError :errorMessages="validateErrors.title" />
          </td>
        </tr>
        <tr>
          <th>セラピスト名</th>
          <td class="py-2">
            {{ blog.therapist.name }}
          </td>
        </tr>
        <tr>
          <th>内容</th>
          <td class="py-2">
            <textarea
              class="form-control"
              rows=""
              cols=""
              v-model="items.body"
            ></textarea>
            <ValidateError :errorMessages="validateErrors.body" />
          </td>
        </tr>
        <tr>
          <th>画像</th>
          <td class="py-2">
            <div>
              <UploadFile v-on:uploadedFile="setUploadFile" />
            </div>
            <div v-bind:style="{ 'display':`flex`, 'gap':`10px`, 'overflow-x':`auto`, 'width':`30rem`}" v-if="items.upload_file_hashs.length !== 0">
              <div v-for="imageUrl in imageUrls">
                <img :src="imageUrl" width="100" height="100"/>
              </div>
            </div>
            <ValidateError
              :errorMessages="validateErrors['upload_file_hashs.0']"
            />
          </td>
        </tr>
        <tr>
          <th>公開/非公開</th>
          <td class="py-2">
            <select class="form-select" aria-label="" v-model="items.is_public">
              <option :value="0">非公開</option>
              <option :value="1">公開</option>
            </select>
            <ValidateError :errorMessages="validateErrors.profile" />
          </td>
        </tr>
      </table>

      <div class="d-flex justify-content-center">
        <div class="p-2">
          <button
            type="button"
            class="btn btn-primary"
            v-on:click="update()"
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
import {
  showTherapistBlogApi,
  updateTherapistBlogApi,
  destroyTherapistBlogApi,
} from "@/api/therapist-blogs";
import UploadFile from "@/components/UploadFile.vue";

export default defineComponent({
  name: "TherapistBlogUpdate",
  components: {
    ErrorMessage,
    ValidateError,
    UploadFile,
  },
  data: () => ({
    isShow: false,
    message: "",
    count: 0,
    submitDisable: false,
    validateErrors: {} as any,
    items: {
      upload_file_hashs: [] as string[],
    } as any,
    blog: {} as any,
    imageUrls: [] as string[],
  }),
  mounted: async function () {
    const result = await showTherapistBlogApi(this.$route.params.id);
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.blog = result.data;
    this.init();
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
      const result = await updateTherapistBlogApi(
        this.$route.params.id,
        this.items
      );
      this.submitDisable = false;
      if (!result.success) {
        this.commonError(result);
        return;
      }
      alert("更新しました");
    },
    init: function () {
      this.items.title = this.blog.title;
      this.items.body = this.blog.body;
      this.items.is_public = this.blog.is_public;
      this.items.upload_file_hashs[0] = this.blog.upload_files[0].hash;
      this.imageUrls[0] = this.blog.upload_files[0].url;
    },
    destroy: async function () {
      if (!window.confirm("本当に削除しますか？")) {
        return;
      }
      this.submitDisable = true;
      const result = await destroyTherapistBlogApi(this.$route.params.id);
      this.submitDisable = false;
      if (!result.success) {
        this.commonError(result);
        this.submitDisable = false;
        return;
      }
      alert("削除しました");
      this.$router.push({
        name: "TherapistBlogIndex",
      });
    },
    setUploadFile: function (uploadFile: any) {
      console.log(uploadFile);
      this.items.upload_file_hashs[this.count] = uploadFile.hash;
      this.imageUrls[this.count] = uploadFile.url;
      console.log(this.imageUrls);
      this.count ++;
    },
  },
});
</script>
<style lang="scss" scoped></style>
