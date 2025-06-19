<template>
  <div v-if="show" class="modal-overlay">
    <div class="modal-content">
      <h2>Bienvenue chez</h2>
      <p>Burger Shop</p>
      <input
        type="text"
        v-model="firstName"
        placeholder="Entrez votre prénom"
      />
      <button @click="saveName">Valider</button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";

const emit = defineEmits(["name-set"]);
const show = ref(false);
const firstName = ref("");

const saveName = () => {
  if (firstName.value.trim()) {
    const expirationTime = Date.now() + 30 * 1000; // 1 min pour tests
    const userData = {
      name: firstName.value,
      expiresAt: expirationTime,
    };
    localStorage.setItem("burgerShopUser", JSON.stringify(userData));
    emit("name-set", firstName.value); // envoie le prénom
    show.value = false;

    // pour réapparition automatique après expiration
    setTimeout(() => {
      localStorage.removeItem("burgerShopUser");
      show.value = true;
    }, 60 * 1000);
  }
};

onMounted(() => {
  const stored = localStorage.getItem("burgerShopUser");
  if (stored) {
    try {
      const data = JSON.parse(stored);
      const now = Date.now();
      console.log("Now:", Date.now());
      console.log("ExpiresAt:", data.expiresAt);
      console.log("Expired?", Date.now() > data.expiresAt);
      if (data.expiresAt && now < data.expiresAt) {
        // si le nom est encore valide
        show.value = false;
        emit("name-set", data.name); // met à jour le prénom
        return;
      } else {
        localStorage.removeItem("burgerShopUser");
      }
    } catch {
      localStorage.removeItem("burgerShopUser"); 
    }
  }
  show.value = true;
   console.log(show.value)
});
</script>

<style scoped>
p{
   font-family: 'Lilita One', cursive;
   font-size: 20px;
}
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
  z-index: 9999;
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
