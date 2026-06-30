<template>
  <div class="benefits-page">

    <!-- ─── NAVBAR ──────────────────────────────────────────── -->
    <nav class="navbar">
      <div class="nav-inner">
        <a href="/" class="nav-logo">
          <span class="logo-dot" />Juicie Ride
        </a>

        <ul class="nav-links">
          <li><a href="/">Home</a></li>
          <li><a href="/products">Shop</a></li>
          <li><a href="/about">About</a></li>
          <li><a href="/benefits" class="active">Benefits</a></li>
          <li><a href="/recipes">Recipes</a></li>
          <li><a href="/contact">Contact</a></li>
        </ul>

        <div class="nav-actions">
          <button class="btn-order">Order Now</button>
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

    <!-- ─── PROGRESS INDICATOR ────────────────────────────── -->
    <div class="progress-indicator" id="progress-indicator">
      <div v-for="(benefit, i) in benefits" :key="i" class="progress-dot" :data-index="i">
        <span class="dot-number">{{ String(i + 1).padStart(2, '0') }}</span>
        <span class="dot-label">{{ benefit.short }}</span>
      </div>
    </div>

    <!-- ─── HERO SECTION ────────────────────────────────────── -->
    <section class="hero-section">
      <div class="hero-bg">
        <img src="https://images.unsplash.com/photo-1610832958506-aa56368176cf?w=1800&auto=format&fit=crop" alt="Fresh fruits" />
        <div class="hero-overlay" />
      </div>
      <div class="hero-content">
        <div class="hero-eyebrow">Why Juicie Ride</div>
        <h1 class="hero-title">Pure <em>Benefits</em></h1>
        <p class="hero-sub">Every sip is crafted to nourish your body, support local farmers, and celebrate the vibrant taste of Ethiopia.</p>
      </div>
    </section>

    <!-- ─── HORIZONTAL SCROLL SECTION ──────────────────────── -->
    <section class="horizontal-scroll-section" id="horizontal-scroll">
      <div class="horizontal-track" id="horizontal-track">
        <div v-for="(benefit, i) in benefits" :key="i" class="panel" :data-index="i">
          <div class="panel-content">
            <div class="panel-number">{{ String(i + 1).padStart(2, '0') }}</div>
            <div class="panel-icon">{{ benefit.icon }}</div>
            <h2 class="panel-title">{{ benefit.title }}</h2>
            <p class="panel-desc">{{ benefit.desc }}</p>
            <div class="panel-tag">{{ benefit.tag }}</div>
            <div class="panel-accent" :style="`background: ${benefit.color}`" />
          </div>
        </div>
      </div>
    </section>

    <!-- ─── CART DRAWER ────────────────────────────────────── -->
    <CartDrawer :isOpen="cartOpen" @close="closeCart" />

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

const openCart = () => {
  cartOpen.value = true
}

const closeCart = () => {
  cartOpen.value = false
}

/* ── BENEFITS DATA ─────────────────────────────────────────── */
const benefits = [
  {
    id: 1,
    title: 'Fresh From Ethiopian Farms',
    short: 'Local & Fresh',
    desc: 'Every bottle begins with carefully selected fruits grown by Ethiopian farmers. We partner with local growers to ensure every ingredient is fresh, naturally ripened, and full of authentic flavor.',
    icon: '🇪🇹',
    tag: 'Proudly Ethiopian',
    color: '#FF8C42'
  },
  {
    id: 2,
    title: 'Naturally Healthy',
    short: 'No Artificials',
    desc: 'Our juices are made with natural ingredients, real fruit, and refreshing flavors without unnecessary artificial additives.',
    icon: '🌿',
    tag: '100% Natural',
    color: '#7EC850'
  },
  {
    id: 3,
    title: 'Freshness You Can Trust',
    short: 'Quality Assured',
    desc: 'Every bottle follows strict quality and hygiene standards to preserve freshness from farm to bottle.',
    icon: '✨',
    tag: 'Premium Quality',
    color: '#F4A636'
  },
  {
    id: 4,
    title: 'Delivered Fresh To You',
    short: 'Fast Delivery',
    desc: 'Fast delivery ensures every bottle arrives chilled, fresh, and ready to enjoy.',
    icon: '🚚',
    tag: 'Fresh & Chilled',
    color: '#4A90D9'
  },
  {
    id: 5,
    title: 'Proudly Ethiopian',
    short: 'Supporting Farmers',
    desc: 'Every purchase supports Ethiopian farmers and celebrates local agriculture.',
    icon: '💚',
    tag: 'Community First',
    color: '#8B5CF6'
  },
  {
    id: 6,
    title: 'Refresh Every Moment',
    short: 'Every Occasion',
    desc: 'Whether morning, work, gym, or family time, Juicie Ride is the perfect refreshment.',
    icon: '🍊',
    tag: 'For Every Moment',
    color: '#E8D44D'
  }
]

/* ── GSAP ANIMATIONS ───────────────────────────────────────── */
let scrollTriggerInstance = null

