//import vue router
import { createRouter, createWebHistory } from "vue-router";
//define a routes
const routes = [
  {
    path: "/",
    name: "home",
    component: () => import(/* webpackChunkName: "home" */ "../views/home.vue"),
  },
  {
    path: "/edit/:id",
    name: "EditLaptop",
    component: () =>
      import(/* webpackChunkName: "index" */ "../views/EditLaptop.vue"),
  },
  {
    path: "/create",
    name: "CreateLaptop",
    component: () =>
      import(/* webpackChunkName: "create" */ "../views/Createlaptop.vue"),
  },
  {
    path: "/category",
    name: "Category",
    component: () =>
      import(/* webpackChunkName: "create" */ "../views/Category.vue"),
  },
];
//create router
const router = createRouter({
  history: createWebHistory(),
  routes, // <-- routes,
});
export default router;
