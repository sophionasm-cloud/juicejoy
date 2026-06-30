<template>
  <div class="cinema-root">

   <!-- ─── NAVBAR ──────────────────────────────────────────────── -->
<nav class="super-nav">
  <div class="nav-inner">
    <router-link to="/" class="nav-logo">
      <span class="logo-dot" />JuicePure
    </router-link>

    <!-- Mobile Hamburger -->
    <button class="hamburger" @click="mobileMenuOpen = !mobileMenuOpen" aria-label="Toggle menu">
      <span class="hamburger-line" :class="{ open: mobileMenuOpen }" />
      <span class="hamburger-line" :class="{ open: mobileMenuOpen }" />
      <span class="hamburger-line" :class="{ open: mobileMenuOpen }" />
    </button>

    <!-- Nav Links -->
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

<!-- ─── FIXED NAV DOTS ──────────────────────────────────── -->
<nav class="dot-nav">
  <button
    v-for="(p, i) in products"
    :key="p.id"
    class="dot"
    :class="{ active: current === i }"
    :aria-label="p.name"
    @click="goTo(i)"
  />
</nav>
    <!-- ─── FIXED COUNTER ──────────────────────────────────── -->
    <div class="fixed-counter">
      <span class="c-now">{{ pad(current + 1) }}</span>
      <span class="c-line" />
      <span class="c-total">{{ pad(products.length) }}</span>
    </div>

    <!-- ─── FIXED PRODUCT NAME ────────────────────────────── -->
    <Transition name="label" mode="out-in">
      <div class="fixed-label" :key="current">{{ products[current].name }}</div>
    </Transition>

    <!-- ─── CART TOAST ─────────────────────────────────────── -->
    <Transition name="toast">
      <div v-if="toast" class="toast">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="20 6 9 17 4 12"/>
        </svg>
        Added to cart
      </div>
    </Transition>

    <!-- ─── CART DRAWER ─────────────────────────────────────── -->
    <CartDrawer :isOpen="cartOpen" @close="cartOpen = false" />

    <!-- ─── SCROLL CONTAINER ───────────────────────────────── -->
    <div class="scroll-container" ref="scrollEl" @scroll.passive="onScroll">

      <section
        v-for="(p, i) in products"
        :key="p.id"
        :ref="el => { if(el) slides[i] = el }"
        class="slide"
        :class="{ active: current === i }"
      >

        <!-- PARALLAX BG IMAGE -->
        <div class="slide-bg" :ref="el => { if(el) bgs[i] = el }">
          <img :src="p.img" :alt="p.name" class="bg-img" />

          <!-- layered cinematic overlays -->
          <div class="ov-base"   />
          <div class="ov-left"   />
          <div class="ov-radial" />
          <div class="ov-bottom" />
          <div class="ov-tint"   :style="`background:${p.color}22`" />
        </div>

        <!-- ANIMATED FRUIT / JUICE ELEMENT -->
        <div class="juice-visual" :class="{ in: current === i }">
          <div class="juice-glow" :style="`background:radial-gradient(ellipse,${p.color}55 0%,transparent 68%)`" />
          <img :src="p.fruitImg" :alt="p.name + ' fruit'" class="fruit-img" />
          <!-- light refraction rings -->
          <div class="ring ring-1" :style="`border-color:${p.color}30`" />
          <div class="ring ring-2" :style="`border-color:${p.color}18`" />
          <div class="ring ring-3" :style="`border-color:${p.color}0c`" />
          <!-- animated particles -->
          <div v-for="d in 6" :key="d" class="particle" :style="`--n:${d};background:${p.color}`" />
        </div>

        <!-- SLIDE CONTENT -->
        <div class="slide-content" :class="{ in: current === i }">

          <div class="s-eyebrow">
            <span class="e-dot" :style="`background:${p.color}`" />
            {{ p.category }}
          </div>

          <h2 class="s-title">{{ p.name }}</h2>
          <p  class="s-italic"><em>{{ p.tagline }}</em></p>
          <p  class="s-desc">{{ p.desc }}</p>

          <div class="s-tags">
            <span v-for="t in p.notes" :key="t" class="s-tag">{{ t }}</span>
          </div>

          <div class="s-cta">
            <div class="s-price">
              <span class="p-label">From</span>
              <span class="p-val">${{ p.price.toFixed(2) }}</span>
            </div>
            <button class="btn-cart" @click="addToCart(p)">
              Add to Cart
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
              </svg>
            </button>
          </div>

        </div>

        <!-- BIG GHOST NUMBER -->
        <div class="ghost-num">{{ pad(i + 1) }}</div>

      </section>
    </div>

    <!-- SCROLL HINT -->
    <Transition name="fade">
      <div v-if="current === 0 && !scrolled" class="scroll-hint">
        <div class="sh-line" /><span>Scroll</span>
      </div>
    </Transition>

  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useCartStore } from '../stores/cart.js'
