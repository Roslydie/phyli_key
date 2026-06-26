<template>
  <nav class="topbar" role="banner">
    <div class="topbar-title">Dashboard</div>
    <div class="topbar-actions">
      <a href="#" class="icon-btn">🔔 <span>2</span></a>
      <a href="#" class="user-pill">
        <img src="/assets/admin/images/avatar/avatar-1.jpg" alt="avatar" />
        <span>Shrina</span>
      </a>
    </div>
  </nav>
</template>

<style scoped>
.topbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 70px;
  padding: 0 24px;
  background: #ffffff;
  border-bottom: 1px solid #e2e8f0;
  box-sizing: border-box;
  width: 100%;
  z-index: 10;
  position: relative;
}

.topbar-title {
  font-size: 1.1rem;
  font-weight: 700;
  color: #0f172a;
}

.topbar-actions {
  display: flex;
  align-items: center;
  gap: 12px;
}

.icon-btn,
.user-pill {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  text-decoration: none;
  color: #334155;
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 999px;
  padding: 8px 12px;
  line-height: 1;
}

.icon-btn span {
  background: #ef4444;
  color: white;
  border-radius: 999px;
  font-size: 0.75rem;
  padding: 2px 6px;
}

.user-pill img {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  display: block;
}
</style>