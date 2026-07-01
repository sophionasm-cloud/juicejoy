<template>
  <div class="about-page">

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
          <li><router-link to="/about" @click="mobileMenuOpen = false" class="active">About</router-link></li>
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

    <!-- ─── HERO SECTION ────────────────────────────────────── -->
    <section class="hero-section">
      <div class="hero-bg">
        <img src="https://images.unsplash.com/photo-1610832958506-aa56368176cf?w=1800&auto=format&fit=crop" alt="Fresh fruits" />
        <div class="hero-overlay" />
      </div>
      <div class="hero-content">
        <div class="hero-eyebrow">About Us</div>
        <h1 class="hero-title">Juicie <em>Ride</em></h1>
        <p class="hero-sub">Where freshness meets flavor — bringing you the authentic taste of Ethiopia, one sip at a time.</p>
      </div>
      <div class="scroll-indicator">
        <span>Scroll to explore</span>
        <div class="scroll-line" />
      </div>
    </section>

    <!-- ─── SCROLL CONTAINER ────────────────────────────────── -->
    <div class="scroll-container" ref="scrollEl">

      <!-- ─── SLIDE 1: Welcome ───────────────────────────────── -->
      <section class="slide" id="welcome">
        <div class="slide-bg">
          <img src="https://images.unsplash.com/photo-1547592166-23ac45744acd?w=1800&auto=format&fit=crop" alt="Ethiopian fruits" />
          <div class="slide-overlay" />
        </div>
        <div class="slide-content" ref="slide1">
          <div class="content-circle circle-left">
            <div class="circle-icon">🇪🇹</div>
          </div>
          <div class="content-text">
            <span class="slide-number">01</span>
            <h2 class="slide-title">Welcome to <em>Juicie Ride</em></h2>
            <p class="slide-desc">
              We are an Ethiopian juice company dedicated to delivering delicious, healthy, 
              and refreshing fruit juices made from carefully selected local ingredients.
            </p>
            <p class="slide-desc">
              At Juicie Ride, we believe that great juice starts with nature. That's why we work 
              with fresh fruits sourced from trusted Ethiopian farmers to create beverages that 
              are rich in taste, packed with nutrients, and free from unnecessary additives.
            </p>
            <div class="slide-tag">🇪🇹 Proudly Ethiopian</div>
          </div>
        </div>
      </section>

      <!-- ─── SLIDE 2: Our Philosophy ────────────────────────── -->
      <section class="slide" id="philosophy">
        <div class="slide-bg">
          <img src="https://images.unsplash.com/photo-1610832958506-aa56368176cf?w=1800&auto=format&fit=crop" alt="Fresh juice" />
          <div class="slide-overlay" />
        </div>
        <div class="slide-content reverse" ref="slide2">
          <div class="content-text">
            <span class="slide-number">02</span>
            <h2 class="slide-title">Our <em>Philosophy</em></h2>
            <p class="slide-desc">
              Every bottle is crafted with quality, freshness, and customer satisfaction in mind. 
              We believe that great juice starts with great ingredients.
            </p>
            <p class="slide-desc">
              Whether you're looking for a refreshing drink on a hot day or a healthy addition 
              to your daily routine, Juicie Ride is here to bring you the authentic taste of 
              Ethiopia — one sip at a time.
            </p>
            <div class="slide-tag">🌿 Natural & Pure</div>
          </div>
          <div class="content-circle circle-right">
            <div class="circle-icon">🌿</div>
          </div>
        </div>
      </section>

      <!-- ─── SLIDE 3: Why Choose Us ─────────────────────────── -->
      <section class="slide" id="why-choose">
        <div class="slide-bg">
          <img src="https://images.unsplash.com/photo-1576673442511-7e39b6545c87?w=1800&auto=format&fit=crop" alt="Fruit selection" />
          <div class="slide-overlay" />
        </div>
        <div class="slide-content" ref="slide3">
          <div class="content-circle circle-left">
            <div class="circle-icon">✨</div>
          </div>
          <div class="content-text">
            <span class="slide-number">03</span>
            <h2 class="slide-title">Why Choose <em>Juicie Ride</em></h2>
            <div class="benefits-grid">
              <div class="benefit-item">
                <span class="benefit-icon">🍊</span>
                <span class="benefit-text">Fresh, locally sourced Ethiopian fruits</span>
              </div>
              <div class="benefit-item">
                <span class="benefit-icon">🌿</span>
                <span class="benefit-text">Natural ingredients, no artificial flavors</span>
              </div>
              <div class="benefit-item">
                <span class="benefit-icon">💚</span>
                <span class="benefit-text">Healthy, refreshing, nutrient-rich</span>
              </div>
              <div class="benefit-item">
                <span class="benefit-icon">🏆</span>
                <span class="benefit-text">Committed to quality & hygiene</span>
              </div>
              <div class="benefit-item">
                <span class="benefit-icon">🚚</span>
                <span class="benefit-text">Fast and reliable delivery</span>
              </div>
              <div class="benefit-item">
                <span class="benefit-icon">🇪🇹</span>
                <span class="benefit-text">Supporting Ethiopian farmers</span>
              </div>
              <div class="benefit-item">
                <span class="benefit-icon">♻️</span>
                <span class="benefit-text">Sustainable & eco-friendly</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ─── SLIDE 4: Our Values ────────────────────────────── -->
      <section class="slide" id="values">
        <div class="slide-bg">
          <img src="https://images.unsplash.com/photo-1550258987-190a2d41a8ba?w=1800&auto=format&fit=crop" alt="Strawberries" />
          <div class="slide-overlay" />
        </div>
        <div class="slide-content reverse" ref="slide4">
          <div class="content-text">
            <span class="slide-number">04</span>
            <h2 class="slide-title">Our <em>Values</em></h2>
            <div class="values-grid">
              <div class="value-item">
                <h4>Quality</h4>
                <p>Premium fruits, premium taste</p>
              </div>
              <div class="value-item">
                <h4>Purity</h4>
                <p>100% natural, no compromises</p>
              </div>
              <div class="value-item">
                <h4>Sustainability</h4>
                <p>Good for you, good for the planet</p>
              </div>
              <div class="value-item">
                <h4>Community</h4>
                <p>Supporting local farmers</p>
              </div>
            </div>
          </div>
          <div class="content-circle circle-right">
            <div class="circle-icon">💎</div>
          </div>
        </div>
      </section>

    </div>

    <!-- ─── CART DRAWER ──────────────────────────────────────── -->
    <CartDrawer :isOpen="cartOpen" @close="cartOpen = false" />

  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useCartStore } from '../stores/cart.js'
