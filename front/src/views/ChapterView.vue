<template>
  <div class="container">
    <h1>{{ chapter?.title }}</h1>

    <p>{{ chapter?.content }}</p>

    <img
      v-if="chapter?.story_id && chapter?.id"
      :src="`/images/${chapter.story_id}/${chapter.id}.png`"
      alt="Image du chapitre"
      class="image"
    />

    <!-- ✅ Afficher les choix si disponibles -->
    <div v-if="chapter?.choices?.length > 0">
      <h2>Que veux-tu faire ?</h2>
      <ul>
        <li v-for="choice in chapter.choices" :key="choice.id">
          <button @click="goToChoice(choice.target_chapter_id)">
            {{ choice.label }}
          </button>
        </li>
      </ul>
    </div>

    <!-- ✅ Si c'est un chapitre de fin -->
    <div v-else-if="chapter?.is_end">
      <h2>🏁 Fin de l'histoire !</h2>
    </div>

    <!-- ✅ Si ni choix ni fin connue -->
    <div v-else>
      <h2>Aucune action disponible pour le moment...</h2>
    </div>
  </div>
</template>


<script setup>
import { ref, onMounted, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import axios from "axios";

const route = useRoute();
const router = useRouter();
const story = ref({});
const chapters = ref([]);
const chapter = ref(null);

// Fonction pour charger un chapitre depuis l'API
const loadChapter = async (id) => {
  try {
    const response = await axios.get(`/api/v1/chapters/${id}`);
    chapter.value = response.data;
    console.log(chapter.value.id);
  } catch (error) {
    console.error("Erreur lors du chargement du chapitre:", error);
  }
};

// Au démarrage du composant, on charge le chapitre courant
onMounted(async () => {
  try {
    const response = await axios.get(`/api/v1/stories/${route.params.storyId}`);
    story.value = response.data.story;
    chapters.value = response.data.story.chapters;

    //Si l’URL contient un id de chapitre, on le charge
    if (route.params.id) {
      loadChapter(route.params.id);
    } else {
      //Sinon, on charge le chapitre de départ
      chapter.value = response.data.starting_chapter;
    }
  } catch (error) {
    console.error("Erreur lors du chargement de l'histoire :", error);
  }
});

// Si on clique sur un choix, on change de chapitre
const goToChoice = (targetId) => {
  router.push(`/chapter/${targetId}`);
};

// Quand l'URL change (nouveau chapitre), on recharge
watch(
  () => route.params.id,
  (newId) => {
    loadChapter(newId);
  }
);
</script>
