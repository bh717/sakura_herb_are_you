<template>
  <div class="mb-3 mt-4 mp-0 w-75">
    <p v-if="message" class="text-danger">{{ message }}</p>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  name: "ErrorMessage",
  props: {
    message: {
      type: String,
      required: true,
    },
  },
});
</script>
