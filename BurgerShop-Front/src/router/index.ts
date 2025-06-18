import { createRouter, createWebHistory } from 'vue-router';
import Modal from '@/components/Modal.vue';
import Hello from '@/components/HelloWorld.vue';
import HomePage from '@/components/HomePage.vue';;
import path = require('path');


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
  {path: '/carte', name: 'Carte', component: HomePage},
 
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
