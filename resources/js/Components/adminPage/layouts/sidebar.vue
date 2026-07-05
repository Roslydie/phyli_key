<template>
  <aside id="sidebar" class="sidebar">
    <div class="logo-area">
      <a href="#" class="brand">
        <img src="/assets/admin/images/logo-icon.svg" alt="" width="40">
        <span>Phili Keys</span>
      </a>
    </div>

    <div v-if="user" class="user-card">
      <div class="user-avatar">{{ user.name?.charAt(0) || 'A' }}</div>
      <div>
        <div class="user-name">{{ user.name }}</div>
        <div class="user-email">{{ user.email }}</div>
      </div>
    </div>

    <ul class="nav-list">
      <li class="nav-title">Main</li>
      <li><RouterLink to="/admin" class="nav-link" exact-active-class="active"><i class="ti ti-home"></i><span>Dashboard</span></RouterLink></li>
      <li><RouterLink to="/admin/testimonial" class="nav-link" exact-active-class="active"><i class="ti ti-message-dots"></i><span>Testimonials</span></RouterLink></li>
      <li><RouterLink to="/admin/users" class="nav-link" exact-active-class="active"><i class="ti ti-users"></i><span>Users</span></RouterLink></li>
      <li><RouterLink to="/admin/profile" class="nav-link" exact-active-class="active"><i class="ti ti-user-circle"></i><span>Profile</span></RouterLink></li>
      <li><RouterLink to="/admin/contact" class="nav-link" exact-active-class="active"><i class="ti ti-message-circle"></i><span>Contact</span></RouterLink></li>
      <li class="nav-title">Account</li>
      <li>
        <button type="button" class="nav-link logout-btn" @click="handleLogout">
          <i class="ti ti-logout"></i><span>Log out</span>
        </button>
      </li>
    </ul>
  </aside>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { postData } from '../../plugins/axios'

const router = useRouter()
const user = ref(null)

const loadUser = () => {
  const storedUser = localStorage.getItem('user')
  if (storedUser) {
    user.value = JSON.parse(storedUser)
  }
}

const handleLogout = async () => {
  try {
    await postData('/logout', {})
  } catch (error) {
    console.error('Logout error:', error)
  } finally {
    localStorage.removeItem('token')
    localStorage.removeItem('user')
    router.push('/admin/login')
  }
}

onMounted(() => {
  loadUser()
})
</script>

<style scoped>
.sidebar {
  height: 100%;
  background: linear-gradient(180deg, #0f172a 0%, #111827 100%);
  color: #f8fafc;
  padding: 20px 14px;
}

.user-card {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 12px;
  border-radius: 12px;
  background: rgba(255,255,255,0.08);
  margin-bottom: 12px;
}

.user-avatar {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(255,255,255,0.16);
  font-weight: 700;
}

.user-name {
  font-weight: 600;
  font-size: 0.95rem;
}

.user-email {
  font-size: 0.78rem;
  color: #cbd5e1;
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
  width: 100%;
  border: none;
  background: transparent;
  text-align: left;
  cursor: pointer;
}

.nav-link:hover,
.nav-link.active {
  background: rgba(255,255,255,0.12);
  color: white;
}

.logout-btn:hover {
  background: rgba(248, 113, 113, 0.15);
  color: #fecaca;
}
</style>