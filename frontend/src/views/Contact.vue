<template>
  <div class="contact-page">

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
          <li><a href="/benefits">Benefits</a></li>
          <li><a href="/recipes">Recipes</a></li>
          <li><a href="/contact" class="active">Contact</a></li>
        </ul>

        <div class="nav-actions">
          <a href="/checkout" class="btn-order">Order Now</a>
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

    <!-- ─── FLOATING FRUIT DECORATIONS ────────────────────── -->
    <div class="floating-fruits">
      <span class="fruit fruit-1">🍊</span>
      <span class="fruit fruit-2">🍋</span>
      <span class="fruit fruit-3">🍇</span>
      <span class="fruit fruit-4">🍉</span>
      <span class="fruit fruit-5">🍓</span>
      <span class="fruit fruit-6">🥝</span>
      <span class="fruit fruit-7">🍑</span>
      <span class="fruit fruit-8">🍍</span>
    </div>

    <!-- ─── HERO SECTION ────────────────────────────────────── -->
    <section class="hero-section">
      <div class="hero-bg">
        <div class="floating-glow glow-1" />
        <div class="floating-glow glow-2" />
        <div class="floating-glow glow-3" />
      </div>
      <div class="hero-content">
        <div class="hero-text">
          <div class="hero-eyebrow">Get in Touch</div>
          <h1 class="hero-title">
            <span class="word">Let's</span>
            <span class="word">Create</span>
            <span class="word">Something</span>
            <span class="word highlight">Refreshing</span>
            <span class="word">Together.</span>
          </h1>
          <p class="hero-sub">
            We'd love to hear from you. Whether you have questions about our fresh juices,
            partnership opportunities, catering services, or simply want to say hello,
            our team is ready to help.
          </p>
        </div>
      </div>
    </section>

    <!-- ─── CONTACT SECTION ────────────────────────────────── -->
    <section class="contact-section">
      <div class="contact-container">

        <!-- LEFT: Contact Info -->
        <div class="contact-left">
          <div class="info-cards">
            <div class="info-card">
              <div class="info-icon">📍</div>
              <div class="info-content">
                <h4 class="info-label">Location</h4>
                <p class="info-value">Addis Ababa, Ethiopia</p>
              </div>
            </div>

            <div class="info-card">
              <div class="info-icon">📞</div>
              <div class="info-content">
                <h4 class="info-label">Phone</h4>
                <p class="info-value">+251 978901893</p>
              </div>
            </div>

            <div class="info-card">
              <div class="info-icon">✉️</div>
              <div class="info-content">
                <h4 class="info-label">Email</h4>
                <a href="mailto:Sophoniasmelaku@gmail.com" class="info-value link">Sophoniasmelaku@gmail.com</a>
              </div>
            </div>
          </div>

          <div class="social-section">
            <h4 class="social-label">Follow Us</h4>
            <div class="social-icons">
              <!-- Instagram -->
              <a href="https://instagram.com/juicieride" target="_blank" class="social-icon instagram" aria-label="Instagram">
                <div class="icon-wrapper">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                    <circle cx="12" cy="12" r="5"/>
                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                  </svg>
                  <div class="icon-glow instagram-glow" />
                </div>
                <span>Instagram</span>
                <div class="social-badge">12.5K</div>
              </a>

              <!-- YouTube -->
              <a href="https://youtube.com/@juicieride" target="_blank" class="social-icon youtube" aria-label="YouTube">
                <div class="icon-wrapper">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/>
                    <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/>
                  </svg>
                  <div class="icon-glow youtube-glow" />
                </div>
                <span>YouTube</span>
                <div class="social-badge">8.2K</div>
              </a>

              <!-- Telegram -->
              <a href="https://t.me/juicieride" target="_blank" class="social-icon telegram" aria-label="Telegram">
                <div class="icon-wrapper">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 2L11 13"/>
                    <path d="M22 2l-7 20-4-9-9-4 20-7z"/>
                  </svg>
                  <div class="icon-glow telegram-glow" />
                </div>
                <span>Telegram</span>
                <div class="social-badge">@JuicieRide</div>
              </a>

              <!-- Facebook -->
              <a href="https://facebook.com/juicieride" target="_blank" class="social-icon facebook" aria-label="Facebook">
                <div class="icon-wrapper">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                  </svg>
                  <div class="icon-glow facebook-glow" />
                </div>
                <span>Facebook</span>
                <div class="social-badge">15.8K</div>
              </a>

              <!-- TikTok -->
              <a href="https://tiktok.com/@juicieride" target="_blank" class="social-icon tiktok" aria-label="TikTok">
                <div class="icon-wrapper">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 8a6 6 0 0 0 6 6v4a10 10 0 0 1-10-10v-8h4v8z"/>
                    <path d="M10 12a4 4 0 1 1-4 4v-4h4z"/>
                  </svg>
                  <div class="icon-glow tiktok-glow" />
                </div>
                <span>TikTok</span>
                <div class="social-badge">6.4K</div>
              </a>

              <!-- Twitter/X -->
              <a href="https://twitter.com/juicieride" target="_blank" class="social-icon twitter" aria-label="Twitter/X">
                <div class="icon-wrapper">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4l11.733 16h4.267l-11.733 -16z"/>
                    <path d="M4 20l6.768 -6.768"/>
                    <path d="M19 4l-6.768 6.768"/>
                  </svg>
                  <div class="icon-glow twitter-glow" />
                </div>
                <span>Twitter/X</span>
                <div class="social-badge">3.1K</div>
              </a>
            </div>
          </div>
        </div>

        <!-- RIGHT: Contact Form -->
        <div class="contact-right">
          <form class="contact-form" @submit.prevent="handleSubmit">
            <h3 class="form-title">Send a Message</h3>

            <div class="form-row">
              <div class="form-group">
                <input type="text" id="firstName" v-model="form.firstName" required />
                <label for="firstName">First Name</label>
                <span class="focus-border" />
              </div>
              <div class="form-group">
                <input type="text" id="lastName" v-model="form.lastName" required />
                <label for="lastName">Last Name</label>
                <span class="focus-border" />
              </div>
            </div>

            <div class="form-group">
              <input type="email" id="email" v-model="form.email" required />
              <label for="email">Email Address</label>
              <span class="focus-border" />
            </div>

            <div class="form-group">
              <input type="tel" id="phone" v-model="form.phone" />
              <label for="phone">Phone Number</label>
              <span class="focus-border" />
            </div>

            <div class="form-group">
              <input type="text" id="subject" v-model="form.subject" required />
              <label for="subject">Subject</label>
              <span class="focus-border" />
            </div>

            <div class="form-group">
              <textarea id="message" v-model="form.message" rows="5" required></textarea>
              <label for="message">Message</label>
              <span class="focus-border" />
            </div>

            <button type="submit" class="submit-btn">
              <span>Send Message</span>
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"/>
                <polyline points="12 5 19 12 12 19"/>
              </svg>
            </button>
          </form>
        </div>
      </div>
    </section>

    <!-- ─── FOOTER ───────────────────────────────────────────── -->
    <footer class="footer">
      <p class="footer-text">Made with ❤️ in Ethiopia.</p>
    </footer>

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

