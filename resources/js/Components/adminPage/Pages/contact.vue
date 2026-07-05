<template>
  <main id="content" class="content py-10">
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1080;">
      <div v-for="toast in toasts" :key="toast.id" class="toast show align-items-center text-white border-0 mb-2" :class="toast.type === 'success' ? 'bg-success' : toast.type === 'error' ? 'bg-danger' : 'bg-info'" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">
            {{ toast.message }}
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" @click="removeToast(toast.id)"></button>
        </div>
      </div>
    </div>

    <div v-if="confirmState.show" class="modal d-block" style="background: rgba(0,0,0,0.5);">
      <div class="modal-dialog modal-sm">
        <div class="modal-content border-0 shadow-lg rounded-3">
          <div class="modal-header border-0 px-4 py-3">
            <h5 class="modal-title fw-semibold">Confirmation</h5>
          </div>
          <div class="modal-body px-4 py-2">
            <p class="mb-0">{{ confirmState.message }}</p>
          </div>
          <div class="modal-footer border-0 px-4 py-3">
            <button type="button" class="btn btn-light border" @click="cancelConfirm">Annuler</button>
            <button type="button" class="btn btn-danger" @click="confirmAction">Supprimer</button>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row mb-4">
        <div class="col-12">
          <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
              <h1 class="fs-3 mb-1 fw-semibold">Messages de contact</h1>
              <p class="text-muted mb-0">Consultez et gérez les messages envoyés par les visiteurs.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
              <div>
                <h2 class="h5 mb-1">Tous les messages</h2>
                <p class="text-muted small mb-0">Messages reçus des visiteurs.</p>
              </div>
              <span class="badge bg-light text-dark border">{{ contacts.length }} total</span>
            </div>
            <div class="card-body p-4">
              <div v-if="contacts.length === 0" class="text-center py-5">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-3" style="width:54px;height:54px;">
                  <i class="ti ti-message-circle fs-4 text-muted"></i>
                </div>
                <p class="text-muted mb-0">Aucun message pour le moment.</p>
              </div>
              <div v-else class="table-responsive">
                <Datatable
                    :data="contacts"
                    :columns="tableColumns"
                    :DeleteAllFunction="deleteSelected"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-if="showDetailModal" class="modal d-block" style="background: rgba(0,0,0,0.5);">
      <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-3">
          <div class="modal-header border-0 px-4 py-3">
            <h5 class="modal-title fw-semibold">Détails du message</h5>
            <button type="button" class="btn-close" @click="showDetailModal = false"></button>
          </div>
          <div class="modal-body px-4 py-3" v-if="selectedContact">
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label text-muted small">Nom</label>
                <p class="fw-semibold">{{ selectedContact.full_name }}</p>
              </div>
              <div class="col-md-6">
                <label class="form-label text-muted small">Email</label>
                <p class="fw-semibold">{{ selectedContact.email }}</p>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label text-muted small">Téléphone</label>
                <p class="fw-semibold">{{ selectedContact.phone }}</p>
              </div>
              <div class="col-md-6">
                <label class="form-label text-muted small">Sujet</label>
                <p class="fw-semibold">{{ selectedContact.subject }}</p>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label text-muted small">Statut</label>
                <span class="badge" :class="statusClass(selectedContact.status)">{{ statusLabel(selectedContact.status) }}</span>
              </div>
              <div class="col-md-6">
                <label class="form-label text-muted small">Date</label>
                <p class="fw-semibold">{{ formatDate(selectedContact.created_at) }}</p>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label text-muted small">Message</label>
              <p style="white-space: pre-wrap; background: #f8fafc; padding: 1rem; border-radius: 0.5rem;">{{ selectedContact.message }}</p>
            </div>
          </div>
          <div class="modal-footer border-0 px-4 py-3">
            <button type="button" class="btn btn-light border" @click="showDetailModal = false">Fermer</button>
            <button type="button" class="btn btn-success" @click="updateStatus('read')" v-if="selectedContact?.status !== 'read'">Marquer comme lu</button>
            <button type="button" class="btn btn-secondary" @click="updateStatus('closed')" v-if="selectedContact?.status !== 'closed'">Fermer le ticket</button>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import Datatable from '../datatable/Datatable.vue'
import { getData, putData, deleteData } from '../../plugins/axios'

const contacts = ref([])
const selectedContact = ref(null)
const showDetailModal = ref(false)
const toasts = ref([])
const confirmState = ref({ show: false, message: '', action: null })

