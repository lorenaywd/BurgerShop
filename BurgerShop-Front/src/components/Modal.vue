<template>
  <div v-if="show" class="modal-overlay">
    <div class="modal-content">
      <h2>Bienvenue chez BurgerShop!</h2>
      <input
        type="text"
        v-model="firstName"
        placeholder="Entrez votre prénom"
      />
      <button @click="saveName">Valider</button>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { ref, onMounted } from 'vue';

const show = ref(false);
const firstName = ref('');

const saveName = () => {
  if (firstName.value.trim()) {
    const expirationTime = Date.now() + 3600 * 1000; // 1 heure de stockage
    const userData = {
      name: firstName.value,
      expiresAt: expirationTime,
    };
    localStorage.setItem('burgerShopUser', JSON.stringify(userData));
    show.value = false;
  }
};

onMounted(() => {
  const stored = localStorage.getItem('burgerShopUser');
  if (stored) {
    try {
      const data = JSON.parse(stored);
      if (data.expiresAt && Date.now() < data.expiresAt) {
        show.value = false;
        return;
      } else {
        localStorage.removeItem('burgerShopUser');
      }
    } catch {
      localStorage.removeItem('burgerShopUser');
    }
  }
  show.value = true;
});
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.6);
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-content {
  background: white;
  padding: 2rem;
  border-radius: 10px;
  text-align: center;
  width: 300px;
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
  cursor: pointer;
  background-color: black;
  color: white;
  border: none;
  border-radius: 20px;
  width: 50%;
  cursor: pointer;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
  margin-top: 5%;
}
button:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}
</style>
