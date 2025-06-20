import { createRouter, createWebHistory } from 'vue-router';
import Modal from '@/components/Modal.vue';
import Order from '@/components/OrderForm.vue';
import HomePage from '@/components/HomePage.vue';
import { useUserStore } from '@/store/user'
import LoginForm from '@/components/LoginForm.vue';
import RegisterForm from '@/components/RegisterForm.vue';


const routes = [
  {
    path: "/",
    name: "Home",
    component: HomePage,
  },
  {
    path: "/login",
    name: "login",
    component: LoginForm,
  },
   {
    path: "/register",
    name: "register",
    component: RegisterForm,
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
     meta: { requiresAuth: true }
  },
  {
    path: '/menu/:type?',
    name: 'Carte',
    component: HomePage
  },
  {
    path: '/burgers/:type',
    name: 'Burgers',
    component: HomePage,
  }
  // { path: '/history',
  //   component: HistoryPage, 
  //   meta: { requiresAuth: true } 
  // },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const userStore = useUserStore();
  if (to.meta.requiresAuth && !userStore.isAuthenticated) {
    next('/login');
  } else if ((to.path === '/login' || to.path === '/register') && userStore.isAuthenticated) {
    next('/');
  } else {
    next();
  }
});

export default router;
