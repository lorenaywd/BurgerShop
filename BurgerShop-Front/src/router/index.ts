import { createRouter, createWebHistory } from 'vue-router';
import Modal from '@/components/Modal.vue';
import Hello from '@/components/HelloWorld.vue';
import Order from '@/components/OrderForm.vue';


const routes = [
  {
    path: '/',
    name: 'Home',
    component: Hello,
  },
  {
    path: '/modal',
    name: 'Modal',
    component:  Modal,
  }, 
  {
    path: '/order',
    name: 'Order',
    component:  Order,
  },
 
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
