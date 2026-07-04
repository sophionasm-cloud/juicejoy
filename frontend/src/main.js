import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { createRouter, createWebHistory } from 'vue-router'
import App from './App.vue'
import './style.css'
import axios from 'axios'

// Import views
import Home from './views/Home.vue'
import Products from './views/Products.vue'
import About from './views/About.vue'
import Benefits from './views/Benefits.vue'
import Recipes from './views/Recipes.vue'
import Contact from './views/Contact.vue'
import Order from './views/Order.vue'

// Routes
const routes = [
  { path: '/', component: Home },
  { path: '/products', component: Products },
  { path: '/about', component: About },
  { path: '/benefits', component: Benefits },
  { path: '/recipes', component: Recipes },
  { path: '/contact', component: Contact },
  { path: '/order', component: Order },
  // { path: '/checkout', component: Checkout },
  // { path: '/success', component: Success }
]

const router = createRouter({
  history: createWebHistory('/juicejoy/'),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { top: 0 }
    }
  }
})

const pinia = createPinia()
const app = createApp(App)

app.use(pinia)
app.use(router)
app.mount('#app')