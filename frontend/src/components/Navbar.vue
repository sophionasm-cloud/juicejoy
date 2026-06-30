<template>
  <nav class="navbar">
    <div class="nav-inner">
      <!-- Logo -->
      <a href="/" class="nav-logo">
        <span class="logo-dot" />Juicie Ride
      </a>

      <!-- Desktop Nav Links -->
      <ul class="nav-links" :class="{ active: mobileMenuOpen }">
        <li><a href="/" @click="closeMobileMenu">Home</a></li>
        <li><a href="/products" @click="closeMobileMenu">Shop</a></li>
        <li><a href="/about" @click="closeMobileMenu">About</a></li>
        <li><a href="/benefits" @click="closeMobileMenu">Benefits</a></li>
        <li><a href="/recipes" @click="closeMobileMenu">Recipes</a></li>
        <li><a href="/contact" @click="closeMobileMenu">Contact</a></li>
      </ul>

      <!-- Actions -->
      <div class="nav-actions">
        <a href="/order" class="btn-order">Order Now</a>
        
        <!-- Search Icon -->
        <div class="nav-icon" title="Search" @click="toggleSearch">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <circle cx="11" cy="11" r="8" />
            <line x1="21" y1="21" x2="16.65" y2="16.65" />
          </svg>
        </div>
        
        <!-- Cart Icon -->
        <div class="nav-icon" title="Cart" @click="openCart">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="9" cy="21" r="1" />
            <circle cx="20" cy="21" r="1" />
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
          </svg>
          <span class="cart-badge">{{ cartStore.totalItems }}</span>
        </div>

        <!-- Hamburger Menu Button -->
        <button class="hamburger" @click="toggleMobileMenu" aria-label="Toggle menu">
          <span class="hamburger-line" :class="{ open: mobileMenuOpen }" />
          <span class="hamburger-line" :class="{ open: mobileMenuOpen }" />
          <span class="hamburger-line" :class="{ open: mobileMenuOpen }" />
        </button>
      </div>
    </div>

    <!-- Mobile Search Bar -->
    <div class="mobile-search" :class="{ active: searchOpen }">
      <input type="text" placeholder="Search for juices..." />
      <button class="search-close" @click="toggleSearch">✕</button>
    </div>
  </nav>
</template>

<script setup>
import { ref } from 'vue'
import { useCartStore } from '../stores/cart.js'

const cartStore = useCartStore()
const mobileMenuOpen = ref(false)
const searchOpen = ref(false)

const emit = defineEmits(['open-cart'])

const toggleMobileMenu = () => {
  mobileMenuOpen.value = !mobileMenuOpen.value
  document.body.style.overflow = mobileMenuOpen.value ? 'hidden' : ''
}

const closeMobileMenu = () => {
  mobileMenuOpen.value = false
  document.body.style.overflow = ''
}

const openCart = () => {
  emit('open-cart')
}

const toggleSearch = () => {
  searchOpen.value = !searchOpen.value
}
</script>

<style scoped>
/* ═══ NAVBAR ════════════════════════════════════════════════ */
.navbar {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 999;
  padding: 0 20px;
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
  position: relative;
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
  flex-shrink: 0;
}

.logo-dot {
  display: inline-block;
  width: 8px;
  height: 8px;
  background: #fff;
  border-radius: 50%;
  margin-bottom: 2px;
}

/* ─── NAV LINKS ───────────────────────────────────────────── */
.nav-links {
  display: flex;
  gap: 36px;
  list-style: none;
  align-items: center;
  margin: 0;
  padding: 0;
  transition: all 0.3s ease;
}

.nav-links a {
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

.nav-links a::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 1px;
  background: rgba(255, 255, 255, 0.55);
  transition: width 0.3s ease;
}

.nav-links a:hover {
  color: rgba(255, 255, 255, 0.90);
}

.nav-links a:hover::after {
  width: 100%;
}

