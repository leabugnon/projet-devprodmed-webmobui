<template>
  <div class="container">
    <!-- Affichage du message d'accueil -->
    <div class="welcome-message">
      <p>{{ welcomeMessage }}</p>
    </div>
    <!-- Liste des histoires avec gestion du chargement -->
    <ListeHistoires :stories="stories" :loading="loading" />
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import ListeHistoires from "../components/listeHistoires.vue";

const stories = ref([]);
const loading = ref(true);
const welcomeMessage = ref(""); // Variable pour stocker le message d'accueil

onMounted(async () => {
  try {
    // Récupération des histoires
    const response = await axios.get("/api/v1/stories");
    stories.value = response.data;
    console.log("Réponse API:", response.data);

    // Récupération du message d'accueil
    const welcomeResponse = await axios.get("/api/settings/welcome-message");
    welcomeMessage.value = welcomeResponse.data.welcome_message;
  } catch (error) {
    console.error("Erreur lors du chargement des données:", error);
  } finally {
    loading.value = false;
  }
});
</script>

<style scoped>
.welcome-message {
  font-size: 1.2rem;
  margin-bottom: 1rem;
  color: #000000;
  margin-left: 10px;
  margin-right: 10px;
  background-color: #e6f7ff;
}
</style>
