<template>
  <h2 class="mb-3">商品更新</h2>
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
          <th>香りの特徴</th>
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
          <th>公開/非公開</th>
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
                <input class="form-check-input" type="radio" name="is_productStatus" id="is_product" :value="0"
                  v-model="items.is_productStatus" />
                <label class="form-check-label" for="is_productStatus"> 独自 </label>
              </div>
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
            <div class = "imageDiv">
              <div v-if="items.upload_file_hashs.length !== 0" v-for="imageUrl in imageUrls" >
                <img :src="imageUrl" width="100" height="100" @click=""/>
              </div>
            </div>
            <ValidateError :errorMessages="validateErrors['upload_file_hashs.0'] ?? []" />
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
          <button type="button" class="btn btn-primary" v-on:click="update()" :disabled="submitDisable">
            編集する
          </button>
        </div>
        <div class="px-2">
          <button type="button" class="btn btn-primary" v-on:click="addPrice()" :disabled="submitDisable">
            packを追加する
          </button>
        </div>
        <div class="px-2">
          <button type="button" class="btn btn-danger" v-on:click="destroy()" :disabled="submitDisable">
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
import { indexProductCategoryApi } from "@/api/product-categories";
import { indexMaterialApi } from "@/api/mst-materials";
import { indexSymptomApi } from "@/api/mst-symptoms";
import { indexTasteApi } from "@/api/mst-tastes";
import { indexFlavorApi } from "@/api/mst-flavors";

import {
  showProductApi,
  updateProductApi,
  destroyProductApi,
} from "@/api/products";
import UploadFile from "@/components/UploadFile.vue";

export default defineComponent({
  name: "ProductUpdate",
  components: {
    ErrorMessage,
    ValidateError,
    UploadFile,
  },
  data: () => ({
    isShow: false,
    message: "",
    count : 0,
    submitDisable: false,
    validateErrors: {} as any,
    items: {
      material_ids: [] as number[],
      symptom_ids: [] as number[],
      taste_ids: [] as number[],
      flavor_ids: [] as number[],
      prices: [] as any[],
      upload_file_hashs: [] as string[],
    } as any,
    categories: [] as any[],
    materials: [] as any[],
    sortedmaterials: [] as any[],
    symptoms: [] as any[],
    tastes: [] as any[],
    flavors: [] as any[],
    product: {} as any,
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

    this.materials = this.materials.sort((a, b) => {
      if (a.name < b.name) return -1;
      if (a.name > b.name) return 1;
      return 0;
    });

    // 症状
    result = await indexSymptomApi();
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.symptoms = result.data;
    // 味
    result = await indexTasteApi();
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.tastes = result.data;

    result = await indexFlavorApi();
    if (!result.success) {
      this.commonError(result);
      return;
    }
    this.flavors = result.data;

    await this.setInitData();
    this.isShow = true;
  },
  methods: {
    commonError: function (result: any = null): void {
      if (result.status === 422) {
        this.validateErrors = result.data;
      }
      if (result.message && result.message !== "") {
        this.message = result.message;
      }
    },
    setInitData: async function () {
      // 商品
      let result = await showProductApi(this.$route.params.id);
      if (!result.success) {
        this.commonError(result);
        return;
      }
      this.product = result.data;
      console.log("asdfa:", this.product);

      this.items.product_category_id = this.product.product_category_id;
      this.items.product_no = this.product.product_no;
      this.items.name1 = this.product.name1;
      this.items.name2 = this.product.name2;
      this.items.description = this.product.description;
      this.items.is_public = this.product.is_public ?? 0;
      this.items.is_productStatus = this.product.is_productStatus ?? 0;

      this.items.material_ids = this.product.material_ids;
      this.items.symptom_ids = this.product.symptom_ids;
      this.items.taste_ids = this.product.taste_ids;
      this.items.flavor_ids = this.product.flavor_ids;
      this.items.keyword_csv = this.product.keyword_csv;
      this.items.capacity = this.product.capacity;
      this.items.prices = [];
      for (const price of this.product.prices) {
        const p: any = price; // TODO ここいい感じにならないか
        this.items.prices.push({
          id: p.id,
          capacity: p.capacity,
          price: p.price,
          sort_order: p.sort_order,
        });
      }
      // this.items.upload_file_hashs[0] = this.product.upload_files[0].hash;

      for (let i = 0; i < this.product.upload_files.length; i++) {
        this.items.upload_file_hashs[i] = this.product.upload_files[i].hash;
      }
      console.log("image urls:", this.product.upload_files);

      this.product.upload_files.forEach((item: {
        [x: string]: string; url: any;
      }, index: string | number) => {
        this.imageUrls[index] = "https://content.herbareyou.jp/" + item?.file_path;
        console.log(this.imageUrls[index]);
      })

    },
    addPrice: function () {
      this.items.prices.push({
        id: null,
        capacity: null,
        price: null,
        sort_order: this.items.prices.length + 1,
      });
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

    update: async function () {
      this.validateErrors = {};
      this.message = "";
      this.submitDisable = true;
      console.log("updated Data:", this.items);
      const result = await updateProductApi(this.$route.params.id, this.items);
      this.submitDisable = false;
      if (!result.success) {
        this.commonError(result);
        return;
      }
      alert("更新しました");
      await this.setInitData();
    },
    setUploadFile: function (uploadFile: any) {
      // console.log(uploadFile);
      // this.items.upload_file_hashs[0] = uploadFile.hash;
      // this.imageUrls[0] = uploadFile.url;
      // console.log(this.imageUrls);

      console.log(uploadFile);
      this.items.upload_file_hashs[this.count] = uploadFile.hash;
      this.imageUrls[this.count] = uploadFile.url;
      console.log(this.imageUrls);
      this.count ++;
      console.log("count:", this.count);
    },
    destroy: async function () {
      if (!confirm("削除します。よろしいですか？")) {
        return;
      }
      this.submitDisable = true;
      const result = await destroyProductApi(this.$route.params.id);
      this.submitDisable = false;
      if (!result.success) {
        this.commonError(result);
        return;
      }
      alert("削除しました");
      this.$router.push({
        name: "ProductIndex",
      });
    },
  },
});
</script>
<style lang="scss" scoped>
.imageDiv{
  display:flex;
  flex-wrap: wrap;
  gap: 10px;
}
</style>