onMounted(() => {
  // ─── Horizontal Scroll Animation ──────────────────────────
  const track = document.getElementById('horizontal-track')
  const section = document.getElementById('horizontal-scroll')
  const panels = document.querySelectorAll('.panel')
  const totalPanels = panels.length

  if (track && section) {
    // Set panel width based on viewport
    const panelWidth = window.innerWidth
    const totalWidth = panelWidth * totalPanels
    track.style.width = totalWidth + 'px'
    track.style.display = 'flex'
    track.style.flexDirection = 'row'

    // Create the main horizontal scroll timeline
    const tl = gsap.to(track, {
      x: -(totalWidth - window.innerWidth),
      ease: 'none',
      scrollTrigger: {
        trigger: section,
        pin: true,
        scrub: 1.2,
        start: 'top top',
        end: () => `+=${section.offsetHeight}`,
        invalidateOnRefresh: true,
        onUpdate: (self) => {
          const progress = self.progress
          const activeIndex = Math.min(Math.floor(progress * totalPanels), totalPanels - 1)
          updateProgress(activeIndex)
        }
      }
    })

    scrollTriggerInstance = tl.scrollTrigger

    // ─── Panel Content Animations ──────────────────────────
    panels.forEach((panel, i) => {
      const content = panel.querySelector('.panel-content')
      const title = panel.querySelector('.panel-title')
      const desc = panel.querySelector('.panel-desc')
      const icon = panel.querySelector('.panel-icon')
      const number = panel.querySelector('.panel-number')
      const tag = panel.querySelector('.panel-tag')

      // Create a timeline for each panel's content
      const panelTl = gsap.timeline({
        scrollTrigger: {
          trigger: panel,
          containerAnimation: scrollTriggerInstance,
          start: 'left center',
          end: 'right center',
          scrub: 1.5,
          invalidateOnRefresh: true
        }
      })

      // Set initial states
      gsap.set(content, { opacity: 0, x: 100, scale: 0.95, filter: 'blur(10px)' })
      gsap.set(title, { opacity: 0, y: 60 })
      gsap.set(desc, { opacity: 0, y: 40 })
      gsap.set(icon, { opacity: 0, scale: 0.5 })
      gsap.set(number, { opacity: 0, y: 20 })
      gsap.set(tag, { opacity: 0, y: 20 })

      // Animate in sequence with stagger
      panelTl
        .to(content, {
          opacity: 1,
          x: 0,
          scale: 1,
          filter: 'blur(0px)',
          duration: 1,
          ease: 'power3.out'
        })
        .to(icon, {
          opacity: 1,
          scale: 1,
          duration: 0.8,
          ease: 'back.out(1.7)'
        }, '-=0.6')
        .to(number, {
          opacity: 1,
          y: 0,
          duration: 0.6,
          ease: 'power2.out'
        }, '-=0.4')
        .to(title, {
          opacity: 1,
          y: 0,
          duration: 0.8,
          ease: 'power3.out'
        }, '-=0.3')
        .to(desc, {
          opacity: 1,
          y: 0,
          duration: 0.7,
          ease: 'power2.out'
        }, '-=0.3')
        .to(tag, {
          opacity: 1,
          y: 0,
          duration: 0.5,
          ease: 'power2.out'
        }, '-=0.2')

      // Exit animation - reverse when scrolling back
      panelTl.to(content, {
        opacity: 0,
        x: -100,
        scale: 0.95,
        filter: 'blur(10px)',
        duration: 0.8,
        ease: 'power2.in'
      }, '+=0.1')
    })

    // ─── Progress Indicator Animation ──────────────────────
    const dots = document.querySelectorAll('.progress-dot')

    function updateProgress(index) {
      dots.forEach((dot, i) => {
        if (i === index) {
          dot.classList.add('active')
        } else {
          dot.classList.remove('active')
        }
      })
    }

    // Initial update
    updateProgress(0)
  }

  // ─── Handle resize ──────────────────────────────────────────
  const handleResize = () => {
    ScrollTrigger.refresh()
  }
  window.addEventListener('resize', handleResize)

  // ─── Cleanup on unmount ──────────────────────────────────
  onUnmounted(() => {
    window.removeEventListener('resize', handleResize)
    if (scrollTriggerInstance) {
      scrollTriggerInstance.kill()
    }
    ScrollTrigger.getAll().forEach(st => st.kill())
  })
})
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,700&family=Inter:wght@300;400;500;600&display=swap');

/* ═══ ROOT ══════════════════════════════════════════════════ */
.benefits-page {
  background: #000;
  color: #fff;
  font-family: 'Inter', sans-serif;
  overflow-x: hidden;
  min-height: 100vh;
}

/* ═══ NAVBAR ════════════════════════════════════════════════ */
.navbar {
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

.nav-links a:hover,
.nav-links a.active {
  color: rgba(255, 255, 255, 0.90);
}

.nav-links a.active::after {
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

/* ═══ HERO SECTION ══════════════════════════════════════════ */
.hero-section {
  height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
  z-index: 1;
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
  filter: brightness(0.3) saturate(0.7);
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.6);
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
  color: rgba(255, 255, 255, 0.3);
  margin-bottom: 24px;
}

.hero-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(48px, 6vw, 80px);
  font-weight: 900;
  line-height: 0.92;
  letter-spacing: -0.03em;
  color: #fff;
  margin-bottom: 24px;
}

