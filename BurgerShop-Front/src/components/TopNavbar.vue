<template>
  <div class="top-navbar">
    <div class="navbar-left">
      <h1>Burger Shop</h1>
      <img :src="logo" alt="Burger Shop Logo" style="width: 50px; height: 50px; margin-left: 10px;" />
    </div>
    <div class="navbar-right">
      <template v-if="!userStore.isAuthenticated">
        <button class="login-btn" @click="login">Se connecter</button>
        <button class="register-btn" @click="register">S'inscrire</button>
      </template>

      <button class="register-btn" v-else @click="logout">Déconnexion</button>

      <button @click="$emit('open-cart')" class="cart-button" v-if="userStore.isAuthenticated">
        <img :src="cartImage" alt="cart image" />
        <span class="badge">{{ cartCount }}</span>
      </button>
    </div>
  </div>
</template>


<script setup lang="ts">
import { defineProps } from 'vue';
import { useUserStore } from '../store/user';
import { useRouter } from 'vue-router';
import LoginForm from './LoginForm.vue';
import cartImage from '@/assets/cart.png';
import logo from '@/assets/navbar.png';

const userStore = useUserStore();
const router = useRouter();
const logout = () => {
  userStore.logout();
  router.push('/login');
};
const register = () => {
  router.push('/register');
};
const login = () => {
  router.push('/login');
};
const props = defineProps<{
  cartCount: number;
}>();
</script>

<style scoped>
img{
  width: 20%;
}

.top-navbar {
  display: flex;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  justify-content:space-between;
  position: fixed;
  left: 0;
  top: 0;
  width: 100vw;
  padding: 1rem;
  background: #fff;
  z-index: 1000;
}


.navbar-left h1 {
  margin: 0;
}

.navbar-right {
  display: flex;
  margin-right: 5%;
  gap: 10%;
  max-width: 100%;
}

.cart-button img {
  width: 28px;
  height: 28px;
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
  background-color: white;
  border:none;
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
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.register-btn {
  padding: 0.5rem 1rem;
  background-color: white;
  color: black;
  border: 1px solid black;
  border-radius: 20px;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
  margin-left: 2%;
}
 .login-btn:hover, .register-btn:hover{
  transform: translateY(-4px);
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

</style>