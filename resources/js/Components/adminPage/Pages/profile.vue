<template>
  <main id="content" class="content py-10">
    <div class="container-fluid">
      <div class="row mb-4">
        <div class="col-12">
          <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
              <h1 class="fs-3 mb-1 fw-semibold">My Profile</h1>
              <p class="text-muted mb-0">View and update your connected account details.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-lg-4">
          <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
              <div class="profile-avatar">{{ profile?.name?.charAt(0) || 'A' }}</div>
              <h4 class="mt-3 mb-1 fw-semibold">{{ profile?.name || '—' }}</h4>
              <p class="text-muted mb-3">{{ profile?.email || '—' }}</p>
              <div class="info-block">
                <div class="label">Member since</div>
                <div class="value">{{ formatDate(profile?.created_at) }}</div>
              </div>
              <div class="info-block">
                <div class="label">Password</div>
                <div class="value">••••••••</div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom px-4 py-3">
              <h2 class="h5 mb-0">Update profile</h2>
            </div>
            <div class="card-body p-4">
              <form @submit.prevent="submitProfile">
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">Full name</label>
                    <input v-model="form.name" type="text" class="form-control" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input v-model="form.email" type="email" class="form-control" required>
                  </div>
                  <div class="col-12">
                    <label class="form-label">New password</label>
                    <input v-model="form.password" type="password" class="form-control" placeholder="Leave blank to keep current password">
                  </div>
                </div>

                <div v-if="message" class="alert mt-4" :class="messageType === 'success' ? 'alert-success' : 'alert-danger'">
                  {{ message }}
                </div>

                <div class="d-flex justify-content-end mt-4">
                  <button type="submit" class="btn btn-primary px-4">Save changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getData, putData } from '../../plugins/axios'

const profile = ref(null)
const form = ref({ name: '', email: '', password: '' })
const message = ref('')
const messageType = ref('success')

const loadProfile = async () => {
  try {
    const response = await getData('/profile')
    profile.value = response
    form.value = {
      name: response.name || '',
      email: response.email || '',
      password: ''
    }
  } catch (error) {
    console.error('Error loading profile:', error)
  }
}

const submitProfile = async () => {
  try {
    const payload = { ...form.value }
    if (!payload.password) delete payload.password

    const response = await putData('/profile', payload)
    profile.value = response
    form.value = {
      name: response.name || '',
      email: response.email || '',
      password: ''
    }
    message.value = 'Profile updated successfully.'
    messageType.value = 'success'
  } catch (error) {
    message.value = error?.response?.data?.message || 'Unable to update profile.'
    messageType.value = 'danger'
  }
}

const formatDate = (value) => {
  if (!value) return '—'
  return new Date(value).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })
}

onMounted(() => {
  loadProfile()
})
</script>

<style scoped>
.profile-avatar {
  width: 84px;
  height: 84px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #0f172a, #334155);
  color: white;
  font-size: 2rem;
  font-weight: 700;
}

.info-block {
  padding: 12px 0;
  border-bottom: 1px solid #e2e8f0;
}

.info-block:last-child {
  border-bottom: 0;
}

.label {
  font-size: 0.82rem;
  color: #64748b;
  text-transform: uppercase;
  letter-spacing: 0.04em;
  margin-bottom: 4px;
}

.value {
  font-weight: 600;
  color: #0f172a;
}

.form-control {
  border-radius: 10px;
  padding: 10px 12px;
}

.btn-primary {
  background: #0f172a;
  border: none;
  border-radius: 10px;
}
</style>
