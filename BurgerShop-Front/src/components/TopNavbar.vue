<template>
  <div class="top-navbar">
    <button class="login-btn">Se connecter</button>
    <button @click="$emit('open-cart')" class="cart-button">
      🛒 <span class="badge">{{ cartCount }}</span>
    </button>
  </div>
</template>


<script setup lang="ts">
import { defineProps } from 'vue';

const props = defineProps<{
  cartCount: number;
}>();
</script>

<style scoped>
.cart-button {
  display: flex;
  align-items: center;
  background: none;
  border: none;
  cursor: pointer;
  font-size: 1.5rem;
  position: relative;
}
.top-navbar {
  
  display: flex;
  /* justify-content: space-between; */
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  position: fixed;
  left: 0;
  top: 0;
  width: 100vw;  
  /* z-index: 1000;  */
  /* align-items: center; */
  padding: 1rem;
  background: #fff;
  /* border-bottom: 1px solid #ccc; */
}
.login-btn {
  padding: 0.5rem 1rem;
  border: none;
  background-color: black;
  color: white;
  border-radius: 20px;
}
.cart-icon {
  position: relative;
  font-size: 1.5rem;
  cursor: pointer;
} 
.badge {
  position: absolute;
  /* top: -10px; */
  /* right: -10px; */
  background: red;
  color: white;
  border-radius: 50%;
  padding: 2px 6px;
  font-size: 0.75rem;
}
</style>
