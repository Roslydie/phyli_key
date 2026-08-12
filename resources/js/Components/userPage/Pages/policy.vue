<template>
  <div role="main" class="main policy-page">
    <section class="section section-height-2 border-0 m-0 p-0 position-relative overflow-hidden policy-hero-section pt-5">
      <div class="section-overlay"></div>
      <div class="container py-6 position-relative z-index-2">
        <div class="row justify-content-center text-center">
          <div class="col-lg-8">
            <span class="letter-spacing-3 mb-3 d-inline-block" style="color: yellow;">
              <RouterLink to="/" class="text-warning text-decoration-none">Home</RouterLink>
              <span class="mx-2 text-white">/</span>
              <strong>Privacy Policy</strong>
            </span>
            <h1 class="font-weight-bold text-white display-5 mb-3">Privacy Policy & Terms of Service</h1>
            <p class="text-white-75 lead mb-0">How we collect, protect, and use information to provide trusted locksmith services across Philadelphia and South Jersey.</p>
            <p class="text-white-75 mt-3 mb-0"><strong>Last updated:</strong> August 11, 2026</p>
          </div>
        </div>
      </div>
    </section>

    <section class="section bg-light border-0 m-0 py-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="policy-card rounded-5 bg-white shadow-sm p-4 p-lg-5">
              <p class="lead text-muted mb-2">
                Tire and Key Express values your privacy and is committed to protecting the personal information you share with us.
                This policy explains how we collect, use, safeguard, and disclose information when you contact us, request a service, or visit our website.
              </p>
              <p class="text-muted mb-4"><strong>Last updated:</strong> August 11, 2026</p>

              <div class="policy-content">
                <div class="policy-section mb-5">
                  <h2>1. Information We Collect</h2>
                  <p>We may collect information you provide directly, including your name, email address, phone number, service type, property location, and message details when you request a quote or contact our team. We also collect technical information such as browser type, device information, IP address, and website usage data to improve our services and website experience.</p>
                </div>

                <div class="policy-section mb-5">
                  <h2>2. How We Use Your Information</h2>
                  <p>We use your information to respond to service requests, schedule locksmith visits, confirm appointments, provide service updates, improve customer support, and communicate important information about your request. We may also use your contact details to send service confirmations, emergency follow-ups, and occasional updates related to our business.</p>
                </div>

                <div class="policy-section mb-5">
                  <h2>3. Sharing of Information</h2>
                  <p>We do not sell, rent, or trade your personal information with third parties for marketing purposes. We may share limited information with trusted service providers who help operate our business, such as email or communication tools, website hosting, analytics, or customer support services. These partners are required to protect your information and use it only for the intended business purpose.</p>
                </div>

                <div class="policy-section mb-5">
                  <h2>4. Cookies and Website Analytics</h2>
                  <p>Our website may use cookies, analytics tools, and similar technologies to understand visitor behavior, improve functionality, and enhance user experience. These tools may collect information such as page visits, referral sources, and general device details. You may disable cookies in your browser settings, but some parts of the website may not function properly as a result.</p>
                </div>

                <div class="policy-section mb-5">
                  <h2>5. Security Measures</h2>
                  <p>We take reasonable steps to protect customer information from unauthorized access, disclosure, alteration, or destruction. This includes secure storage practices, restricted access to personal data, and careful handling of information submitted through our contact forms or service requests. While we work to protect your information, no online system can be guaranteed to be completely secure.</p>
                </div>

                <div class="policy-section mb-5">
                  <h2>6. Retention of Information</h2>
                  <p>We retain customer information only as long as necessary to fulfill our service obligations, manage inquiries, comply with legal requirements, and improve our business operations. If you no longer wish to receive communications from us, you may contact us at any time to request removal from our contact list.</p>
                </div>

                <div class="policy-section mb-5">
                  <h2>7. Your Rights</h2>
                  <p>You may request access to the information we hold about you, ask for corrections, or request that your data be deleted where appropriate. If you would like to review, update, or remove your information, please contact us using the details provided below. We will respond to reasonable requests in accordance with applicable privacy laws.</p>
                </div>

                <div class="policy-section mb-5">
                  <h2>8. Contact Us</h2>
                  <p>If you have questions about this Privacy Policy or how we handle your information, please contact us:</p>
                  <ul class="contact-list">
                    <li><strong>Email:</strong> techr7129@gmail.com</li>
                    <li><strong>Phone:</strong> 2679242208</li>
                    <li><strong>Address:</strong> 6544 Essington Ave, Philadelphia, PA 19153</li>
                  </ul>
                </div>

                <div class="policy-section mb-0">
                  <h2>9. Policy Updates</h2>
                  <p>We may update this policy from time to time to reflect changes in legal requirements, customer needs, or business practices. Any changes will be posted on this page with the updated revision date. This policy was last updated on August 11, 2026. We encourage you to review this page periodically for the latest information.</p>
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
import { RouterLink } from 'vue-router';
</script>

<style scoped>
.policy-hero-section {
  background-image: linear-gradient(180deg, rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.95)), url('/assets/img/demos/auto-services/service2.jpg');
  background-size: cover;
  background-position: center;
}

.section-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(15, 23, 42, 0.20), rgba(15, 23, 42, 0.55));
}

.policy-card {
  border: 1px solid rgba(15, 23, 42, 0.06);
}

.policy-content h2 {
  font-size: clamp(1.5rem, 2vw, 2rem);
  font-weight: 700;
  color: #0f172a;
  margin-bottom: 0.9rem;
}

.policy-content p,
.policy-content li {
  color: #475569;
  line-height: 1.8;
  font-size: 1.02rem;
}

.contact-list {
  list-style: none;
  padding: 0;
  margin: 1rem 0 0;
}

.contact-list li {
  margin-bottom: 0.5rem;
}
</style>