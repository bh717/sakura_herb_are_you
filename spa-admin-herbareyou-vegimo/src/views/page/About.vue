<template>
  <h2 class="mb-3">HerbAreYouについて(データの取得、データの更新に時間がかかります)</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-borderless">
        <tr>
          <th>画像1(*注意 画像は選択された時点で反映されます)<br />アップできるフォーマットは画像のみとなります</th>
          <td class="py-2">
            <UploadFile v-on:uploadedFile="setUploadUrl1" />
            <div v-if="fileUrl1">
              <img width="200" height="" :src="fileUrl1 + '?' + dateTime" />
            </div>
          </td>
        </tr>
        <tr>
          <th>タイトル1</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="title1" />
          </td>
        </tr>
        <tr class="border-bottom border-dark">
          <th>内容1</th>
          <td class="py-2">
            <textarea name="" id="" cols="40" rows="10" class="form-control" v-model="body1"></textarea>
          </td>
        </tr>

        <tr>
          <th>画像2(*注意 画像は選択された時点で反映されます)<br />アップできるフォーマットは画像のみとなります</th>
          <td class="py-2">
            <UploadFile v-on:uploadedFile="setUploadUrl2" />
            <div v-if="fileUrl2">
              <img width="200" height="" :src="fileUrl2 + '?' + dateTime" />
            </div>
          </td>
        </tr>
        <tr>
          <th>タイトル2</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="title2" />
          </td>
        </tr>
        <tr class="border-bottom border-dark">
          <th>内容2</th>
          <td class="py-2">
            <textarea name="" id="" cols="40" rows="10" class="form-control" v-model="body2"></textarea>
          </td>
        </tr>

        <tr>
          <th>画像3(*注意 画像は選択された時点で反映されます)<br />アップできるフォーマットは画像のみとなります</th>
          <td class="py-2">
            <UploadFile v-on:uploadedFile="setUploadUrl3" />
            <div v-if="fileUrl3">
              <img width="200" height="" :src="fileUrl3 + '?' + dateTime" />
            </div>
          </td>
        </tr>
        <tr>
          <th>タイトル3</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="title3" />
          </td>
        </tr>
        <tr class="border-bottom border-dark">
          <th>内容3</th>
          <td class="py-2">
            <textarea name="" id="" cols="40" rows="10" class="form-control" v-model="body3"></textarea>
          </td>
        </tr>

        <tr>
          <th>画像4(*注意 画像は選択された時点で反映されます)<br />アップできるフォーマットは画像のみとなります</th>
          <td class="py-2">
            <UploadFile v-on:uploadedFile="setUploadUrl4" />
            <div v-if="fileUrl4">
              <img width="200" height="" :src="fileUrl4 + '?' + dateTime" />
            </div>
          </td>
        </tr>
        <tr>
          <th>タイトル4</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="title4" />
          </td>
        </tr>
        <tr class="border-bottom border-dark">
          <th>内容4</th>
          <td class="py-2">
            <textarea name="" id="" cols="40" rows="10" class="form-control" v-model="body4"></textarea>
          </td>
        </tr>

        <tr>
          <th>画像5(*注意 画像は選択された時点で反映されます)<br />アップできるフォーマットは画像のみとなります</th>
          <td class="py-2">
            <UploadFile v-on:uploadedFile="setUploadUrl5" />
            <div v-if="fileUrl5">
              <img width="200" height="" :src="fileUrl5 + '?' + dateTime" />
            </div>
          </td>
        </tr>
        <tr>
          <th>タイトル5</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="title5" />
          </td>
        </tr>
        <tr class="border-bottom border-dark">
          <th>内容5</th>
          <td class="py-2">
            <textarea name="" id="" cols="40" rows="10" class="form-control" v-model="body5"></textarea>
          </td>
        </tr>
      </table>
      <div class="d-flex justify-content-center">
        <div class="px-2">
          <button type="button" class="btn btn-primary" v-on:click="save()" :disabled="submitDisable">
            更新する
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
import { storeContentAPi, firstContentApi } from "@/api/contents";
import UploadFile from "@/components/UploadFile.vue";

