<template>
  <Navbar />

  <main class="main-content">
    <router-view />
  </main>

  <Footer />
</template>

<script setup>
import Navbar from "./navbar.vue";
import Footer from "./footer.vue";
import { onMounted, watch, nextTick } from "vue";
import { useRoute } from "vue-router";
import { themeInit } from "../../plugins/themeInit";

const route = useRoute();

function initAllScripts() {
  themeInit();
}

onMounted(async () => {
  await nextTick();
  initAllScripts();
});

watch(
  () => route.fullPath,
  async () => {
    await nextTick();
    initAllScripts();
  }
);
</script>

<style scoped>
.main-content {
  padding-top: 60px; /* Ajuste cette valeur selon la hauteur du header */
}
</style>