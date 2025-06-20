<template>
  <div class="form-container">
    <form @submit.prevent="onSubmit" class="form-card">
      <h2>Créer un compte</h2>

      <div class="form-group">
        <label>Email</label>
        <input v-model="email" type="email" required />
      </div>

      <div class="form-group">
        <label>Mot de passe</label>
        <input v-model="password" type="password" required minlength="6" />
      </div>

      <div class="form-group">
        <label>Confirmer le mot de passe</label>
        <input v-model="passwordConfirm" type="password" required minlength="6" />
      </div>

      <p v-if="error" class="error-message">{{ error }}</p>

      <button type="submit" class="submit-btn">Prêt à déguster !</button>
    </form>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const email = ref('');
const password = ref('');
const passwordConfirm = ref('');
const error = ref('');
const router = useRouter();

const validate = () => {
  if (!email.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
    error.value = 'Email invalide.';
    return false;
  }
  if (password.value.length < 6) {
    error.value = 'Le mot de passe doit contenir au moins 6 caractères.';
    return false;
  }
  if (password.value !== passwordConfirm.value) {
    error.value = 'Les mots de passe ne correspondent pas.';
    return false;
  }
  error.value = '';
  return true;
};

const onSubmit = async () => {
  if (!validate()) return;
  try {
    await axios.post('https://localhost:8000/api/auth/register', {
      email: email.value,
      password: password.value
    });
    router.push('/login');
  } catch (e) {
    error.value = e.response?.data?.message || "Erreur lors de l'inscription.";
  }
};
</script>

<style scoped>
label {
  font-family: 'Open Sans', sans-serif;
}
.form-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  min-width: 100vw;
  background-color: #f5f5f5;
}

.form-card {
  background: white;
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
  max-width: 400px;
  width: 100%;
}

.form-card h2 {
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
