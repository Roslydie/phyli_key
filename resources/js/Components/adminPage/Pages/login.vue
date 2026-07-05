<template>
  <div class="login-page">
    <div class="login-card">
      <div class="login-brand">
        <div class="brand-icon">
          <i class="ti ti-lock"></i>
        </div>
        <div>
          <h3>Phili Keys</h3>
          <p>Admin access</p>
        </div>
      </div>

      <!-- Session Expired Alert -->
      <div v-if="sessionExpired" class="alert alert-warning py-2 mb-3">
        <i class="ti ti-alert-circle me-2"></i>
        <strong>Session Expired</strong> - Your session has expired. Please sign in again.
      </div>

      <!-- Unauthorized Alert -->
      <div v-if="unauthorized" class="alert alert-danger py-2 mb-3">
        <i class="ti ti-circle-x me-2"></i>
        <strong>Unauthorized</strong> - Your credentials are invalid. Please sign in again.
      </div>

      <!-- Invalid Token Alert -->
      <div v-if="invalidToken" class="alert alert-danger py-2 mb-3">
        <i class="ti ti-circle-x me-2"></i>
        <strong>Invalid Token</strong> - Your authentication token is invalid. Please sign in again.
      </div>

      <form @submit.prevent="submitLogin" class="login-form">
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input v-model="form.email" type="email" class="form-control" placeholder="admin@example.com" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input v-model="form.password" type="password" class="form-control" placeholder="••••••••" required>
        </div>

        <div v-if="errorMessage" class="alert alert-danger py-2">{{ errorMessage }}</div>

        <button type="submit" class="btn btn-primary w-100">Sign in</button>
      </form>

      <p class="text-center text-muted mt-3 small">
        Session will auto-expire after 10 minutes of inactivity
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { postData } from '../../plugins/axios'

const router = useRouter()
const route = useRoute()
const form = ref({ email: '', password: '' })
const errorMessage = ref('')
const sessionExpired = ref(false)
const unauthorized = ref(false)
const invalidToken = ref(false)

onMounted(() => {
  // Check for session expiry query parameter
  if (route.query.session_expired) {
    sessionExpired.value = true
  }
  if (route.query.unauthorized) {
    unauthorized.value = true
  }
  if (route.query.invalid_token) {
    invalidToken.value = true
  }
})

const submitLogin = async () => {
  try {
    const response = await postData('/login', form.value)
    localStorage.setItem('token', response.token)
    localStorage.setItem('user', JSON.stringify(response.user))
    errorMessage.value = ''
    router.push('/admin')
  } catch (error) {
    errorMessage.value = error?.response?.data?.message || 'Unable to sign in.'
  }
}
</script>

<style scoped>
.login-page {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
  padding: 24px;
}

.login-card {
  width: 100%;
  max-width: 420px;
  background: white;
  border-radius: 18px;
  box-shadow: 0 20px 45px rgba(15, 23, 42, 0.2);
  padding: 32px;
}

.login-brand {
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 24px;
}

.brand-icon {
  width: 48px;
  height: 48px;
  border-radius: 14px;
  background: #0f172a;
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
}

.login-brand h3 {
  margin: 0;
  font-weight: 700;
  color: #0f172a;
}

.login-brand p {
  margin: 2px 0 0;
  color: #64748b;
}

.login-form .form-control {
  border-radius: 10px;
  padding: 10px 12px;
}

.btn-primary {
  background: #0f172a;
  border: none;
  border-radius: 10px;
  padding: 10px 14px;
}
</style>
