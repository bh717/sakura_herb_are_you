<template>
  <h2 class="mb-3">Home</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <p class="text-danger">
        キャッシュを削除するために、反映までに少し時間がかかります
      </p>
      <table class="table table-striped">
        <tr>
          <th>動画1<br/>アップできるフォーマットは動画のみとなります</th>
          <td class="py-2">
            <UploadFile :filePath="filePath" />
          </td>
          <td>
            <video width="200" height="" controls :src="cloudFrontBaseurl + filePath + '?' + dateTime"></video>
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
import { firstContentApi } from "@/api/contents";
import UploadFile from "@/components/UploadFile.vue";

export default defineComponent({
  name: "PageHome",
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
    filePath: "assets/img/home/home.mp4",
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