import CartDrawer from '../components/CartDrawer.vue'
import gsap from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger)

const cartStore = useCartStore()
const cartOpen = ref(false)
const mobileMenuOpen = ref(false)

const openCart = () => {
  cartOpen.value = true
}

const closeCart = () => {
  cartOpen.value = false
}

// ─── SCROLL ANIMATIONS ────────────────────────────────────────
const scrollEl = ref(null)
const slide1 = ref(null)
const slide2 = ref(null)
const slide3 = ref(null)
const slide4 = ref(null)
let observer = null

onMounted(() => {
  const slides = [slide1.value, slide2.value, slide3.value, slide4.value]
  
  observer = new IntersectionObserver(
    (entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const el = entry.target
          const circle = el.querySelector('.content-circle')
          const text = el.querySelector('.content-text')
          
          if (circle) {
            circle.style.opacity = '1'
            circle.style.transform = 'scale(1)'
          }
          if (text) {
            text.style.opacity = '1'
            text.style.transform = 'translateX(0)'
          }
        }
      })
    },
    { threshold: 0.2 }
  )

  slides.forEach(slide => {
    if (slide) observer.observe(slide)
  })
})

onUnmounted(() => {
  if (observer) observer.disconnect()
})
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,700&family=Inter:wght@300;400;500;600&display=swap');

/* ═══ ROOT ══════════════════════════════════════════════════ */
.about-page {
  background: #000;
  color: #fff;
  font-family: 'Inter', sans-serif;
  min-height: 100vh;
  overflow: hidden;
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

/* ─── HERO SECTION ══════════════════════════════════════════ */
.hero-section {
  height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
}

.hero-bg {
  position: absolute;
  inset: 0;
  z-index: 0;
}

.hero-bg img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: brightness(0.4) saturate(0.8);
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to right, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 60%, transparent 100%);
}

.hero-content {
  position: relative;
  z-index: 10;
  text-align: center;
  max-width: 800px;
  padding: 0 24px;
}

.hero-eyebrow {
  font-size: 11px;
  letter-spacing: 0.22em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.4);
  margin-bottom: 24px;
}

.hero-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(56px, 8vw, 100px);
  font-weight: 900;
  line-height: 0.92;
  letter-spacing: -0.03em;
  color: #fff;
  margin-bottom: 24px;
}

.hero-title em {
  font-style: italic;
  color: rgba(255,255,255,0.5);
}

.hero-sub {
  font-size: 18px;
  font-weight: 300;
  line-height: 1.8;
  color: rgba(255,255,255,0.5);
  max-width: 500px;
  margin: 0 auto;
}

.scroll-indicator {
  position: absolute;
  bottom: 40px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 10;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
}

.scroll-indicator span {
  font-size: 10px;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.3);
}

.scroll-line {
  width: 1px;
  height: 40px;
  background: linear-gradient(to bottom, rgba(255,255,255,0.3), transparent);
  animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
  0%,100% { opacity: 0.3; transform: scaleY(1); }
  50% { opacity: 0.8; transform: scaleY(1.1); }
}

/* ═══ SCROLL CONTAINER ══════════════════════════════════════ */
.scroll-container {
  height: 100vh;
  overflow-y: scroll;
  scroll-snap-type: y mandatory;
  scroll-behavior: smooth;
}

.scroll-container::-webkit-scrollbar {
  display: none;
}

/* ═══ SLIDES ════════════════════════════════════════════════ */
.slide {
  height: 100vh;
  scroll-snap-align: start;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
}

.slide-bg {
  position: absolute;
  inset: 0;
  z-index: 0;
}

