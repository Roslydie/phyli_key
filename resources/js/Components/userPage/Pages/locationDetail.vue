<template>
  <div role="main" class="main location-detail-page">
    <!-- Back Navigation & Hero Section -->
    <section class="section section-height-2 border-0 m-0 p-0 hero-detail-section position-relative overflow-hidden pt-5">
      <div class="hero-detail-overlay"></div>
      <div class="container py-6 position-relative z-index-2">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-lg-10">
            <span class="letter-spacing-3 mb-5" style="color: yellow;">
              <RouterLink to="/" class="text-warning text-decoration-none">Home</RouterLink>
              <span class="mx-2 text-white">/</span>
              <RouterLink to="/location" class="text-warning text-decoration-none">Service Areas</RouterLink>
              <span class="mx-2 text-white">/</span>
              <strong>{{ currentLocation?.name }}</strong>
            </span>
            <h1 class="hero-title text-white mb-4">{{ currentLocation?.name }} Services</h1>
            <p class="text-white-75 lead mb-4">Complete locksmith solutions available in {{ currentLocation?.name }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Location Info & Services Section -->
    <div class="detail-section section-padding bg-light">
      <div class="container">
        <div class="row g-4">
          <!-- Location Information Sidebar -->
          <div class="col-lg-3">
            <div class="location-info-card bg-white rounded-4 shadow-sm p-4 h-100">
              <div class="location-info-header mb-4">
                <h2 class="font-weight-bold mb-3">{{ currentLocation?.name }}</h2>
                <div class="location-badge mb-3">
                  <span class="badge bg-warning text-dark">Service Available 24/7</span>
                </div>
              </div>

              <div class="location-contact-info mb-4">
                <div class="contact-item mb-3">
                  <strong class="text-warning d-block mb-2">
                    <i class="fas fa-map-marker-alt me-2"></i>Address
                  </strong>
                  <p class="mb-0">{{ currentLocation?.address }}</p>
                </div>
                <div class="contact-item mb-3">
                  <strong class="text-warning d-block mb-2">
                    <i class="fas fa-phone me-2"></i>Call Us
                  </strong>
                  <a href="tel:2679242208" class="text-decoration-none text-dark">(215) 989-0101</a>
                </div>
                <div class="contact-item">
                  <strong class="text-warning d-block mb-2">
                    <i class="fas fa-envelope me-2"></i>Email
                  </strong>
                  <a href="mailto:techr7129@gmail.com" class="text-decoration-none text-dark">techr7129@gmail.com</a>
                </div>
              </div>

              <div class="location-hours bg-light rounded-3 p-3 mb-4">
                <strong class="d-block mb-2">Hours</strong>
                <p class="mb-1 small">Mon - Sun: 8:00 AM - 8:00 PM</p>
                <p class="mb-0 small text-warning">Emergency: 24/7 Available</p>
              </div>

              <a href="tel:2679242208" class="btn btn-warning w-100 btn-lg">
                <i class="fas fa-phone me-2"></i>Call Now
              </a>
            </div>
          </div>

          <!-- Services Grid -->
          <div class="col-lg-9">
            <div class="services-wrapper">
              <div class="services-header mb-5">
                <h2 class="font-weight-bold mb-3">Available Services</h2>
                <p class="lead">Professional locksmith services tailored for {{ currentLocation?.name }}</p>
              </div>

              <div class="row g-4">
                <div v-for="service in services" :key="service.id" class="col-md-6 col-lg-6">
                  <div class="service-card bg-white rounded-4 shadow-sm overflow-hidden transition-all h-100">
                    <div class="service-icon-wrapper bg-warning position-relative overflow-hidden">
                      <div class="service-icon">
                        <i :class="service.icon" style="font-size: 2.5rem; color: #0f172a;"></i>
                      </div>
                    </div>
                    <div class="service-body p-4">
                      <h3 class="font-weight-bold mb-2">{{ service.name }}</h3>
                      <p class="mb-3">{{ service.description }}</p>
                      <ul class="service-features small">
                        <li v-for="feature in service.features" :key="feature" class="mb-2">
                          <i class="fas fa-check text-warning me-2"></i>{{ feature }}
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- CTA Section -->
    <section class="cta-section section-padding bg-dark position-relative overflow-hidden">
      <div class="cta-overlay"></div>
      <div class="container position-relative z-index-2">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-lg-8">
            <h2 class="text-white font-weight-bold mb-4">Need Immediate Assistance?</h2>
            <p class="text-white-75 lead mb-4">Our mobile locksmith team is ready to serve {{ currentLocation?.name }} right now. Emergency response available 24/7.</p>
            <div class="d-flex flex-wrap gap-3 justify-content-center">
              <a href="tel:2679242208" class="btn btn-warning btn-lg px-5 py-3">
                <i class="fas fa-phone me-2"></i>Call: 2679242208
              </a>
              <RouterLink to="/contact" class="btn btn-outline-light btn-lg px-5 py-3">
                Request Service
              </RouterLink>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { RouterLink } from 'vue-router';

const route = useRoute();

const locationMap = {
  'philadelphia': { name: 'Philadelphia', address: 'Philadelphia, PA 19103' },
  'upper-darby': { name: 'Upper Darby', address: 'Upper Darby, PA 19082' },
  'darby': { name: 'Darby', address: 'Darby, PA 19023' },
  'yeadon': { name: 'Yeadon', address: 'Yeadon, PA 19050' },
  'lansdowne': { name: 'Lansdowne', address: 'Lansdowne, PA 19050' },
  'springfield': { name: 'Springfield', address: 'Springfield, PA 19064' },
  'collingdale': { name: 'Collingdale', address: 'Collingdale, PA 19023' },
  'sharon-hill': { name: 'Sharon Hill', address: 'Sharon Hill, PA 19079' },
  'chester': { name: 'Chester', address: 'Chester, PA 19013' },
  'camden': { name: 'Camden', address: 'Camden, NJ 08101' },
  'woodbury': { name: 'Woodbury', address: 'Woodbury, NJ 08096' },
  'deptford': { name: 'Deptford', address: 'Deptford, NJ 08096' }
};

const currentLocation = computed(() => {
  const locationId = route.params.id;
  return locationMap[locationId] || { name: 'Service Area', address: 'Check back soon' };
});

const services = ref([
  {
    id: 1,
    name: 'Emergency Lockouts',
    icon: 'fas fa-door-open',
    description: 'Fast response to residential and commercial lockouts. We\'ll get you back inside quickly and safely.',
    features: ['Home lockouts', 'Car lockouts', 'Business lockouts', 'No damage entry'],
    price: '$75-$150'
  },
  {
    id: 2,
    name: 'Key Replacement',
    icon: 'fas fa-key',
    description: 'Lost or damaged keys? We provide fast key cutting and replacement services on-site.',
    features: ['Lost keys', 'Key duplication', 'Broken key removal', 'All key types'],
    price: '$15-$50'
  },
  {
    id: 3,
    name: 'Lock Installation',
    icon: 'fas fa-lock',
    description: 'Professional installation of new locks for maximum security. All types and brands available.',
    features: ['Residential locks', 'Commercial locks', 'High-security locks', 'Smart locks'],
    price: '$100-$300'
  },
  {
    id: 4,
    name: 'Lock Repair',
    icon: 'fas fa-wrench',
    description: 'Repair or replacement of damaged locks. Experienced technicians for all lock mechanisms.',
    features: ['Lock jamming', 'Broken locks', 'Worn mechanisms', 'Quick fixes'],
    price: '$50-$150'
  },
  {
    id: 5,
    name: 'Security Upgrades',
    icon: 'fas fa-shield-alt',
    description: 'Enhance your security with modern lock systems and security solutions designed for your needs.',
    features: ['Deadbolts upgrade', 'Smart locks', 'Security assessment', 'Multi-lock systems'],
    price: '$200-$500'
  },
  {
    id: 6,
    name: 'Automotive Services',
    icon: 'fas fa-car',
    description: 'Car lockouts, key replacement, and lock repair. Available for all vehicle types and models.',
    features: ['Car lockouts', 'Ignition repair', 'Key fob replacement', 'Transponder keys'],
    price: '$75-$200'
  }
]);

onMounted(() => {
  // You can add any additional initialization here if needed
  console.log('Location detail loaded for:', currentLocation.value.name);
});
</script>

<style scoped>
.hero-detail-section {
  background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(15, 23, 42, 0.85)), url('/assets/img/demos/auto-services/service2.jpg') no-repeat center / cover;
  background-size: cover;
  background-position: center;
  position: relative;
  min-height: 400px;
  display: flex;
  align-items: center;
}

