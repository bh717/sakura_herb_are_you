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
                  <input type="radio" name="condition" value="1" id="condition1" />
                  <label for="condition1" class="sec-container__form-label">むくみを解消したい</label>
                </div>
                <div class="sec-container__form-parts">
                  <input type="radio" name="condition" value="2" id="condition2" />
                  <label for="condition2" class="sec-container__form-label">身体をスマートにしたい</label>
                </div>
                <div class="sec-container__form-parts">
                  <input type="radio" name="condition" value="3" id="condition3" />
                  <label for="condition3" class="sec-container__form-label">ストレスが気になる</label>
                </div>
                <div class="sec-container__form-parts">
                  <input type="radio" name="condition" value="4" id="condition4" />
                  <label for="condition4" class="sec-container__form-label">しっかり眠りたい</label>
                </div>
                <div class="sec-container__form-parts">
                  <input type="radio" name="condition" value="5" id="condition5" />
                  <label for="condition5" class="sec-container__form-label">美容につなげたい</label>
                </div>
                <div class="sec-container__form-parts">
                  <input type="radio" name="condition" value="6" id="condition6" />
                  <label for="condition6" class="sec-container__form-label">疲れを取りたい</label>
                </div>
                <div class="sec-container__form-parts">
                  <input type="radio" name="condition" value="7" id="condition7" />
                  <label for="condition7" class="sec-container__form-label">女性の不調を整えたい</label>
                </div>
                <div class="sec-container__form-parts">
                  <input type="radio" name="condition" value="8" id="condition8" />
                  <label for="condition8" class="sec-container__form-label">気持ちを前向きにしたい</label>
                </div>
                <div class="sec-container__form-parts">
                  <input type="radio" name="condition" value="9" id="condition9" />
                  <label for="condition9" class="sec-container__form-label">身体を温めたい</label>
                </div>
                <div class="sec-container__form-parts">
                  <input type="radio" name="condition" value="10" id="condition10" />
                  <label for="condition10" class="sec-container__form-label">おいしいハーブティーを楽しみたい</label>
                </div>
                <div class="sec-container__form-parts"></div>
              </div>
              <div class="sec-container__btn">
                <button class="sec-container__btn-inner" onclick="window.location.href = '/diagnose/diagnoseresult/'">
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
    methods: {},
  });
  </script>
  <style scoped src="@/assets/css/diagnose-4.css">
  
  </style>
  