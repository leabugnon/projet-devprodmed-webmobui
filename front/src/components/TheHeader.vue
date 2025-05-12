<template>
  <!-- Le header principal de l'application -->
  <header class="header">
    <nav class="nav">
      <!-- Logo de l'application -->
      <h1 class="logo">Fiction Interactive 📖</h1>
      <!-- Zone de navigation -->
      <div class="nav-links">
        <!-- Lien vers le Dashboard si l'utilisateur est connecté -->
        <router-link v-if="userState.user" to="/dashboard" class="btn dashboard-btn"
          >Dashboard</router-link
        >
        <!-- Lien vers la page d'accueil si l'utilisateur est déconnecté -->
        <router-link v-else to="/" class="btn home-btn">Accueil</router-link>
      </div>
      <!-- Zone d'authentification -->
      <div class="auth-zone">
        <!-- Message de bienvenue si l'utilisateur est connecté -->
        <!-- <span v-if="userState.user" class="welcome-message">Bonjour {{ userState.user.name }} !</span> -->
        <!-- Bouton de déconnexion si l'utilisateur est connecté -->
        <a v-if="isLoggedIn" href="#" class="btn logout-btn" @click.prevent="logout">
          Se déconnecter
        </a>
        <!-- Lien vers la page de connexion si l'utilisateur n'est pas connecté -->
        <router-link v-else to="/login" class="btn login-btn">Se connecter</router-link>
      </div>
    </nav>
  </header>
</template>

<script setup>
import { computed, onMounted } from 'vue'
import { userState } from '../store/userState'
import { useRouter } from 'vue-router'
import axios from '../axios'
const router = useRouter();
// Réactif à userState.user
const isLoggedIn = computed(() => !!userState.user)
// Fonction pour récupérer les informations de l'utilisateur connecté
const fetchUser = async () => {
  try {
    const response = await axios.get("/api/user"); // Appel à l'API pour récupérer l'utilisateur
    userState.user = response.data; // Met à jour l'utilisateur dans la variable globale
  } catch {
    userState.user = null; // Si une erreur survient, l'utilisateur est considéré comme déconnecté
  }
};

// Fonction pour gérer la déconnexion de l'utilisateur
const logout = async () => {
  try {
    await axios.get("/sanctum/csrf-cookie"); // Récupération du cookie CSRF
    await axios.post("/logout"); // Appel à l'API pour déconnecter l'utilisateur
    userState.user = null; // Réinitialise les données de l'utilisateur
    alert("Déconnecté avec succès !"); // Message de confirmation
    router.push("/"); // Redirection vers la page d'accueil
  } catch (error) {
    console.error("Erreur lors de la déconnexion :", error); // Affiche l'erreur dans la console
    alert("Une erreur est survenue lors de la déconnexion."); // Message d'erreur
  }
};

// Appelle `fetchUser` lorsque le composant est monté pour vérifier si l'utilisateur est connecté
onMounted(fetchUser);
</script>

<style scoped>
/* Styles pour le header */
.header {
  position: sticky; /* Le header reste visible en haut lors du défilement */
  top: 0;
  z-index: 1000; /* Priorité d'affichage élevée */
  background-color: #1a202c; /* Couleur sombre */
  color: #fff; /* Texte blanc */
  padding: 1rem 2rem; /* Espacement interne */
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Ombre pour un effet de profondeur */
  display: flex;
  justify-content: space-between;
  align-items: center;
}

/* Styles pour la navigation */
.nav {
  display: flex;
  align-items: center;
  width: 100%;
}

/* Style du logo */
.logo {
  font-size: 1.8rem; /* Taille du texte */
  font-weight: bold; /* Texte en gras */
  color: #f7fafc; /* Couleur claire */
}

/* Zone de navigation */
.nav-links {
  margin-left: auto; /* Pousse les liens vers la droite */
  display: flex;
  gap: 1.5rem; /* Augmente l'espacement entre les liens */
}
/* Bouton Dashboard */
.dashboard-btn {
  background-color: #38a169; /* Vert */
  color: #fff; /* Texte blanc */
  padding: 0.5rem 1rem;
  border-radius: 5px;
  text-decoration: none;
}

.dashboard-btn:hover {
  background-color: #2f855a; /* Vert foncé au survol */
}

/* Bouton Accueil */
.home-btn {
  background-color: #3182ce; /* Bleu */
  color: #fff; /* Texte blanc */
  padding: 0.5rem 1rem;
  border-radius: 5px;
  text-decoration: none;
}

.home-btn:hover {
  background-color: #2b6cb0; /* Bleu foncé au survol */
}

/* Zone d'authentification */
.auth-zone {
  display: flex;
  align-items: center;
  gap: 2rem;
}

/* Message de bienvenue */
/*pas utilisé */
.welcome-message {
  font-size: 1rem; /* Taille du texte */
  color: #cbd5e0; /* Couleur grise claire */
}

/* Styles généraux pour les boutons */
.btn {
  padding: 0.5rem 1rem; /* Espacement interne */
  font-size: 1rem; /* Taille du texte */
  border: none; /* Pas de bordure */
  border-radius: 5px; /* Coins arrondis */
  cursor: pointer; /* Curseur pointeur */
  transition: background-color 0.3s ease; /* Transition pour l'effet au survol */
  margin: 5px;
}

/* Bouton de connexion */
.login-btn {
  background-color: #3182ce; /* Bleu */
  color: #fff; /* Texte blanc */
}

.login-btn:hover {
  background-color: #2b6cb0; /* Bleu foncé au survol */
}

/* Bouton de déconnexion */
.logout-btn {
  background-color: #e53e3e; /* Rouge */
  color: #fff; /* Texte blanc */
}

.logout-btn:hover {
  background-color: #c53030; /* Rouge foncé au survol */
}
</style>
