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
            <div class="p-2">
              <!-- <example-modal v-if="open" @close="open = false" v-show="showModal" /> -->
              <!-- <example-modal v-show="showModal" /> -->

              <button type="button" v-on:click="showHyperlinkDialog">
                リンクを設定する
              </button>
            </div>
            <!-- <ejs-documenteditor ref="documenteditor" :enableSelection='true' :isReadOnly='false' :enableEditor='true'
              :enableEditorHistory='true' :enableHyperlinkDialog='true' :enableSfdtExport='true' class="form-control"
              rows="" cols="" v-model="items.body" @select="testFunction" /> -->
            <textarea ref="documenteditor" class="form-control" rows="" cols="" v-model="items.body" />
            <!-- <p ref="target">Lorem ipsum dolor sit amet</p> -->
            <ValidateError :errorMessages="validateErrors.body" />
          </td>
        </tr>
        <tr>
          <th>画像</th>
          <td class="py-2">
            <div>
              <UploadFile v-on:uploadedFile="setUploadFile" />
            </div>
            <div v-bind:style="{ 'display': `flex`, 'gap': `10px`, 'overflow-x': `auto`, 'width': `30rem` }"
              v-if="items.upload_file_hashs.length !== 0">
              <div v-for="imageUrl in imageUrls">
                <img :src="imageUrl" width="100" height="100" />
              </div>
            </div>
            <ValidateError :errorMessages="validateErrors['upload_file_hashs.0']" />
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
          <button type="button" class="btn btn-primary" v-on:click="update()" :disabled="submitDisable">
            編集する
          </button>
        </div>
        <div class="p-2">
          <button type="button" class="btn btn-danger" v-on:click="destroy()" :disabled="submitDisable">
            削除する
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
// import Vue from 'vue'
import { defineComponent } from "vue";
import { DocumentEditorPlugin, Selection, Editor, EditorHistory, HyperlinkDialog, SfdtExport, RequestNavigateEventArgs } from '@syncfusion/ej2-vue-documenteditor';
import ErrorMessage from "@/components/ErrorMessage.vue";
import ValidateError from "@/components/ValidateError.vue";
import {
  showTherapistBlogApi,
  updateTherapistBlogApi,
  destroyTherapistBlogApi,
} from "@/api/therapist-blogs";
import UploadFile from "@/components/UploadFile.vue";
// import Vdialog from 'v-dialog';
import exampleModal from './exampleModal.vue'

export default defineComponent({
  name: "TherapistBlogUpdate",
  components: {
    ErrorMessage,
    ValidateError,
    UploadFile,
    "example-modal":exampleModal,
    // vDialog: Vdialog,
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
    open: false,
    showModal:false,
  }),
  mounted: async function () {
    const result = await showTherapistBlogApi(this.$route.params.id);

    // document.addEventListener('mouseup', event => {
    //   if (event.target === this.$refs.target)
    //     this.testFunction();
    // });

    if (!result.success) {
      this.commonError(result);
      return;
    }

    this.blog = result.data;
    this.init();
    this.isShow = true;
  },
  provide: {
    // DocumentEditor: [Selection, Editor, EditorHistory, HyperlinkDialog, SfdtExport]
  },
  methods: {
    showHyperlinkDialog: function () {
      // alert(window.getSelection()?.toString()); 
      // let element = this.$refs.modal.$el;
      // // element?.modal('show');
      // element.modal();
      this.showModal = !this.showModal;
      alert(this.showModal);
      // this.$refs.modal.show();
    },

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

      for (let i = 0; i < this.blog.upload_files.length; i++) {
        this.items.upload_file_hashs[i] = this.blog.upload_files[i].hash;
      }
      console.log("image urls:", this.blog.upload_files);

      this.blog.upload_files.forEach((item: {
        [x: string]: string; url: any;
      }, index: string | number) => {
        this.imageUrls[index] = "https://content.herbareyou.jp/" + item?.file_path;
        console.log(this.imageUrls[index]);
      })

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
      this.count++;
    },
  },
});
</script>

<style>
@import "../../../node_modules/@syncfusion/ej2-vue-documenteditor/styles/material.css";
</style>

<style lang="scss" scoped>

</style>