// ─── FORM DATA ──────────────────────────────────────────────
const form = ref({
  firstName: '',
  lastName: '',
  email: '',
  phone: '',
  subject: '',
  message: ''
})

// ─── FORM SUBMIT ─────────────────────────────────────────────
const handleSubmit = () => {
  const { firstName, lastName, email, phone, subject, message } = form.value
  const fullName = `${firstName} ${lastName}`.trim()

  const telegramMessage = `
Hello Juicie Ride!%0A%0A
Name: ${fullName}%0A
Email: ${email}%0A
Phone: ${phone || 'Not provided'}%0A
Subject: ${subject}%0A
Message: ${message}
  `.trim()

  const url = `https://t.me/sophitily?text=${encodeURIComponent(telegramMessage)}`
  window.open(url, '_blank')
}

// ─── ANIMATIONS ──────────────────────────────────────────────
onMounted(() => {
  // ─── HERO LETTER STAGGER ─────────────────────────────────
  const words = document.querySelectorAll('.word')
  gsap.from(words, {
    duration: 1.2,
    y: 80,
    opacity: 0,
    rotateX: -15,
    stagger: 0.08,
    ease: 'back.out(1.7)',
    scrollTrigger: {
      trigger: '.hero-text',
      start: 'top 80%',
      toggleActions: 'play none none reverse'
    }
  })

  // ─── INFO CARDS ──────────────────────────────────────────
  gsap.from('.info-card', {
    duration: 0.9,
    x: -60,
    opacity: 0,
    stagger: 0.15,
    ease: 'power3.out',
    scrollTrigger: {
      trigger: '.contact-left',
      start: 'top 70%',
      toggleActions: 'play none none reverse'
    }
  })

  // ─── FORM SLIDE ──────────────────────────────────────────
  gsap.from('.contact-form', {
    duration: 1,
    x: 60,
    opacity: 0,
    ease: 'power3.out',
    scrollTrigger: {
      trigger: '.contact-right',
      start: 'top 70%',
      toggleActions: 'play none none reverse'
    }
  })

  // ─── FORM INPUTS STAGGER ─────────────────────────────────
  gsap.from('.form-group', {
    duration: 0.7,
    y: 30,
    opacity: 0,
    stagger: 0.08,
    ease: 'power2.out',
    scrollTrigger: {
      trigger: '.contact-form',
      start: 'top 70%',
      toggleActions: 'play none none reverse'
    }
  })

  // ─── SOCIAL ICONS ────────────────────────────────────────
  gsap.from('.social-icon', {
    duration: 0.8,
    y: 30,
    opacity: 0,
    stagger: 0.1,
    ease: 'back.out(1.7)',
    scrollTrigger: {
      trigger: '.social-section',
      start: 'top 75%',
      toggleActions: 'play none none reverse'
    }
  })

  // ─── FLOATING FRUITS ────────────────────────────────────
  gsap.from('.fruit', {
    duration: 1.5,
    scale: 0,
    opacity: 0,
    stagger: 0.15,
    ease: 'back.out(2)',
    scrollTrigger: {
      trigger: '.hero-section',
      start: 'top 80%',
      toggleActions: 'play none none reverse'
    }
  })
})
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,700&family=Inter:wght@300;400;500;600&display=swap');

