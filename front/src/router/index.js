// Importation des modules nécessaires pour configurer le routeur Vue
import { createRouter, createWebHistory } from "vue-router";
import LoginView from "../views/LoginView.vue";
import DashboardView from "../views/DashboardView.vue";
import HomeView from "../views/HomeView.vue";
import axios from "../axios";
import ChapterView from "../views/ChapterView.vue";

// Fonction utilitaire pour vérifier si l'utilisateur est authentifié
const isAuthenticated = async () => {
  try {
    const response = await axios.get("/api/user");
    return !!response.data; // Retourne `true` si l'utilisateur est connecté
  } catch {
    return false; // Retourne `false` si l'utilisateur n'est pas connecté
  }
};

// Définition des routes de l'application
const routes = [
  { path: "/story/:storyId", name: "StoryStart", component: ChapterView }, // Route pour afficher le début d'une histoire
  { path: "/chapter/:id", name: "Chapter", component: ChapterView }, // Route pour afficher un chapitre spécifique
  { path: "/", name: "Home", component: HomeView }, // Route pour la page d'accueil
  { path: "/", name: "home", component: HomeView }, // Duplication inutile de la route d'accueil
  { path: "/story/:id", name: "story", component: ChapterView }, // Duplication inutile de la route pour une histoire
  { path: "/login", name: "Login", component: LoginView }, // Route pour la page de connexion
  { path: "/chapter/:id", name: "chapter", component: ChapterView }, // Duplication inutile de la route pour un chapitre
  {
    path: "/dashboard", // Route pour le tableau de bord
    name: "Dashboard",
    component: DashboardView,
    beforeEnter: async (to, from, next) => {
      // Middleware pour vérifier l'authentification avant d'accéder au tableau de bord
      if (await isAuthenticated()) {
        next(); // L'utilisateur est connecté, accès autorisé
      } else {
        alert("Vous devez être connecté pour accéder au Dashboard.");
        next("/login"); // Redirige vers la page de connexion
      }
    },
  },
];

// Création et configuration du routeur Vue
const router = createRouter({
  history: createWebHistory(), // Utilisation de l'historique HTML5 pour les routes
  routes, // Assignation des routes définies
});

export default router; // Exportation du routeur pour l'utiliser dans l'application
