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
    await axios.post('https://localhost:8000/api/auth/register', { email: email.value, password: password.value });
    router.push('/login');
  } catch (e) {
    error.value = e.response?.data?.message || 'Erreur lors de l\'inscription.';
  }
};
</script>

<template>
  <form @submit.prevent="onSubmit">
    <div>
      <label>Email</label>
      <input v-model="email" type="email" required />
    </div>
    <div>
      <label>Mot de passe</label>
      <input v-model="password" type="password" required minlength="6" />
    </div>
    <div>
      <label>Confirmer mot de passe</label>
      <input v-model="passwordConfirm" type="password" required minlength="6" />
    </div>
    <p v-if="error" style="color:red">{{ error }}</p>
    <button type="submit">S'inscrire</button>
  </form>
</template>
