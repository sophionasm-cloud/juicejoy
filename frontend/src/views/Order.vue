<template>
  <div class="order-page">

    <!-- ─── SUPER TRANSPARENT NAVBAR ──────────────────────── -->
    <nav class="super-nav">
      <div class="nav-inner">
        <router-link to="/" class="nav-logo">
          <span class="logo-dot" />Juicie Ride
        </router-link>

        <!-- Mobile Hamburger -->
        <button class="hamburger" @click="mobileMenuOpen = !mobileMenuOpen" aria-label="Toggle menu">
          <span class="hamburger-line" :class="{ open: mobileMenuOpen }" />
          <span class="hamburger-line" :class="{ open: mobileMenuOpen }" />
          <span class="hamburger-line" :class="{ open: mobileMenuOpen }" />
        </button>

        <ul class="nav-links" :class="{ active: mobileMenuOpen }">
          <li><router-link to="/" @click="mobileMenuOpen = false">Home</router-link></li>
          <li><router-link to="/products" @click="mobileMenuOpen = false">Shop</router-link></li>
          <li><router-link to="/about" @click="mobileMenuOpen = false">About</router-link></li>
          <li><router-link to="/benefits" @click="mobileMenuOpen = false">Benefits</router-link></li>
          <li><router-link to="/recipes" @click="mobileMenuOpen = false">Recipes</router-link></li>
          <li><router-link to="/contact" @click="mobileMenuOpen = false">Contact</router-link></li>
        </ul>

        <div class="nav-actions">
          <router-link to="/order" class="btn-order">Order Now</router-link>
          <div class="nav-icon" title="Search">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
              <circle cx="11" cy="11" r="8" />
              <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
          </div>
          <div class="nav-icon" title="Cart" @click="openCart">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="9" cy="21" r="1" />
              <circle cx="20" cy="21" r="1" />
              <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
            </svg>
            <span class="cart-badge">{{ cartStore.totalItems }}</span>
          </div>
        </div>
      </div>
    </nav>

    <!-- ─── ORDER CONTENT ────────────────────────────────────── -->
    <div class="order-container">
      <div class="order-header">
        <h1 class="order-title">Place Your Order</h1>
        <p class="order-sub">{{ steps[orderStore.currentStep] }}</p>
      </div>

      <!-- Progress Bar -->
      <div class="progress-bar">
        <div 
          class="progress-fill" 
          :style="{ width: `${((orderStore.currentStep) / (steps.length - 1)) * 100}%` }"
        />
        <div class="progress-dots">
          <div 
            v-for="(step, i) in steps" 
            :key="i" 
            class="progress-dot"
            :class="{ active: i <= orderStore.currentStep }"
          >
            <span class="dot-number">{{ i + 1 }}</span>
          </div>
        </div>
      </div>

      <!-- Step Content -->
      <div class="order-content">
        <component 
          :is="currentStepComponent" 
          :key="orderStore.currentStep"
        />
      </div>

      <!-- Navigation Buttons -->
      <div class="order-navigation">
        <button 
          v-if="orderStore.currentStep > 0 && orderStore.currentStep < steps.length - 1"
          class="nav-btn prev"
          @click="orderStore.prevStep()"
        >
          Back
        </button>
        
        <button 
          v-if="orderStore.currentStep < steps.length - 1"
          class="nav-btn next"
          @click="nextStep"
        >
          {{ orderStore.currentStep === steps.length - 2 ? 'Review Order' : 'Continue' }}
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <line x1="5" y1="12" x2="19" y2="12"/>
            <polyline points="12 5 19 12 12 19"/>
          </svg>
        </button>
      </div>
    </div>

    <!-- ─── CART DRAWER ────────────────────────────────────── -->
    <CartDrawer :isOpen="cartOpen" @close="closeCart" />

  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useCartStore } from '../stores/cart.js'
import { useOrderStore } from '../stores/order.js'
import CartDrawer from '../components/CartDrawer.vue'

// Components
import StepReview from '../components/order/StepReview.vue'
import StepDelivery from '../components/order/StepDelivery.vue'
import StepOptions from '../components/order/StepOptions.vue'
import StepSummary from '../components/order/StepSummary.vue'
import StepConfirmation from '../components/order/StepConfirmation.vue'

const cartStore = useCartStore()
const orderStore = useOrderStore()

const cartOpen = ref(false)
const mobileMenuOpen = ref(false)

const openCart = () => {
  cartOpen.value = true
}

const closeCart = () => {
  cartOpen.value = false
}

const steps = ['Cart', 'Delivery', 'Options', 'Summary', 'Confirm']

