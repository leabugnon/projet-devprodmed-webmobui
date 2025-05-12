<template>
  <div>
    <h2>📋 Liste des histoires 📋</h2>
    <div v-if="loading" class="loading">Chargement des histoires...</div>
    <ul v-else class="story-list">
      <li v-for="story in stories" :key="story.id" class="story-item">
        <router-link :to="`/story/${story.id}`" class="story-link">
          <div class="story-content">
            {{ story.title }}
          </div>
        </router-link>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { defineProps } from "vue";

defineProps({
  stories: {
    type: Array,
    required: true,
  },
  loading: {
    type: Boolean,
    required: true,
  },
});
</script>

<style scoped>


.loading {
  text-align: center;
  font-size: 1.2rem;
  color: #4a5568;
}

.story-list {
  list-style: none;
  padding: 0;
}

.story-item {
  margin-bottom: 1rem;
}

.story-link {
  display: block;
  background: #e6f7ff;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  padding: 1rem;
  text-decoration: none;
  color: #000000;
  font-weight: 600;
  transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.3s ease;
}

.story-link:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  background-color: #8ebae6;
}

.story-content {
  font-size: 1rem;
}
</style>
