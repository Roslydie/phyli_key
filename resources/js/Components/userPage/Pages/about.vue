<template>
  <div role="main" class="main">

    <section class="section section-height-2 border-0 m-0 p-0 position-relative overflow-hidden about-hero-section pt-5">
      <div class="section-overlay"></div>
      <div class="container py-6 position-relative z-index-2">
        <div class="row justify-content-between align-items-center">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <span class="letter-spacing-3 mb-3" style="color: yellow;"><RouterLink to="/" class="text-warning text-decoration-none">Home</RouterLink><span class="mx-2 text-white">/</span><strong>About Us</strong></span>
            <h1 class="font-weight-bold text-white display-5 mb-4">A modern locksmith company with premium service and seamless support.</h1>
            <p class="text-white-75 lead mb-4">We blend fast emergency response with elegant workmanship and trustworthy locksmith solutions for homes, cars and businesses.</p>
            <div class="d-flex flex-wrap gap-3">
              <a href="/services" class="btn btn-warning btn-lg px-5 py-3">Our Services</a>
              <a href="tel:+17735217000" class="btn btn-outline-light btn-lg px-5 py-3">Call Us Now</a>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="about-hero-card rounded-5 shadow-lg overflow-hidden border border-white border-opacity-10">
              <img src="/assets/img/demos/auto-services/service1.jpg" alt="Locksmith service" class="img-fluid w-100">
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section bg-light border-0 m-0 py-5">
      <div class="container">
        <div class="row gx-5 align-items-stretch">
          <div class="col-lg-6">
            <div class="about-feature-card rounded-5 shadow-sm bg-white p-5 h-100">
              <span class="d-inline-block text-uppercase letter-spacing-3 text-warning mb-3">Company story</span>
              <h2 class="font-weight-bold text-color-dark mb-4">Built from trust, driven by excellence.</h2>
              <p class="text-muted fs-5 mb-5">We began as a local locksmith team with one clear goal: get people moving again quickly and safely. Over the years, we expanded to provide a full range of locksmith services while preserving the fast, friendly support that customers rely on.</p>
              <div class="d-flex flex-column gap-4">
                <div class="feature-item d-flex align-items-start gap-3">
                  <span class="feature-badge bg-warning text-dark"><i class="fas fa-shield-alt"></i></span>
                  <div>
                    <h5 class="mb-1">Trusted craftsmanship</h5>
                    <p class="mb-0 text-muted">Precise lock installs and secure solutions for every property.</p>
                  </div>
                </div>
                <div class="feature-item d-flex align-items-start gap-3">
                  <span class="feature-badge bg-warning text-dark"><i class="fas fa-clock"></i></span>
                  <div>
                    <h5 class="mb-1">Fast on-site response</h5>
                    <p class="mb-0 text-muted">Rapid arrival and efficient completion of urgent calls.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-feature-card rounded-5 shadow-sm bg-white p-5 h-100">
              <span class="d-inline-block text-uppercase letter-spacing-3 text-warning mb-3">Mission</span>
              <h2 class="font-weight-bold text-color-dark mb-4">Deliver clear, reliable locksmith care every time.</h2>
              <p class="text-muted fs-5 mb-4">Our mission is to make locksmith services simple, elegant and dependable. We focus on transparency, quality parts and a polished experience from first call to service completion.</p>
              <ul class="list-unstyled mb-0 feature-list">
                <li class="d-flex align-items-start mb-4">
                  <span class="feature-check text-warning me-3 mt-1"><i class="fas fa-check-circle"></i></span>
                  <span class="text-muted">Clear pricing with no hidden fees.</span>
                </li>
                <li class="d-flex align-items-start mb-4">
                  <span class="feature-check text-warning me-3 mt-1"><i class="fas fa-check-circle"></i></span>
                  <span class="text-muted">Skilled technicians for modern lock systems.</span>
                </li>
                <li class="d-flex align-items-start">
                  <span class="feature-check text-warning me-3 mt-1"><i class="fas fa-check-circle"></i></span>
                  <span class="text-muted">Responsive support whenever you need it.</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section border-0 m-0 py-5">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-lg-8">
            <span class="d-inline-block text-uppercase letter-spacing-3 text-warning mb-3">Service area</span>
            <h2 class="font-weight-bold text-color-dark mb-3">We protect homes, keys and businesses across the region.</h2>
            <p class="text-muted fs-5 mb-0">Covering the city and surrounding communities with locksmith services for residential, automotive and commercial needs.</p>
          </div>
        </div>
        <div class="row g-4">
          <div class="col-md-6 col-lg-3">
            <div class="about-service-card rounded-5 bg-white shadow-sm p-4 h-100 text-center">
              <span class="icon-circle bg-warning text-dark mb-3"><i class="fas fa-home"></i></span>
              <h4 class="font-weight-semibold mb-2">Residential</h4>
              <p class="text-muted mb-0">Lockouts, rekeys, installations and upgrade services.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="about-service-card rounded-5 bg-white shadow-sm p-4 h-100 text-center">
              <span class="icon-circle bg-warning text-dark mb-3"><i class="fas fa-car"></i></span>
              <h4 class="font-weight-semibold mb-2">Automotive</h4>
              <p class="text-muted mb-0">Key fob programming, ignition repair and emergency entry.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="about-service-card rounded-5 bg-white shadow-sm p-4 h-100 text-center">
              <span class="icon-circle bg-warning text-dark mb-3"><i class="fas fa-building"></i></span>
              <h4 class="font-weight-semibold mb-2">Commercial</h4>
              <p class="text-muted mb-0">Master keys, safe locks and secure business entry solutions.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="about-service-card rounded-5 bg-white shadow-sm p-4 h-100 text-center">
              <span class="icon-circle bg-warning text-dark mb-3"><i class="fas fa-map-marker-alt"></i></span>
              <h4 class="font-weight-semibold mb-2">Local coverage</h4>
              <p class="text-muted mb-0">Philadelphia, suburbs, and nearby neighborhoods.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section border-0 m-0 bg-black text-white py-5">
      <div class="container">
        <div class="row gx-5">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <span class="d-inline-block text-uppercase letter-spacing-3 text-warning mb-3">What sets us apart</span>
            <h2 class="font-weight-bold text-white display-4 mb-4">Premium locksmith service built on trust, speed and flawless execution.</h2>
            <p class="text-white-75 fs-5 mb-5">Our clients choose us for a higher standard: expert technicians, transparent pricing, and a service experience designed around reliability and professionalism.</p>
            <div class="d-flex flex-column gap-3">
              <div class="premium-feature-card p-4 rounded-5">
                <h5 class="mb-2 text-warning">White-glove service</h5>
                <p class="mb-0 text-white-75">Personalized locksmith support with clear communication and premium workmanship.</p>
              </div>
              <div class="premium-feature-card p-4 rounded-5">
                <h5 class="mb-2 text-warning">Rapid response</h5>
                <p class="mb-0 text-white-75">Fast arrival and efficient service for every emergency, day or night.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row g-3">
              <div class="col-6">
                <div class="premium-stat-card rounded-5 p-4 h-100">
                  <span class="d-block text-uppercase letter-spacing-3 text-warning mb-3">Experience</span>
                  <h3 class="mb-0 text-white">+10 years</h3>
                </div>
              </div>
              <div class="col-6">
                <div class="premium-stat-card rounded-5 p-4 h-100">
                  <span class="d-block text-uppercase letter-spacing-3 text-warning mb-3">Reviews</span>
                  <h3 class="mb-0 text-white">4.9/5</h3>
                </div>
              </div>
              <div class="col-6">
                <div class="premium-stat-card rounded-5 p-4 h-100">
                  <span class="d-block text-uppercase letter-spacing-3 text-warning mb-3">Coverage</span>
                  <h3 class="mb-0 text-white">24/7</h3>
                </div>
              </div>
              <div class="col-6">
                <div class="premium-stat-card rounded-5 p-4 h-100">
                  <span class="d-inline-block text-uppercase letter-spacing-3 text-warning mb-3">Guarantee</span>
                  <h3 class="mb-0 text-white">Certified</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
