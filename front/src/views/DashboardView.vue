<template>
  <div class="dashboard-container">
    <div class="bienvenue">
      <h1>🎉 Bienvenue sur le Dashboard 🎉</h1>
      <p>Vous êtes connecté·e.</p>
    </div>

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

    <!-- Liste des histoires avec gestion du chargement -->
    <ListeHistoires :stories="stories" :loading="loading" />
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "../axios";
import ListeHistoires from "../components/listeHistoires.vue";

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
.dashboard-container {
  max-width: 900px;
  margin: 2rem auto;
  padding: 2rem;
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.bienvenue {
  text-align: center;
  margin-bottom: 2rem;
  padding: 1.5rem;
  background-color: #e6f7ff;
  border-radius: 10px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.welcome-message-form {
  margin-top: 2rem;
}

.form-control {
  width: 100%;
  padding: 10px;
  margin-bottom: 1rem;
  border: 1px solid #d1d5db;
  border-radius: 5px;
  font-size: 1rem;
  align-items: center;
  resize: none;
}

.success-message {
  color: #38a169;
  margin-top: 1rem;
  font-weight: bold;
}

.error-message {
  color: #e53e3e;
  margin-top: 1rem;
  font-weight: bold;
}

.section-title {
  font-size: 1.8rem;
  color: #2d3748;
  margin-bottom: 1rem;
  text-align: left;
}

.loading {
  text-align: center;
  font-size: 1.2rem;
  color: #4a5568;
}
</style>
