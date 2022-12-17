<template>
  <div class="container">
    <Header />
    <!-- <div class="container"> -->
    <router-view />
    <!-- </div> -->
    <Footer />

    <div class="mb-5"></div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import Footer from "@/components/Footer.vue";
import Header from "@/components/Header.vue";

export default defineComponent({
  name: "App",
  data() {
    return {};
  },
  components: {
    Footer,
    Header,
  },
  created: function (): void {},
  mounted: async function (): Promise<void> {},
  methods: {},
});
</script>

<style lang="scss" src="@/assets/scss/main.scss"></style>
