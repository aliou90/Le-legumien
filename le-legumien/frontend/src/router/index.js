import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/Home.vue";
import AdminList from "../pages/admin/AdminList.vue";
import AdminEdit from "../pages/admin/AdminEdit.vue";

export default createRouter({
  history: createWebHistory(),
  routes: [
    { path: "/", name: "home", component: Home },
    { path: "/admin", name: "admin", component: AdminList },
    { path: "/admin/edit/:id?", name: "admin-edit", component: AdminEdit, props: true },
  ]
});
