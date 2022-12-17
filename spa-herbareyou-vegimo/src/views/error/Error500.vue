<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article>
        <section class="sec" data-anime="fadeup">
          <div class="sec-container">
            <h2 class="sec-container__hd2" data-anime="fadeup">サーバーエラーが発生しました</h2>
            <div class="sec-container__illust-container" data-anime="fadeup">
              <img src="@/assets/img/error/error.svg" alt="" />
            </div>
          </div>
        </section>
      </article>
    </main>
    <Footer />
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { CommonScriptService } from "@/services/CommonScriptService";
import Footer from "@/components/Footer.vue";
import Header from "@/components/Header.vue";

export default defineComponent({
  name: "Error500",
  data() {
    return {
      commonScriptService: new CommonScriptService(),
    };
  },
  components: {
    Footer,
    Header,
  },
  // created: function (): void {
  // },
  mounted: async function (): Promise<void> {
    document.body.className = "seccess";
    this.isShow = true;
    this.$nextTick(function () {
      this.commonScriptService.execute();
    });
  },
  methods: {
  },
});
</script>
<style scoped src="@/assets/css/error.css"></style>