</template>

<script setup>
import { RouterLink } from 'vue-router'
</script>

<style scoped>
.about-hero-section {
  background-image: linear-gradient(180deg, rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.95)), url('/assets/img/demos/auto-services/service2.jpg');
  background-size: cover;
  background-position: center;
}
.section-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(15, 23, 42, 0.20), rgba(15, 23, 42, 0.55));
}
.about-hero-card {
  min-height: 420px;
  display: flex;
  align-items: stretch;
}
.about-hero-card img {
  width: 100%;
  height: 500px;
  object-fit: cover;
  display: block;
}
.about-feature-card {
  min-height: 100%;
}
.feature-item {
  gap: 1.25rem;
}
.feature-badge,
.feature-check {
  width: 54px;
  height: 54px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 18px;
  font-size: 1.1rem;
  background: rgba(255, 199, 44, 0.12);
}
.about-service-card {
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.about-service-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 18px 45px rgba(15, 23, 42, 0.14);
}
.icon-circle {
  width: 65px;
  height: 65px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 20px;
  font-size: 1.2rem;
}
.badge-card,
.feature-box-style-2 {
  border: 1px solid rgba(15, 23, 42, 0.08);
}
.about-trust-image img {
  min-height: 420px;
  object-fit: cover;
}
.premium-feature-card,
.premium-stat-card {
  border: 1px solid rgba(255, 199, 44, 0.25);
  background: rgba(255, 199, 44, 0.08);
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
}
.premium-feature-card h5,
.premium-stat-card h3 {
  font-weight: 700;
}
.premium-feature-card p,
.premium-stat-card span {
  color: rgba(255, 255, 255, 0.92);
}
.premium-stat-card {
  min-height: 170px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.text-color-dark {
  color: #111827 !important;
}
</style>
