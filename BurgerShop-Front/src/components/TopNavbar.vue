<template>
  <div class="top-navbar">
    <button class="login-btn" @click="login">Se connecter</button>
    <button v-if="userStore.isAuthenticated" @click="logout">Déconnexion</button>
    <button @click="$emit('open-cart')" class="cart-button">
      🛒 <span class="badge">{{ cartCount }}</span>
    </button>
  </div>
</template>


<script setup lang="ts">
import { defineProps } from 'vue';
import { useUserStore } from '../store/user';
import { useRouter } from 'vue-router';
import LoginForm from './LoginForm.vue';

const userStore = useUserStore();
const router = useRouter();
const logout = () => {
  userStore.logout();
  router.push('/login');
};
const login = () => {
  router.push('/login');
};
const props = defineProps<{
  cartCount: number;
}>();
</script>

<style scoped>
.top-navbar {
  display: flex;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  position: fixed;
  left: 0;
  top: 0;
  width: 100vw;  
  padding: 1rem;
  background: #fff;
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
.cart-button{
  margin-left: 90%;
}
.badge {
  position: absolute;
  background: red;
  color: white;
  border-radius: 50%;
  padding: 2px 6px;
  font-size: 0.75rem;
}
.login-btn {
  padding: 0.5rem 1rem;
  background-color: black;
  color: white;
  border: none;
  border-radius: 20px;
  width: 50%;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
button:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}
</style>
