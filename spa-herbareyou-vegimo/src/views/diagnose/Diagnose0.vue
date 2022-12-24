<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article id="app" v-if="isShow">
        <section class="sec">
          <div class="sec-container">
            <h2 class="sec-container__hd2">ハーブティ診断START!</h2>
            <div class="sec-container__form">
              <label for="" class="sec-container__label">あなたのお名前</label>
              <input type="text" class="sec-container__input" v-model="name" />
            </div>
            <div class="sec-container__btn">
              <button
                type="button"
                class="sec-container__btn-inner"
                v-on:click="nextPage()"
              >
                次へすすむ
              </button>
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
import { getName } from "@/api/name";

export default defineComponent({
  name: "Diagnose0",
  watch: {},
  data() {
    return {
      isShow: true,
      name: "" as string,
      nextPath: "Diagnose1",
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
    this.$nextTick(function () {
      this.commonScriptService.execute();
    });
  },

  methods: {
    init: async function (): Promise<any> {
      localStorage.removeItem("diagnoseJsonData");
      if (!localStorage.getItem("access_token")) {
        this.name = "ゲスト様";

        localStorage.setItem(
          "diagnoseJsonData",
          JSON.stringify({
            diagnose0: { name: this.name },
          })
        );
      }

      else {
        this.email = localStorage.getItem("gmail");
        const res = await getName(this.email);
        const response = res.data;
        console.log("resData:", res.data);
        this.firstname = response[0].first_name;
        this.lastname = response[0].last_name;
        this.name = this.firstname + " " + this.lastname;
        this.nextPage();
      }
    },
    nextPage: function () {
      if (!this.name) {
        return;
      }
      localStorage.setItem(
        "diagnoseJsonData",
        JSON.stringify({
          diagnose0: { name: this.name },
        })
      );
      this.$router.push({
        name: this.nextPath,
      });
    },
  },
});
</script>
<style scoped src="@/assets/css/diagnose.css"></style>
