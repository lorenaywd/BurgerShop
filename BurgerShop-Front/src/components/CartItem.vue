<template>
  <div class="cart-items">
    <h2>Votre panier</h2>

    <div v-if="cart.length === 0">
      <p>Panier vide</p>
    </div>

    <div v-else>
      <div
        v-for="(item, index) in cart"
        :key="item.id"
        class="card"
        style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;"
      >
        <img :src="item.image" alt="" width="60" height="60" style="border-radius: 8px;" />
        <div>
          <h3>{{ item.name }}</h3>
          <p>{{ item.price }} €</p>
          <div class="quantity-row" style="display: flex; align-items: center; gap: 0.5rem;">
            <button @click="decreaseQuantity(index)">➖</button>
            <span>{{ item.quantity }}</span>
            <button @click="increaseQuantity(index)">➕</button>
          </div>
        </div>
        <button @click="removeItem(index)" style="margin-left: auto;">❌</button>
      </div>

      <h3>Total : {{ totalPrice }} €</h3>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, watch } from 'vue';

type CartItem = {
  id: number;
  name: string;
  image: string;
  description: string;
  type: string;
  price: number;
  quantity: number;
};

const cart = ref<CartItem[]>([]);

onMounted(() => {
  const saved = JSON.parse(localStorage.getItem('cart') || '[]');
  cart.value = saved.map((item: CartItem) => ({
    ...item,
    quantity: item.quantity ?? 1,
  }));
});


const totalPrice = computed(() =>
  cart.value.reduce((total, item) => total + item.price * item.quantity, 0).toFixed(2)
);

const increaseQuantity = (index: number) => {
  cart.value[index].quantity++;
};

const decreaseQuantity = (index: number) => {
  if (cart.value[index].quantity > 1) {
    cart.value[index].quantity--;
  } else {
    removeItem(index);
  }
};

const removeItem = (index: number) => {
  cart.value.splice(index, 1);
};

watch(
  cart,
  (newCart) => {
    localStorage.setItem('cart', JSON.stringify(newCart));
  },
  { deep: true }
);
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