/* ═══ ROOT ══════════════════════════════════════════════════ */
.contact-page {
  background: #000;
  color: #fff;
  font-family: 'Inter', sans-serif;
  overflow-x: hidden;
  min-height: 100vh;
}

/* ═══ FLOATING FRUITS ══════════════════════════════════════ */
.floating-fruits {
  position: fixed;
  inset: 0;
  z-index: 1;
  pointer-events: none;
  overflow: hidden;
}

.fruit {
  position: absolute;
  font-size: 40px;
  opacity: 0.06;
  animation: floatFruit 8s ease-in-out infinite;
}

.fruit-1 { top: 5%; left: 3%; animation-delay: 0s; font-size: 50px; }
.fruit-2 { top: 15%; right: 5%; animation-delay: 1.2s; font-size: 35px; }
.fruit-3 { bottom: 30%; left: 2%; animation-delay: 2.5s; font-size: 45px; }
.fruit-4 { bottom: 20%; right: 3%; animation-delay: 0.8s; font-size: 55px; }
.fruit-5 { top: 50%; left: 8%; animation-delay: 1.8s; font-size: 30px; }
.fruit-6 { top: 60%; right: 8%; animation-delay: 3s; font-size: 40px; }
.fruit-7 { bottom: 10%; left: 15%; animation-delay: 0.5s; font-size: 35px; }
.fruit-8 { top: 8%; left: 50%; animation-delay: 2s; font-size: 30px; }

