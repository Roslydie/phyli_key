<template>
  <div role="main" class="main contact-page">

    <section class="section section-height-2 border-0 m-0 p-0 hero-contact-section position-relative overflow-hidden pt-5">
      <div class="hero-contact-overlay"></div>
      <div class="container py-6 position-relative z-index-2">
        <div class="row align-items-center justify-content-between">
          <div class="col-lg-7 mb-4 mb-lg-0">
             <span class="letter-spacing-3 mb-5 " style="color: yellow;"><RouterLink to="/" class="text-warning text-decoration-none">Home</RouterLink><span class="mx-2 text-white">/</span><strong>Contact Us</strong></span>
            <h1 class="hero-title text-white mb-4">Fast locksmith support for Greater Philadelphia & South Jersey.</h1>
            <p class="text-white-75 lead mb-4">Reach our mobile locksmith team for emergency lockouts, key replacements, security upgrades and trusted service across the region.</p>
            <div class="d-flex flex-wrap gap-3">
              <a href="tel:2679242208" class="btn btn-warning btn-lg px-5 py-3">Call Now</a>
              <a href="#contact-form-section" class="btn btn-outline-light btn-lg px-5 py-3">Request Service</a>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="hero-image rounded-5 overflow-hidden shadow-lg">
              <img src="/assets/img/demos/auto-services/services/service-small-3.jpg" alt="Contact locksmith" class="img-fluid w-100">
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="contact-section section-padding pt-0 bg-light">
      <div class="container">
        <div class="row gy-5">
          <div class="col-xl-5 col-lg-5">
            <div class="contact-text bg-white rounded-4 shadow-sm p-5 h-100">
              <span class="text-uppercase  letter-spacing-3"  style="color: #ffc72c;"><strong>Get in touch</strong></span>
              <h2 class="font-weight-bold mt-3 mb-4">Questions? Need immediate locksmith help?</h2>
              <p class="text-muted">Our team is available for emergency lockouts, key replacements and security upgrades across Greater Philadelphia and South Jersey. Fill out the form or call us directly for the fastest response.</p>

              <div class="contact-details mt-4">
                <div class="contact-item mb-4">
                  <strong>Phone</strong>
                  <p><a href="tel:2679242208" class="text-decoration-none text-dark">(267) 924-2208</a></p>
                </div>
                <div class="contact-item mb-4">
                  <strong>Email</strong>
                  <p><a href="mailto:techr7129@gmail.com" class="text-decoration-none text-dark">techr7129@gmail.com</a></p>
                </div>
                <div class="contact-item">
                  <strong>Hours</strong>
                  <p class="mb-1">Mon - Sun: 8:00 AM - 8:00 PM</p>
                  <p class="mb-0">Emergency response available 24/7</p>
                </div>
              </div>
            </div>
          </div>

          <div id="contact-form-section" class="offset-xl-1 col-xl-6 offset-lg-1 col-lg-6">
            <div class="submit-form-wrap bg-white rounded-4 shadow-sm p-5">
              <div class="section-title mb-4">
                <h2 class="font-weight-bold">Send a message</h2>
              </div>

              <div v-if="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ successMessage }}
                <button type="button" class="btn-close" @click="successMessage = ''" aria-label="Close"></button>
              </div>

              <div v-if="errorMessage" class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ errorMessage }}
                <button type="button" class="btn-close" @click="errorMessage = ''" aria-label="Close"></button>
              </div>

              <form @submit.prevent="submitContact" class="contact-form">
                <div class="row g-3">
                  <div class="col-12">
                    <input
                      type="text"
                      v-model="contactForm.full_name"
                      placeholder="Your Name"
                      required
                      :class="{ 'is-invalid': errors.full_name }"
                      class="form-control"
                    />
                    <small v-if="errors.full_name" class="text-danger">{{ errors.full_name }}</small>
                  </div>

                  <div class="col-12">
                    <input
                      type="email"
                      v-model="contactForm.email"
                      placeholder="Email"
                      required
                      @input="validateEmail"
                      :class="{ 'is-invalid': errors.email }"
                      class="form-control"
                    />
                    <small v-if="errors.email" class="text-danger">{{ errors.email }}</small>
                  </div>

                  <div class="col-12">
                    <PhoneInput
                      v-model="contactForm.phone"
                      placeholder="Phone Number"
                      :class="{ 'is-invalid': errors.phone }"
                    />
                    <small v-if="errors.phone" class="text-danger">{{ errors.phone }}</small>
                  </div>

                  <div class="col-12">
                    <input
                      type="text"
                      v-model="contactForm.subject"
                      placeholder="Subject"
                      required
                      :class="{ 'is-invalid': errors.subject }"
                      class="form-control"
                    />
                    <small v-if="errors.subject" class="text-danger">{{ errors.subject }}</small>
                  </div>

                  <div class="col-12">
                    <textarea
                      v-model="contactForm.message"
                      cols="30"
                      rows="7"
                      placeholder="Message"
                      required
                      :class="{ 'is-invalid': errors.message }"
                      class="form-control"
                    ></textarea>
                    <small v-if="errors.message" class="text-danger">{{ errors.message }}</small>
                  </div>

                  <div class="col-12 text-end">
                    <button type="submit" :disabled="isSubmitting" class="btn btn-warning btn-lg px-5 py-3">
                      {{ isSubmitting ? 'Sending...' : 'Send Message' }}
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="contact-info-wrap mt-5">
          <div class="row gy-4">
            <div class="col-xl-6">
              <div class="map-responsive rounded-4 overflow-hidden shadow-sm border">
                <iframe
                  src="https://www.google.com/maps?q=6544%20Essington%20Ave%20Philadelphia%20PA%2019153&output=embed"
                  width="100%"
                  height="100%"
                  style="border:0;"
                  allowfullscreen=""
                  loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade"
                  title="6544 Essington Ave Philadelphia PA 19153"
                ></iframe>
              </div>
            </div>

            <div class="col-xl-6">
              <div class="contact-info bg-white rounded-4 shadow-sm p-5 h-100">
                <div class="section-title mb-4">
                  <h2>Contact Info</h2>
                </div>
                <div class="contact-info-inner">
                  <div class="single-contact-info mb-4">
                    <p class="text-uppercase text-warning mb-2">Email</p>
                    <h4 class="mb-0">techr7129@gmail.com</h4>
                  </div>
                  <div class="single-contact-info mb-4">
                    <p class="text-uppercase text-warning mb-2">Phone</p>
                    <h4 class="mb-0">2679242208</h4>
                  </div>
                  <div class="single-contact-info mb-4">
                    <p class="text-uppercase text-warning mb-2">Address</p>
                    <h4 class="mb-0">6544 Essington Ave Philadelphia PA 19153</h4>
                  </div>

                  <div class="contact-hours mb-4">
                    <p class="text-uppercase text-warning mb-2">Hours</p>
                    <p class="mb-1">Monday – Sunday: 8:00 AM – 8:00 PM</p>
                    <p class="mb-0">Emergency assistance 24/7</p>
                  </div>

                  <div class="service-area">
                    <p class="text-uppercase text-warning mb-3">Service Areas</p>
                    <div class="service-area-list">
                      <span>Philadelphia</span>
                      <span>Upper Darby</span>
                      <span>Darby</span>
                      <span>Yeadon</span>
                      <span>Lansdowne</span>
                      <span>Springfield</span>
                      <span>Collingdale</span>
                      <span>Sharon Hill</span>
                      <span>Chester</span>
                      <span>Camden</span>
                      <span>Woodbury</span>
                      <span>Deptford</span>
                    </div>
                  </div>

                 
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { RouterLink } from 'vue-router';
import PhoneInput from '../../shared/PhoneInput.vue';

