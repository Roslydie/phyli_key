<template>
  <main id="content" class="content py-10">
    <div class="container-fluid">
      <div class="row mb-6">
        <div class="col-12">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h1 class="fs-3 mb-1">Dashboard</h1>
              <p class="text-muted mb-0">Bienvenue dans votre tableau de bord d'administration</p>
            </div>
            <button @click="refreshStats" class="btn btn-outline-primary">
              <i class="ti ti-refresh me-2"></i> Actualiser
            </button>
          </div>
        </div>
      </div>

      <!-- Top Stats Cards -->
      <div class="row g-3 mb-4">
        <!-- Messages Reçus -->
        <div class="col-lg-3 col-md-6 col-12">
          <div class="card p-4 bg-primary bg-opacity-10 border border-primary border-opacity-25 rounded-2">
            <div class="d-flex gap-3">
              <div class="icon-shape icon-md bg-primary text-white rounded-2">
                <i class="ti ti-message-circle fs-4"></i>
              </div>
              <div>
                <h2 class="mb-3 fs-6">Messages Reçus</h2>
                <h3 class="fw-bold mb-0">{{ stats.contacts.total }}</h3>
                <p class="text-primary mb-0 small">{{ stats.contacts.this_month }} ce mois</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Messages Non Lus -->
        <div class="col-lg-3 col-md-6 col-12">
          <div class="card p-4 bg-warning bg-opacity-10 border border-warning border-opacity-25 rounded-2">
            <div class="d-flex gap-3">
              <div class="icon-shape icon-md bg-warning text-white rounded-2">
                <i class="ti ti-alert-circle fs-4"></i>
              </div>
              <div>
                <h2 class="mb-3 fs-6">Messages Non Lus</h2>
                <h3 class="fw-bold mb-0">{{ stats.contacts.new }}</h3>
                <p class="text-warning mb-0 small">En attente de traitement</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Utilisateurs -->
        <div class="col-lg-3 col-md-6 col-12">
          <div class="card p-4 bg-success bg-opacity-10 border border-success border-opacity-25 rounded-2">
            <div class="d-flex gap-3">
              <div class="icon-shape icon-md bg-success text-white rounded-2">
                <i class="ti ti-users fs-4"></i>
              </div>
              <div>
                <h2 class="mb-3 fs-6">Utilisateurs</h2>
                <h3 class="fw-bold mb-0">{{ stats.users.total }}</h3>
                <p class="text-success mb-0 small">{{ stats.users.this_month }} nouveaux</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Témoignages -->
        <div class="col-lg-3 col-md-6 col-12">
          <div class="card p-4 bg-info bg-opacity-10 border border-info border-opacity-25 rounded-2">
            <div class="d-flex gap-3">
              <div class="icon-shape icon-md bg-info text-white rounded-2">
                <i class="ti ti-star fs-4"></i>
              </div>
              <div>
                <h2 class="mb-3 fs-6">Témoignages</h2>
                <h3 class="fw-bold mb-0">{{ stats.testimonials.total }}</h3>
                <p class="text-info mb-0 small">{{ stats.testimonials.published }} publiés</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Middle Stats Cards -->
      <div class="row g-3 mb-4">
        <!-- Messages par Statut -->
        <div class="col-lg-4 col-12">
          <div class="card h-100">
            <div class="card-body p-4">
              <h5 class="mb-4 fw-semibold">Statut des Messages</h5>
              <div class="space-y-3">
                <div v-for="item in stats.charts.contacts_by_status" :key="item.status" class="d-flex align-items-center gap-3">
                  <div class="flex-shrink-0">
                    <div class="rounded-circle p-2" :class="`bg-${item.color}-subtle`">
                      <div class="rounded-circle" :class="`bg-${item.color}`" style="width: 8px; height: 8px;"></div>
                    </div>
                  </div>
                  <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-center">
                      <span>{{ item.status }}</span>
                      <span class="fw-semibold">{{ item.count }}</span>
                    </div>
                    <div class="progress mt-1" style="height: 4px;">
                      <div class="progress-bar" :class="`bg-${item.color}`" :style="{ width: (stats.contacts.total > 0 ? (item.count / stats.contacts.total * 100) : 0) + '%' }"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Témoignages Overview -->
        <div class="col-lg-4 col-12">
          <div class="card h-100">
            <div class="card-body p-4">
              <h5 class="mb-4 fw-semibold">Aperçu Témoignages</h5>
              <div class="row text-center">
                <div class="col-6 border-end">
                  <div class="mb-3">
                    <h3 class="fw-bold mb-1">{{ stats.testimonials.published }}</h3>
                    <small class="text-success">Publiés</small>
                  </div>
                </div>
                <div class="col-6">
                  <div class="mb-3">
                    <h3 class="fw-bold mb-1">{{ stats.testimonials.unpublished }}</h3>
                    <small class="text-warning">Non publiés</small>
                  </div>
                </div>
              </div>
              <div class="mt-4 pt-3 border-top">
                <div class="d-flex justify-content-between align-items-center">
                  <span>Taux de publication</span>
                  <strong>{{ stats.testimonials.total ? Math.round((stats.testimonials.published / stats.testimonials.total) * 100) : 0 }}%</strong>
                </div>
                <div class="progress mt-2" style="height: 6px;">
                  <div class="progress-bar bg-success" :style="{ width: (stats.testimonials.total ? (stats.testimonials.published / stats.testimonials.total) * 100 : 0) + '%' }"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Messages ce Mois -->
        <div class="col-lg-4 col-12">
          <div class="card h-100">
            <div class="card-body p-4">
              <h5 class="mb-4 fw-semibold">Résumé du Mois</h5>
              <div class="space-y-3">
                <div class="d-flex justify-content-between align-items-center pb-3 border-bottom">
                  <span class="text-muted">Messages</span>
                  <span class="fw-semibold">{{ stats.contacts.this_month }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center pb-3 border-bottom">
                  <span class="text-muted">Nouveaux utilisateurs</span>
                  <span class="fw-semibold">{{ stats.users.this_month }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <span class="text-muted">Témoignages</span>
                  <span class="fw-semibold">{{ stats.testimonials.this_month }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Charts Row -->
      <div class="row g-3 mb-4">
        <!-- Messages par Jour -->
        <div class="col-lg-6 col-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center bg-transparent px-4 py-3 border-bottom">
              <h5 class="mb-0">Messages des 7 derniers jours</h5>
            </div>
            <div class="card-body p-4">
              <div class="chart-container" style="position: relative; height: 300px;">
                <svg viewBox="0 0 700 300" class="w-100" preserveAspectRatio="none" style="height: 100%;" role="img" aria-label="Messages chart">
                  <!-- Grid lines -->
                  <g stroke="#e2e8f0" stroke-width="1">
                    <line x1="50" y1="240" x2="680" y2="240" />
                    <line x1="50" y1="180" x2="680" y2="180" />
                    <line x1="50" y1="120" x2="680" y2="120" />
                    <line x1="50" y1="60" x2="680" y2="60" />
                  </g>
                  <!-- Bars -->
                  <g>
                    <rect v-for="(item, index) in stats.charts.contacts_by_day" :key="index"
                      :x="50 + (index * 90)"
                      y="240"
                      :height="Math.max(item.count * 20, 5)"
                      width="70"
                      rx="4"
                      class="bar"
                      :style="{ fill: '#3b82f6' }"
                    />
                  </g>
                  <!-- Labels -->
                  <g font-size="12" fill="#64748b" text-anchor="middle">
                    <text v-for="(item, index) in stats.charts.contacts_by_day" :key="'label-' + index"
                      :x="85 + (index * 90)"
                      y="270"
                      :dy="0"
                    >
                      {{ item.date }}
                    </text>
                  </g>
                </svg>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Messages -->
        <div class="col-lg-6 col-12">
          <div class="card">
            <div class="card-header bg-transparent px-4 py-3 border-bottom">
              <h5 class="mb-0">Messages Récents</h5>
            </div>
            <div class="card-body p-0">
              <ul class="list-group list-group-flush">
                <li v-for="contact in stats.recent_contacts" :key="contact.id" class="list-group-item px-4 py-3">
                  <div class="d-flex justify-content-between align-items-start gap-2">
                    <div class="flex-grow-1">
                      <h6 class="mb-1">{{ contact.full_name }}</h6>
                      <p class="mb-1 text-muted small">{{ contact.subject }}</p>
                      <small class="text-muted">{{ contact.email }}</small>
                    </div>
                    <span class="badge" :class="`bg-${getStatusColor(contact.status)}-subtle text-${getStatusColor(contact.status)}`">
                      {{ getStatusLabel(contact.status) }}
                    </span>
                  </div>
                  <small class="text-muted mt-2 d-block">{{ formatDate(contact.created_at) }}</small>
                </li>
                <li v-if="stats.recent_contacts.length === 0" class="list-group-item px-4 py-3 text-center text-muted">
                  Aucun message pour le moment
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getData } from '../../plugins/axios'

const stats = ref({
  contacts: { total: 0, new: 0, read: 0, closed: 0, this_month: 0 },
  users: { total: 0, this_month: 0 },
  testimonials: { total: 0, published: 0, unpublished: 0, this_month: 0 },
  charts: { contacts_by_day: [], contacts_by_status: [] },
  recent_contacts: []
})

const loadStats = async () => {
  try {
    const response = await getData('/dashboard-stats')
    stats.value = response
  } catch (error) {
    console.error('Error loading dashboard stats:', error)
  }
}

const refreshStats = async () => {
  await loadStats()
}

const formatDate = (dateString) => {
  if (!dateString) return '-'
  return new Date(dateString).toLocaleDateString('fr-FR', { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' })
}

const getStatusColor = (status) => {
  switch (status) {
    case 'read': return 'success'
    case 'closed': return 'secondary'
    default: return 'warning'
  }
}

const getStatusLabel = (status) => {
  switch (status) {
    case 'read': return 'Lu'
    case 'closed': return 'Fermé'
    default: return 'Nouveau'
  }
}

onMounted(() => {
  loadStats()
})
</script>

<style scoped>
.space-y-3 > * + * {
  margin-top: 1rem;
}

.icon-shape {
  width: 48px;
  height: 48px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.icon-md {
  width: 54px;
  height: 54px;
  font-size: 1.5rem;
}

.chart-container {
  width: 100%;
}

.bar {
  transition: fill 0.3s ease;
  cursor: pointer;
}

.bar:hover {
  opacity: 0.8;
}

@media (max-width: 768px) {
  .icon-md {
    width: 48px;
    height: 48px;
  }
}
</style>
