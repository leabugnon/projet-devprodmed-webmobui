<template>
  <div>
    <h1>Bienvenue sur le Dashboard 🎉</h1>
    <p>Vous êtes connecté·e.</p>
    <div class="welcome-message-form">
      <h2>Modifier le message d'accueil</h2>
      <form @submit.prevent="updateWelcomeMessage">
        <textarea
          v-model="welcomeMessage"
          placeholder="Entrez le nouveau message d'accueil"
          class="form-control"
          rows="3"
          required
        ></textarea>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
      </form>
      <p v-if="successMessage" class="success-message">{{ successMessage }}</p>
      <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
    </div>
    <h2>📋 Liste des histoires</h2>
    <div v-if="loading">Chargement des histoires...</div>
    <ul v-else>
      <li v-for="story in stories" :key="story.id">
        <router-link :to="`/story/${story.id}`">
          {{ story.title }}
        </router-link>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "../axios";

const stories = ref([]);
const loading = ref(true);

// Variables pour le message d'accueil
const welcomeMessage = ref(""); // Stocke le message d'accueil
const successMessage = ref(""); // Message de succès
const errorMessage = ref(""); // Message d'erreur

onMounted(async () => {
  try {
    const response = await axios.get("/api/v1/stories");
    stories.value = response.data;
    console.log("Réponse API:", response.data);
  } catch (error) {
    console.error("Erreur lors du chargement des histoires :", error);
  } finally {
    loading.value = false;
  }
});

// Fonction pour récupérer le message d'accueil actuel
const fetchWelcomeMessage = async () => {
  try {
    const response = await axios.get("/api/settings/welcome-message");
    welcomeMessage.value = response.data.welcome_message; // Met à jour le message d'accueil
    console.log("Réponse API pour le message d'accueil :", response.data); // Vérifiez ici
  } catch (error) {
    console.error("Erreur lors de la récupération du message d'accueil :", error);
  }
};

// Fonction pour mettre à jour le message d'accueil
const updateWelcomeMessage = async () => {
  try {
    const response = await axios.put("/api/settings/welcome-message", {
      welcome_message: welcomeMessage.value,
    });
    successMessage.value = response.data.message; // Affiche le message de succès
    errorMessage.value = ""; // Réinitialise le message d'erreur
  } catch (error) {
    console.error("Erreur lors de la mise à jour du message d'accueil :", error);
    errorMessage.value = "Une erreur est survenue lors de la mise à jour.";
    successMessage.value = ""; // Réinitialise le message de succès
  }
};

// Récupère le message d'accueil actuel au montage du composant
onMounted(fetchWelcomeMessage);
</script>

<style scoped>
/* Styles pour le formulaire */
.welcome-message-form {
  margin-top: 20px;
}
.form-control {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

/* Les styles scoped sont utilisés ici pour des ajustements spécifiques au composant DashboardView.
   Cela permet d'éviter que ces styles n'affectent d'autres composants de l'application. */

/* Les styles globaux (dans style.css) sont utilisés pour des éléments réutilisables ou des thèmes communs.
   Par exemple, les boutons ou les messages d'accueil peuvent avoir un style global pour assurer une cohérence visuelle dans toute l'application. */

.success-message {
  color: green;
  margin-top: 10px;
}

.error-message {
  color: red;
  margin-top: 10px;
}
</style>