const contactForm = ref({
  full_name: '',
  email: '',
  phone: '',
  subject: '',
  message: ''
});
const errors = ref({});
const successMessage = ref('');
const errorMessage = ref('');
const isSubmitting = ref(false);
const apiUrl = '/api';

function validateEmail() {
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!contactForm.value.email) {
    errors.value.email = '';
    return;
  }
  errors.value.email = regex.test(contactForm.value.email) ? '' : 'Invalid email address';
}

async function submitContact() {
  successMessage.value = '';
  errorMessage.value = '';
  errors.value = {};

  if (!contactForm.value.full_name) {
    errors.value.full_name = 'Full name is required';
  }
  if (!contactForm.value.email) {
    errors.value.email = 'Email is required';
  }
  if (!contactForm.value.phone) {
    errors.value.phone = 'Phone number is required';
  }
  if (!contactForm.value.subject) {
    errors.value.subject = 'Subject is required';
  }
  if (!contactForm.value.message) {
    errors.value.message = 'Message is required';
  }

  if (Object.keys(errors.value).length > 0) {
    return;
  }

  try {
    isSubmitting.value = true;
    await axios.post(`${apiUrl}/addcontact`, {
      full_name: contactForm.value.full_name,
      email: contactForm.value.email,
      phone: contactForm.value.phone,
      subject: contactForm.value.subject,
      message: contactForm.value.message
    });

    successMessage.value = 'Your message has been sent successfully!';
    contactForm.value = { full_name: '', email: '', phone: '', subject: '', message: '' };
    setTimeout(() => { successMessage.value = ''; }, 5000);
  } catch (error) {
    errorMessage.value = error.response?.data?.message || 'Error sending message. Please try again.';
  } finally {
    isSubmitting.value = false;
  }
}
</script>