@keyframes floatFruit {
  0%, 100% {
    transform: translateY(0px) rotate(0deg) scale(1);
  }
  33% {
    transform: translateY(-20px) rotate(10deg) scale(1.05);
  }
  66% {
    transform: translateY(10px) rotate(-5deg) scale(0.95);
  }
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

/* ═══ HERO SECTION ══════════════════════════════════════════ */
.hero-section {
  min-height: 60vh;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
  padding: 120px 24px 40px;
}

.hero-bg {
  position: absolute;
  inset: 0;
  z-index: 0;
  overflow: hidden;
}

.floating-glow {
  position: absolute;
  border-radius: 50%;
  filter: blur(120px);
  pointer-events: none;
  animation: floatGlow 12s ease-in-out infinite;
}

.glow-1 {
  width: 400px;
  height: 400px;
  background: rgba(255, 140, 66, 0.08);
  top: -100px;
  right: -100px;
  animation-delay: 0s;
}

.glow-2 {
  width: 300px;
  height: 300px;
  background: rgba(126, 200, 80, 0.06);
  bottom: -80px;
  left: -80px;
  animation-delay: 3s;
}

.glow-3 {
  width: 250px;
  height: 250px;
  background: rgba(244, 166, 54, 0.05);
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation-delay: 6s;
}

@keyframes floatGlow {
  0%, 100% {
    transform: translate(0, 0) scale(1);
  }
  33% {
    transform: translate(30px, -30px) scale(1.1);
  }
  66% {
    transform: translate(-20px, 20px) scale(0.9);
  }
}

.hero-content {
  position: relative;
  z-index: 10;
  max-width: 900px;
  width: 100%;
}

.hero-text {
  text-align: center;
}

.hero-eyebrow {
  font-size: 11px;
  letter-spacing: 0.22em;
  text-transform: uppercase;
  color: rgba(255, 255, 255, 0.3);
  margin-bottom: 24px;
  display: block;
}

.hero-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(42px, 6vw, 72px);
  font-weight: 900;
  line-height: 1.05;
  letter-spacing: -0.03em;
  color: #fff;
  margin-bottom: 24px;
}

.word {
  display: inline-block;
  margin-right: 4px;
}