export default defineComponent({
  name: "PageAbout",
  components: {
    ErrorMessage,
    ValidateError,
    UploadFile,
  },
  data: () => ({
    isShow: false,
    message: "",
    items: {} as any,
    submitDisable: false,
    dateTime: Date.now(),

    title1: '' as string,
    body1: '' as string,
    filePath1: null as string | null,
    fileUrl1: '' as string,

    title2: '' as string,
    body2: '' as string,
    filePath2: null as string | null,
    fileUrl2: '' as string,

    title3: '' as string,
    body3: '' as string,
    filePath3: null as string | null,
    fileUrl3: '' as string,

    title4: '' as string,
    body4: '' as string,
    filePath4: null as string | null,
    fileUrl4: '' as string,

    title5: '' as string,
    body5: '' as string,
    filePath5: null as string | null,
    fileUrl5: '' as string,
  }),
  beforeRouteUpdate: async function (to, from, next) {},
  mounted: async function () {
    let result = await firstContentApi('about1_title');
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.title1 = result.data.content;
    result = await firstContentApi('about1_body');
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.body1 = result.data.content;
    result = await firstContentApi('about1_file_path');
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.filePath1 = result.data.content;
    if (this.filePath1) {
      this.fileUrl1 = process.env.VUE_APP_CLOUD_FRONT_URL + result.data.content;
    }

    result = await firstContentApi('about2_title');
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.title2 = result.data.content;
    result = await firstContentApi('about2_body');
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.body2 = result.data.content;
    result = await firstContentApi('about2_file_path');
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.filePath2 = result.data.content;
    if (this.filePath2) {
      this.fileUrl2 = process.env.VUE_APP_CLOUD_FRONT_URL + result.data.content;
    }

    result = await firstContentApi('about3_title');
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.title3 = result.data.content;
    result = await firstContentApi('about3_body');
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.body3 = result.data.content;
    result = await firstContentApi('about3_file_path');
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.filePath3 = result.data.content;
    if (this.filePath3) {
      this.fileUrl3 = process.env.VUE_APP_CLOUD_FRONT_URL + result.data.content;
    }
    result = await firstContentApi('about4_title');
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.title4 = result.data.content;
    result = await firstContentApi('about4_body');
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.body4 = result.data.content;
    result = await firstContentApi('about4_file_path');
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.filePath4 = result.data.content;
    if (this.filePath4) {
      this.fileUrl4 = process.env.VUE_APP_CLOUD_FRONT_URL + result.data.content;
    }
    result = await firstContentApi('about5_title');
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.title5 = result.data.content;
    result = await firstContentApi('about5_body');
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.body5 = result.data.content;
    result = await firstContentApi('about5_file_path');
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.filePath5 = result.data.content;
    if (this.filePath5) {
      this.fileUrl5 = process.env.VUE_APP_CLOUD_FRONT_URL + result.data.content;
    }
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
      this.submitDisable = false;
    },
    save: async function () {
      this.submitDisable = true;
      let result = await storeContentAPi(
        'about1_title',
        this.title1
      );
      if (!result.success) {
        this.commonError(result);
        return;
      }
      result = await storeContentAPi(
        'about1_body',
        this.body1
      );
      if (!result.success) {
        this.commonError(result);
        return;
      }
      result = await storeContentAPi(
        'about1_file_path',
        this.filePath1
      );
      if (!result.success) {
        this.commonError(result);
        return;
      }

      result = await storeContentAPi(
        'about2_title',
        this.title2
      );
      if (!result.success) {
        this.commonError(result);
        return;
      }
      result = await storeContentAPi(
        'about2_body',
        this.body2
      );
      if (!result.success) {
        this.commonError(result);
        return;
      }
      result = await storeContentAPi(
        'about2_file_path',
        this.filePath2
      );
      if (!result.success) {
        this.commonError(result);
        return;
      }

      result = await storeContentAPi(
        'about3_title',
        this.title3
      );
      if (!result.success) {
        this.commonError(result);
        return;
      }
      result = await storeContentAPi(
        'about3_body',
        this.body3
      );
      if (!result.success) {
        this.commonError(result);
        return;
      }
      result = await storeContentAPi(
        'about3_file_path',
        this.filePath3
      );
      if (!result.success) {
        this.commonError(result);
        return;
      }

      result = await storeContentAPi(
        'about4_title',
        this.title4
      );
      if (!result.success) {
        this.commonError(result);
        return;
      }
      result = await storeContentAPi(
        'about4_body',
        this.body4
      );
      if (!result.success) {
        this.commonError(result);
        return;
      }
      result = await storeContentAPi(
        'about4_file_path',
        this.filePath4
      );
      if (!result.success) {
        this.commonError(result);
        return;
      }

      result = await storeContentAPi(
        'about5_title',
        this.title5
      );
      if (!result.success) {
        this.commonError(result);
        return;
      }
      result = await storeContentAPi(
        'about5_body',
        this.body5
      );
      if (!result.success) {
        this.commonError(result);
        return;
      }
      result = await storeContentAPi(
        'about5_file_path',
        this.filePath5
      );
      if (!result.success) {
        this.commonError(result);
        return;
      }

      alert("更新しました");
      this.submitDisable = false;
    },
    setUploadUrl1: function (uploadFile: any) {
      console.log(uploadFile)
      this.fileUrl1 = uploadFile.url;
      this.filePath1 = uploadFile.file_path;
    },
    setUploadUrl2: function (uploadFile: any) {
      this.fileUrl2 = uploadFile.url;
      this.filePath2 = uploadFile.file_path;
    },
    setUploadUrl3: function (uploadFile: any) {
      this.fileUrl3 = uploadFile.url;
      this.filePath3 = uploadFile.file_path;
    },
    setUploadUrl4: function (uploadFile: any) {
      this.fileUrl4 = uploadFile.url;
      this.filePath4 = uploadFile.file_path;
    },
    setUploadUrl5: function (uploadFile: any) {
      this.fileUrl5 = uploadFile.url;
      this.filePath5 = uploadFile.file_path;
    },
  },
});
</script>
<style lang="scss" scoped></style>