.hero-detail-overlay {
  position: absolute;
  inset: 0;
  background: rgba(15, 23, 42, 0.55);
}

.hero-title {
  font-size: clamp(2.5rem, 4vw, 4rem);
  line-height: 1.02;
  font-weight: 700;
}

.detail-section {
  background: #f8fafc;
}

.location-info-card {
  background: #ffffff;
  border: 1px solid #e5e7eb;
  position: sticky;
  top: 100px;
}

.location-info-header h2 {
  font-size: 1.8rem;
  color: #0f172a;
}

.location-badge {
  display: inline-block;
}

.location-badge .badge {
  font-size: 1rem;
  padding: 0.6rem 1.2rem;
  font-weight: 600;
}

.location-contact-info {
  border-top: 1px solid #e5e7eb;
  padding-top: 1.5rem;
}

.contact-item strong {
  font-size: 1.1rem;
}

.contact-item p {
  font-size: 1.1rem;
  color: #374151;
}

.contact-item a {
  color: #0f172a;
  font-weight: 500;
  transition: color 0.3s ease;
  font-size: 1.05rem;
  display: inline-block;
}

.contact-item a:hover {
  color: #ffc72c;
}

.location-hours {
  background: #f3f4f6;
}

.location-hours strong {
  font-size: 1.1rem;
  color: #0f172a;
}

