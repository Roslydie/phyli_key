<template>

    <footer id="footer" class="border-0 mt-0">
				<div class="container py-5">
					<div class="row py-3">
						<div class="col-md-4 mb-5 mb-md-0">
							<div class="feature-box flex-column flex-xl-row align-items-center align-items-lg-start text-center text-lg-start">
								<div class="feature-box-icon bg-transparent mb-4 mb-xl-0 p-0">
									<i class="fas fa-map-marker-alt text-5 text-color-light"></i>
								</div>
								<div class="feature-box-info line-height-1 ps-2">
									<span class="d-block font-weight-bold text-color-light text-5 mb-2">Address</span>
									<p class="text-color-light text-4 line-height-4 font-weight-light mb-0">6544 Essington Ave Philadelphia PA 19153</p>
								</div>
							</div>
						</div>
						<div class="col-md-4 mb-5 mb-md-0">
							<div class="feature-box flex-column flex-xl-row align-items-center align-items-lg-start text-center text-lg-start">
								<div class="feature-box-icon bg-transparent mb-4 mb-xl-0 p-0">
									<i class="icons icon-phone text-9 text-color-light position-relative top-4"></i>
								</div>
								<div class="feature-box-info line-height-1 ps-2">
									<span class="d-block font-weight-bold text-color-light text-5 pb-1 mb-1">Call Us Now</span>
									<a href="tel:2679242208" class="text-color-light text-4 line-height-7 text-decoration-none"> 2679242208</a>
									
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="feature-box flex-column flex-xl-row align-items-center align-items-lg-start text-center text-lg-start">
								<div class="feature-box-icon bg-transparent mb-4 mb-xl-0 p-0">
									<i class="icons icon-envelope text-9 text-color-light position-relative top-4"></i>
								</div>
								<div class="feature-box-info line-height-1 ps-xl-3">
									<span class="d-block font-weight-bold text-color-light text-5 pb-1 mb-1">Contact Info</span>
									<a href="mailto:contact@tireandkeyexpress.com" class="text-color-light text-4 line-height-7 text-decoration-none">contact@tireandkeyexpress.com</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr class="border-color-light my-2">
				<div class="container">
					<div class="row align-items-center gy-3">
						<div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
							<p class="text-color-light mb-0">&copy; {{ currentYear }} Tire and Key Express. All rights reserved.</p>
						</div>
						<div class="col-md-6 text-center text-md-end d-flex align-items-center justify-content-center justify-content-md-end gap-3">
							<RouterLink to="/policy" class="text-color-light text-decoration-none hover-effect legal-link">
							<strong>Privacy Policy</strong>
							</RouterLink>
							<button @click="openAdminPanel" class="text-color-light text-decoration-none hover-effect admin-link">
								<i class="ti ti-lock me-1"></i>Admin Panel
							</button>
						</div>
					</div>
				</div>
			</footer>
		</template>

<script setup>
import { ref } from 'vue'
import { RouterLink } from 'vue-router'

const currentYear = ref(new Date().getFullYear())

const openAdminPanel = () => {
	window.open('/admin/login', '_blank', 'noopener,noreferrer')
}
</script>

<style scoped>
.hover-effect {
	transition: color 0.3s ease;
	cursor: pointer;
	border: none;
	background: none;
	padding: 0;
	font-size: inherit;
}

.admin-link,
.legal-link {
	display: inline-block;
}

.hover-effect:hover {
	color: #fff !important;
	text-decoration: underline !important;
}
</style>