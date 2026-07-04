<template>
  <aside id="sidebar" class="sidebar">
    <div class="logo-area">
      <a href="#" class="brand">
        <img src="/assets/admin/images/logo-icon.svg" alt="" width="24">
        <span>Phili Keys</span>
      </a>
    </div>

    <ul class="nav-list">
      <li class="nav-title">Main</li>
      <li><a class="nav-link active" href="#"><i class="ti ti-home"></i><span>Dashboard</span></a></li>
      <li><RouterLink to="/admin/testimonial" class="nav-link"><i class="ti ti-users"></i><span>Testimonials</span></RouterLink></li>
      <li><RouterLink to="/admin/users" class="nav-link"><i class="ti ti-users"></i><span>Users</span></RouterLink></li>

      <li><a class="nav-link" href="#"><i class="ti ti-alert-circle"></i><span>404 Error</span></a></li>
      <li><a class="nav-link" href="#"><i class="ti ti-file-text"></i><span>Docs</span></a></li>

      <li class="nav-title">Account</li>
      <li><a class="nav-link" href="#"><i class="ti ti-logout"></i><span>Log in</span></a></li>
      <li><a class="nav-link" href="#"><i class="ti ti-user-plus"></i><span>Sign up</span></a></li>
    </ul>
  </aside>
</template>

<style scoped>
.sidebar {
  height: 100%;
  background: linear-gradient(180deg, #0f172a 0%, #111827 100%);
  color: #f8fafc;
  padding: 20px 14px;
}

.brand {
  display: flex;
  align-items: center;
  gap: 10px;
  color: white;
  text-decoration: none;
  font-weight: 700;
  margin-bottom: 20px;
}

.nav-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.nav-title {
  padding: 12px 10px 6px;
  font-size: 0.78rem;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: #94a3b8;
}

.nav-link {
  display: flex;
  align-items: center;
  gap: 10px;
  color: #cbd5e1;
  text-decoration: none;
  padding: 10px 12px;
  border-radius: 10px;
  margin-bottom: 4px;
}

.nav-link:hover,
.nav-link.active {
  background: rgba(255,255,255,0.12);
  color: white;
}
</style>