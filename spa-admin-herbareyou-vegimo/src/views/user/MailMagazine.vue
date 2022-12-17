<template>
  <h2 class="mb-3">メールマガジン送信</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      htmlメールになります。改行は&lt;br&gt;を使用してください。<br />
      また、htmlは特殊文字というものが存在します。「半角スペース」は「&nbsp;」と入力しても表示されません。<br />
      詳しくは「html 特殊文字」などで検索してみてください。
    </div>
    <div>
      <table class="table table-striped">
        <tr>
          <th>タイトル</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="subject" />
            <ValidateError :errorMessages="validateErrors.subject" />
          </td>
        </tr>
        <tr>
          <th>内容</th>
          <td class="py-2">
            <textarea
              class="form-control"
              rows="15"
              cols=""
              v-model="body"
            ></textarea>
            <ValidateError :errorMessages="validateErrors.body" />
          </td>
        </tr>
      </table>

      <div class="d-flex justify-content-center">
        <div class="p-2">
          <button
            type="button"
            class="btn btn-primary"
            v-on:click="sendMailMagazine()"
            :disabled="submitDisable"
          >
            送信する
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

import { mailMagazineApi } from "@/api/users";

export default defineComponent({
  name: "MailMagazine",
  components: {
    ErrorMessage,
    ValidateError,
  },
  data: () => ({
    isShow: false,
    message: "",
    submitDisable: false,
    validateErrors: {} as any,

    subject: "",
    body: "",
  }),
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
    sendMailMagazine: async function () {
      if (!window.confirm("メールを送信します。よろしいですか？")) {
        return;
      }
      this.validateErrors = {};
      this.message = "";
      this.submitDisable = true;
      const result = await mailMagazineApi(this.subject, this.body);
      this.submitDisable = false;
      console.log(result);
      if (!result.success) {
        this.commonError(result);
        return;
      }
      alert("送信しました");
      this.subject = "";
      this.body = "";
    },
  },
});
</script>
<style lang="scss" scoped></style>
