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
    <div class ="modal-content login-container">
    <div >
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
    </div>
  </form>
</template>
<style scoped>

p {
  color: red;
  font-size: 15px;
}
label{
    font-family: 'Open Sans', sans-serif;
    font-weight: 500;
    font-size: larger;
}
.modal-content {
  background: white;
  box-shadow: 1px 1px 1px 1px rgb(234, 234, 234);
  /* padding: 2rem; */
  border-radius: 10px;
  text-align: center;
  width: 40rem;
  height: 25rem;
  padding-top: 2rem;
  padding-right:2rem ;
  padding-left: 2rem;
  margin-left: 30%;
}

input {
  width: 100%;
  margin: 1rem 0;
  padding: 0.5rem;
  background-color: rgb(227, 227, 227);
  border: none;
}

button {
  padding: 0.5rem 1rem;
  background-color: black;
  color: white;
  border: none;
  border-radius: 20px;
  width: 50%;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
  margin-top: 2rem;
}

button:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}
</style>