.slide-bg img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: brightness(0.3) saturate(0.7);
}

.slide-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,0.6);
}

.slide-content {
  position: relative;
  z-index: 10;
  max-width: 1200px;
  width: 100%;
  padding: 0 64px;
  display: flex;
  align-items: center;
  gap: 60px;
}

.slide-content.reverse {
  flex-direction: row-reverse;
}

/* ─── Content Circle ────────────────────────────────────────── */
.content-circle {
  width: 280px;
  height: 280px;
  border-radius: 50%;
  border: 2px solid rgba(255,255,255,0.08);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  opacity: 0;
  transform: scale(0.8);
  transition: all 0.8s cubic-bezier(0.16,1,0.3,1);
  position: relative;
  background: rgba(255,255,255,0.02);
  backdrop-filter: blur(10px);
}

.content-circle::before {
  content: '';
  position: absolute;
  inset: -20px;
  border-radius: 50%;
  border: 1px solid rgba(255,255,255,0.03);
  animation: spin 20s linear infinite;
}

@keyframes spin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

.content-circle::after {
  content: '';
  position: absolute;
  inset: 20px;
  border-radius: 50%;
  border: 1px solid rgba(255,255,255,0.03);
  animation: spin 15s linear infinite reverse;
}

.circle-icon {
  font-size: 72px;
  animation: float 4s ease-in-out infinite;
}

@keyframes float {
  0%,100% { transform: translateY(0px); }
  50% { transform: translateY(-15px); }
}

.circle-left {
  margin-left: 0;
}

.circle-right {
  margin-right: 0;
}

/* ─── Content Text ──────────────────────────────────────────── */
.content-text {
  flex: 1;
  opacity: 0;
  transform: translateX(-30px);
  transition: all 0.8s cubic-bezier(0.16,1,0.3,1) 0.2s;
}

.slide-content.reverse .content-text {
  transform: translateX(30px);
}

.slide-number {
  font-size: 12px;
  font-weight: 400;
  letter-spacing: 0.2em;
  color: rgba(255,255,255,0.2);
  margin-bottom: 16px;
  display: block;
}

.slide-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(36px, 4vw, 56px);
  font-weight: 900;
  color: #fff;
  margin-bottom: 24px;
  line-height: 1.05;
}

.slide-title em {
  font-style: italic;
  color: rgba(255,255,255,0.4);
}

.slide-desc {
  font-size: 16px;
  font-weight: 300;
  line-height: 1.85;
  color: rgba(255,255,255,0.5);
  max-width: 500px;
  margin-bottom: 16px;
}

.slide-tag {
  display: inline-block;
  font-size: 11px;
  font-weight: 500;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.5);
  border: 1px solid rgba(255,255,255,0.1);
  padding: 8px 20px;
  border-radius: 100px;
  margin-top: 8px;
  background: rgba(255,255,255,0.03);
}

/* ─── Benefits Grid ──────────────────────────────────────────── */
.benefits-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
  max-width: 520px;
}

.benefit-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 16px;
  border-radius: 12px;
  background: rgba(255,255,255,0.03);
  border: 1px solid rgba(255,255,255,0.04);
  transition: all 0.3s ease;
}

.benefit-item:hover {
  background: rgba(255,255,255,0.06);
  border-color: rgba(255,255,255,0.08);
}

.benefit-icon {
  font-size: 20px;
  flex-shrink: 0;
}

.benefit-text {
  font-size: 13px;
  color: rgba(255,255,255,0.6);
  font-weight: 300;
}

/* ─── Values Grid ───────────────────────────────────────────── */
.values-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  max-width: 440px;
}

.value-item {
  padding: 20px 24px;
  border-radius: 16px;
  background: rgba(255,255,255,0.03);
  border: 1px solid rgba(255,255,255,0.04);
  text-align: center;
}

.value-item h4 {
  font-family: 'Playfair Display', serif;
  font-size: 20px;
  font-weight: 700;
  color: #fff;
  margin-bottom: 4px;
}

.value-item p {
  font-size: 12px;
  color: rgba(255,255,255,0.4);
  font-weight: 300;
}

/* ─── RESPONSIVE ────────────────────────────────────────────── */
@media (max-width: 1024px) {
  .slide-content {
    padding: 0 40px;
    gap: 40px;
  }
  .content-circle {
    width: 200px;
    height: 200px;
  }
  .circle-icon {
    font-size: 48px;
  }
}

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

  .slide-content {
    padding: 0 24px;
    flex-direction: column !important;
    gap: 24px;
    text-align: center;
  }
  
  .content-circle {
    width: 160px;
    height: 160px;
  }
  .circle-icon {
    font-size: 40px;
  }
  
  .content-text {
    transform: translateX(0) !important;
  }
  
  .slide-desc {
    max-width: 100%;
  }
  
  .benefits-grid {
    grid-template-columns: 1fr;
    max-width: 100%;
  }
  
  .values-grid {
    grid-template-columns: 1fr;
    max-width: 100%;
  }
  
  .hero-title {
    font-size: 48px;
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

  .hero-title {
    font-size: 32px;
  }
}
</style>