<template>
    <div class="confirmation">
      <h1>Merci pour votre commande N°{{ orderId }}</h1>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref, onMounted } from 'vue';
  import { useRoute } from 'vue-router';
  
  const route = useRoute();
  const orderId = ref('');
  
  onMounted(() => {
    orderId.value = route.params.orderId as string || 'inconnue';
  });
  </script>
  
  <style scoped>
  html, body, #app {
  margin: 0;
  padding: 0;
  height: 100%;
  width: 100%;
}
  
.confirmation {
  height: 100vh;
  width: 100vw;
  background-color: #2ecc71;
  color: white;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 2rem;
  font-weight: bold;
  text-align: center;
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}
  </style>
  