const currentStepComponent = computed(() => {
  const components = [
    StepReview,
    StepDelivery,
    StepOptions,
    StepSummary,
    StepConfirmation
  ]
  return components[orderStore.currentStep]
})

const nextStep = () => {
  if (orderStore.currentStep === 0 && cartStore.items.length === 0) {
    alert('Your cart is empty. Please add some items first.')
    return
  }
  orderStore.nextStep()
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,700&family=Inter:wght@300;400;500;600&display=swap');

.order-page {
  min-height: 100vh;
  background: #000;
  color: #fff;
  font-family: 'Inter', sans-serif;
  overflow-x: hidden;
}

/* ═══ SUPER TRANSPARENT NAVBAR ══════════════════════════════ */
.super-nav {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 999;
  padding: 0 48px;
  height: 72px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(0, 0, 0, 0.15);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.04);
}

.nav-inner {
  width: 100%;
  max-width: 1400px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.nav-logo {
  font-family: 'Playfair Display', serif;
  font-size: 22px;
  font-weight: 700;
  color: #fff;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 8px;
}

.logo-dot {
  display: inline-block;
  width: 8px;
  height: 8px;
  background: #fff;
  border-radius: 50%;
  margin-bottom: 2px;
}

.nav-links {
  display: flex;
  gap: 36px;
  list-style: none;
  align-items: center;
  margin: 0;
  padding: 0;
}

.nav-links a, .nav-links router-link {
  font-size: 12px;
  font-weight: 400;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: rgba(255, 255, 255, 0.45);
  text-decoration: none;
  position: relative;
  padding: 4px 0;
  transition: color 0.3s ease;
}

.nav-links a::after, .nav-links router-link::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 1px;
  background: rgba(255, 255, 255, 0.55);
  transition: width 0.3s ease;
}

.nav-links a:hover, .nav-links router-link:hover {
  color: rgba(255, 255, 255, 0.90);
}

.nav-links a.active::after, .nav-links router-link.active::after {
  width: 100%;
}

.nav-actions {
  display: flex;
  align-items: center;
  gap: 16px;
}

.btn-order {
  font-family: 'Inter', sans-serif;
  font-size: 11px;
  font-weight: 500;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: #000;
  background: #fff;
  border: none;
  padding: 10px 22px;
  border-radius: 100px;
  cursor: pointer;
  transition: background 0.25s, transform 0.2s;
  text-decoration: none;
  display: inline-block;
}

.btn-order:hover {
  background: rgba(255, 255, 255, 0.85);
  transform: scale(1.03);
}

.nav-icon {
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  border: 1px solid rgba(255, 255, 255, 0.12);
  background: rgba(255, 255, 255, 0.04);
  color: rgba(255, 255, 255, 0.55);
  cursor: pointer;
  position: relative;
  transition: border-color 0.25s, background 0.25s, color 0.25s;
}

.nav-icon:hover {
  border-color: rgba(255, 255, 255, 0.28);
  background: rgba(255, 255, 255, 0.10);
  color: #fff;
}

