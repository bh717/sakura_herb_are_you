<template>
  <h2 class="mb-3">ブログ作成</h2>
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
          <th>セラピスト</th>
          <td class="py-2">
            <select
              class="form-select"
              aria-label=""
              v-model="items.therapist_id"
            >
              <option
                v-for="therapist in therapists"
                :key="therapist.id"
                :value="therapist.id"
              >
                {{ therapist.name }}
              </option>
            </select>
            <ValidateError :errorMessages="validateErrors.therapist_id" />
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
            <div v-if="items.upload_file_hashs.length !== 0">
              <img :src="imageUrls[0]" with="100" />
            </div>
            <ValidateError :errorMessages="validateErrors.upload_file_urls" />
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
import { storeTherapistBlogApi } from "@/api/therapist-blogs";
import { indexTherapistApi } from "@/api/therapists";
import UploadFile from "@/components/UploadFile.vue";

export default defineComponent({
  name: "TherapistBlogStore",
  components: {
    ErrorMessage,
    ValidateError,
    UploadFile,
  },
  data: () => ({
    isShow: false,
    message: "",
    submitDisable: false,
    validateErrors: {} as any,
    items: {
      is_public: 0,
      upload_file_hashs: [] as string[],
    } as any,
    therapist: [] as any[],
    imageUrls: [] as string[],
    therapists: [] as any[],
  }),
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
    create: async function () {
      this.submitDisable = true;
      const result = await storeTherapistBlogApi(this.items);
      if (!result.success) {
        this.commonError(result);
        this.submitDisable = false;
        return;
      }
      alert("作成しました");
      this.$router.push({
        name: "TherapistBlogUpdate",
        params: {
          id: result.data.id,
        },
      });
    },
    setUploadFile: function (uploadFile: any) {
      console.log(uploadFile);
      this.items.upload_file_hashs[0] = uploadFile.hash;
      this.imageUrls[0] = uploadFile.url;
      console.log(this.imageUrls);
    },
  },
});
</script>
<style lang="scss" scoped></style>