import CartDrawer from '../components/CartDrawer.vue'

// ─── CART STORE ──────────────────────────────────────────────
const cartStore = useCartStore()
const cartOpen = ref(false)
const mobileMenuOpen = ref(false)

const openCart = () => {
  cartOpen.value = true
}

/* ── PRODUCTS ─────────────────────────────────────────────── */
const products = [
  {
    id: 1,
    name: 'Orange Bliss',
    tagline: 'Sun-kissed sweetness, every sip.',
    desc: 'Valencian oranges cold-pressed at dawn with raw wildflower honey. Bright, floral, effortlessly alive.',
    price: 4.99,
    category: 'Citrus',
    color: '#FF8C42',
    notes: ['Valencia Orange', 'Wildflower Honey', 'Vitamin C'],
    img: 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=1800&auto=format&fit=crop&q=85',
    fruitImg: 'https://images.unsplash.com/photo-1547514701-42782101795e?w=700&auto=format&fit=crop&q=85',
  },
  {
    id: 2,
    name: 'Berry Blast',
    tagline: 'Dark, wild, and deeply alive.',
    desc: 'Strawberry, blueberry and raspberry crushed cold. Antioxidant-rich, vibrantly purple, completely addictive.',
    price: 5.49,
    category: 'Berry',
    color: '#C0507A',
    notes: ['Strawberry', 'Blueberry', 'Raspberry'],
    img: 'https://images.unsplash.com/photo-1553361371-9b22f78e8b1d?w=1800&auto=format&fit=crop&q=85',
    fruitImg: 'https://images.unsplash.com/photo-1464965911861-746a04b4bca6?w=700&auto=format&fit=crop&q=85',
  },
  {
    id: 3,
    name: 'Mango Tango',
    tagline: 'Tropics bottled. Chaos tamed.',
    desc: 'Alphonso mangoes at peak ripeness pressed with lime zest and a whisper of chilli. Warm, golden, dangerously smooth.',
    price: 5.99,
    category: 'Tropical',
    color: '#F4A636',
    notes: ['Alphonso Mango', 'Lime Zest', 'Chilli'],
    img: 'https://images.unsplash.com/photo-1546548970-71785318a17b?w=1800&auto=format&fit=crop&q=85',
    fruitImg: 'https://images.unsplash.com/photo-1601493700631-2b16ec4b4716?w=700&auto=format&fit=crop&q=85',
  },
  {
    id: 4,
    name: 'Lemon Zest',
    tagline: 'Sharp. Bright. Uncompromising.',
    desc: 'Sicilian lemons cold-pressed with raw ginger root and turmeric. A morning ritual disguised as a drink.',
    price: 4.29,
    category: 'Citrus',
    color: '#E8D44D',
    notes: ['Sicilian Lemon', 'Ginger Root', 'Turmeric'],
    img: 'https://images.unsplash.com/photo-1621506289937-a8e4df240d0b?w=1800&auto=format&fit=crop&q=85',
    fruitImg: 'https://images.unsplash.com/photo-1582979512210-99b6a53386f9?w=700&auto=format&fit=crop&q=85',
  },
  {
    id: 5,
    name: 'Apple Tango',
    tagline: 'Clean. Crisp. Effortless.',
    desc: 'Granny Smith apples pressed with garden-fresh mint and cucumber water. The definition of refreshed.',
    price: 4.49,
    category: 'Classic',
    color: '#7EC850',
    notes: ['Granny Smith', 'Fresh Mint', 'Cucumber'],
    img: 'https://images.unsplash.com/photo-1576673442511-7e39b6545c87?w=1800&auto=format&fit=crop&q=85',
    fruitImg: 'https://images.unsplash.com/photo-1570913149827-d2ac84ab3f9a?w=700&auto=format&fit=crop&q=85',
  },
  {
    id: 6,
    name: 'Grape Vine',
    tagline: 'Velvet darkness. Every drop.',
    desc: 'Concord grapes slow-pressed into a deep jewel-toned elixir. Rich, earthy, utterly indulgent.',
    price: 5.29,
    category: 'Classic',
    color: '#8B5CF6',
    notes: ['Concord Grape', 'Elderberry', 'Pomegranate'],
    img: 'https://images.unsplash.com/photo-1596363505724-9c3c2a3b4a5d?w=1800&auto=format&fit=crop&q=85',
    fruitImg: 'https://images.unsplash.com/photo-1537640538966-79f369143f8f?w=700&auto=format&fit=crop&q=85',
  },
]

