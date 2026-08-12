<template>
  <div role="main" class="main">

    <section class="section section-height-2 border-0 m-0 p-0 hero-services-section position-relative overflow-hidden pt-5">
      <div class="hero-services-overlay"></div>
      <div class="container py-6 position-relative z-index-2">
        <div class="row align-items-center justify-content-between">
          <div class="col-lg-7 mb-4 mb-lg-0">
             <span class="letter-spacing-3 mb-5 " style="color: yellow;"><RouterLink to="/" class="text-warning text-decoration-none">Home</RouterLink><span class="mx-2 text-white">/</span><strong>Service</strong></span>
            <h1 class="hero-title text-white mb-4">Locksmith services built for fast response and trusted protection.</h1>
            <p class="text-white-75 lead mb-4">Whether you need a home lock change, vehicle key replacement, or emergency lockout support, our team arrives quickly with the right tools and honest pricing.</p>
            <div class="d-flex flex-wrap gap-3">
              <a href="tel:2679242208" class="btn btn-warning btn-lg px-5 py-3">Call Now</a>
              <a href="#services-section" class="btn btn-outline-light btn-lg px-5 py-3">Browse Services</a>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="hero-services-image rounded-5 overflow-hidden shadow-lg">
              <img src="/assets/img/demos/auto-services/service3.jpg" alt="Locksmith service hero" class="img-fluid w-100">
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="services-section" class="section section-height-2 border-0 m-0 p-0 bg-light py-5">
      <div class="container">
        <div class="row justify-content-center mb-4">
          <div class="col-lg-8 text-center">
            <h2 class="font-weight-bold text-color-dark mb-2">Our Services</h2>
            <p class="mb-4 text-muted">Professional locksmith solutions for homes, vehicles and businesses — available day or night.</p>
          </div>
        </div>

        <div class="row g-4">
          <div v-for="(service, idx) in services" :key="idx" class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 rounded-5 overflow-hidden">
              <div class="thumb-info-wrapper">
            <RouterLink :to="{ name: 'user.singleService', params: { id: service.slug } }" class="text-decoration-none">
                <img :src="service.image" class="card-img-top img-fluid" :alt="service.title">
            </RouterLink>
              </div>
              <div class="card-body">
              <RouterLink :to="{ name: 'user.singleService', params: { id: service.slug } }" class="text-decoration-none">
                <h4 class="card-title mb-2">{{ service.title }}</h4>
              </RouterLink>
                <p class="card-text text-muted mb-4">{{ service.description }}</p>
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                  <RouterLink :to="{ name: 'user.singleService', params: { id: service.slug } }" class="btn btn-outline-logo-blue btn-sm">Learn More</RouterLink>
                  <a href="tel:2679242208" class="btn btn-warning btn-sm">Call Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col text-center">
            <a href="/contact#contact-form-section" class="btn btn-logo-blue btn-lg px-5 py-3 me-3">Request Service</a>
            <a href="tel:2679242208" class="btn btn-outline-dark btn-lg px-5 py-3">Speak with us</a>
          </div>
        </div>
      </div>
    </section>

  </div>
</template>

<script setup>
import { ref } from 'vue'
import { RouterLink } from 'vue-router'
import { locksmithServices } from '../data/services'

const services = ref(locksmithServices)
</script>

<style scoped>

.btn-outline-logo-blue {
    color: #061B4F !important;
    border-color: #061B4F !important;
    background-color: transparent !important;
}

.btn-outline-logo-blue:hover,
.btn-outline-logo-blue:focus {
    color: #fff !important;
    background-color: #061B4F !important;
    border-color: #061B4F !important;
}

.btn-logo-blue {
    background-color: #061B4F !important;
    border-color: #061B4F !important;
    color: #fff !important;
}

.btn-logo-blue:hover {
    background-color: #08276B !important;
    border-color: #08276B !important;
    color: #fff !important;
}
.hero-services-section {
  background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(15, 23, 42, 0.85)), url('/assets/img/demos/auto-services/blog/blog-1.jpg') no-repeat center / cover;
  position: relative;
}
.hero-services-overlay {
  position: absolute;
  inset: 0;
  background: rgba(15, 23, 42, 0.55);
}
.hero-title {
  font-size: clamp(2.75rem, 4vw, 4.5rem);
  line-height: 1.02;
}
.hero-services-image img {
    width: 400px;
  height: 500px;
  object-fit: cover;
  display: block;
}
.thumb-info-wrapper img {
  height: 240px;
  object-fit: cover;
}
.card {
  overflow: hidden;
}
.card-body {
  padding: 1.5rem;
}
.card-title {
  font-size: 1.15rem;
  color: #061B4F;
  font-weight: 600;
}
.card-text {
  color: #6b7280;
}
.btn-outline-light {
  border-color: rgba(255,255,255,0.85);
  color: #ffffff;
}
.btn-outline-light:hover {
  background: rgba(255,255,255,0.12);
}
</style>
