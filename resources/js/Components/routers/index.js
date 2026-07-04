import { createRouter, createWebHistory } from "vue-router";
import axiosInstance from "../plugins/axios.js";
import AdminLayout from "../adminPage/layouts/contentWrapper.vue";
import UserLayout from "../userPage/layouts/ContentWrapper.vue";
import AdminHome from "../adminPage/Pages/home.vue";
import UserHome from "../userPage/Pages/home.vue";
import UserSingleService from "../userPage/Pages/singleService.vue";
import ServicePage from "../userPage/Pages/service.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/admin",
      component: AdminLayout,
      children: [{ path: "", name: "admin.home", component: AdminHome },
                 { path: "testimonial", name: "admin.testimonial", component: () => import("../adminPage/Pages/testimonial.vue") },
                 { path: "users", name: "admin.users", component: () => import("../adminPage/Pages/user.vue") },
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
        { path: "location", name: "user.location", component: () => import("../userPage/Pages/location.vue") },
        { path: "location/:id", name: "user.locationDetail", component: () => import("../userPage/Pages/locationDetail.vue") },
      ],
    },
  ],
});

export default router;