/* ── STATE ────────────────────────────────────────────────── */
const scrollEl = ref(null)
const slides   = ref([])
const bgs      = ref([])
const current  = ref(0)
const toast    = ref(false)
const scrolled = ref(false)
let toastTimer = null
let ticking    = false

/* ── HELPERS ──────────────────────────────────────────────── */
const pad = n => String(n).padStart(2, '0')

/* ── SCROLL HANDLER ───────────────────────────────────────── */
function onScroll() {
  scrolled.value = true
  if (ticking) return
  ticking = true
  requestAnimationFrame(() => {
    const el = scrollEl.value
    if (!el) { ticking = false; return }
    const { scrollTop, clientHeight } = el
    const mid = scrollTop + clientHeight / 2

    slides.value.forEach((slide, i) => {
      if (!slide) return
      const top = slide.offsetTop
      const bot = top + slide.offsetHeight
      if (mid >= top && mid < bot) current.value = i

      const bg = bgs.value[i]
      if (bg) {
        const progress = (scrollTop - top) / clientHeight
        const shift = progress * 80
        bg.style.transform = `translateY(${shift}px)`
      }
    })
    ticking = false
  })
}

/* ── NAVIGATE ─────────────────────────────────────────────── */
function goTo(i) {
  const el = scrollEl.value
  const slide = slides.value[i]
  if (!el || !slide) return
  el.scrollTo({ top: slide.offsetTop, behavior: 'smooth' })
}

/* ── ADD TO CART ──────────────────────────────────────────── */
function addToCart(product) {
  cartStore.addItem({
    id: product.id,
    name: product.name,
    price: product.price,
    color: product.color,
    img: product.fruitImg,
    fruitImg: product.fruitImg
  })
  
  if (toastTimer) clearTimeout(toastTimer)
  toast.value = true
  toastTimer = setTimeout(() => { toast.value = false }, 2200)
}

/* ── LIFECYCLE ────────────────────────────────────────────── */
onMounted(() => {
  const el = scrollEl.value
  if (el) el.addEventListener('scroll', onScroll, { passive: true })
})
onUnmounted(() => {
  const el = scrollEl.value
  if (el) el.removeEventListener('scroll', onScroll)
  if (toastTimer) clearTimeout(toastTimer)
})
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,900;1,700&family=Inter:wght@300;400;500;600&display=swap');

/* ═══ ROOT ══════════════════════════════════════════════════ */
.cinema-root {
  position: relative;
  width: 100%;
  height: 100vh;
  background: #000;
  font-family: 'Inter', sans-serif;
  color: #fff;
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
  animation: navSlide 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
}

