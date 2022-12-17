<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article id="app" v-if="isShow">
        <section class="sec">
          <div class="sec-container">
            <p class="sec-container__name">山田太郎さん</p>
            <h2 class="sec-container__hd2">どんな味がお好みですか？</h2>
            <div class="sec-container__form">
              <div class="sec-container__form-parts">
                <input type="radio" name="condition" :value="1" id="condition1" v-model="condition" />
                <label for="condition1" class="sec-container__form-label">むくみを解消したい</label>
              </div>
              <div class="sec-container__form-parts">
                <input type="radio" name="condition" :value="2" id="condition2" v-model="condition" />
                <label for="condition2" class="sec-container__form-label">身体をスマートにしたい</label>
              </div>
              <div class="sec-container__form-parts">
                <input type="radio" name="condition" :value="3" id="condition3" v-model="condition" />
                <label for="condition3" class="sec-container__form-label">ストレスが気になる</label>
              </div>
              <div class="sec-container__form-parts">
                <input type="radio" name="condition" :value="4" id="condition4" v-model="condition" />
                <label for="condition4" class="sec-container__form-label">しっかり眠りたい</label>
              </div>
              <div class="sec-container__form-parts">
                <input type="radio" name="condition" :value="5" id="condition5" v-model="condition" />
                <label for="condition5" class="sec-container__form-label">美容につなげたい</label>
              </div>
              <div class="sec-container__form-parts">
                <input type="radio" name="condition" :value="6" id="condition6" v-model="condition" />
                <label for="condition6" class="sec-container__form-label">疲れを取りたい</label>
              </div>
              <div class="sec-container__form-parts">
                <input type="radio" name="condition" :value="7" id="condition7" v-model="condition" />
                <label for="condition7" class="sec-container__form-label">女性の不調を整えたい</label>
              </div>
              <div class="sec-container__form-parts">
                <input type="radio" name="condition" :value="8" id="condition8" v-model="condition" />
                <label for="condition8" class="sec-container__form-label">気持ちを前向きにしたい</label>
              </div>
              <div class="sec-container__form-parts">
                <input type="radio" name="condition" :value="9" id="condition9" v-model="condition" />
                <label for="condition9" class="sec-container__form-label">身体を温めたい</label>
              </div>
              <div class="sec-container__form-parts">
                <input type="radio" name="condition" :value="10" id="condition10" v-model="condition" />
                <label for="condition10" class="sec-container__form-label">おいしいハーブティーを楽しみたい</label>
              </div>
              <div class="sec-container__form-parts"></div>
            </div>
            <div class="sec-container__btn">
              <button class="sec-container__btn-inner" v-on:click="nextPage()">
                なるほど…
              </button>
            </div>
            <div class="sec-container__back">
              <a href="/diagnose2" class="sec-container__back-inner">前のページへ戻る</a>
            </div>
          </div>
        </section>
      </article>
      <div class="deco">
        <img src="@/assets/img/diagnose/dogtor.gif" alt="" class="deco__img" />
      </div>
    </main>
    <Footer />
  </div>
</template>
<script lang="ts">
import { defineComponent } from "vue";
import Footer from "@/components/Footer.vue";
import Header from "@/components/Header.vue";
import { CommonScriptService } from "@/services/CommonScriptService";

export default defineComponent({
  name: "Diagnose4",
  watch: {},
  data() {
    return {
      isShow: true,
      condition: 0 as number,
      nextPath: "Diagnose3",
    };
  },
  components: {
    Footer,
    Header,
  },
  created: async function () { },
  mounted: async function (): Promise<void> {
    this.$nextTick(function () {
      this.commonScriptService.execute();
    });
  },
  beforeDestroy: function (): void { },
  methods: {
    nextPage: function () {
      // alert(this.condition);
      let query;
      switch (this.condition) {
        case 1:
          query =
            "?" +
            "&symptom_ids=" +
            1;
          location.href = location.origin + "/product" + query;
          break;

        case 2:
          query =
            "?" +
            "&symptom_ids=" +
            2;
          location.href = location.origin + "/product" + query;
          break;

        case 3:
          query =
            "?" +
            "&symptom_ids=" +
            5;
          location.href = location.origin + "/product" + query;
          break;
        //
        case 4:
          query =
            "?" +
            "&symptom_ids=" +
            6;
          location.href = location.origin + "/product" + query;

        case 5:
          query =
            "?" +
            "&symptom_ids=" +
            10;
          location.href = location.origin + "/product" + query;

        case 6:
          query =
            "?" +
            "&symptom_ids=" +
            11;
          location.href = location.origin + "/product" + query;

        case 7:
          query =
            "?" +
            "&symptom_ids=" +
            12;
          location.href = location.origin + "/product" + query;

        case 8:
          query =
            "?" +
            "&symptom_ids=" +
            13;
          location.href = location.origin + "/product" + query;

        case 9:
          query =
            "?" +
            "&symptom_ids=" +
            18;
          location.href = location.origin + "/product" + query;


        case 10:
          query =
            "?" +
            "&symptom_ids=" +
            19;
          location.href = location.origin + "/product" + query;
          break;
        default:
          break;
      }
    },
  },
});
</script>
<style scoped src="@/assets/css/diagnose-4.css">

</style>
