<template>
  <div role="main" class="main">
    <section class="page-header page-header-modern bg-color-grey page-header-lg">
      <div class="container">
        <div class="row">
          <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
            <h1 class="text-color-dark font-weight-bold">{{ currentService?.title || 'Service Detail' }}</h1>
          </div>
          <div class="col-md-4 order-1 order-md-2 align-self-center">
            <ul class="breadcrumb d-flex justify-content-md-end text-3-5">
              <li><RouterLink to="/" class="text-color-default text-color-hover-primary text-decoration-none">HOME</RouterLink></li>
              <li><RouterLink to="/services" class="text-color-default text-color-hover-primary text-decoration-none">SERVICES</RouterLink></li>
              <li class="active text-uppercase">{{ currentService?.title || 'Service' }}</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <div class="container my-5 pt-4 pb-5">
      <div class="row">
        <div class="col-lg-8 order-lg-2 mb-5 mb-lg-0">
          <div v-if="currentService" class="service-detail-card">
            <p class="text-3-5">{{ currentService.summary }}</p>
            <p class="pb-2 mb-4">{{ currentService.description }}</p>
            <img :src="currentService.detailImage" class="img-fluid custom-border-radius-1 float-start me-4 mb-4" :alt="currentService.title">
            <p class="pt-2">{{ currentService.detailCopy }}</p>
            <p>{{ currentService.extraCopy }}</p>
            <p class="mt-5 mt-md-0 mt-xl-5">Whether you need an urgent lockout response or a planned security upgrade, we are ready to assist with professional service.</p>
            <ul class="list list-icons list-icons-style-2 list-icons-lg mb-4 mb-xl-5">
              <li v-for="(item, index) in currentService.highlights" :key="index" class="font-weight-semibold text-color-dark">
                <i class="fas fa-check text-color-dark border-color-grey-1 top-7 text-3"></i>
                {{ item }}
              </li>
            </ul>
            <div class="d-flex flex-wrap gap-3 mt-4">
              <a :href="`tel:${phoneNumber}`" class="btn btn-warning btn-lg px-5 py-3">Call Now</a>
              <RouterLink :to="{ name: 'user.contact', hash: '#contact-form-section' }" class="btn btn-outline-dark btn-lg px-5 py-3">Request Service</RouterLink>
            </div>
          </div>

          <div v-else class="text-center py-5">
            <h3 class="mb-3">Service details are not available yet.</h3>
            <p>Please return to the services list and select another option.</p>
          </div>
        </div>

        <div class="col-lg-4 order-lg-1">
          <div class="card box-shadow-1 custom-border-radius-1 mb-5">
            <div class="card-body z-index-1 py-4 my-3">
              <h2 class="text-color-dark font-weight-bold text-6 mb-4">All Services</h2>
              <ul class="custom-nav-list-effect-1 list list-unstyled mb-0">
                <li v-for="item in services" :key="item.slug" :class="{ active: item.slug === currentService?.slug }">
                  <RouterLink :to="{ name: 'user.singleService', params: { id: item.slug } }" class="text-decoration-none text-color-dark text-color-hover-primary text-3-5">
                    {{ item.title }}
                  </RouterLink>
                </li>
              </ul>
            </div>
          </div>

          <div class="card bg-logo-blue custom-border-radius-1">
            <div class="card-body text-center py-5 my-2">
              <h2 class="text-color-light font-weight-medium text-3 line-height-2 line-height-sm-1 mb-3 pb-1">LOOKING FOR HONEST AND RELIABLE SERVICES?</h2>
              <h3 class="font-weight-bold text-color-light text-transform-none text-8 line-height-3 mb-3">Fast locksmith support in Philadelphia</h3>
              <p class="font-weight-bold text-color-light text-4 opacity-7 mb-5">Reach out today through the contact form or call us directly.</p>
              <div class="feature-box custom-feature-box-justify-center align-items-center text-start mb-4">
                <div class="feature-box-icon bg-transparent">
                  <i class="icons icon-phone text-8 text-color-light"></i>
                </div>
                <div class="feature-box-info line-height-2 ps-1">
                  <span class="d-block text-4 font-weight-medium text-color-light mb-1">CALL US NOW</span>
                  <strong class="text-6"><a :href="`tel:${phoneNumber}`" class="text-color-light text-decoration-none">{{ phoneNumber }}</a></strong>
                </div>
              </div>
              <RouterLink :to="{ name: 'user.contact', hash: '#contact-form-section' }" class="btn btn-light btn-outline custom-btn-border-radius font-weight-bold text-color-light text-color-hover-dark bg-color-hover-light btn-px-5 btn-py-3">Request Service</RouterLink>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute, RouterLink } from 'vue-router'
import { locksmithServices, phoneNumber } from '../data/services'

const route = useRoute()
const services = locksmithServices
const currentService = computed(() => services.find((item) => item.slug === route.params.id))
</script>

<style scoped>
.bg-logo-blue {
    background-color: #061B4F !important;
}
</style>