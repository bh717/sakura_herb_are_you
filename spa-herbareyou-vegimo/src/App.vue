<template>
  <router-view />
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { CommonScriptService } from "@/services/CommonScriptService";
import ValidateError from "@/components/ValidateError.vue";

export default defineComponent({
  name: "App",
  data() {
    return {
      commonScriptService: new CommonScriptService(),
    };
  },
  components: {},
  created: function (): void {},
  mounted: async function (): Promise<void> {},
  methods: {},
});
</script>

<style src="@/assets/css/common.css"></style>
