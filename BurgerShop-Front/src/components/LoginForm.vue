<script setup lang="ts">
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { useUserStore } from '../store/user';
import icone from '@/assets/inscription_connexion.png';

const email = ref('');
const password = ref('');
const error = ref('');
const router = useRouter();
const userStore = useUserStore();

const validate = () => {
  if (!email.value || !password.value) {
    error.value = 'Email et mot de passe requis.';
    return false;
  }
  error.value = '';
  return true;
};

const onSubmit = async () => {
  if (!validate()) return;
  try {
    const response = await axios.post('https://localhost:8000/api/auth/login', {
      email: email.value,
      password: password.value
    });
    const { token, user } = response.data;
    userStore.setUser(token, user);
    router.push('/');
  } catch (e) {
    error.value = e.response?.data?.message || 'Erreur lors de la connexion.';
  }
};
</script>

<template>
  <div class="login">
    <div class="gauche">
      <img :src="icone" alt="Image d'inscription" style="width: 80%; height: 80%; object-fit: cover;" />
    </div>
    <div class="droite">
      <form @submit.prevent="onSubmit" class="login-card">
        <h2>Connexion</h2>

        <div class="form-group">
          <label>Email</label>
          <input v-model="email" type="email" required />
        </div>

        <div class="form-group">
          <label>Mot de passe</label>
          <input v-model="password" type="password" required />
        </div>

        <p v-if="error" class="error-message">{{ error }}</p>

        <button type="submit" class="submit-btn">Se connecter</button>
      </form>
    </div>
  </div>
</template>

<style scoped>
.gauche {
  width: 40%;;
  background-size: cover;
  background-position: center;
}

.droite {
  width: 60%;
}

label {
  font-family: 'Open Sans', sans-serif;
}

.login {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 60px 20px;
  min-height: 100vh;
  min-width: 100vw;
  background-color: #f5f5f5;
}

.login-card {
  background: white;
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
  max-width: 400px;
  width: 100%;
}

.login-card h2 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
}

.form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 16px;
}

label {
  margin-bottom: 6px;
  font-weight: 500;
  color: #444;
}

input {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 15px;
  transition: border-color 0.3s ease;
}

input:focus {
  outline: none;
  border-color: #ff8800;
  box-shadow: 0 0 5px rgba(255, 136, 0, 0.3);
}

.error-message {
  color: red;
  margin-bottom: 12px;
  font-size: 14px;
  text-align: center;
}

.submit-btn {
  width: 100%;
  padding: 12px;
  background-color: #ff8800;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.25s ease;
}

.submit-btn:hover {
  background-color: #e67300;
}
</style>
