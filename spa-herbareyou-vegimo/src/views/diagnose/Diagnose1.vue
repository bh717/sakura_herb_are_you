<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article id="app">
        <section class="sec" v-if="isShow">
          <div class="sec-container">
            <p class="sec-container__name">
              {{ this.name }}さん
            </p>
            <h2 class="sec-container__hd2">
              <span class="sec-container__hd2-upper">HERB ARE YOU?</span>
              <span class="sec-container__hd2-below">調子はどうですか？</span>
            </h2>
            <div class="sec-container__form">
              <div class="sec-container__form-parts">
                <input
                  type="radio"
                  name="condition"
                  id="NotGood"
                  :value="1"
                  v-model="condition"
                />
                <label for="NotGood" class="sec-container__form-label"
                  >Not Good</label
                >
                <p class="sec-container__form-txt">
                  困った症状あり。<br
                    class="sp"
                  />具体的な痛みや不調に向き合いたい。
                </p>
              </div>
              <div class="sec-container__form-parts">
                <input
                  type="radio"
                  name="condition"
                  id="Soso"
                  :value="2"
                  v-model="condition"
                />
                <label for="Soso" class="sec-container__form-label">Soso</label>
                <p class="sec-container__form-txt">
                  まあまあ。<br class="sp" />なんとなくの不調に備えたい。
                </p>
              </div>
              <div class="sec-container__form-parts">
                <input
                  type="radio"
                  name="condition"
                  id="Good"
                  :value="3"
                  v-model="condition"
                />
                <label for="Good" class="sec-container__form-label">Good</label>
                <p class="sec-container__form-txt">
                  いい気分。<br class="sp" />ハーブティで自分らしくなりたい。
                </p>
              </div>
            </div>
            <div class="sec-container__btn">
              <button
                type="button"
                class="sec-container__btn-inner"
                v-on:click="nextPage()"
              >
                次の質問へ
              </button>
            </div>
            <div class="sec-container__back">
              <router-link
                :to="{ name: backPath }"
                class="sec-container__back-inner"
              >
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
import { getName } from "@/api/name";

export default defineComponent({
  name: "Diagnose1",
  watch: {},
  data() {
    return {
      isShow: false,
      backPath: "Diagnose0",
      nextPath: "Diagnose2",
      condition: 0 as number,
      email: "" as string,
      name: "" as string,
      firstname: "" as string,
      lastname: "" as string,
      diagnoseData: {} as any,
      commonScriptService: new CommonScriptService(),
    };
  },
  components: {
    Footer,
    Header,
  },
  created: async function () {},
  mounted: function (): void {
    document.body.className = "diagnose";
    this.init();
    this.isShow = true;
    this.$nextTick(function () {
      this.commonScriptService.execute();
    });
  },

  methods: {
    init: async function (): Promise<any> {
      if (!localStorage.getItem("access_token")) {
        const diagnoseJsonData = localStorage.getItem("diagnoseJsonData");
        if (!diagnoseJsonData) {
          this.$router.push({
            name: "Diagnose0",
          });
          return;
        }
        const diagnoseData = JSON.parse(diagnoseJsonData);
        console.log("diagnose:", diagnoseData?.diagnose0?.name);
        this.name = diagnoseData?.diagnose0?.name;
      } else {
        this.email = localStorage.getItem("gmail");
        const res = await getName(this.email);
        const response = res.data;
        console.log("resData:", res.data);
        this.firstname = response[0].first_name;
        this.lastname = response[0].last_name;
        this.name = this.firstname + " " + this.lastname;
      }
      // const diagnoseJsonData = localStorage.getItem("diagnoseJsonData");
      // if (!diagnoseJsonData) {
      //   this.$router.push({
      //     name: "Diagnose0",
      //   });
      //   return;
      // }
      // const diagnoseData = JSON.parse(diagnoseJsonData);
      // if (!diagnoseData?.diagnose0) {
      //   this.$router.push({
      //     name: "Diagnose0",
      //   });
      //   return;
      // }
      // this.diagnoseData = diagnoseData;
    },
    nextPage: function () {
      if (this.condition === 0) {
        return;
      }
      this.diagnoseData.diagnose1 = {
        condition: this.condition,
      };
      localStorage.setItem(
        "diagnoseJsonData",
        JSON.stringify({
          diagnose0: { name: this.name },
          diagnose1: { condition: this.condition },
        })
      );
      // localStorage.setItem(
      //   "diagnoseJsonData",
      //   JSON.stringify(this.diagnoseData)
      // );
      this.$router.push({
        name: this.nextPath,
      });
    },
  },
});
</script>
<style scoped src="@/assets/css/diagnose-1.css"></style>
