<template>
  <div class="top-navbar">
    <button class="login-btn">Se connecter</button>
    <div class="cart-icon" @click="$emit('open-cart')">
      🛒
      <span class="badge" v-if="cartCount > 0">{{ cartCount }}</span>
    </div>
  </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';

const props = defineProps<{
  cartCount: number;
}>();
</script>

<style scoped>
.top-navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  background: #fff;
  border-bottom: 1px solid #ccc;
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
  top: -10px;
  right: -10px;
  background: red;
  color: white;
  border-radius: 50%;
  padding: 2px 6px;
  font-size: 0.75rem;
}
</style>