.word.highlight {
  background: linear-gradient(135deg, #FF8C42, #F4A636);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.hero-sub {
  font-size: 18px;
  font-weight: 300;
  line-height: 1.8;
  color: rgba(255, 255, 255, 0.4);
  max-width: 600px;
  margin: 0 auto;
}

/* ═══ CONTACT SECTION ══════════════════════════════════════ */
.contact-section {
  padding: 40px 48px 80px;
  max-width: 1400px;
  margin: 0 auto;
}

.contact-container {
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 80px;
  align-items: start;
}

/* ─── LEFT SIDE ────────────────────────────────────────────── */
.contact-left {
  display: flex;
  flex-direction: column;
  gap: 48px;
}

.info-cards {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.info-card {
  display: flex;
  align-items: center;
  gap: 20px;
  padding: 20px 24px;
  background: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 16px;
  transition: all 0.3s ease;
}

.info-card:hover {
  background: rgba(255, 255, 255, 0.06);
  border-color: rgba(255, 255, 255, 0.12);
  transform: translateX(4px);
}

.info-icon {
  font-size: 28px;
  flex-shrink: 0;
}

.info-content {
  flex: 1;
}

.info-label {
  font-size: 10px;
  font-weight: 500;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: rgba(255, 255, 255, 0.25);
  margin-bottom: 4px;
}

.info-value {
  font-size: 15px;
  font-weight: 400;
  color: rgba(255, 255, 255, 0.8);
}

.info-value.link {
  color: #FF8C42;
  text-decoration: none;
  transition: color 0.3s ease;
}

.info-value.link:hover {
  color: #F4A636;
}

/* ─── SOCIAL SECTION ───────────────────────────────────────── */
.social-section {
  border-top: 1px solid rgba(255, 255, 255, 0.06);
  padding-top: 40px;
}

.social-label {
  font-size: 11px;
  font-weight: 500;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: rgba(255, 255, 255, 0.25);
  margin-bottom: 20px;
}

.social-icons {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
}

.social-icon {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 14px 18px;
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 14px;
  color: rgba(255, 255, 255, 0.6);
  text-decoration: none;
  font-size: 13px;
  transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
  position: relative;
  overflow: hidden;
}

.social-icon .icon-wrapper {
  position: relative;
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.05);
  transition: all 0.4s ease;
  flex-shrink: 0;
}

.social-icon .icon-wrapper svg {
  width: 16px;
  height: 16px;
  position: relative;
  z-index: 2;
  transition: all 0.4s ease;
}

.icon-glow {
  position: absolute;
  inset: -4px;
  border-radius: 50%;
  opacity: 0;
  transition: opacity 0.4s ease;
  filter: blur(12px);
}

.social-icon:hover .icon-glow {
  opacity: 1;
}

/* Instagram */
.instagram-glow {
  background: radial-gradient(circle at 30% 30%, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
}
.social-icon.instagram:hover {
  border-color: #dc2743;
  transform: translateY(-4px) scale(1.02);
  box-shadow: 0 12px 40px rgba(220, 39, 67, 0.25);
}
.social-icon.instagram:hover .icon-wrapper {
  background: rgba(220, 39, 67, 0.2);
}
.social-icon.instagram:hover svg {
  color: #dc2743;
}

/* YouTube */
.youtube-glow {
  background: radial-gradient(circle at 30% 30%, #ff0000, #cc0000);
}
.social-icon.youtube:hover {
  border-color: #ff0000;
  transform: translateY(-4px) scale(1.02);
  box-shadow: 0 12px 40px rgba(255, 0, 0, 0.25);
}
.social-icon.youtube:hover .icon-wrapper {
  background: rgba(255, 0, 0, 0.15);
}
.social-icon.youtube:hover svg {
  color: #ff0000;
}

/* Telegram */
.telegram-glow {
  background: radial-gradient(circle at 30% 30%, #0088cc, #006699);
}
.social-icon.telegram:hover {
  border-color: #0088cc;
  transform: translateY(-4px) scale(1.02);
  box-shadow: 0 12px 40px rgba(0, 136, 204, 0.25);
}
.social-icon.telegram:hover .icon-wrapper {
  background: rgba(0, 136, 204, 0.15);
}
.social-icon.telegram:hover svg {
  color: #0088cc;
}

/* Facebook */
.facebook-glow {
  background: radial-gradient(circle at 30% 30%, #1877f2, #0d47a1);
}
.social-icon.facebook:hover {
  border-color: #1877f2;
  transform: translateY(-4px) scale(1.02);
  box-shadow: 0 12px 40px rgba(24, 119, 242, 0.25);
}
.social-icon.facebook:hover .icon-wrapper {
  background: rgba(24, 119, 242, 0.15);
}
.social-icon.facebook:hover svg {
  color: #1877f2;
}

/* TikTok */
.tiktok-glow {
  background: radial-gradient(circle at 30% 30%, #00f2ea, #ff0050);
}
.social-icon.tiktok:hover {
  border-color: #ff0050;
  transform: translateY(-4px) scale(1.02);
  box-shadow: 0 12px 40px rgba(255, 0, 80, 0.25);
}
.social-icon.tiktok:hover .icon-wrapper {
  background: rgba(255, 0, 80, 0.15);
}
.social-icon.tiktok:hover svg {
  color: #ff0050;
}

/* Twitter */
.twitter-glow {
  background: radial-gradient(circle at 30% 30%, #1da1f2, #0d8bd9);
}
.social-icon.twitter:hover {
  border-color: #1da1f2;
  transform: translateY(-4px) scale(1.02);
  box-shadow: 0 12px 40px rgba(29, 161, 242, 0.25);
}
.social-icon.twitter:hover .icon-wrapper {
  background: rgba(29, 161, 242, 0.15);
}
.social-icon.twitter:hover svg {
  color: #1da1f2;
}

.social-icon span {
  flex: 1;
  font-weight: 400;
}

.social-badge {
  font-size: 9px;
  font-weight: 500;
  padding: 3px 10px;
  background: rgba(255, 255, 255, 0.06);
  border-radius: 100px;
  color: rgba(255, 255, 255, 0.3);
  transition: all 0.3s ease;
  letter-spacing: 0.04em;
}

.social-icon:hover .social-badge {
  background: rgba(255, 255, 255, 0.12);
  color: rgba(255, 255, 255, 0.6);
}

/* ─── RIGHT SIDE ───────────────────────────────────────────── */
.contact-right {
  position: relative;
}

.contact-form {
  padding: 48px;
  background: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 24px;
  box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
}

.form-title {
  font-family: 'Playfair Display', serif;
  font-size: 28px;
  font-weight: 700;
  color: #fff;
  margin-bottom: 32px;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

.form-group {
  position: relative;
  margin-bottom: 24px;
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 16px 16px 10px;
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 12px;
  font-family: 'Inter', sans-serif;
  font-size: 15px;
  color: #fff;
  transition: all 0.3s ease;
  outline: none;
}

.form-group textarea {
  resize: vertical;
  min-height: 100px;
}

.form-group label {
  position: absolute;
  top: 16px;
  left: 16px;
  font-size: 13px;
  color: rgba(255, 255, 255, 0.3);
  transition: all 0.3s ease;
  pointer-events: none;
  font-weight: 400;
}

.form-group input:focus,
.form-group textarea:focus {
  border-color: rgba(255, 140, 66, 0.4);
  background: rgba(255, 255, 255, 0.06);
}

.form-group input:focus + label,
.form-group textarea:focus + label,
.form-group input:not(:placeholder-shown) + label,
.form-group textarea:not(:placeholder-shown) + label {
  top: -8px;
  left: 12px;
  font-size: 10px;
  color: #FF8C42;
  background: #000;
  padding: 0 8px;
}

.focus-border {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: linear-gradient(90deg, #FF8C42, #F4A636);
  transition: width 0.3s ease;
  border-radius: 0 0 12px 12px;
}

.form-group input:focus ~ .focus-border,
.form-group textarea:focus ~ .focus-border {
  width: 100%;
}

/* ─── SUBMIT BUTTON ────────────────────────────────────────── */
.submit-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  width: 100%;
  padding: 16px 32px;
  background: linear-gradient(135deg, #FF8C42, #F4A636);
  border: none;
  border-radius: 12px;
  font-family: 'Inter', sans-serif;
  font-size: 15px;
  font-weight: 600;
  color: #000;
  cursor: pointer;
  transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
  position: relative;
  overflow: hidden;
  margin-top: 8px;
}

.submit-btn::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, #F4A636, #FF8C42);
  opacity: 0;
  transition: opacity 0.4s ease;
}

.submit-btn:hover {
  transform: translateY(-3px) scale(1.02);
  box-shadow: 0 20px 40px rgba(255, 140, 66, 0.3);
}

.submit-btn:hover::before {
  opacity: 1;
}

.submit-btn span,
.submit-btn svg {
  position: relative;
  z-index: 1;
}

.submit-btn svg {
  transition: transform 0.3s ease;
}

.submit-btn:hover svg {
  transform: translateX(4px);
}

/* ─── FOOTER ────────────────────────────────────────────────── */
.footer {
  padding: 40px 48px;
  text-align: center;
  border-top: 1px solid rgba(255, 255, 255, 0.04);
}

.footer-text {
  font-size: 13px;
  font-weight: 300;
  color: rgba(255, 255, 255, 0.2);
}

/* ═══ RESPONSIVE ══════════════════════════════════════════ */
@media (max-width: 1024px) {
  .contact-container {
    gap: 48px;
  }
}

@media (max-width: 768px) {
  .navbar {
    padding: 0 20px;
  }

  .nav-links {
    display: none;
  }

  .contact-container {
    grid-template-columns: 1fr;
    gap: 40px;
  }

  .contact-section {
    padding: 20px 20px 60px;
  }

  .contact-form {
    padding: 32px 24px;
  }

  .form-row {
    grid-template-columns: 1fr;
  }

  .hero-title {
    font-size: 36px;
  }

  .hero-sub {
    font-size: 15px;
  }

  .footer {
    padding: 24px;
  }

  .social-icons {
    grid-template-columns: 1fr;
  }

  .floating-fruits {
    display: none;
  }
}

@media (max-width: 480px) {
  .hero-title {
    font-size: 28px;
  }

  .contact-form {
    padding: 24px 16px;
  }

  .info-card {
    padding: 16px;
  }
}
</style>