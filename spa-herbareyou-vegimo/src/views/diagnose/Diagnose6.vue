<template>
    <div class="wrapper">
      <Header />
      <main class="main">
        <article id="app" v-if="isShow">
          <section class="sec">
            <div class="sec-container">
              <p class="sec-container__name">
                {{ diagnoseData.diagnose0.name }}さん
              </p>
              <!-- <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose2.condition === 3">どのような頭痛ですか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose2.condition === 4">ミントを使用しても大丈夫ですか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose2.condition === 7">どのような原因からだと考えられますか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose2.condition === 8">どのような痛みですか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose2.condition === 9">どのようなかぜですか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose2.condition === 14">身体のめぐりを良くしましょう！</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose2.condition === 15">ミントを使用しても大丈夫ですか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose2.condition === 16">ミネラルを取り入れましょう！</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose2.condition === 17">どのような胃腸の悩みがありますか？</h2> -->
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 1">水分の巡りを良くしましょう！</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 2">身体を整えてボディフルネスを！</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 5">どのようにストレスを感じていますか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 6">どのような眠りの悩みですか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 10">最も興味があるのはどれですか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 11">どこが疲れていますか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 12">ハーブティーでペースを取り戻しましょう</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 13">ハーブティーで前向きな気持ちに</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 18">ハーブティーで身体をポカポカ温めよう</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 19">おいしいハーブティーで素敵な毎日を</h2>
  
              <div class="sec-container__form">
                <div class="sec-container__form-parts" v-for="symptom in symptoms" v-bind:key="symptom.id">
                  <input type="radio" name="condition" :value=symptom.name :id=String(symptom.id) v-model="condition" />
                  <label :for=String(symptom.id) class="sec-container__form-label">{{ symptom.name }}</label>
                </div>
              </div>
  
              <div class="sec-container__btn">
                <button type="button" class="sec-container__btn-inner" v-on:click="nextPage()">
                  次の質問へ
                </button>
              </div>
  
              <div class="sec-container__back">
                <router-link :to="{ name: backPath }" class="sec-container__back-inner">
                  前のページへ戻る
                </router-link>
              </div>
            </div>
          </section>
        </article>
  
        <article id="app" v-if="isSecondShow">
          <section class="sec">
            <div class="sec-container">
              <p class="sec-container__name">
                {{ diagnoseData.diagnose0.name }}さん
              </p>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 3">どのような頭痛ですか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 4">ミントを使用しても大丈夫ですか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 7">どのような原因からだと考えられますか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 8">どのような痛みですか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 9">どのようなかぜですか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 14">身体のめぐりを良くしましょう！</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 15">ミントを使用しても大丈夫ですか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 16">ミネラルを取り入れましょう！</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 17">どのような胃腸の悩みがありますか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 1">水分の巡りを良くしましょう！</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 2">身体を整えてボディフルネスを！</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 5">どのようにストレスを感じていますか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 6">どのような眠りの悩みですか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 10">最も興味があるのはどれですか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 11">どこが疲れていますか？</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 12">ハーブティーでペースを取り戻しましょう</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 13">ハーブティーで前向きな気持ちに</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 18">ハーブティーで身体をポカポカ温めよう</h2>
              <h2 class="sec-container__hd2" v-if="diagnoseData.diagnose4.condition === 19">おいしいハーブティーで素敵な毎日を</h2>
              
              <h2 class="sec-container__hd2">味の特徴</h2>
              <div class="sec-container__form">
                <div class="sec-container__form-parts" v-for="flavor in flavors" v-bind:key="flavor.id">
                  <input type="checkbox" name="condition" :value=flavor.id :id=String(flavor.name) v-model="flavorIds"
                    :checked="flavorIds.includes(flavor.id)" />
                  <label :for=String(flavor.name) class="sec-container__form-label">{{ flavor.name }}</label>
                </div>
              </div>
  
              <h2 class="sec-container__hd2">香りの特徴</h2>
              <div class="sec-container__form">
                <div class="sec-container__form-parts" v-for="taste in tastes" v-bind:key="taste.id">
                  <input type="checkbox" name="condition1" :value=taste.id :id=String(taste.name) v-model="tasteIds"
                    :checked="tasteIds.includes(taste.id)" />
                  <label :for=String(taste.name) class="sec-container__form-label">{{ taste.name }}</label>
                </div>
              </div>
  
              <div class="sec-container__btn">
                <button type="button" class="sec-container__btn-inner" v-on:click="nextPage()">
                  次の質問へ
                </button>
              </div>
  
              <div class="sec-container__back">
                <router-link :to="{ name: backPath }" class="sec-container__back-inner">
                  前のページへ戻る
                </router-link>
              </div>
            </div>
          </section>
        </article>
        <div class="deco">
          <img src="@/assets/img/diagnose/dogtor.gif" alt="" class="deco__img" />
        </div>
      </main>
      <!-- <Footer /> -->
      <div class="footer-div"></div>
    </div>
  </template>
  <script lang="ts">
  import { defineComponent } from "vue";
  import Footer from "@/components/Footer.vue";
  import Header from "@/components/Header.vue";
  import { CommonScriptService } from "@/services/CommonScriptService";
  import { showDetailedSymptomsApi } from "@/api/detailed-symptoms";
  
  import { showDetailedFlavorsApi } from "@/api/detailed-flavors";
  import { showDetailedTastesApi } from "@/api/detailed-tastes";
  
  
  export default defineComponent({
    name: "2",
    watch: {},
    data() {
      return {
        isShow: false,
        isSecondShow: false,
        backPath: "Diagnose4",
        symptoms: [] as any[],
        flavors: [] as any[],
        tastes: [] as any[],
  
        flavorIds: [] as any[],
        tasteIds: [] as any[],
        // currentPath: 'Diagnose3',
        nextPath: "Diagnose5",
        nextPath1: "Diagnose4",
  
        condition: 0 as number,
        condition1: 0 as number,
  
        taste: 0 as number,
        diagnoseData: {} as any,
        commonScriptService: new CommonScriptService(),
      };
    },
    components: {
      Footer,
      Header,
    },
    created: async function () { },
    mounted: function (): void {
      document.body.className = "diagnose";
  
      this.init();
      this.isShow = true;
      this.isSecondShow = false;
      this.$nextTick(function () {
        this.commonScriptService.execute();
      });
    },
  
    methods: {
      init: async function () {
  
        const diagnoseJsonData = localStorage.getItem("diagnoseJsonData");
        if (!diagnoseJsonData) {
          this.$router.push({
            name: "Diagnose0",
          });
          return;
        }
        const diagnoseData = JSON.parse(diagnoseJsonData);
        if (!diagnoseData?.diagnose4) {
          this.$router.push({
            name: this.backPath,
          });
          return;
        }
        this.diagnoseData = diagnoseData;
        console.log("detailedSymptomsID:", this.diagnoseData.diagnose4.condition);
  
        const DetailedSymptomsApiResult = await showDetailedSymptomsApi(Number(this.diagnoseData.diagnose4.condition));
        console.log("detailedSymptoms:", DetailedSymptomsApiResult);
  
        if (!DetailedSymptomsApiResult.success) {
          this.commonError(DetailedSymptomsApiResult);
          return;
        }
        this.symptoms = DetailedSymptomsApiResult.data
  
        if (this.symptoms[0].name === "味と香りの好みを選択してください") {
          this.isShow = false;
          const result = await showDetailedFlavorsApi(this.symptoms[0].symptom_id);
          console.log("data:", result);
          this.flavors = result.data;
  
          const result1 = await showDetailedTastesApi(this.symptoms[0].symptom_id);
          console.log("data:", result1);
          this.tastes = result1.data;
  
          this.isSecondShow = true;
        }
      },
  
      nextPage: function () {

        if (this.isShow === true) {
          if (this.condition === 0) {
            return;
          }
          this.diagnoseData.diagnose6 = {
            id: this.diagnoseData.diagnose4.condition,
            condition: this.condition,
          };
          localStorage.setItem(
            "diagnoseJsonData",
            JSON.stringify(this.diagnoseData)
          );
          console.log("diagnoseData:::::", this.diagnoseData.diagnose6);
          if (this.diagnoseData.diagnose6.condition === '当てはまるものがない' || this.diagnoseData.diagnose6.condition === "分からない") {
            this.$router.push({
              name: this.nextPath1,
            });
          }
          else {
            this.$router.push({
              name: this.nextPath,
            });
          }
        }
        if (this.isSecondShow === true) {
          if (this.condition === 0) {
            return;
          }
          const query: string =
            "?" +
            "taste_ids=" +
            this.tasteIds +
            "&flavor_ids=" +
            this.flavorIds +
            "&material_ids=" +
            "" +
            "&symptom_ids=" +
            "" +
            "&order_by=" +
            "" +
            "&recommendation_kind=" +
            "";
          location.href = location.origin + "/product" + query;
        }
        // else {
        //   console.log(this.diagnoseData.diagnose2.condition);
        //   const query: string =
        //     "?" +
        //     "&symptom_ids=" +
        //     this.diagnoseData.diagnose2.condition;
        //   location.href = location.origin + "/product" + query;
        //   console.log("filepath:", location);
        // }
      },
    },
  });
  </script>
  <style scoped src="@/assets/css/diagnose-6.css">
  
  </style>
  