<template>
  <h2 class="mb-3">商品作成</h2>
  <ErrorMessage :message="message" />
  <div id="app" v-if="isShow">
    <div>
      <table class="table table-striped">
        <tr>
          <th>品番</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="items.product_no" />
            <ValidateError :errorMessages="validateErrors.product_no" />
          </td>
        </tr>
        <tr>
          <th>シリーズ名</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="items.name1" />
            <ValidateError :errorMessages="validateErrors.name1" />
          </td>
        </tr>
        <tr>
          <th>商品名</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="items.name2" />
            <ValidateError :errorMessages="validateErrors.name2" />
          </td>
        </tr>
        <tr>
          <th>カテゴリー</th>
          <td class="py-2">
            <select class="form-select" v-model="items.product_category_id">
              <option v-for="category in categories" :selected="category.id === items.product_category_id"
                :value="category.id">
                {{ category.name }}
              </option>
            </select>
            <ValidateError :errorMessages="validateErrors.product_category_id" />
          </td>
        </tr>
        <tr>
          <th>内容量</th>
          <td class="py-2">
            <input type="text" class="form-control" v-model="items.capacity" />
            <ValidateError :errorMessages="validateErrors.capacity" />
          </td>
        </tr>
        <tr>
          <th>材料</th>
          <td class="py-2">
            <div>
              <div class="form-check form-check-inline" v-for="material in materials" :key="material.id">
                <input class="form-check-input" type="checkbox" :id="'materialCheckbox' + String(material.id)"
                  :value="material.id" v-model="items.material_ids" />
                <label class="form-check-label" :for="'materialCheckbox' + String(material.id)">{{ material.name
}}</label>
              </div>
            </div>
            <ValidateError :errorMessages="validateErrors.material_ids" />
          </td>
        </tr>
        <tr>
          <th>症状</th>
          <td class="py-2">
            <div>
              <div class="form-check form-check-inline" v-for="symptom in symptoms" :key="symptom.id">
                <input class="form-check-input" type="checkbox" :id="'symptomCheckbox' + String(symptom.id)"
                  :value="symptom.id" v-model="items.symptom_ids" />
                <label class="form-check-label" :for="'symptomCheckbox' + String(symptom.id)">{{ symptom.name }}</label>
              </div>
            </div>
            <ValidateError :errorMessages="validateErrors.symptom_ids" />
          </td>
        </tr>
        <tr>
          <th>味の特徴</th>
          <td class="py-2">
            <div>
              <div class="form-check form-check-inline" v-for="taste in tastes" :key="taste.id">
                <input class="form-check-input" type="checkbox" :id="'tasteCheckbox' + String(taste.id)"
                  :value="taste.id" v-model="items.taste_ids" />
                <label class="form-check-label" :for="'tasteCheckbox' + String(taste.id)">{{ taste.name }}</label>
              </div>
            </div>
            <ValidateError :errorMessages="validateErrors.taste_ids" />
          </td>
        </tr>

        <tr>
          <th>味の特徴</th>
          <td class="py-2">
            <div>
              <div class="form-check form-check-inline" v-for="flavor in flavors" :key="flavor.id">
                <input class="form-check-input" type="checkbox" :id="'flavorCheckbox' + String(flavor.id)"
                  :value="flavor.id" v-model="items.flavor_ids" />
                <label class="form-check-label" :for="'flavorCheckbox' + String(flavor.id)">{{ flavor.name }}</label>
              </div>
            </div>
            <ValidateError :errorMessages="validateErrors.flavor_ids" />
          </td>
        </tr>

        <tr>
          <th>状態</th>
          <td class="py-2">
            <div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_public" id="is_public" :value="1"
                  v-model="items.is_public" />
                <label class="form-check-label" for="is_public"> 公開 </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_public" id="is_not_public" :value="0"
                  v-model="items.is_public" />
                <label class="form-check-label" for="is_not_public">
                  非公開
                </label>
              </div>
            </div>
            <ValidateError :errorMessages="validateErrors.is_public" />
          </td>
        </tr>

        <tr>
          <th>状態</th>
          <td class="py-2">
            <div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_productStatus" id="is_productStatus" :value="1"
                  v-model="items.is_productStatus" />
                <label class="form-check-label" for="is_productStatus"> 新着 </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_productStatus" id="is_sold_out" :value="2"
                  v-model="items.is_productStatus" />
                <label class="form-check-label" for="is_sold_out">
                  完売
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_productStatus" id="is_recommend" :value="3"
                  v-model="items.is_productStatus" />
                <label class="form-check-label" for="is_recommend">
                  お勧め
                </label>
              </div>
            </div>
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
              <div v-for="(imageUrl, index) in imageUrls">
                <img :src="imageUrl" width="100" height="100" @click="deleteImage(index)"/>
              </div>
            </div>
            <ValidateError :errorMessages="validateErrors['upload_file_hashs.0']" />
          </td>
        </tr>
        <tr>
          <th>商品説明</th>
          <td class="py-2">
            <textarea class="form-control" placeholder="商品説明" id="floatingTextarea"
              v-model="items.description"></textarea>
            <ValidateError :errorMessages="validateErrors.description" />
          </td>
        </tr>
        <tr>
          <th>キーワード(カンマ区切りで入力してください)</th>
          <td class="py-2">
            <textarea class="form-control" placeholder="キーワード(カンマ区切りで入力してください)" id="floatingTextarea"
              v-model="items.keyword_csv"></textarea>
            <ValidateError :errorMessages="validateErrors.keyword_csv" />
          </td>
        </tr>
        <tr>
          <th>packs</th>
          <td class="py-2">
            <div class="row" v-for="(price, index) in items.prices" :key="price.id">
              <div class="col-5">
                <input type="text" class="form-control" v-model="items.prices[index].capacity" placeholder="pack" />
              </div>
              <div class="col-5">
                <input type="text" class="form-control" v-model="items.prices[index].price" placeholder="値段" />
              </div>
              <div class="col-2">
                <button type="button" class="btn btn-danger" v-on:click="deletePrice(index)">
                  削除
                </button>
              </div>
              <ValidateError :errorMessages="
  validateErrors[`prices.${index}.capacity`] ?? []