@keyframes navSlide {
  from { transform: translateY(-100%); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
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

/* ─── NAV LINKS ───────────────────────────────────────────── */
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

.nav-links a:hover::after, .nav-links router-link:hover::after {
  width: 100%;
}

/* ─── NAV ACTIONS ──────────────────────────────────────────── */
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

  .nav-icon svg {
    width: 16px;
    height: 16px;
  }

  .slide-content {
    padding: 0 24px;
    max-width: 100%;
  }

  .juice-visual {
    right: 50%;
    top: 22%;
    transform: translateX(50%) scale(0.7);
    width: 200px;
    opacity: 0.4 !important;
  }

  .juice-visual.in {
    transform: translateX(50%) scale(1);
    opacity: 0.4 !important;
  }

  .ghost-num {
    font-size: 120px;
  }

  .dot-nav {
    right: 12px;
  }

  .fixed-counter {
    left: 14px;
  }

  .s-title {
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
}

/* ═══ SCROLL CONTAINER ══════════════════════════════════════ */
.scroll-container {
  width: 100%;
  height: 100%;
  overflow-y: scroll;
  scroll-snap-type: y mandatory;
  scroll-behavior: smooth;
  -webkit-overflow-scrolling: touch;
}
.scroll-container::-webkit-scrollbar { display: none; }
.scroll-container { scrollbar-width: none; }

/* ═══ SLIDE ═════════════════════════════════════════════════ */
.slide {
  position: relative;
  width: 100%;
  height: 100vh;
  scroll-snap-align: start;
  display: flex;
  align-items: center;
  overflow: hidden;
}

/* ═══ BACKGROUND ════════════════════════════════════════════ */
.slide-bg {
  position: absolute;
  inset: -60px 0;
  will-change: transform;
  z-index: 0;
}
.bg-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  filter: brightness(0.55) saturate(1.1);
  transition: filter 1.2s ease;
}
.slide.active .bg-img { filter: brightness(0.50) saturate(1.15); }

.ov-base {
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,0.35);
  z-index: 1;
}
.ov-left {
  position: absolute;
  inset: 0;
  background: linear-gradient(to right, rgba(0,0,0,0.92) 0%, rgba(0,0,0,0.55) 45%, transparent 72%);
  z-index: 2;
}
.ov-radial {
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at 70% 50%, transparent 35%, rgba(0,0,0,0.50) 100%);
  z-index: 3;
}
.ov-bottom {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(0,0,0,0.65) 0%, transparent 40%);
  z-index: 4;
}
.ov-tint {
  position: absolute;
  inset: 0;
  mix-blend-mode: screen;
  pointer-events: none;
  z-index: 5;
}

/* ═══ JUICE VISUAL ════════════════════════════════════════════ */
.juice-visual {
  position: absolute;
  right: 7%;
  top: 50%;
  transform: translateY(-50%) scale(0.82) translateX(60px);
  width: clamp(280px, 32vw, 520px);
  aspect-ratio: 1;
  opacity: 0;
  z-index: 15;
  transition:
    opacity   0.9s cubic-bezier(0.16,1,0.3,1) 0.25s,
    transform 1.1s cubic-bezier(0.16,1,0.3,1) 0.25s;
}
.juice-visual.in {
  opacity: 1;
  transform: translateY(-50%) scale(1) translateX(0);
}

.juice-glow {
  position: absolute;
  inset: -20%;
  border-radius: 50%;
  animation: pulseGlow 4s ease-in-out infinite;
  pointer-events: none;
}
@keyframes pulseGlow {
  0%,100% { opacity: 0.7; transform: scale(1); }
  50% { opacity: 1; transform: scale(1.08); }
}

