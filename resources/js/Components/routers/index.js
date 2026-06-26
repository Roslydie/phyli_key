import { createRouter, createWebHistory } from "vue-router";
import axiosInstance from "../plugins/axios.js";
import AdminLayout from "../adminPage/layouts/contentWrapper.vue";
import UserLayout from "../userPage/layouts/ContentWrapper.vue";
import AdminHome from "../adminPage/Pages/home.vue";
import UserHome from "../userPage/Pages/home.vue";
import UserSingleService from "../userPage/Pages/singleService.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/admin",
      component: AdminLayout,
      children: [{ path: "", name: "admin.home", component: AdminHome }],
    },
    {
      path: "/",
      component: UserLayout,
      children: [
        { path: "", name: "user.home", component: UserHome },
        { path: "service", name: "user.singleService", component: UserSingleService },
      ],
    },
  ],
});

export default router;