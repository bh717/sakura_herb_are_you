<template>
  <div id="">
    <div>
      <input
        type="file"
        id="file"
        v-on:change="uploadToS3"
        v-if="inputFileFlg"
      />
    </div>
    <ErrorMessage :message="message" />
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { getPreSignedUrlApi, confirmApi, upload } from "@/api/file-uploads";
import ErrorMessage from "@/components/ErrorMessage.vue";

export default defineComponent({
  name: "UploadFile",
  layout: "base",
  components: {
    ErrorMessage,
  },
  props: {
    filePath: {
      type: String,
      required: false,
    },
  },
  data: () => ({
    message: "",
    inputFileFlg: true,
  }),
  methods: {
    resetMessage: function (): void {
      this.message = "";
    },
    setInputFileEmpty: function (): void {
      this.inputFileFlg = false;
      this.$nextTick(function () {
        this.inputFileFlg = true;
      });
    },
    uploadToS3: async function (event: any): Promise<void> {
      this.message = "";
      console.log("uploaded files",event.target.files);
      const file = event.target.files[0];
      const preSignedUrlResult = await getPreSignedUrlApi(
        file.name,
        this.filePath
      );
      console.log(preSignedUrlResult);
      if (!preSignedUrlResult.success) {
        this.message = "アップロードに失敗しました";
        return;
      }
      const uploadResult = await upload(
        preSignedUrlResult.data.pre_signed_url,
        file
      );
      if (!uploadResult.success) {
        this.message = "アップロードに失敗しました";
        return;
      }
      const confirmResult = await confirmApi(preSignedUrlResult.data.hash);
      if (!confirmResult.success) {
        this.message = "アップロードに失敗しました";
        return;
      }
      // this.message = "成功しました";
      this.setInputFileEmpty();
      this.$emit("uploadedFile", confirmResult.data);
    },
  },
  mounted: function () {},
});
</script>

<style lang="stylus" scoped></style>
