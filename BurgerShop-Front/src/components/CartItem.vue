<template>
  <div class="cart-items">
    <h2>Votre panier</h2>
    <ul>
      <li v-for="(item, index) in cart" :key="item.id">
        <span>{{ item.nom }} x{{ item.quantity }}</span>
        <button @click="removeItem(index)">❌</button>
      </li>
    </ul>
    <p v-if="cart.length === 0">Panier vide</p>
    <h3>Total : {{ totalPrice }} €</h3>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, watch } from 'vue'

// Charger le panier depuis le localStorage
const cart = ref(JSON.parse(localStorage.getItem('cartItems') || '[]'))

// Total
const totalPrice = computed(() =>
  cart.value.reduce((acc, item) => acc + item.quantity * (item.price || 10), 0)
)

// Supprimer un item
const removeItem = (index: number) => {
  cart.value.splice(index, 1)
  localStorage.setItem('cartItems', JSON.stringify(cart.value))
}

// Watcher pour garder localStorage à jour si des modifs sont faites manuellement
watch(cart, (newVal) => {
  localStorage.setItem('cartItems', JSON.stringify(newVal))
}, { deep: true })
</script>

<style scoped>
.cart-items {
  width: 350px;
  padding: 1rem;
  background-color: #f4f4f4;
  border-radius: 8px;
}
ul {
  list-style: none;
  padding: 0;
}
li {
  display: flex;
  justify-content: space-between;
  margin: 0.5rem 0;
}
button {
  background: none;
  border: none;
  color: red;
  font-size: 1.2rem;
  cursor: pointer;
}
</style>
