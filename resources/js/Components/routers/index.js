import { createRouter, createWebHistory } from "vue-router";
import axiosInstance from "../plugins/axios.js";
import { isUserAuthenticated, verifyToken, initSessionTimeout } from "../middleware/auth.js";
import AdminLayout from "../adminPage/layouts/contentWrapper.vue";
import UserLayout from "../userPage/layouts/ContentWrapper.vue";
import AdminHome from "../adminPage/Pages/home.vue";
import LoginPage from "../adminPage/Pages/login.vue";
import UserHome from "../userPage/Pages/home.vue";
import UserSingleService from "../userPage/Pages/singleService.vue";
import ServicePage from "../userPage/Pages/service.vue";
import PolicyPage from "../userPage/Pages/policy.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/admin/login",
      name: "admin.login",
      component: LoginPage,
    },
    {
      path: "/admin",
      component: AdminLayout,
      beforeEnter: async (to, from, next) => {
        if (!isUserAuthenticated()) {
          next({ name: 'admin.login' });
          return;
        }

        // Verify token is still valid with server
        const isValid = await verifyToken();
        if (!isValid) {
          localStorage.removeItem('token');
          localStorage.removeItem('user');
          next({ name: 'admin.login', query: { invalid_token: 'true' } });
          return;
        }

        // Initialize session timeout on first admin access
        initSessionTimeout();
        next();
      },
      children: [{ path: "", name: "admin.home", component: AdminHome },
                 { path: "testimonial", name: "admin.testimonial", component: () => import("../adminPage/Pages/testimonial.vue") },
                 { path: "users", name: "admin.users", component: () => import("../adminPage/Pages/user.vue") },
                 { path: "profile", name: "admin.profile", component: () => import("../adminPage/Pages/profile.vue") },
                 { path: "contact", name: "admin.contact", component: () => import("../adminPage/Pages/contact.vue") },
      ],
    },
    {
      path: "/",
      component: UserLayout,
      children: [
        { path: "", name: "user.home", component: UserHome },
        { path: "services", name: "user.services", component: ServicePage },
        { path: "about", name: "user.about", component: () => import("../userPage/Pages/about.vue") },
        { path: "services/:id", name: "user.singleService", component: UserSingleService },
        { path: "contact", name: "user.contact", component: () => import("../userPage/Pages/contact.vue") },
        { path: "policy", name: "user.policy", component: PolicyPage },
        { path: "location", name: "user.location", component: () => import("../userPage/Pages/location.vue") },
        { path: "location/:id", name: "user.locationDetail", component: () => import("../userPage/Pages/locationDetail.vue") },
      ],
    },
  ],
});

export default router;