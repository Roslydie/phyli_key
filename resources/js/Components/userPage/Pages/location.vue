<template>
  <div role="main" class="main location-page">
    <!-- Hero Section -->
    <section class="section section-height-2 border-0 m-0 p-0 hero-location-section position-relative overflow-hidden pt-5">
      <div class="hero-location-overlay"></div>
      <div class="container py-6 position-relative z-index-2">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-lg-10">
            <span class="letter-spacing-3 mb-5" style="color: yellow;"><RouterLink to="/" class="text-warning text-decoration-none">Home</RouterLink><span class="mx-2 text-white">/</span><strong>Service Areas</strong></span>
            <h1 class="hero-title text-white mb-4">Our Service Areas</h1>
            <p class="text-white-75 lead mb-4">We serve Philadelphia and South Jersey with fast, reliable locksmith services. Select your area to view available services.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Locations Grid Section -->
    <div class="locations-section section-padding bg-light">
      <div class="container">
        <div class="section-title text-center mb-5">
          <h2 class="font-weight-bold mb-3">Service Coverage Areas</h2>
          <p class="lead ">Available 24/7 across all locations</p>
        </div>

        <div class="row g-4">
          <div
            v-for="location in locations"
            :key="location.id"
            class="col-lg-4 col-md-6"
          >
            <div class="location-card rounded-4 shadow-sm overflow-hidden transition-all h-100" @click="selectLocation(location)">
              <div class="location-card-body p-4 bg-white">
                <h3 class="font-weight-bold mb-2">{{ location.name }}</h3>
                <p class="mb-3 location-description">{{ location.description }}</p>
                
                <div class="location-address mb-3">
                  <small class="">
                    <i class="fas fa-map-marker-alt me-2 text-warning"></i>
                    {{ location.address }}
                  </small>
                </div>

                <div class="location-footer">
                  <RouterLink :to="`/location/${location.id}`" class="btn btn-warning btn-sm w-100">
                    View Services
                    <i class="fas fa-arrow-right ms-2"></i>
                  </RouterLink>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Coverage Info Section -->
    <section class="coverage-info-section section-padding bg-white">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="coverage-content">
              <h2 class="font-weight-bold mb-4">Fast Response, Trusted Service</h2>
              <p class="mb-3">Our mobile locksmith team operates across Greater Philadelphia and South Jersey with equipment and expertise to handle:</p>
              <ul class="coverage-list">
                <li><i class="fas fa-check text-warning me-3"></i>Emergency Lockouts (Residential & Commercial)</li>
                <li><i class="fas fa-check text-warning me-3"></i>Key Replacements & Duplication</li>
                <li><i class="fas fa-check text-warning me-3"></i>Security System Upgrades</li>
                <li><i class="fas fa-check text-warning me-3"></i>Lock Repairs & Installation</li>
                <li><i class="fas fa-check text-warning me-3"></i>24/7 Emergency Response</li>
              </ul>
              <a href="tel:2679242208" class="btn btn-warning btn-lg mt-4">Call Now: (215) 989-0101</a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="coverage-image rounded-4 overflow-hidden shadow-lg">
              <img src="/assets/img/demos/auto-services/services/service-small-3.jpg" alt="Coverage area" class="img-fluid w-100">
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { RouterLink } from 'vue-router';

const router = useRouter();