.location-hours p {
  margin-bottom: 0.5rem;
  color: #4b5563;
  font-size: 1.05rem;
}

.services-header h2 {
  font-size: 2.2rem;
  color: #0f172a;
}

.services-header p {
  font-size: 1.2rem;
}

.service-card {
  background: #ffffff;
  border: 1px solid #e5e7eb;
  display: flex;
  flex-direction: column;
  transition: all 0.3s ease;
  height: 100%;
}

.service-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 40px rgba(15, 23, 42, 0.1) !important;
  border-color: #ffc72c;
}

.service-icon-wrapper {
  background: linear-gradient(135deg, #ffc72c, #ffb800);
  padding: 2rem;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.service-icon-wrapper::before {
  content: '';
  position: absolute;
  inset: 0;
  background: rgba(255, 255, 255, 0.1);
}

.service-icon {
  position: relative;
  z-index: 1;
}

.service-body {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.service-body h3 {
  font-size: 1.5rem;
  color: #0f172a;
  transition: color 0.3s ease;
}

.service-card:hover .service-body h3 {
  color: #ffc72c;
}

.service-body p {
  font-size: 1.15rem;
  line-height: 1.6;
}

.service-features {
  list-style: none;
  padding: 0;
  margin: 0;
  color: #4b5563;
}

.service-features li {
  display: flex;
  align-items: flex-start;
  margin-bottom: 0.5rem;
  font-size: 1rem;
}

.cta-section {
  background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(30, 41, 59, 0.95)), url('/assets/img/demos/auto-services/service2.jpg') no-repeat center / cover;
  background-size: cover;
  background-position: center;
  min-height: 350px;
  display: flex;
  align-items: center;
}

.cta-overlay {
  position: absolute;
  inset: 0;
  background: rgba(15, 23, 42, 0.6);
}

.cta-section h2 {
  font-size: 2.5rem;
}

.cta-section .lead {
  font-size: 1.1rem;
}

.transition-all {
  transition: all 0.3s ease;
}

.small {
  font-size: 1.05rem !important;
}

/* Responsive */
@media (max-width: 991px) {
  .location-info-card {
    position: static;
    top: auto;
  }

  .hero-title {
    font-size: 2rem;
  }

  .services-header h2 {
    font-size: 1.75rem;
  }

  .cta-section h2 {
    font-size: 2rem;
  }
}

@media (max-width: 576px) {
  .hero-title {
    font-size: 1.5rem;
  }

  .location-info-header h2 {
    font-size: 1.5rem;
  }

  .service-body h3 {
    font-size: 1.1rem;
  }

  .service-body p {
    font-size: 0.9rem;
  }

  .services-header h2 {
    font-size: 1.5rem;
  }

  .cta-section h2 {
    font-size: 1.5rem;
  }

  .d-flex.flex-wrap {
    flex-direction: column;
  }

  .d-flex.flex-wrap .btn {
    width: 100%;
  }
}
</style>
