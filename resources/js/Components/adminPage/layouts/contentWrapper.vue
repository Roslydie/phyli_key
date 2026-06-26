<template>
  <div class="admin-shell">
    <aside class="admin-sidebar">
      <sidebar />
    </aside>

    <div class="admin-main">
      <header class="admin-header">
        <Header />
      </header>
      <main class="admin-content">
        <router-view />
      </main>
      <footer class="admin-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              {{ new Date().getFullYear() }} © Phili Keys — Admin Panel
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
</template>

<script setup>

  import { themeInitAdminCustomier } from '../../plugins/themeInitAdminCustomier';
  import { useRoute } from "vue-router";
  import { onMounted, watch, ref, nextTick } from 'vue';
 
  import sidebar from './sidebar.vue';
    import Header from './header.vue';
  const route = useRoute();

  function initAllScripts() {
    themeInitAdminCustomier();
  }

  onMounted(async () => {
    await nextTick();
    initAllScripts();
  });

  watch(route, async () => {
    await nextTick();
    initAllScripts();
  });

</script>

<style scoped>
.admin-shell {
  display: flex;
  min-height: 100vh;
  background: #f4f7fb;
  font-family: 'Segoe UI', sans-serif;
}

.admin-sidebar {
  width: 260px;
  background: #0f172a;
  color: white;
}

.admin-main {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.admin-header {
  height: 70px;
  background: white;
  border-bottom: 1px solid #e2e8f0;
}

.admin-content {
  flex: 1;
  padding: 24px;
}

.admin-footer {
  padding: 16px 24px;
  background: white;
  border-top: 1px solid #e2e8f0;
  color: #64748b;
}
</style>