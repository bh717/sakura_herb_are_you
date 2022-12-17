<template>
  <h2 class="mb-3">植物療法士便り</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <p class="text-danger">
        キャッシュを削除するために、反映までに少し時間がかかります
      </p>
      <table class="table table-striped">
        <tr>
          <th>
            (目安: 1920px × 728px)<br />アップできるフォーマットは画像のみとなります
          </th>
          <td class="py-2">
            <UploadFile :filePath="filePath" />
          </td>
          <td>
            <img
              width="200"
              height=""
              :src="cloudFrontBaseurl + filePath + '?' + dateTime"
            />
          </td>
        </tr>
        <tr>
          <th>
            sp用画像(目安: 1000px × 1000px)<br />アップできるフォーマットは画像のみとなります
          </th>
          <td class="py-2">
            <UploadFile :filePath="filePath2" />
          </td>
          <td>
            <img
              width="200"
              height=""
              :src="cloudFrontBaseurl + filePath2 + '?' + dateTime"
            />
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import ErrorMessage from "@/components/ErrorMessage.vue";
import ValidateError from "@/components/ValidateError.vue";
import UploadFile from "@/components/UploadFile.vue";

export default defineComponent({
  name: "PageTherapistBlog",
  components: {
    ErrorMessage,
    ValidateError,
    UploadFile,
  },
  data: () => ({
    isShow: false,
    message: "",
    items: [] as any[],
    submitDisable: false,
    cloudFrontBaseurl: process.env.VUE_APP_CLOUD_FRONT_BASE_URL,
    filePath: "assets/img/therapist-blog/top.jpg",
    filePath2: "assets/img/therapist-blog/top-sp.jpg",
    dateTime: Date.now(),
  }),
  beforeRouteUpdate: async function (to, from, next) {},
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
  },
});
</script>
<style lang="scss" scoped></style>
