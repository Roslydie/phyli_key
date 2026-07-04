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
                        <h5 class="modal-title fw-semibold">Confirm</h5>
                    </div>
                    <div class="modal-body px-4 py-2">
                        <p class="mb-0">{{ confirmState.message }}</p>
                    </div>
                    <div class="modal-footer border-0 px-4 py-3">
                        <button type="button" class="btn btn-light border" @click="cancelConfirm">Cancel</button>
                        <button type="button" class="btn btn-danger" @click="confirmAction">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h1 class="fs-3 mb-1 fw-semibold">Testimonials</h1>
                            <p class="text-muted mb-0">Manage customer testimonials and publish them on your homepage.</p>
                        </div>
                        <button @click="showForm = true" class="btn btn-primary rounded-2 px-4 py-2 fw-semibold shadow-sm">
                            <i class="ti ti-plus me-2"></i>Add Testimonial
                        </button>
                    </div>
                </div>
            </div>

            <div v-if="showForm" class="modal d-block" style="background: rgba(0,0,0,0.5);">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content border-0 shadow-lg rounded-3">
                        <div class="modal-header border-0 px-4 py-3">
                            <h5 class="modal-title fw-semibold">{{ editingId ? 'Edit Testimonial' : 'Add New Testimonial' }}</h5>
                            <button type="button" class="btn-close" @click="closeForm"></button>
                        </div>
                        <form @submit.prevent="submitForm">
                            <div class="modal-body px-4 py-3">
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">First Name *</label>
                                    <input v-model="form.prenom" type="text" class="form-control" id="prenom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Last Name *</label>
                                    <input v-model="form.nom" type="text" class="form-control" id="nom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message *</label>
                                    <textarea v-model="form.message" class="form-control" id="message" rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer border-0 px-4 py-3">
                                <button type="button" class="btn btn-light border" @click="closeForm">Cancel</button>
                                <button type="submit" class="btn btn-primary px-4">{{ editingId ? 'Update' : 'Save' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="h5 mb-1">All testimonials</h2>
                                <p class="text-muted small mb-0">Review, publish, and remove testimonials from one place.</p>
                            </div>
                            <span class="badge bg-light text-dark border">{{ testimonials.length }} total</span>
                        </div>
                        <div class="card-body p-4">
                            <div v-if="testimonials.length === 0" class="text-center py-5">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-3" style="width:54px;height:54px;">
                                    <i class="ti ti-message-check fs-4 text-muted"></i>
                                </div>
                                <p class="text-muted mb-0">No testimonials yet. Create your first one.</p>
                            </div>
                            <div v-else class="table-responsive">
                                <Datatable
                                    :data="testimonials"
                                    :columns="tableColumns"
                                    :DeleteAllFunction="deleteSelected"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import Datatable from '../datatable/Datatable.vue'
import { getData, postData, putData, deleteData } from '../../plugins/axios'

const testimonials = ref([])
const showForm = ref(false)
const editingId = ref(null)
const loading = ref(false)
const toasts = ref([])
const confirmState = ref({ show: false, message: '', action: null })
const form = ref({
    prenom: '',
    nom: '',
    message: ''
})

const tableColumns = [
    {
        title: '',
        data: null,
        orderable: false,
        searchable: false,
        render: (_data, _type, row) => `<input type="checkbox" class="form-check-input row-checkbox" data-id="${row.id}">`
    },
    {
        title: 'Name',
        data: null,
        render: (_data, _type, row) => `${row.prenom} ${row.nom}`
    },
    {
        title: 'Message',
        data: 'message',
        render: (data) => data && data.length > 80 ? `${data.substring(0, 80)}...` : data
    },
    {
        title: 'Status',
        data: null,
        render: (_data, _type, row) => row.published
            ? '<span class="badge bg-success">Published</span>'
            : '<span class="badge bg-secondary">Draft</span>'
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
                <button type="button" class="btn btn-outline-primary" data-action="edit" data-id="${row.id}" title="Edit">
                    <i class="ti ti-pencil"></i>
                </button>
                <button type="button" class="btn ${row.published ? 'btn-outline-warning' : 'btn-outline-success'}" data-action="publish" data-id="${row.id}" title="${row.published ? 'Unpublish' : 'Publish'}">
                    <i class="${row.published ? 'ti ti-eye-off' : 'ti ti-eye'}"></i>
                </button>
                <button type="button" class="btn btn-outline-danger" data-action="delete" data-id="${row.id}" title="Delete">
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

// Fetch all testimonials
const fetchTestimonials = async () => {
    try {
        const response = await getData('/testimonials')
        testimonials.value = Array.isArray(response) ? response : []
    } catch (error) {
        console.error('Error fetching testimonials:', error)
        showToast('Unable to load testimonials.', 'error')
    }
}

const handleTableAction = async (event) => {
    const button = event.target.closest('[data-action]')
    if (!button) return

    const action = button.getAttribute('data-action')
    const id = Number(button.getAttribute('data-id'))
    const testimonial = testimonials.value.find((item) => item.id === id)

    if (!testimonial) return

    if (action === 'edit') {
        editTestimonial(testimonial)
    } else if (action === 'publish') {
        await togglePublish(testimonial)
    } else if (action === 'delete') {
        await deleteTestimonial(id)
    }
}

// Submit form (create or update)
const submitForm = async () => {
    loading.value = true
    try {
        if (editingId.value) {
            await putData(`/testimonials/${editingId.value}`, form.value)
            showToast('Testimonial updated successfully.', 'success')
        } else {
            await postData('/testimonials', form.value)
            showToast('Testimonial added successfully.', 'success')
        }
        await fetchTestimonials()
        closeForm()
    } catch (error) {
        console.error('Error submitting form:', error)
        showToast('Unable to save testimonial. Please try again.', 'error')
    } finally {
        loading.value = false
    }
}

// Edit testimonial
const editTestimonial = (testimonial) => {
    editingId.value = testimonial.id
    form.value = {
        prenom: testimonial.prenom,
        nom: testimonial.nom,
        message: testimonial.message
    }
    showForm.value = true
}

// Toggle publish status
const togglePublish = async (testimonial) => {
    try {
        await putData(`/testimonials/${testimonial.id}/publish`, {})
        await fetchTestimonials()
        showToast(testimonial.published ? 'Testimonial unpublished.' : 'Testimonial published.', 'success')
    } catch (error) {
        console.error('Error publishing testimonial:', error)
        showToast('Unable to update status. Please try again.', 'error')
    }
}

// Delete testimonial
const deleteTestimonial = async (id) => {
    openConfirm('Are you sure you want to delete this testimonial?', async () => {
        try {
            await deleteData(`/testimonials/${id}`)
            await fetchTestimonials()
            showToast('Testimonial deleted successfully.', 'success')
        } catch (error) {
            console.error('Error deleting testimonial:', error)
            showToast('Unable to delete testimonial. Please try again.', 'error')
        }
    })
}

const deleteSelected = async () => {
    const selected = document.querySelectorAll('.row-checkbox:checked')
    if (!selected.length) {
        showToast('Please select testimonials to delete.', 'info')
        return
    }

    openConfirm(`Delete ${selected.length} testimonial(s)?`, async () => {
        for (const item of selected) {
            const id = item.getAttribute('data-id')
            try {
                await deleteData(`/testimonials/${id}`)
            } catch (error) {
                console.error(`Error deleting testimonial ${id}:`, error)
            }
        }

        await fetchTestimonials()
        showToast('Selected testimonials deleted successfully.', 'success')
    })
}

// Close form and reset
const closeForm = () => {
    showForm.value = false
    editingId.value = null
    form.value = {
        prenom: '',
        nom: '',
        message: ''
    }
}

// Format date
const formatDate = (dateString) => {
    if (!dateString) return '-'
    const options = { year: 'numeric', month: 'short', day: 'numeric' }
    return new Date(dateString).toLocaleDateString('en-US', options)
}

// Load testimonials on mount
onMounted(() => {
    document.addEventListener('click', handleTableAction)
    fetchTestimonials()
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

.text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>