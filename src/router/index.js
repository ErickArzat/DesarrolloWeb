import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import listar from '../components/Listar.vue'
import Editar from '../components/Editar.vue';


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    
    {
      path: '/login',
      name: 'login',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/LogIn.vue')
    }, 
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/Register.vue')
    }, 
    {
      path: '/home',
      name: 'home',
      component: HomeView
    },
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/Admin',
      name: 'admin',
      component: () => import('../views/Admin.vue')
    }, 
    
  ]
})

export default router
