<script setup lang="ts">
import { ref } from 'vue';
import NavBar from './NavBar.vue';

const items = ref([
  { id: 1, nom: 'Burger basique', image: "src/assets/burger.jpg", description: 'Un burger des plus basique', type: 'boeuf' },
  { id: 2,nom: 'Burger 2 fromages', image: "src/assets/burger.jpg", description: 'Deux fromages pour + de plaisir', type: 'boeuf' },
  { id: 3,nom: 'Burger poulet', image: "src/assets/burger.jpg", description: 'Un burger avec du poulet', type: 'boeuf' },
  { id: 4,nom: 'Burger végétarien', image: "src/assets/burger.jpg", description: 'Un burger pour les végétariens', type: 'vegetarien' },
  { id: 5,nom: 'Burger épicé', image: "src/assets/burger.jpg", description: 'Un burger pour les amateurs de sensations fortes', type: 'boeuf' },
  { id: 6,nom: 'Burger double', image: "src/assets/burger.jpg", description: 'Un burger avec deux steaks', type: 'boeuf' },
  { id: 7,nom: 'Burger BBQ', image: "src/assets/burger.jpg", description: 'Un burger avec une sauce BBQ maison', type: 'boeuf' },
  { id: 8,nom: 'Burger gourmet', image: "src/assets/burger.jpg", description: 'Un burger haut de gamme avec des ingrédients raffinés', type: 'boeuf' },
  { id: 9,nom: 'Burger au saumon', image: "src/assets/burger.jpg", description: 'Un burger avec du saumon frais', type: 'poisson' }
])
const prenom = ref('Romain');
</script>

<template>
  <div class="main-container">
    <div class="sidebar">
      <NavBar />
    </div>


    <div class="content">
      <header>
        <h1>Bienvenue, {{ prenom }}</h1>
        <p>Découvrez nos délicieux burgers faits maison !</p>
      </header>

      <img src="../assets/burgerAccueil.jpg" alt="Burger image"
        style="width: 60%; border-radius: 8px; margin-bottom: 20px;">

      <h2>Notre menu</h2>

      <div class="burger-list">
    <div v-for="(item, index) in items" :key="index" class="card">
      <img :src="item.image" alt="Burger image" class="card-img">
      <h3>{{ item.nom }}</h3>
      <p>{{ item.description }}</p>

      <div class="quantity-row">
      </div>

      <button class="commander" @click="">Commander</button>
    </div>
  </div>
    </div>
  </div>
</template>

<style>
.burger-list {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}

.card {
  background-color: white;
  border-radius: 12px;
  padding: 16px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
  box-sizing: border-box;
}

.card-img {
  width: 100%;
  border-radius: 8px;
}
.main-container {
  display: flex;
  min-height: 100vh;
  width: 100vw;
  background-color: #EDE8D0;
}

.sidebar {
  width: 20%;
  background-color: #f5f5f5;
}

.content {
  width: 80%;
  flex: 1;
  padding: 24px;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f8f9fa;
  color: #333;
  margin: 0;
}

.row {
  display: flex;
  justify-content: center;
  margin-left: 0px;
  margin-top: 10px;
  margin-right: 10px;
}

.commander {
  background-color: #d5c75c;
  color: white;
  border: none;
  border-radius: 25px;
  padding: 10px 20px;
  cursor: pointer;
  font-size: 16px;
  margin-top: 5px;
}

.quantite {
  margin: 0 5px;
  background-color: #f0f0f0;
  border: none;
  border-radius: 50%;
  padding: 5px 10px;
  cursor: pointer;
  font-size: 16px;
}
</style>