const tableColumns = [
    {
        title: '',
        data: null,
        orderable: false,
        searchable: false,
        render: (_data, _type, row) => `<input type="checkbox" class="form-check-input row-checkbox" data-id="${row.id}">`
    },
    {
        title: 'Nom',
        data: 'full_name'
    },
    {
        title: 'Email',
        data: 'email'
    },
    {
        title: 'Sujet',
        data: 'subject'
    },
    {
        title: 'Statut',
        data: 'status',
        render: (data) => {
            const statusClass = data === 'read' ? 'bg-success-subtle text-success' : data === 'closed' ? 'bg-secondary-subtle text-secondary' : 'bg-warning-subtle text-warning'
            const statusLabel = data === 'read' ? 'Lu' : data === 'closed' ? 'Fermé' : 'Nouveau'
            return `<span class="badge ${statusClass}">${statusLabel}</span>`
        }
    },
    {
        title: 'Date',
        data: 'created_at',
        render: (data) => formatDate(data)
    },
    {
        title: 'Actions',
        data: null,
        orderable: false,
        searchable: false,
        render: (_data, _type, row) => `
            <div class="btn-group btn-group-sm" role="group">
                <button type="button" class="btn btn-outline-primary" data-action="view" data-id="${row.id}" title="Voir">
                    <i class="ti ti-eye"></i>
                </button>
                <button type="button" class="btn btn-outline-danger" data-action="delete" data-id="${row.id}" title="Supprimer">
                    <i class="ti ti-trash"></i>
                </button>
            </div>`
    }
]

const showToast = (message, type = 'info') => {
    const id = Date.now() + Math.random()
    toasts.value.push({ id, message, type })
    setTimeout(() => removeToast(id), 3000)
}

const removeToast = (id) => {
    toasts.value = toasts.value.filter((toast) => toast.id !== id)
}

const openConfirm = (message, action) => {
    confirmState.value = { show: true, message, action }
}

const cancelConfirm = () => {
    confirmState.value = { show: false, message: '', action: null }
}

const confirmAction = async () => {
    const action = confirmState.value.action
    cancelConfirm()
    if (action) {
        await action()
    }
}

const fetchContacts = async () => {
    try {
        const response = await getData('/contacts')
        contacts.value = Array.isArray(response) ? response : []
    } catch (error) {
        console.error('Error fetching contacts:', error)
        showToast('Impossible de charger les messages.', 'error')
    }
}

const handleTableAction = async (event) => {
    const button = event.target.closest('[data-action]')
    if (!button) return

    const action = button.getAttribute('data-action')
    const id = Number(button.getAttribute('data-id'))
    const contact = contacts.value.find((item) => item.id === id)

    if (!contact) return

    if (action === 'view') {
        viewContact(contact)
    } else if (action === 'delete') {
        await deleteContact(id)
    }
}

const viewContact = (contact) => {
    selectedContact.value = contact
    showDetailModal.value = true
}

const updateStatus = async (status) => {
    if (!selectedContact.value) return
    try {
        await putData(`/contacts/${selectedContact.value.id}`, { status })
        showToast('Statut mis à jour avec succès.', 'success')
        await fetchContacts()
        showDetailModal.value = false
    } catch (error) {
        console.error('Error updating status:', error)
        showToast('Impossible de mettre à jour le statut.', 'error')
    }
}

const deleteContact = async (id) => {
    openConfirm('Êtes-vous sûr de vouloir supprimer ce message ?', async () => {
        try {
            await deleteData(`/contacts/${id}`)
            await fetchContacts()
            showToast('Message supprimé avec succès.', 'success')
        } catch (error) {
            console.error('Error deleting contact:', error)
            showToast('Impossible de supprimer le message.', 'error')
        }
    })
}

const deleteSelected = async () => {
    const selected = document.querySelectorAll('.row-checkbox:checked')
    if (!selected.length) {
        showToast('Veuillez sélectionner des messages à supprimer.', 'info')
        return
    }

    openConfirm(`Supprimer ${selected.length} message(s) ?`, async () => {
        for (const item of selected) {
            const id = item.getAttribute('data-id')
            try {
                await deleteData(`/contacts/${id}`)
            } catch (error) {
                console.error(`Error deleting contact ${id}:`, error)
            }
        }

        await fetchContacts()
        showToast('Messages supprimés avec succès.', 'success')
    })
}

const statusClass = (status) => {
    switch (status) {
        case 'read': return 'bg-success-subtle text-success'
        case 'closed': return 'bg-secondary-subtle text-secondary'
        default: return 'bg-warning-subtle text-warning'
    }
}

const statusLabel = (status) => {
    switch (status) {
        case 'read': return 'Lu'
        case 'closed': return 'Fermé'
        default: return 'Nouveau'
    }
}

const formatDate = (dateString) => {
    if (!dateString) return '-'
    return new Date(dateString).toLocaleDateString('fr-FR', { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' })
}

onMounted(() => {
    document.addEventListener('click', handleTableAction)
    fetchContacts()
})

onUnmounted(() => {
    document.removeEventListener('click', handleTableAction)
})
</script>

<style scoped>
.modal.d-block {
    display: flex !important;
    align-items: center;
    justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1050;
}

.modal-dialog {
    width: 90%;
    max-width: 600px;
}

.btn-group {
    display: flex;
    gap: 0.25rem;
}

.table td {
    vertical-align: middle;
}
</style>