<script setup lang="ts">
import { onMounted, ref, watch, watchEffect } from 'vue';
import NavBar from './NavBar.vue';
import axios from 'axios';
import { useRoute } from 'vue-router';


const route = useRoute();
const items = ref<Burger[]>([]);

type Burger = {
  id: number;
  name: string;
  image: string;
  description: string;
  type: string;
  price: number;
};

const fetchMenu = async () => {
  const type = route.params.type;
  let url = `/api/menu`;

  if (type) {
    url += `/${type}`;
  }
  try {
    items.value = [];
    const response = await axios.get(url);
    items.value = response.data;
    console.log('Burgers chargés avec succès', items.value);
  } catch (e) {
    console.error('Erreur lors du chargement des burgers', e);
  }
};


onMounted(fetchMenu);

watch(() => route.params.type, fetchMenu);

import WelcomeModal from './Modal.vue';
import TopNavBar from './TopNavbar.vue';
import { useRouter } from 'vue-router'

const router = useRouter()
const prenom = ref('');

onMounted(() => {
  const saved = JSON.parse(localStorage.getItem('cart') || '[]');
  const totalCount = saved.reduce((acc: number, item: any) => {
    const quantity = Number(item.quantity) || 1;
    return acc + quantity;
  }, 0);
  cartCount.value = totalCount;
});

const handleNameSet = (name: string) => {
  prenom.value = name;
};
const cartCount = ref(0);
const handleOpenCart = () => {
  router.push('/order')
}

const addToCart = (burger: Burger) => {
  const cart = JSON.parse(localStorage.getItem('cart') || '[]');
  cart.push(burger);
  cartCount.value++
  localStorage.setItem('cart', JSON.stringify(cart));
};

</script>

<template>
  
  <TopNavBar :cartCount="cartCount" @open-cart="handleOpenCart" />
  <div class="main-container">
    <div class="sidebar">
      <NavBar />
    </div>
    <div class="content">
      <header>
        <!-- <h1>Bienvenue, {{ prenom }}</h1> -->
        <p>Découvrez nos délicieux burgers faits maison !</p>
      </header>

      <h2>Notre menu</h2>

      <div class="burger-list">
        <div v-for="(item, index) in items" :key="index" class="card">
          <img :src="`http://localhost:8000${item.image}`" alt="Burger image" />
          <h3>{{ item.name }}</h3>
          <p>{{ item.description }}</p>

          <div class="quantity-row">
          </div>

          <button class="commander" @click="addToCart(item)">Commander</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.burger-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start; 
  gap: 0px;                  
  width: 100%;                 
}

.card{
  margin-bottom: 5%;
  margin: 0; 
  padding: 8px; 
  width: calc(33% - 40px);  
  box-sizing: border-box;
}

/* .card-img {
  max-width: 100%;
  height: auto;      
  display: block; 
  width: 80%;
  border-radius: 8px;
  height: 25rem;
} */

.card-img {
  width: 100px;
  height: 250px; 
  object-fit: cover;
  border-radius: 8px;
  display: block;
}
.main-container {
  display: flex;
  min-height: 100vh;
  width: 100vw;
   margin-top: 80px;
}

.sidebar {
  width: 20%;
  position: fixed;   
  top: 0;            
  left: 0;           
  height: 100vh;     
  width: 20%;      
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