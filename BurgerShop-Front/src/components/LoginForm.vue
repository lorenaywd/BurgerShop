<script setup lang="ts">
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { useUserStore } from '../store/user';

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
    const response = await axios.post('https://localhost:8000/api/auth/login', { email: email.value, password: password.value });
    const { token, user } = response.data;
    userStore.setUser(token, user);
    router.push('/');
  } catch (e) {
    error.value = e.response?.data?.message || 'Erreur lors de la connexion.';
  }
};
</script>

<template>
    <div class="modal-content login-container">
      <form @submit.prevent="onSubmit">
        <div>
          <label>Email</label>
          <input v-model="email" type="email" required />
        </div>
        <div>
          <label>Mot de passe</label>
          <input v-model="password" type="password" required />
        </div>
        <p v-if="error">{{ error }}</p>
        <button type="submit">Se connecter</button>
      </form>
    </div>
</template>
<style scoped>

p {
  color: red;
  font-size: 15px;
}

.modal-content {

  background: white;
  box-shadow: 1px 1px 1px 1px rgb(234, 234, 234);
  padding: 2rem;
  border-radius: 10px;
  text-align: center;
  width: 40rem;
  height: 40rem;
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
}

button:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}
</style>