/* ─── NAV ACTIONS ──────────────────────────────────────────── */
.nav-actions {
  display: flex;
  align-items: center;
  gap: 12px;
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
  white-space: nowrap;
}

.btn-order:hover {
  background: rgba(255, 255, 255, 0.85);
  transform: scale(1.03);
}

.nav-icon {
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  border: 1px solid rgba(255, 255, 255, 0.08);
  background: rgba(255, 255, 255, 0.03);
  color: rgba(255, 255, 255, 0.55);
  cursor: pointer;
  position: relative;
  transition: all 0.3s ease;
  flex-shrink: 0;
}

.nav-icon:hover {
  border-color: rgba(255, 255, 255, 0.25);
  background: rgba(255, 255, 255, 0.08);
  color: #fff;
}

.cart-badge {
  position: absolute;
  top: -4px;
  right: -4px;
  width: 18px;
  height: 18px;
  background: #FF6B35;
  color: #fff;
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
  position: relative;
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

/* ─── MOBILE SEARCH ────────────────────────────────────────── */
.mobile-search {
  position: absolute;
  top: 72px;
  left: 0;
  right: 0;
  padding: 12px 20px;
  background: rgba(0, 0, 0, 0.95);
  backdrop-filter: blur(12px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.06);
  transform: translateY(-10px);
  opacity: 0;
  pointer-events: none;
  transition: all 0.3s ease;
}

.mobile-search.active {
  transform: translateY(0);
  opacity: 1;
  pointer-events: all;
}

.mobile-search input {
  width: 100%;
  padding: 12px 16px;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 10px;
  color: #fff;
  font-size: 15px;
  outline: none;
}

.mobile-search input::placeholder {
  color: rgba(255, 255, 255, 0.3);
}

.mobile-search input:focus {
  border-color: rgba(255, 140, 66, 0.4);
}

.search-close {
  position: absolute;
  right: 32px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: rgba(255, 255, 255, 0.3);
  font-size: 18px;
  cursor: pointer;
}

/* ═══ RESPONSIVE ══════════════════════════════════════════ */
@media (max-width: 1024px) {
  .nav-links {
    gap: 24px;
  }
}

@media (max-width: 768px) {
  .hamburger {
    display: flex;
  }

  .nav-links {
    position: fixed;
    top: 0;
    right: -100%;
    width: 70%;
    max-width: 320px;
    height: 100vh;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 24px;
    background: rgba(0, 0, 0, 0.95);
    backdrop-filter: blur(20px);
    padding: 40px;
    transition: right 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    border-left: 1px solid rgba(255, 255, 255, 0.06);
  }

  .nav-links.active {
    right: 0;
  }

  .nav-links a {
    font-size: 16px;
    color: rgba(255, 255, 255, 0.7);
  }

  .nav-links a::after {
    display: none;
  }

  .nav-links a:hover {
    color: #fff;
  }

  .btn-order {
    padding: 8px 16px;
    font-size: 10px;
  }

  .nav-icon {
    width: 36px;
    height: 36px;
  }

  .nav-icon svg {
    width: 16px;
    height: 16px;
  }
}

@media (max-width: 480px) {
  .navbar {
    padding: 0 12px;
    height: 64px;
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

  .nav-icon svg {
    width: 14px;
    height: 14px;
  }

  .cart-badge {
    width: 16px;
    height: 16px;
    font-size: 8px;
    top: -3px;
    right: -3px;
  }

  .nav-links {
    width: 80%;
    gap: 20px;
    padding: 30px;
  }

  .nav-links a {
    font-size: 14px;
  }

  .hamburger-line {
    width: 20px;
    height: 2px;
  }

  .hamburger {
    gap: 4px;
    padding: 6px;
  }

  .mobile-search {
    padding: 10px 16px;
  }
}

/* ═══ OVERLAY FOR MOBILE MENU ══════════════════════════════ */
.nav-links.active::before {
  content: '';
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.4);
  z-index: -1;
}
</style>