.fruit-img {
  position: relative;
  z-index: 2;
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
  box-shadow: 0 40px 120px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.06);
  animation: floatFruit 7s ease-in-out infinite;
}
@keyframes floatFruit {
  0%,100% { transform: translateY(0px) rotate(0deg); }
  33% { transform: translateY(-18px) rotate(3deg); }
  66% { transform: translateY(-8px) rotate(-2deg); }
}

.ring {
  position: absolute;
  border-radius: 50%;
  border: 1px solid;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  animation: ringPulse 3s ease-in-out infinite;
  pointer-events: none;
  z-index: 1;
}
.ring-1 { width: 108%; height: 108%; animation-delay: 0s; }
.ring-2 { width: 124%; height: 124%; animation-delay: 0.6s; }
.ring-3 { width: 142%; height: 142%; animation-delay: 1.2s; }
@keyframes ringPulse {
  0%,100% { opacity: 0.6; transform: translate(-50%,-50%) scale(1); }
  50% { opacity: 1; transform: translate(-50%,-50%) scale(1.03); }
}

.particle {
  position: absolute;
  width: 5px;
  height: 5px;
  border-radius: 50%;
  top: 50%;
  left: 50%;
  opacity: 0;
  z-index: 3;
  animation: orbit calc(4s + var(--n) * 0.7s) ease-in-out infinite;
  animation-delay: calc(var(--n) * 0.4s);
}
@keyframes orbit {
  0% { opacity:0; transform: translate(-50%,-50%) rotate(calc(var(--n)*60deg)) translateX(55%) scale(0); }
  20% { opacity:1; }
  80% { opacity:1; }
  100% { opacity:0; transform: translate(-50%,-50%) rotate(calc(var(--n)*60deg + 360deg)) translateX(65%) scale(1.5); }
}

/* ═══ SLIDE CONTENT ═════════════════════════════════════════ */
.slide-content {
  position: relative;
  z-index: 20;
  padding: 0 5% 0 7%;
  max-width: 580px;
  opacity: 0;
  transform: translateX(-40px);
  transition:
    opacity   0.85s cubic-bezier(0.16,1,0.3,1) 0.1s,
    transform 0.85s cubic-bezier(0.16,1,0.3,1) 0.1s;
}
.slide-content.in {
  opacity: 1;
  transform: translateX(0);
}

.s-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 10px;
  letter-spacing: 0.24em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.40);
  margin-bottom: 18px;
  transition: all 0.6s ease 0.3s;
}
.e-dot {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  flex-shrink: 0;
}

.s-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(48px, 6.5vw, 92px);
  font-weight: 900;
  line-height: 0.88;
  letter-spacing: -0.03em;
  color: #fff;
  margin-bottom: 16px;
}

.s-italic {
  font-family: 'Playfair Display', serif;
  font-size: clamp(15px, 1.6vw, 20px);
  font-style: italic;
  color: rgba(255,255,255,0.48);
  margin-bottom: 18px;
  line-height: 1.4;
}

.s-desc {
  font-size: 14px;
  font-weight: 300;
  line-height: 1.85;
  color: rgba(255,255,255,0.38);
  max-width: 380px;
  margin-bottom: 26px;
}

.s-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 36px;
}
.s-tag {
  font-size: 10px;
  font-weight: 400;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.34);
  border: 1px solid rgba(255,255,255,0.10);
  background: rgba(255,255,255,0.04);
  padding: 6px 14px;
  border-radius: 100px;
  backdrop-filter: blur(4px);
}

