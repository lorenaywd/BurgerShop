import { createRouter, createWebHistory } from 'vue-router';
import Modal from '@/components/Modal.vue';
import Order from '@/components/OrderForm.vue';
import HomePage from '@/components/HomePage.vue';
import path = require('path');


const routes = [
  {
    path: "/",
    name: "Home",
    component: HomePage,
  },
  {
    path: '/modal',
    name: 'Modal',
    component: Modal,
  },
  {
    path: "/order",
    name: "Order",
    component: Order,
  },
  {
    path: '/carte',
    name: 'Carte',
    component: HomePage
  },
  {
    path: '/burgers/:type',
    name: 'Burgers',
    component: HomePage,
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