<style scoped>
.breadcrumb-bg {
  background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(30, 41, 59, 0.95)), url('/assets/img/demos/auto-services/service2.jpg') no-repeat center / cover;
}
.overlay-3 {
  position: absolute;
  inset: 0;
  background: rgba(15, 23, 42, 0.55);
}
.breadcrumb-title h1 {
  font-size: clamp(2.5rem, 4vw, 4rem);
  line-height: 1.05;
}
.breadcrumb-title p {
  max-width: 520px;
}
.breadcrumb-meta-wrap {
  background: #ffffff;
}
.breadcrumb {
  background: transparent;
  margin-bottom: 0;
  padding: 0;
}
.breadcrumb-item + .breadcrumb-item::before {
  content: '>';
  color: #6b7280;
}
.hero-contact-section {
  background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(15, 23, 42, 0.85)), url('/assets/img/demos/auto-services/service2.jpg') no-repeat center / cover;
  background-size: cover;
  background-position: center;
  position: relative;
}
.hero-contact-overlay {
  position: absolute;
  inset: 0;
  background: rgba(15, 23, 42, 0.55);
}
.hero-title {
  font-size: clamp(2.75rem, 4vw, 4.5rem);
  line-height: 1.02;
}
.hero-image img {
  min-height: 400px;
  object-fit: cover;
}
.contact-section {
  background: #f8fafc;
}
.contact-text {
  position: sticky;
  top: 120px;
}
.contact-text h2 {
  font-size: 2.5rem;
}
.contact-text p,
.contact-details p,
.contact-info-inner p,
.single-contact-info h4,
.service-area-list span {
  font-size: 1rem;
}
.contact-details strong {
  display: block;
  margin-bottom: 0.5rem;
  color: #111827;
  font-size: 1rem;
}
.contact-item p,
.contact-hours p {
  margin-bottom: 0.5rem;
}
.submit-form-wrap {
  position: relative;
}
.submit-form-wrap .form-control {
  border-radius: 0.85rem;
  border: 1px solid #d1d5db;
  padding: 1rem 1.2rem;
}
.submit-form-wrap textarea.form-control {
  min-height: 180px;
}
.form-control.is-invalid {
  border-color: #dc3545;
}
.contact-info-wrap {
  margin-bottom: 4rem;
}
.contact-info-wrap .row {
  align-items: stretch;
}
.contact-info-wrap .col-xl-6,
.contact-info-wrap .col-lg-6 {
  display: flex;
}
.map-responsive,
.contact-info {
  flex: 1;
  min-height: 620px;
}
.map-responsive {
  position: relative;
  overflow: hidden;
}
.map-responsive iframe {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  border: 0;
}
.contact-info {
  display: flex;
  flex-direction: column;
  justify-content: stretch;
}
.contact-info .section-title h2 {
  font-size: 2rem;
}
.single-contact-info p {
  font-weight: 700;
  color: #0ea5e9;
  margin-bottom: 0.5rem;
}
.single-contact-info h4 {
  font-size: 1.1rem;
  font-weight: 600;
}
.service-area-list {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 0.75rem 1rem;
}
.service-area-list span {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0.65rem 1rem;
  background: #eef2ff;
  border-radius: 999px;
  font-size: 0.95rem;
  color: #1d4ed8;
}
.social-area {
  display: flex;
  gap: 0.75rem;
  margin-top: 1rem;
}
.social-icon {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background: #0f172a;
  color: #ffffff;
  transition: transform 0.2s ease, background 0.2s ease;
}
.social-icon:hover {
  transform: translateY(-2px);
  background: #2563eb;
}
@media (max-width: 991px) {
  .contact-text {
    position: static;
    top: auto;
  }
}
</style>