const locations = ref([
  {
    id: 'philadelphia',
    name: 'Philadelphia',
    description: 'Our main service hub covering the entire Philadelphia area. Fast emergency response for residents and businesses.',
    address: 'Philadelphia, PA 19103',
    image: '/assets/img/demos/auto-services/services/service-small-3.jpg'
  },
  {
    id: 'upper-darby',
    name: 'Upper Darby',
    description: 'Serving Upper Darby and surrounding areas with professional locksmith solutions. Same-day service available.',
    address: 'Upper Darby, PA 19082',
    image: '/assets/img/demos/auto-services/services/service-small-3.jpg'
  },
  {
    id: 'darby',
    name: 'Darby',
    description: 'Local locksmith services for Darby residents. Specialized in residential and commercial lock solutions.',
    address: 'Darby, PA 19023',
    image: '/assets/img/demos/auto-services/services/service-small-3.jpg'
  },
  {
    id: 'yeadon',
    name: 'Yeadon',
    description: 'Complete locksmith coverage for Yeadon. Available 24/7 for emergencies and scheduled services.',
    address: 'Yeadon, PA 19050',
    image: '/assets/img/demos/auto-services/services/service-small-3.jpg'
  },
  {
    id: 'lansdowne',
    name: 'Lansdowne',
    description: 'Trusted locksmith services for Lansdowne residents and businesses. Quick response times guaranteed.',
    address: 'Lansdowne, PA 19050',
    image: '/assets/img/demos/auto-services/services/service-small-3.jpg'
  },
  {
    id: 'springfield',
    name: 'Springfield',
    description: 'Professional lock installation and repair in Springfield. Expert technicians with years of experience.',
    address: 'Springfield, PA 19064',
    image: '/assets/img/demos/auto-services/services/service-small-3.jpg'
  },
  {
    id: 'collingdale',
    name: 'Collingdale',
    description: 'Collingdale locksmith services for all your security needs. From lockouts to security upgrades.',
    address: 'Collingdale, PA 19023',
    image: '/assets/img/demos/auto-services/services/service-small-3.jpg'
  },
  {
    id: 'sharon-hill',
    name: 'Sharon Hill',
    description: 'Serving Sharon Hill with comprehensive locksmith services. Emergency and routine service available.',
    address: 'Sharon Hill, PA 19079',
    image: '/assets/img/demos/auto-services/services/service-small-3.jpg'
  },
  {
    id: 'chester',
    name: 'Chester',
    description: 'Professional locksmith solutions in Chester. Equipped to handle residential, commercial, and automotive locks.',
    address: 'Chester, PA 19013',
    image: '/assets/img/demos/auto-services/services/service-small-3.jpg'
  },
  {
    id: 'camden',
    name: 'Camden',
    description: 'Serving Camden with reliable locksmith services across South Jersey. Available for emergencies.',
    address: 'Camden, NJ 08101',
    image: '/assets/img/demos/auto-services/services/service-small-3.jpg'
  },
  {
    id: 'woodbury',
    name: 'Woodbury',
    description: 'Woodbury area locksmith services with quick response times. Specializing in home and business security.',
    address: 'Woodbury, NJ 08096',
    image: '/assets/img/demos/auto-services/services/service-small-3.jpg'
  },
  {
    id: 'deptford',
    name: 'Deptford',
    description: 'Comprehensive locksmith coverage for Deptford. Expert service from certified, insured technicians.',
    address: 'Deptford, NJ 08096',
    image: '/assets/img/demos/auto-services/services/service-small-3.jpg'
  }
]);

function selectLocation(location) {
  router.push(`/location/${location.id}`);
}
</script>

<style scoped>
.hero-location-section {
  background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(15, 23, 42, 0.85)), url('/assets/img/demos/auto-services/service2.jpg') no-repeat center / cover;
  background-size: cover;
  background-position: center;
  position: relative;
  min-height: 450px;
  display: flex;
  align-items: center;
}

.hero-location-overlay {
  position: absolute;
  inset: 0;
  background: rgba(15, 23, 42, 0.55);
}

.hero-title {
  font-size: clamp(2.75rem, 4vw, 4.5rem);
  line-height: 1.02;
  font-weight: 700;
}

.locations-section {
  background: #f8fafc;
}

.section-title {
  margin-bottom: 3rem;
}

.section-title h2 {
  font-size: 2.75rem;
  color: #0f172a;
}

.section-title p {
  font-size: 1.1rem;
  color: #6b7280;
}

.location-card {
  background: #ffffff;
  border: 1px solid #e5e7eb;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  height: 100%;
}

.location-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 40px rgba(15, 23, 42, 0.1) !important;
  border-color: #ffc72c;
}

.location-card-body {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.location-card-body h3 {
  font-size: 1.4rem;
  color: #0f172a;
  transition: color 0.3s ease;
}

.location-card:hover .location-card-body h3 {
  color: #ffc72c;
}

.location-description {
  font-size: 0.95rem;
  line-height: 1.6;
  flex-grow: 1;
}

.location-address {
  border-top: 1px solid #e5e7eb;
  padding-top: 0.75rem;
}

.location-address small {
  font-size: 0.85rem;
}

.location-footer {
  margin-top: auto;
}

.location-footer .btn {
  font-size: 0.95rem;
  font-weight: 600;
  padding: 0.6rem 1rem;
}

.location-footer .btn:hover {
  transform: translateX(4px);
}

.coverage-info-section {
  background: #ffffff;
}

.coverage-content h2 {
  font-size: 2.5rem;
  color: #0f172a;
  margin-bottom: 1.5rem;
}

.coverage-content p {
  font-size: 1rem;
  line-height: 1.7;
  color: #4b5563;
}

.coverage-list {
  list-style: none;
  padding: 0;
  margin: 1.5rem 0;
}

.coverage-list li {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
  font-size: 1rem;
  color: #1f2937;
}

.coverage-list i {
  font-size: 1.2rem;
}

.coverage-image {
  box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15);
}

.coverage-image img {
  min-height: 400px;
  object-fit: cover;
  width: 100%;
}

.transition-all {
  transition: all 0.3s ease;
}

/* Responsive */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2rem;
  }

  .section-title h2 {
    font-size: 2rem;
  }

  .coverage-content h2 {
    font-size: 1.75rem;
  }

  .location-card-image {
    height: 220px;
  }

  .coverage-image img {
    min-height: 300px;
  }
}

@media (max-width: 576px) {
  .section-title h2 {
    font-size: 1.5rem;
  }

  .location-card-body h3 {
    font-size: 1.2rem;
  }

  .location-description {
    font-size: 0.9rem;
  }
}
</style>