.cart-badge {
  position: absolute;
  top: -4px;
  right: -4px;
  width: 16px;
  height: 16px;
  background: #fff;
  color: #000;
  font-size: 9px;
  font-weight: 600;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* ─── HAMBURGER MENU ──────────────────────────────────────── */
.hamburger {
  display: none;
  flex-direction: column;
  gap: 5px;
  background: none;
  border: none;
  cursor: pointer;
  padding: 8px;
  z-index: 10;
}

.hamburger-line {
  width: 24px;
  height: 2px;
  background: #fff;
  border-radius: 2px;
  transition: all 0.3s ease;
  transform-origin: center;
}

.hamburger-line.open:nth-child(1) {
  transform: rotate(45deg) translate(5px, 5px);
}

.hamburger-line.open:nth-child(2) {
  opacity: 0;
  transform: scaleX(0);
}

.hamburger-line.open:nth-child(3) {
  transform: rotate(-45deg) translate(5px, -5px);
}

/* ═══ ORDER CONTAINER ══════════════════════════════════════ */
.order-container {
  position: relative;
  z-index: 10;
  max-width: 800px;
  margin: 0 auto;
  padding: 100px 24px 60px;
}

.order-header {
  text-align: center;
  margin-bottom: 40px;
}

.order-title {
  font-family: 'Playfair Display', serif;
  font-size: 48px;
  font-weight: 900;
  color: #fff;
  margin-bottom: 8px;
}

.order-sub {
  font-size: 16px;
  color: rgba(255, 255, 255, 0.3);
  font-weight: 300;
}

/* ─── PROGRESS BAR ──────────────────────────────────────────── */
.progress-bar {
  position: relative;
  height: 4px;
  background: rgba(255, 255, 255, 0.06);
  border-radius: 2px;
  margin-bottom: 48px;
}

.progress-fill {
  height: 100%;
  background: linear-gradient(90deg, #FF8C42, #F4A636);
  border-radius: 2px;
  transition: width 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.progress-dots {
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  transform: translateY(-50%);
  display: flex;
  justify-content: space-between;
  padding: 0 4px;
}

.progress-dot {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: #1a1a2e;
  border: 2px solid rgba(255, 255, 255, 0.06);
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.4s ease;
  font-size: 11px;
  font-weight: 500;
  color: rgba(255, 255, 255, 0.2);
}

.progress-dot.active {
  border-color: #FF8C42;
  background: rgba(255, 140, 66, 0.15);
  color: #FF8C42;
}

/* ─── ORDER CONTENT ─────────────────────────────────────────── */
.order-content {
  min-height: 400px;
  margin-bottom: 32px;
}

/* ─── ORDER NAVIGATION ──────────────────────────────────────── */
.order-navigation {
  display: flex;
  justify-content: space-between;
  gap: 16px;
}

.nav-btn {
  padding: 14px 32px;
  border-radius: 12px;
  font-family: 'Inter', sans-serif;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 8px;
}

.nav-btn.prev {
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.06);
  color: rgba(255, 255, 255, 0.5);
}

.nav-btn.prev:hover {
  background: rgba(255, 255, 255, 0.08);
  color: #fff;
}

.nav-btn.next {
  background: linear-gradient(135deg, #FF8C42, #F4A636);
  border: none;
  color: #000;
  margin-left: auto;
}

.nav-btn.next:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 40px rgba(255, 140, 66, 0.3);
}

.nav-btn.next svg {
  transition: transform 0.3s ease;
}

.nav-btn.next:hover svg {
  transform: translateX(4px);
}

/* ═══ RESPONSIVE ══════════════════════════════════════════ */
@media (max-width: 768px) {
  .super-nav {
    padding: 0 20px;
  }

  .hamburger {
    display: flex;
  }

  .nav-links {
    position: fixed;
    top: 0;
    right: -100%;
    width: 75%;
    max-width: 320px;
    height: 100vh;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 24px;
    background: rgba(10, 10, 20, 0.98);
    backdrop-filter: blur(20px);
    padding: 40px 30px;
    transition: right 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    border-left: 1px solid rgba(255, 255, 255, 0.08);
    margin: 0;
    z-index: 5;
    box-shadow: -10px 0 60px rgba(0, 0, 0, 0.6);
  }

  .nav-links.active {
    right: 0;
  }

  .nav-links a, .nav-links router-link {
    font-size: 18px;
    color: #ffffff !important;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 8px;
    transition: all 0.3s ease;
    font-weight: 500;
    letter-spacing: 0.08em;
    width: 100%;
    text-align: center;
  }

  .nav-links a:hover, .nav-links router-link:hover {
    color: #FF8C42 !important;
    background: rgba(255, 140, 66, 0.1);
  }

  .nav-links a::after, .nav-links router-link::after {
    display: none;
  }

  .btn-order {
    padding: 8px 16px;
    font-size: 10px;
  }

  .nav-icon {
    width: 36px;
    height: 36px;
  }

  .order-container {
    padding: 80px 16px 40px;
  }
  
  .order-title {
    font-size: 32px;
  }
  
  .nav-btn {
    padding: 12px 24px;
    font-size: 13px;
  }
}

@media (max-width: 480px) {
  .super-nav {
    padding: 0 12px;
  }

  .nav-logo {
    font-size: 18px;
  }

  .btn-order {
    padding: 6px 12px;
    font-size: 9px;
  }

  .nav-icon {
    width: 32px;
    height: 32px;
  }

  .cart-badge {
    width: 16px;
    height: 16px;
    font-size: 8px;
    top: -3px;
    right: -3px;
  }

  .hamburger-line {
    width: 20px;
    height: 2px;
  }

  .hamburger {
    gap: 4px;
    padding: 6px;
  }

  .nav-links {
    width: 80%;
    gap: 20px;
    padding: 30px;
  }

  .nav-links a, .nav-links router-link {
    font-size: 16px;
  }

  .order-title {
    font-size: 24px;
  }
  
  .order-navigation {
    flex-direction: column;
  }
  
  .nav-btn.next {
    margin-left: 0;
  }
}
</style>