.s-cta {
  display: flex;
  align-items: center;
  gap: 28px;
}
.s-price { display: flex; flex-direction: column; gap: 2px; }
.p-label { font-size: 9px; letter-spacing: 0.2em; text-transform: uppercase; color: rgba(255,255,255,0.26); }
.p-val { font-family: 'Playfair Display', serif; font-size: 30px; font-weight: 900; color: #fff; letter-spacing: -0.02em; }

.btn-cart {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  font-family: 'Inter', sans-serif;
  font-size: 12px;
  font-weight: 500;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: #000;
  background: #fff;
  border: none;
  padding: 14px 30px;
  border-radius: 100px;
  cursor: pointer;
  transition: background 0.25s, transform 0.2s;
}
.btn-cart:hover { background: rgba(255,255,255,0.85); transform: scale(1.03); }

/* ═══ GHOST NUMBER ══════════════════════════════════════════ */
.ghost-num {
  position: absolute;
  right: 5%;
  bottom: -30px;
  z-index: 6;
  font-family: 'Playfair Display', serif;
  font-size: clamp(160px, 20vw, 280px);
  font-weight: 900;
  color: rgba(255,255,255,0.028);
  line-height: 1;
  letter-spacing: -0.05em;
  pointer-events: none;
  user-select: none;
}

/* ═══ DOT NAV ═══════════════════════════════════════════════ */
.dot-nav {
  position: fixed;
  right: 28px;
  top: 50%;
  transform: translateY(-50%);
  z-index: 100;
  display: flex;
  flex-direction: column;
  gap: 10px;
  align-items: center;
}
.dot {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  border: none;
  background: rgba(255,255,255,0.22);
  cursor: pointer;
  padding: 0;
  transition: all 0.4s ease;
}
.dot.active {
  background: #fff;
  transform: scale(1.5);
}

/* ═══ COUNTER ═══════════════════════════════════════════════ */
.fixed-counter {
  position: fixed;
  left: 36px;
  bottom: 44px;
  z-index: 100;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
}
.c-now { font-size: 13px; font-weight: 500; color: rgba(255,255,255,0.85); letter-spacing: 0.08em; }
.c-line { width: 1px; height: 28px; background: rgba(255,255,255,0.18); }
.c-total { font-size: 12px; font-weight: 300; color: rgba(255,255,255,0.28); letter-spacing: 0.08em; }

/* ═══ FIXED LABEL ═══════════════════════════════════════════ */
.fixed-label {
  position: fixed;
  top: 36px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 100;
  font-family: 'Playfair Display', serif;
  font-size: 13px;
  font-weight: 400;
  letter-spacing: 0.28em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.28);
}
.label-enter-active { transition: all 0.5s ease; }
.label-leave-active { transition: all 0.3s ease; }
.label-enter-from { opacity: 0; transform: translateX(-50%) translateY(-8px); }
.label-leave-to { opacity: 0; transform: translateX(-50%) translateY(8px); }

/* ═══ SCROLL HINT ════════════════════════════════════════════ */
.scroll-hint {
  position: fixed;
  bottom: 44px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 100;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  pointer-events: none;
}
.scroll-hint span { font-size: 10px; letter-spacing: 0.2em; text-transform: uppercase; color: rgba(255,255,255,0.24); }
.sh-line {
  width: 1px;
  height: 42px;
  background: linear-gradient(to bottom, rgba(255,255,255,0.28), transparent);
  animation: shPulse 2s ease-in-out infinite;
}
@keyframes shPulse {
  0%,100% { opacity: 0.3; transform: scaleY(1); }
  50% { opacity: 0.8; transform: scaleY(1.08); }
}

/* ═══ TOAST ══════════════════════════════════════════════════ */
.toast {
  position: fixed;
  bottom: 40px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 200;
  display: flex;
  align-items: center;
  gap: 10px;
  background: #fff;
  color: #000;
  font-size: 11px;
  font-weight: 500;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  padding: 12px 28px;
  border-radius: 100px;
  box-shadow: 0 12px 48px rgba(0,0,0,0.55);
}
.toast-enter-active { transition: all 0.45s cubic-bezier(0.16,1,0.3,1); }
.toast-leave-active { transition: all 0.3s ease-in; }
.toast-enter-from { opacity: 0; transform: translateX(-50%) translateY(18px); }
.toast-leave-to { opacity: 0; transform: translateX(-50%) translateY(10px); }

/* ═══ FADE ═══════════════════════════════════════════════════ */
.fade-enter-active, .fade-leave-active { transition: opacity 0.5s ease; }
.fade-enter-from, .fade-leave-to { opacity: 0; }
</style>