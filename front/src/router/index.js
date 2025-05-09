import { createRouter, createWebHistory } from "vue-router";
import LoginView from "../views/LoginView.vue";
import DashboardView from "../views/DashboardView.vue";
import HomeView from "../views/HomeView.vue";
import axios from "../axios";
import ChapterView from "../views/ChapterView.vue";

const isAuthenticated = async () => {
  try {
    const response = await axios.get("/api/user");
    return !!response.data; // Retourne `true` si l'utilisateur est connecté
  } catch {
    return false; // Retourne `false` si l'utilisateur n'est pas connecté
  }
};

const routes = [
  {
    path: "/story/:storyId",
    name: "StoryStart",
    component: ChapterView,
  },
  {
    path: "/chapter/:id",
    name: "Chapter",
    component: ChapterView,
  },
  { path: "/", name: "Home", component: HomeView },
  { path: "/", name: "home", component: HomeView },
  { path: "/story/:id", name: "story", component: ChapterView },
  { path: "/login", name: "Login", component: LoginView },
  { path: "/chapter/:id", name: "chapter", component: ChapterView },
  {
    path: "/dashboard",
    name: "Dashboard",
    component: DashboardView,
    beforeEnter: async (to, from, next) => {
      if (await isAuthenticated()) {
        next(); // L'utilisateur est connecté, accès autorisé
      } else {
        alert("Vous devez être connecté pour accéder au Dashboard.");
        next("/login"); // Redirige vers la page de connexion
      }
    },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