.hero-title em {
  font-style: italic;
  color: rgba(255, 255, 255, 0.4);
}

.hero-sub {
  font-size: 18px;
  font-weight: 300;
  line-height: 1.8;
  color: rgba(255, 255, 255, 0.4);
  max-width: 500px;
  margin: 0 auto;
}

/* ═══ HORIZONTAL SCROLL SECTION ════════════════════════════ */
.horizontal-scroll-section {
  position: relative;
  height: 100vh;
  overflow: hidden;
  z-index: 2;
}

.horizontal-track {
  display: flex;
  flex-direction: row;
  height: 100vh;
  will-change: transform;
}

/* ═══ PANELS ════════════════════════════════════════════════ */
.panel {
  width: 100vw;
  height: 100vh;
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
  background: rgba(0, 0, 0, 0.3);
}

.panel::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at center, rgba(255, 255, 255, 0.02) 0%, transparent 70%);
  pointer-events: none;
}

.panel-content {
  position: relative;
  z-index: 10;
  max-width: 600px;
  width: 90%;
  padding: 48px;
  background: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 24px;
  box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
}

.panel-number {
  font-size: 12px;
  font-weight: 400;
  letter-spacing: 0.2em;
  color: rgba(255, 255, 255, 0.15);
  margin-bottom: 16px;
}

.panel-icon {
  font-size: 56px;
  margin-bottom: 16px;
  display: block;
}

.panel-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(28px, 3.5vw, 42px);
  font-weight: 900;
  line-height: 1.05;
  color: #fff;
  margin-bottom: 16px;
}

.panel-desc {
  font-size: 16px;
  font-weight: 300;
  line-height: 1.85;
  color: rgba(255, 255, 255, 0.5);
  margin-bottom: 24px;
}

.panel-tag {
  display: inline-block;
  font-size: 10px;
  font-weight: 500;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: rgba(255, 255, 255, 0.4);
  border: 1px solid rgba(255, 255, 255, 0.08);
  padding: 6px 16px;
  border-radius: 100px;
  background: rgba(255, 255, 255, 0.02);
}

.panel-accent {
  position: absolute;
  top: 0;
  left: 0;
  width: 4px;
  height: 100%;
  border-radius: 24px 0 0 24px;
  opacity: 0.6;
}

/* ═══ PROGRESS INDICATOR ══════════════════════════════════ */
.progress-indicator {
  position: fixed;
  right: 40px;
  top: 50%;
  transform: translateY(-50%);
  z-index: 50;
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 20px;
  pointer-events: none;
}

.progress-dot {
  display: flex;
  align-items: center;
  gap: 12px;
  opacity: 0.2;
  transition: opacity 0.5s ease;
  pointer-events: none;
}

.progress-dot.active {
  opacity: 1;
}

.progress-dot::before {
  content: '';
  width: 2px;
  height: 0;
  background: rgba(255, 255, 255, 0.2);
  transition: height 0.5s ease;
  position: absolute;
  right: -12px;
}

.progress-dot.active::before {
  height: 100%;
}

.dot-number {
  font-size: 11px;
  font-weight: 400;
  letter-spacing: 0.08em;
  color: rgba(255, 255, 255, 0.3);
  transition: color 0.3s ease;
}

.progress-dot.active .dot-number {
  color: #fff;
}

.dot-label {
  font-size: 10px;
  font-weight: 300;
  letter-spacing: 0.06em;
  color: rgba(255, 255, 255, 0.2);
  transition: color 0.3s ease;
  display: none;
}

.progress-dot.active .dot-label {
  color: rgba(255, 255, 255, 0.5);
  display: inline;
}

/* ═══ RESPONSIVE ══════════════════════════════════════════ */
@media (max-width: 1024px) {
  .panel-content {
    padding: 36px;
  }
}

@media (max-width: 768px) {
  .navbar {
    padding: 0 20px;
  }

  .nav-links {
    display: none;
  }

  .panel-content {
    padding: 28px 24px;
    margin: 0 16px;
    border-radius: 16px;
  }

  .panel-icon {
    font-size: 40px;
  }

  .panel-title {
    font-size: 24px;
  }

  .panel-desc {
    font-size: 14px;
  }

  .progress-indicator {
    right: 16px;
    gap: 14px;
  }

  .dot-label {
    display: none !important;
  }

  .dot-number {
    font-size: 10px;
  }

  .hero-title {
    font-size: 40px;
  }

  .hero-sub {
    font-size: 15px;
  }
}

@media (max-width: 480px) {
  .panel-content {
    padding: 20px 16px;
  }

  .panel-icon {
    font-size: 32px;
  }

  .panel-title {
    font-size: 20px;
  }

  .panel-desc {
    font-size: 13px;
  }

  .hero-title {
    font-size: 32px;
  }
}
</style>