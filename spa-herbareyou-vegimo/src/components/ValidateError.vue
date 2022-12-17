<template>
  <!-- <div class=""> -->
  <p
    v-for="(errorMessage, index) in errorMessages"
    v-bind:key="index"
    class="validation"
  >
    {{ errorMessage }}
  </p>
  <!-- </div> -->
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  props: ["errorMessages"],
});
</script>
<style scoped>
.validation {
  color: #ff0000;
  font-size: 75%;
  position: absolute;
  top: -1.5rem;
  left: 0;
}
</style>
