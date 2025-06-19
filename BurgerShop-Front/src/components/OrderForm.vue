<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import CartItems from './CartItem.vue'

const name = ref('');
const email = ref('');
const address = ref('');
const errors = ref<{ name?: string; email?: string; address?: string }>({});

const router = useRouter();

const validateEmail = (value: string) =>
  /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);

const validateForm = () => {
  errors.value = {};

  if (!name.value.trim()) errors.value.name = 'Nom requis';
  if (!email.value.trim()) {
    errors.value.email = 'Email requis';
  } else if (!validateEmail(email.value)) {
    errors.value.email = 'Email invalide';
  }
  if (!address.value.trim()) errors.value.address = 'Adresse requise';

  return Object.keys(errors.value).length === 0;
};

const submitOrder = async () => {
  if (!validateForm()) return;

  try {
    // Simule un appel à une API
    await new Promise((resolve) => setTimeout(resolve, 1000));

    // Vide le panier (exemple avec localStorage)
    localStorage.removeItem('cartItems');

    // Redirection vers confirmation
    router.push('/confirmation');
  } catch (error) {
    console.error('Erreur lors de la commande :', error);
  }
};
</script>

<template>
  <h1>BURGER SHOP</h1>

   <div class="order-page">
    <CartItems />
    <form class="form-container" @submit.prevent="submitOrder">
      <h2>Finalisez votre commande</h2>
      <label>
        Nom 
        <input v-model="name" type="text" />
      </label>
      <span v-if="errors.name" class="error">{{ errors.name }}</span>

      <label>
        Email 
        <input v-model="email" type="email" />
      </label>
      <span v-if="errors.email" class="error">{{ errors.email }}</span>

      <label>
        Adresse 
        <textarea v-model="address"></textarea>
      </label>
      <span v-if="errors.address" class="error">{{ errors.address }}</span>

      <button type="submit">Confirmer la commande</button>
    </form>
  </div>


  
</template>

<style scoped>
.order-page {
  display: flex;
  gap: 2rem;
  padding: 2rem;
}
.form-container {
  width: 500px;
  height: 600px;
  margin-top: 1%;
  padding: 2rem;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
h1{
   font-family: 'Lilita One', cursive;
   font-size: 5rem;
}
h2{
  font-size: 30px;
  font-family: 'Open Sans', sans-serif;
  font-weight: bold;
}
label {
  display: block;
  margin-top: 1.5rem;
  font-size: 20px
}
input,
textarea {
  width: 100%;
  height: 3rem;
  padding: 0.5rem;
  margin-top: 0.25rem;
  background-color: rgb(227, 227, 227);
  border: none; 
  border-radius: 5px;
}
.error {
  color: red;
  font-size: 0.85rem;
}
button {
  margin-top: 5rem;
  padding: 0.75rem 1.5rem;
  background-color: #ff9900;
  color: white;
  border: none;
  border-radius: 20px;
  cursor: pointer;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
  font-size: 18px;

}
button:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}
</style>
