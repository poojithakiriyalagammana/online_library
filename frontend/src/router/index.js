import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import Register from "@/views/Register.vue";
import Login from "@/views/Login.vue";
import BookList from "@/views/BookList.vue";
import BookCreate from "@/views/BookCreate.vue";
import ViewAllBooks from "@/views/ViewAllBooks.vue";
import Cart from "@/views/Cart.vue";
import Home from "@/views/Home.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/register",
      name: "register",
      component: Register,
    },
    {
      path: "/login",
      name: "login",
      component: Login,
    },
    {
      path: "/books",
      name: "BookList",
      component: BookList,
    },
    {
      path: "/books/create",
      name: "BookCreate",
      component: BookCreate,
    },
    {
      path: "/books/view-all",
      name: "ViewAllBooks",
      component: ViewAllBooks,
    },
    {
      path: "/cart",
      name: "Cart",
      component: Cart,
    },
    {
      path: "/home2",
      name: "home2",
      component: Home,
    },
  ],
});

export default router;
