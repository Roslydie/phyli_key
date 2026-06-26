
<template>

    <header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyStartAt': 54, 'stickySetTop': '-54px', 'stickyChangeLogo': false}">
				<div class="header-body header-body-bottom-border-fixed box-shadow-none border-top-0">
					
					<div class="header-container container">
						<div class="header-row">
							<div class="header-column w-100">
								<div class="header-row justify-content-between">
									<div class="header-logo z-index-2 col-lg-2 px-0">
										<RouterLink to="/">
											<img alt="Porto" width="123" height="68" data-sticky-width="82" data-sticky-height="60" data-sticky-top="84" src="/assets/img/demos/auto-services/log.png" data-img-suffix-primary="">
										</RouterLink>
									</div>
									<div class="header-nav header-nav-links justify-content-end pe-lg-4 me-lg-3">
										<div class="header-nav-main header-nav-main-arrows header-nav-main-dropdown-no-borders header-nav-main-effect-3 header-nav-main-sub-effect-1">
												<nav class="d-flex align-items-center">
													<ul class="nav nav-pills flex-wrap mb-0" id="mainNav">
														<li class="nav-item">
															<RouterLink to="/" exact-active-class="active" class="nav-link text-capitalize">Home</RouterLink>
														</li>
														<li class="nav-item">
															<RouterLink to="/services" exact-active-class="active" class="nav-link text-capitalize">Services</RouterLink>
														</li>
														<li class="nav-item">
															<RouterLink to="/locations" exact-active-class="active" class="nav-link text-capitalize">Locations</RouterLink>
														</li>
														<li class="nav-item">
															<RouterLink to="/about" exact-active-class="active" class="nav-link text-capitalize">About Us</RouterLink>
														</li>
														<li class="nav-item">
															<RouterLink to="/contact" exact-active-class="active" class="nav-link text-capitalize">Contact</RouterLink>
													</li>
												</ul>
											</nav>
										</div>
									</div>
									<ul class="header-extra-info custom-left-border-1 d-none d-xl-block">
										<li class="d-none d-sm-inline-flex ms-0">
											<div class="header-extra-info-icon">
												<i class="icons icon-phone text-3 position-relative top-3" style="color: white;"></i>
											</div>
											<div class="header-extra-info-text btn btn-primary px-4 py-2">
    <span class="d-block text-white">CALL US NOW</span>
    <strong>
        <a href="tel:+1234567890" class="text-white text-decoration-none">
            +123 4567 890
        </a>
    </strong>
</div>
										</li>
									</ul>
									
									<button class="btn header-btn-collapse-nav ms-4" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
										<i class="fas fa-bars"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
</template>

<style scoped>
header {
  position: relative;
  z-index: 1000;
}

header,
.header-body,
.header-container,
.header-row,
.header-nav,
.header-nav-main,
.header-logo,
.header-extra-info {
  background-color: #000000 !important;
  background: #000000 !important;
}

.header-body {
  border-bottom: 1px solid rgba(255,255,255,0.08);
}

.header-container {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}

.header-logo img {
  width: 170px;
 
  height: 100px;
}

.nav-link {
  color: #f9fafb !important;
  font-weight: 600;
  padding: 0.6rem 0.9rem;
}

.nav-link:hover,
.nav-link.active {
  color: #fbbf24 !important;
}

.header-extra-info-text {
  background: #fbbf24 !important;
  border: none;
  color: #111827 !important;
  border-radius: 999px;
  padding: 0.55rem 1rem;
  display: inline-flex;
  flex-direction: column;
  align-items: flex-start;
  box-shadow: 0 8px 20px rgba(251, 191, 36, 0.2);
}

.header-extra-info-text span {
  color: #111827 !important;
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}

.header-extra-info-text a {
  color: #111827 !important;
  font-weight: 700;
}

.header-btn-collapse-nav {
  color: #ffffff;
  border: 1px solid rgba(255,255,255,0.2);
}
</style>