" />
              <ValidateError :errorMessages="validateErrors[`prices.${index}.price`] ?? []" />
            </div>
          </td>
        </tr>
      </table>
      <div class="d-flex justify-content-center">
        <div class="px-2">
          <button type="button" class="btn btn-primary" v-on:click="create()" :disabled="submitDisable">
            作成する
          </button>
        </div>
        <div class="px-2">
          <button type="button" class="btn btn-primary" v-on:click="addPrice()" :disabled="submitDisable">
            packを追加する
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
import { indexProductCategoryApi } from "@/api/product-categories";
import { indexMaterialApi } from "@/api/mst-materials";
import { indexSymptomApi } from "@/api/mst-symptoms";
import { indexTasteApi } from "@/api/mst-tastes";
import { indexFlavorApi } from "@/api/mst-flavors";

import { storeProductApi } from "@/api/trialproducts";
import UploadFile from "@/components/UploadFile.vue";

export default defineComponent({
  name: "TrialProductStore",
  components: {
    ErrorMessage,
    ValidateError,
    UploadFile,
  },
  data: () => ({
    isShow: false,
    count: 0,
    message: "",
    submitDisable: false,
    validateErrors: {
      upload_file_urls: [] as any[],
    } as any,
    items: {
      material_ids: [] as number[],
      symptom_ids: [] as number[],
      taste_ids: [] as number[],
      flavor_ids: [] as number[],
      prices: [] as any[],
      is_public: 0,
      is_productStatus:0,
      upload_file_hashs: [] as string[],
    } as any,
    categories: [] as any[],
    materials: [] as any[],
    sortedmaterials: [] as any[],
    imageUrlsHash: [] as string[],

    symptoms: [] as any[],
    tastes: [] as any[],
    flavors: [] as any[],
    imageUrls: [] as string[],
  }),
  mounted: async function () {
    // カテゴリ
    let result = await indexProductCategoryApi();
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.categories = result.data;
    // 材料
    result = await indexMaterialApi();
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.materials = result.data;
    console.log(result.data);

    this.materials.sort((a, b) => {
      if (a.name < b.name) return -1
      if (a.name > b.name) return 1
      return 0
    });

    // 症状
    result = await indexSymptomApi();
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.symptoms = result.data;

    this.symptoms.sort((a, b) => {
      if (a.name < b.name) return -1
      if (a.name > b.name) return 1
      return 0
    });

    // 味
    result = await indexTasteApi();
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.tastes = result.data;
    this.tastes.sort((a, b) => {
      if (a.name < b.name) return -1
      if (a.name > b.name) return 1
      return 0
    });

    result = await indexFlavorApi();
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.flavors = result.data;
    this.flavors.sort((a, b) => {
      if (a.name < b.name) return -1
      if (a.name > b.name) return 1
      return 0
    });

    this.addPrice();
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
    addPrice: function () {
      this.items.prices.push({
        id: null,
        capacity: null,
        price: null,
        sort_order: this.items.prices.length + 1,
      });
    },
    deleteImage:function (index: number) {
      let imageArray: any[] = [];
      for (let i = 0; i < this.imageUrls.length; i++) {
        if (i !== index) {
          imageArray.push(this.imageUrls[i]);
        }
      }
      this.imageUrls = imageArray;

      let imageHashArray: any[] = [];

      for (let i = 0; i < this.imageUrlsHash.length; i++) {
        if (i !== index) {
          imageHashArray.push(this.imageUrlsHash[i]);
        }
      }
      this.imageUrlsHash = imageHashArray;
    },
    deletePrice: function (index: number) {
      let priceArray: any[] = [];
      for (let i = 0; i < this.items.prices.length; i++) {
        if (i !== index) {
          priceArray.push(this.items.prices[i]);
        }
      }
      this.items.prices = priceArray;
    },
    create: async function () {
      this.submitDisable = true;
      console.log("store data:", this.items);
      const result = await storeProductApi(this.items);
      if (!result.success) {
        this.commonError(result);
        this.submitDisable = false;
        return;
      }
      alert("作成しました");
      this.$router.push({
        name: "ProductUpdate",
        params: { id: result.data.id },
      });
    },

    setUploadFile: function (uploadFile: any) {
      console.log(uploadFile);
      this.items.upload_file_hashs[this.count] = uploadFile.hash;
      this.imageUrlsHash[this.count] = uploadFile.hash;
      this.imageUrls[this.count] = uploadFile.url;
      console.log(this.imageUrls);
      this.count++;
      console.log("count:", this.count);
    },
  },
});
</script>
<style lang="scss" scoped>

</style>
