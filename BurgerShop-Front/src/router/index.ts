import { createRouter, createWebHistory } from 'vue-router';
import Modal from '@/components/Modal.vue';
import Order from '@/components/OrderForm.vue';
import HomePage from '@/components/HomePage.vue';
import Confirmation from '@/components/Confirmation.vue';


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
    path: '/menu/:type?',
    name: 'Carte',
    component: HomePage
  },
  {
    path: '/confirmation/:orderId',
    name: 'Confirmation',
    component: Confirmation
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
