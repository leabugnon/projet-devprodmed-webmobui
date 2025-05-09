<template>
  <!-- Conteneur principal de la page de connexion -->
  <div class="login-container">
    <!-- Titre de la page de connexion -->
    <h2 class="login-title">Connexion</h2>
    <!-- Formulaire de connexion -->
    <form @submit.prevent="login" class="login-form">
      <!-- Champ pour l'email -->
      <input v-model="email" type="email" placeholder="Email" class="login-input" required />
      <!-- Champ pour le mot de passe -->
      <input
        v-model="password"
        type="password"
        placeholder="Mot de passe"
        class="login-input"
        required
      />
      <!-- Bouton pour soumettre le formulaire -->
      <button type="submit" class="login-button">Se connecter</button>
    </form>
  </div>
</template>
<script setup>
import { ref } from "vue";
import axios from "../axios";
import { useRouter } from "vue-router";
import { userState } from "../store/userState"; // Importation de la variable réactive globale

const email = ref("");
const password = ref("");
const router = useRouter();

const login = async () => {
  try {
    await axios.get("/sanctum/csrf-cookie"); // obligatoire AVANT
    const response = await axios.post("/login", {
      email: email.value,
      password: password.value,
    });
    userState.user = response.data; // Met à jour l'utilisateur dans la variable globale
    alert("✅ Connecté avec succès");
    router.push("/dashboard"); // Redirection vers le Dashboard
  } catch (error) {
    console.error(error);
    alert("❌ Email ou mot de passe incorrect");
  }
};
</script>

<style scoped>
/* Conteneur principal pour la page de connexion */
.login-container {
  max-width: 400px; /* Largeur maximale du conteneur */
  margin: 50px auto; /* Centrage vertical et horizontal */
  padding: 20px; /* Espacement interne */
  background-color: #f7fafc; /* Couleur de fond claire */
  border-radius: 10px; /* Coins arrondis */
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Ombre pour un effet de profondeur */
  text-align: center; /* Centrage du texte */
}

/* Titre de la page de connexion */
.login-title {
  font-size: 1.8rem; /* Taille de la police */
  font-weight: bold; /* Texte en gras */
  color: #2d3748; /* Couleur sombre */
  margin-bottom: 20px; /* Espacement sous le titre */
}

/* Formulaire de connexion */
.login-form {
  display: flex; /* Utilisation de flexbox */
  flex-direction: column; /* Empile les champs verticalement */
  gap: 15px; /* Espacement entre les champs */
}

/* Champs de saisie */
.login-input {
  padding: 10px; /* Espacement interne */
  font-size: 1rem; /* Taille de la police */
  border: 1px solid #cbd5e0; /* Bordure grise claire */
  border-radius: 5px; /* Coins arrondis */
  outline: none; /* Supprime le contour par défaut */
  transition: border-color 0.3s ease; /* Transition pour l'effet au focus */
}

.login-input:focus {
  border-color: #3182ce; /* Bordure bleue au focus */
}

/* Bouton de connexion */
.login-button {
  padding: 10px; /* Espacement interne */
  font-size: 1rem; /* Taille de la police */
  font-weight: bold; /* Texte en gras */
  color: #fff; /* Texte blanc */
  background-color: #3182ce; /* Couleur bleue */
  border: none; /* Pas de bordure */
  border-radius: 5px; /* Coins arrondis */
  cursor: pointer; /* Curseur pointeur */
  transition: background-color 0.3s ease; /* Transition pour l'effet au survol */
}

.login-button:hover {
  background-color: #2b6cb0; /* Bleu foncé au survol */
}
</style>
