<template>
  <TheHeader />
  
  <main class="container">
    <router-view></router-view>
  </main>
  
  <TheFooter />
</template>

<script setup>
import TheHeader from './components/TheHeader.vue'
import TheFooter from './components/TheFooter.vue'
</script>
