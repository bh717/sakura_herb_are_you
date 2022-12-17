<template>
  <div class="p-0 m-0" v-if="errorMessages.length !== 0">
    <p
      v-for="(errorMessage, index) in errorMessages"
      :key="index"
      class="text-danger p-0 m-0"
    >
      {{ errorMessage }}
    </p>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    errorMessages: {
      type: Array,
      default: [],
      required: false,
    },
  },
});
</script>
