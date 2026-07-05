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
                            <h1 class="fs-3 mb-1 fw-semibold">Users</h1>
                            <p class="text-muted mb-0">Manage registered users from this admin panel.</p>
                        </div>
                        <button @click="showForm = true" class="btn btn-primary rounded-2 px-4 py-2 fw-semibold shadow-sm">
                            <i class="ti ti-plus me-2"></i>Add User
                        </button>
                    </div>
                </div>
            </div>

            <div v-if="showForm" class="modal d-block" style="background: rgba(0,0,0,0.5);">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content border-0 shadow-lg rounded-3">
                        <div class="modal-header border-0 px-4 py-3">
                            <h5 class="modal-title fw-semibold">{{ editingId ? 'Edit User' : 'Add New User' }}</h5>
                            <button type="button" class="btn-close" @click="closeForm"></button>
                        </div>
                        <form @submit.prevent="submitForm">
                            <div class="modal-body px-4 py-3">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name *</label>
                                    <input v-model="form.name" type="text" class="form-control" id="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input v-model="form.email" type="email" class="form-control" id="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password {{ editingId ? '(leave blank to keep current)' : '*' }}</label>
                                    <input v-model="form.password" type="password" class="form-control" id="password" :required="!editingId">
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
                                <h2 class="h5 mb-1">All users</h2>
                                <p class="text-muted small mb-0">Review and manage registered accounts.</p>
                            </div>
                            <span class="badge bg-light text-dark border">{{ users.length }} total</span>
                        </div>
                        <div class="card-body p-4">
                            <div v-if="users.length === 0" class="text-center py-5">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-3" style="width:54px;height:54px;">
                                    <i class="ti ti-users fs-4 text-muted"></i>
                                </div>
                                <p class="text-muted mb-0">No users yet.</p>
                            </div>
                            <div v-else class="table-responsive">
                                <Datatable
                                    :data="users"
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

const users = ref([])
const showForm = ref(false)
const editingId = ref(null)
const toasts = ref([])
const confirmState = ref({ show: false, message: '', action: null })
const form = ref({
    name: '',
    email: '',
    password: ''
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
        data: 'name'
    },
    {
        title: 'Email',
        data: 'email'
    },
    {
        title: 'Created At',
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

const fetchUsers = async () => {
    try {
        const response = await getData('/users')
        users.value = Array.isArray(response) ? response : []
    } catch (error) {
        console.error('Error fetching users:', error)
        showToast('Unable to load users.', 'error')
    }
}

const handleTableAction = async (event) => {
    const button = event.target.closest('[data-action]')
    if (!button) return

    const action = button.getAttribute('data-action')
    const id = Number(button.getAttribute('data-id'))
    const user = users.value.find((item) => item.id === id)

    if (!user) return

    if (action === 'edit') {
        editUser(user)
    } else if (action === 'delete') {
        await deleteUser(id)
    }
}

const submitForm = async () => {
    try {
        const payload = { ...form.value }
        if (editingId.value) {
            if (!payload.password) {
                delete payload.password
            }
            await putData(`/users/${editingId.value}`, payload)
            showToast('User updated successfully.', 'success')
        } else {
            await postData('/users', payload)
            showToast('User added successfully.', 'success')
        }
        await fetchUsers()
        closeForm()
    } catch (error) {
        console.error('Error submitting user form:', error)
        showToast('Unable to save user. Please try again.', 'error')
    }
}

const editUser = (user) => {
    editingId.value = user.id
    form.value = {
        name: user.name,
        email: user.email,
        password: ''
    }
    showForm.value = true
}

const deleteUser = async (id) => {
    openConfirm('Are you sure you want to delete this user?', async () => {
        try {
            await deleteData(`/users/${id}`)
            await fetchUsers()
            showToast('User deleted successfully.', 'success')
        } catch (error) {
            console.error('Error deleting user:', error)
            showToast('Unable to delete user. Please try again.', 'error')
        }
    })
}

const deleteSelected = async () => {
    const selected = document.querySelectorAll('.row-checkbox:checked')
    if (!selected.length) {
        showToast('Please select users to delete.', 'info')
        return
    }

    openConfirm(`Delete ${selected.length} user(s)?`, async () => {
        for (const item of selected) {
            const id = item.getAttribute('data-id')
            try {
                await deleteData(`/users/${id}`)
            } catch (error) {
                console.error(`Error deleting user ${id}:`, error)
            }
        }

        await fetchUsers()
        showToast('Selected users deleted successfully.', 'success')
    })
}

const closeForm = () => {
    showForm.value = false
    editingId.value = null
    form.value = {
        name: '',
        email: '',
        password: ''
    }
}

const formatDate = (dateString) => {
    if (!dateString) return '-'
    const options = { year: 'numeric', month: 'short', day: 'numeric' }
    return new Date(dateString).toLocaleDateString('en-US', options)
}

onMounted(() => {
    document.addEventListener('click', handleTableAction)
    fetchUsers()
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

