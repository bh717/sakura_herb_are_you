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

            
            <h2 class="sec-container__hd3" v-if="diagnoseData.diagnose1.condition === 1">
              それは大変..、
            </h2>
            <h2 class="sec-container__hd3" v-else-if="diagnoseData.diagnose1.condition === 2">
              なるほど。 少し詳しく教えてください。
            </h2>
            <h2 class="sec-container__hd3" v-else-if="diagnoseData.diagnose1.condition === 3">
              良かった！ ところで、
            </h2>
            
            <h2 class="sec-container__hd2" >
              表示されている中に具体的な症状の悩みがありますか？
            </h2>
            <div class="sec-container__form">
              <div class="sec-container__form-parts"  >
                <input type="radio" name="condition" :value="3" id="condition3" v-model="condition" />
                <label for="condition3" class="sec-container__form-label">頭痛</label>
              </div>
              <div class="sec-container__form-parts" >
                <input type="radio" name="condition" :value="4" id="condition4" v-model="condition" />
                <label for="condition4" class="sec-container__form-label">吐き気</label>
              </div>
              <div class="sec-container__form-parts" >
                <input type="radio" name="condition" :value="7" id="condition7" v-model="condition" />
                <label for="condition7" class="sec-container__form-label">便秘</label>
              </div>
              <div class="sec-container__form-parts" >
                <input type="radio" name="condition" :value="8" id="condition8" v-model="condition" />
                <label for="condition8" class="sec-container__form-label">のどの痛み</label>
              </div>
              <div class="sec-container__form-parts" >
                <input type="radio" name="condition" :value="9" id="condition9" v-model="condition" />
                <label for="condition9" class="sec-container__form-label">かぜ</label>
              </div>
              <div class="sec-container__form-parts" >
                <input type="radio" name="condition" :value="14" id="condition14" v-model="condition" />
                <label for="condition14" class="sec-container__form-label">肩こり</label>
              </div>
              <div class="sec-container__form-parts" >
                <input type="radio" name="condition" :value="15" id="condition15" v-model="condition" />
                <label for="condition15" class="sec-container__form-label">花粉症</label>
              </div>
              <div class="sec-container__form-parts" >
                <input type="radio" name="condition" :value="16" id="condition16" v-model="condition" />
                <label for="condition16" class="sec-container__form-label">貧血</label>
              </div>
              <div class="sec-container__form-parts" >
                <input type="radio" name="condition" :value="17" id="condition17" v-model="condition" />
                <label for="condition17" class="sec-container__form-label">胃腸</label>
              </div>
              <!-- <div class="sec-container__form-parts" >
                <input type="radio" name="condition" :value="1" id="condition1" v-model="condition" />
                <label for="condition1" class="sec-container__form-label">むくみ</label>
              </div>
              <div class="sec-container__form-parts" >
                <input type="radio" name="condition" :value="2" id="condition2" v-model="condition" />
                <label for="condition2" class="sec-container__form-label">ダイエット</label>
              </div>
              <div class="sec-container__form-parts" >
                <input type="radio" name="condition" :value="5" id="condition5" v-model="condition" />
                <label for="condition5" class="sec-container__form-label">ストレス</label>
              </div>
              <div class="sec-container__form-parts" >
                <input type="radio" name="condition" :value="6" id="condition6" v-model="condition" />
                <label for="condition6" class="sec-container__form-label">眠り</label>
              </div>
              <div class="sec-container__form-parts">
                <input type="radio" name="condition" :value="10" id="condition10" v-model="condition" />
                <label for="condition10" class="sec-container__form-label">美容</label>
              </div>
              <div class="sec-container__form-parts">
                <input type="radio" name="condition" :value="11" id="condition11" v-model="condition"  />
                <label for="condition11" class="sec-container__form-label">疲れ</label>
              </div>
              <div class="sec-container__form-parts" >
                <input type="radio" name="condition" :value="12" id="condition12" v-model="condition" />
                <label for="condition12" class="sec-container__form-label">女性の不調</label>
              </div>
              <div class="sec-container__form-parts" >
                <input type="radio" name="condition" :value="13" id="condition13" v-model="condition" />
                <label for="condition13" class="sec-container__form-label">前向きな気持ち</label>
              </div>
              <div class="sec-container__form-parts" >
                <input type="radio" name="condition" :value="18" id="condition18" v-model="condition" />
                <label for="condition18" class="sec-container__form-label">冷え</label>
              </div>
              <div class="sec-container__form-parts">
                <input type="radio" name="condition" :value="19" id="condition19" v-model="condition" />
                <label for="condition19" class="sec-container__form-label">ハーブティーを楽しむ</label>
              </div> -->
              <div class="sec-container__form-parts">
                <input type="radio" name="condition" :value="20" id="condition20" v-model="condition" />
                <label for="condition20" class="sec-container__form-label">該当する症状はない</label>
              </div>

              <div class="sec-container__form-parts">
                <input type="radio" name="condition" :value="21" id="condition21" v-model="condition" />
                <label for="condition21" class="sec-container__form-label">具体的な症状はない</label>
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
  </div>
</template>
<script lang="ts">
import { defineComponent } from "vue";
import Footer from "@/components/Footer.vue";
import Header from "@/components/Header.vue";
import { CommonScriptService } from "@/services/CommonScriptService";

export default defineComponent({
  name: "2",
  watch: {},
  data() {
    return {
      isShow: false,
      backPath: "Diagnose1",
      detailedsymptoms: [] as any[],
      // currentPath: 'Diagnose2',
      nextPath: "Diagnose3",
      nextPath1: "Diagnose4",
      condition: 0 as number,
      diagnoseData: {} as any,
      commonScriptService: new CommonScriptService(),
    };
  },
  components: {
    Footer,
    Header,
  },
  created: async function () { },
  mounted: async function (): Promise<void> {
    document.body.className = "diagnose";

    

    await this.init();
    this.isShow = true;
    this.$nextTick(function () {
      this.commonScriptService.execute();
    });
  },

  methods: {
    init: function () {
      const diagnoseJsonData = localStorage.getItem("diagnoseJsonData");
      if (!diagnoseJsonData) {
        this.$router.push({
          name: "Diagnose0",
        });
        return;
      }
      const diagnoseData = JSON.parse(diagnoseJsonData);
      if (!diagnoseData?.diagnose1) {
        this.$router.push({
          name: this.backPath,
        });
        return;
      }
      this.diagnoseData = diagnoseData;
    },
    nextPage: function () {
      if (this.condition === 0) {
        return;
      }
      this.diagnoseData.diagnose2 = {
        condition: this.condition,
      };
      localStorage.setItem(
        "diagnoseJsonData",
        JSON.stringify(this.diagnoseData)
      );
      if(this.condition !== 20 && this.condition !== 21)
      {
        this.$router.push({
          name: this.nextPath,
        });}
      else{
        this.$router.push({
          name: this.nextPath1,
        });
      }
    },
  },
});
</script>
<style scoped src="@/assets/css/diagnose-2.css">

</style>
