<template>
  <div class="container">
    <!-- Affichage du message d'accueil -->
    <p v-if="welcomeMessage" class="welcome-message">{{ welcomeMessage }}</p>
    <!--liste des histoires-->
    <h1>📋 Liste des histoires 📋</h1>
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
import axios from "axios";

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
  color: #555;
  margin-left: 10px;
  margin-right: 10px;
}
</style>
