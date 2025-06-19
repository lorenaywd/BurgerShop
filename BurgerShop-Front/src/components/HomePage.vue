<script setup lang="ts">
import { ref, onMounted } from 'vue';
import NavBar from './NavBar.vue';
import WelcomeModal from './Modal.vue';
import TopNavBar from './TopNavbar.vue';
import { useRouter } from 'vue-router'

const router = useRouter()
const prenom = ref('');

onMounted(() => {
  const stored = localStorage.getItem('burgerShopUser');
  if (stored) {
    const data = JSON.parse(stored);
    if (data.name && Date.now() < data.expiresAt) {
      prenom.value = data.name;
    }
  }
});

const handleNameSet = (name: string) => {
  prenom.value = name;
};
const cartCount = ref(0);
const handleOpenCart = () => {
  router.push('/order')
}

const cart = ref<any[]>([]);

function addToCart(item) {
  const found = cart.value.find(i => i.id === item.id);
  if (found) {
    found.quantity += 1;
  } else {
    cart.value.push({ ...item, quantity: 1 });
  }
  cartCount.value++;
}
const items = ref([
  { id: 1, nom: 'Burger basique', image: "src/assets/burger1.png", description: 'Un burger des plus basique', type: 'boeuf' },
  { id: 2, nom: 'Burger 2 fromages', image: "src/assets/burger3.png", description: 'Deux fromages pour + de plaisir', type: 'boeuf' },
  { id: 3, nom: 'Burger poulet', image: "src/assets/burger10.png", description: 'Un burger avec du poulet', type: 'boeuf' },
  { id: 4, nom: 'Burger végétarien', image: "src/assets/burger2.png", description: 'Un burger pour les végétariens', type: 'vegetarien' },
  { id: 5, nom: 'Burger épicé', image: "src/assets/burger4.png", description: 'Un burger pour les amateurs de sensations fortes', type: 'boeuf' },
  { id: 6, nom: 'Burger double', image: "src/assets/burger5.png", description: 'Un burger avec deux steaks', type: 'boeuf' },
  { id: 7, nom: 'Burger BBQ', image: "src/assets/burger8.png", description: 'Un burger avec une sauce BBQ maison', type: 'boeuf' },
  { id: 8, nom: 'Burger gourmet', image: "src/assets/burger6.png", description: 'Un burger haut de gamme avec des ingrédients raffinés', type: 'boeuf' },
  { id: 9, nom: 'Burger au saumon', image: "src/assets/burger14.png", description: 'Un burger avec du saumon frais', type: 'poisson' }
]);
</script>

<template>
  <!-- Affichage de la modale  -->
  <WelcomeModal @name-set="handleNameSet" />
  <TopNavBar :cartCount="cartCount" @open-cart="handleOpenCart" />
  <div class="main-container">
    <div class="sidebar">
      <NavBar />
    </div>
    <div class="content">
      <header>
        <h1>Bienvenue, {{ prenom }}</h1>
        <p>Découvrez nos délicieux burgers faits maison !</p>
      </header>

      <h2>Notre menu</h2>

      <div class="burger-list">
        <div v-for="(item, index) in items" :key="index" class="card">
          <img :src="item.image" alt="Burger image" class="card-img" />
          <h3>{{ item.nom }}</h3>
          <p>{{ item.description }}</p>
          <button class= "commander" @click="addToCart(item)">Commander</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.burger-list {
  display: flex;
  flex-wrap: wrap; 
  justify-content: space-between;           
  gap: 16px;   
  width: 80%;                
}

.card{
  margin-bottom: 5%;
  margin: 0; 
  padding: 8px; 
  width: calc(33.333% - 11px);  
  box-sizing: border-box;
}

.card-img {
  max-width: 100%;
  height: auto;      
  display: block; 
  width: 80%;
  border-radius: 8px;
  height: 25rem;
}
.main-container {
  display: flex;
  min-height: 100vh;
  width: 100vw;
   margin-top: 80px;
  /* background-color: #EDE8D0; */
}

.sidebar {
  width: 20%;
  position: fixed;   
  top: 0;            
  left: 0;           
  height: 100vh;     
  width: 20%;      
  /* background-color: #fff;  */
  z-index: 1000; 
  margin-top: 4%;
}

.content {
  width: 50%;
  flex: 1;
  padding: 24px;
  margin-left: 3%;
  box-sizing: border-box;
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
