<template>
  <div class="home">

    <!-- ─── NAVBAR (NEW) ─────────────────────────────────────── -->
    <Navbar @open-cart="cartOpen = true" />

    <!-- ─── HERO ───────────────────────────────────────── -->
    <section class="hero">

      <!-- Floating Fruits -->
      <div class="fruits-layer" aria-hidden="true">
        <div
          v-for="(fruit, i) in fruits"
          :key="i"
          class="fruit"
          :style="fruit.style"
        >
          <img :src="fruit.src" alt="" />
        </div>
      </div>

      <!-- Hero Content -->
      <div class="hero-content">
        <div class="hero-eyebrow">100% Natural</div>

        <h1 ref="heroTitle" class="hero-title">
          <span class="word-line">Freshness</span>
          <span class="word-line">in <em>Every</em></span>
          <span class="word-line">Drop</span>
        </h1>

        <p ref="heroSubtitle" class="hero-sub"></p>

        <div ref="heroCtas" class="hero-ctas">
          <router-link to="/products" class="btn-primary-link">
            <button class="btn-primary">Shop Now</button>
          </router-link>
          <button class="btn-secondary">Learn More</button>
        </div>
      </div>

      <!-- Scroll hint -->
      <div class="scroll-hint">
        <div class="scroll-line" />
        <span>Scroll</span>
      </div>
    </section>

    <!-- ─── MARQUEE ─────────────────────────────────────── -->
    <div class="marquee-bar">
      <div class="marquee-track">
        <div v-for="(item, i) in marqueeItems" :key="'a' + i" class="marquee-item">
          {{ item }}<div class="marquee-dot" />
        </div>
        <div v-for="(item, i) in marqueeItems" :key="'b' + i" class="marquee-item">
          {{ item }}<div class="marquee-dot" />
        </div>
      </div>
    </div>

    <!-- ─── CART DRAWER ─────────────────────────────────────── -->
    <CartDrawer :isOpen="cartOpen" @close="cartOpen = false" />

  </div>
</template>

<script>
import gsap from 'gsap'
import Navbar from '../components/Navbar.vue'
import CartDrawer from '../components/CartDrawer.vue'

export default {
  name: 'Home',
  components: {
    Navbar,
    CartDrawer
  },

  data() {
    return {
      cartOpen: false,
      marqueeItems: [
        'Cold Pressed', '100% Natural', 'No Preservatives',
        'Organic Sourced', 'Freshly Squeezed', 'Vitamin Rich', 'Farm to Bottle'
      ],
      fruits: [
        {
          src: 'https://images.unsplash.com/photo-1547514701-42782101795e?w=200&auto=format&fit=crop',
          style: 'top:6%;left:3%;width:72px;height:72px;--dur:9s;--delay:0s;--rot:-8deg;--op:0.28'
        },
        {
          src: 'https://images.unsplash.com/photo-1582979512210-99b6a53386f9?w=200&auto=format&fit=crop',
          style: 'top:18%;left:14%;width:82px;height:82px;--dur:10s;--delay:1.1s;--rot:5deg;--op:0.26'
        },
        {
          src: 'https://images.unsplash.com/photo-1589984662646-d1f8d1f6b9e0?w=200&auto=format&fit=crop',
          style: 'top:30%;left:7%;width:94px;height:94px;--dur:11s;--delay:1.6s;--rot:9deg;--op:0.20'
        },
        {
          src: 'https://images.unsplash.com/photo-1585059895524-72359e06133a?w=200&auto=format&fit=crop',
          style: 'top:42%;left:20%;width:66px;height:66px;--dur:9.5s;--delay:1.3s;--rot:18deg;--op:0.22'
        },
        {
          src: 'https://images.unsplash.com/photo-1550258987-190a2d41a8ba?w=200&auto=format&fit=crop',
          style: 'top:54%;left:4%;width:62px;height:62px;--dur:9.2s;--delay:1.9s;--rot:4deg;--op:0.22'
        },
        {
          src: 'https://images.unsplash.com/photo-1570913149827-d2ac84ab3f9a?w=200&auto=format&fit=crop',
          style: 'top:9%;right:6%;width:64px;height:64px;--dur:7.5s;--delay:0.6s;--rot:12deg;--op:0.24'
        },
        {
          src: 'https://images.unsplash.com/photo-1537640538966-79f369143f8f?w=200&auto=format&fit=crop',
          style: 'top:22%;right:13%;width:68px;height:68px;--dur:8.5s;--delay:0.3s;--rot:-14deg;--op:0.22'
        },
        {
          src: 'https://images.unsplash.com/photo-1464965911861-746a04b4bca6?w=200&auto=format&fit=crop',
          style: 'top:34%;right:9%;width:58px;height:58px;--dur:7s;--delay:0.8s;--rot:-6deg;--op:0.26'
        },
        {
          src: 'https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?w=200&auto=format&fit=crop',
          style: 'top:46%;right:21%;width:70px;height:70px;--dur:8s;--delay:0.5s;--rot:-10deg;--op:0.24'
        },
        {
          src: 'https://images.unsplash.com/photo-1571734870002-1b8bb5b7a1e0?w=200&auto=format&fit=crop',
          style: 'top:58%;right:4%;width:74px;height:74px;--dur:10.5s;--delay:0.2s;--rot:-16deg;--op:0.24'
        },
        {
          src: 'https://images.unsplash.com/photo-1547514701-42782101795e?w=200&auto=format&fit=crop',
          style: 'top:8%;left:44%;width:60px;height:60px;--dur:8.8s;--delay:1.4s;--rot:7deg;--op:0.18'
        },
        {
          src: 'https://images.unsplash.com/photo-1570913149827-d2ac84ab3f9a?w=200&auto=format&fit=crop',
          style: 'top:24%;right:38%;width:56px;height:56px;--dur:7.2s;--delay:0.4s;--rot:-3deg;--op:0.18'
        },
        {
          src: 'https://images.unsplash.com/photo-1582979512210-99b6a53386f9?w=200&auto=format&fit=crop',
          style: 'top:38%;left:34%;width:86px;height:86px;--dur:11.5s;--delay:1.8s;--rot:11deg;--op:0.16'
        },
        {
          src: 'https://images.unsplash.com/photo-1537640538966-79f369143f8f?w=200&auto=format&fit=crop',
          style: 'top:50%;right:33%;width:60px;height:60px;--dur:8.3s;--delay:0.7s;--rot:-9deg;--op:0.16'
        },
        {
          src: 'https://images.unsplash.com/photo-1585059895524-72359e06133a?w=200&auto=format&fit=crop',
          style: 'top:5%;left:62%;width:58px;height:58px;--dur:9s;--delay:1.6s;--rot:3deg;--op:0.16'
        },
        {
          src: 'https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?w=200&auto=format&fit=crop',
          style: 'top:16%;right:58%;width:72px;height:72px;--dur:8.4s;--delay:0.6s;--rot:-11deg;--op:0.18'
        },
        {
          src: 'https://images.unsplash.com/photo-1550258987-190a2d41a8ba?w=200&auto=format&fit=crop',
          style: 'top:62%;left:42%;width:76px;height:76px;--dur:9.8s;--delay:2.0s;--rot:14deg;--op:0.16'
        },
        {
          src: 'https://images.unsplash.com/photo-1464965911861-746a04b4bca6?w=200&auto=format&fit=crop',
          style: 'top:70%;right:44%;width:52px;height:52px;--dur:7.6s;--delay:0.9s;--rot:-7deg;--op:0.14'
        },
        {
          src: 'https://images.unsplash.com/photo-1571734870002-1b8bb5b7a1e0?w=200&auto=format&fit=crop',
          style: 'top:82%;right:52%;width:60px;height:60px;--dur:7.8s;--delay:0.3s;--rot:-13deg;--op:0.14'
        }
      ],
      
      typingText: "Premium cold-pressed juices crafted from the world's finest fruits. No additives. No compromise.",
      isTypingComplete: false
    }
  },

  mounted() {
    this.animateHero()
    this.startTyping()
  },

  methods: {
    animateHero() {
      const tl = gsap.timeline()

      const title = this.$refs.heroTitle
      if (title) {
        const words = title.querySelectorAll('.word-line')
        tl.from(words, {
          duration: 0.8,
          y: 80,
          opacity: 0,
          stagger: 0.12,
          ease: 'power3.out'
        })
      }

      const checkTyping = setInterval(() => {
        if (this.isTypingComplete) {
          clearInterval(checkTyping)
          tl.from(
            this.$refs.heroCtas,
            { duration: 0.8, y: 24, opacity: 0, ease: 'power3.out' },
            '-=0.3'
          )
        }
      }, 100)
    },

    startTyping() {
      let index = 0
      const fullText = this.typingText
      
      if (this.$refs.heroSubtitle) {
        this.$refs.heroSubtitle.textContent = ''
      }

      setTimeout(() => {
        const typeInterval = setInterval(() => {
          if (index < fullText.length) {
            if (this.$refs.heroSubtitle) {
              this.$refs.heroSubtitle.textContent += fullText.charAt(index)
            }
            index++
          } else {
            clearInterval(typeInterval)
            setTimeout(() => {
              this.isTypingComplete = true
            }, 400)
          }
        }, 85)
      }, 1200)
    }
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600&display=swap');

.home {
  background: #000;
  color: #fff;
  font-family: 'Inter', sans-serif;
  min-height: 100vh;
  overflow-x: hidden;
}

/* ═══ HERO SECTION ══════════════════════════════════════════ */
.hero {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
  padding: 72px 24px 0;
}

.hero::before {
  content: '';
  position: absolute;
  top: 50%; left: 50%;
  transform: translate(-50%, -54%);
  width: 700px; height: 700px;
  background: radial-gradient(ellipse at center, rgba(255,255,255,0.032) 0%, transparent 70%);
  pointer-events: none;
  z-index: 0;
}

/* ─── FLOATING FRUITS ───────────────────────────────────────── */
.fruits-layer {
  position: absolute;
  inset: 0;
  pointer-events: none;
  z-index: 1;
}

.fruit {
  position: absolute;
  border-radius: 50%;
  overflow: hidden;
  opacity: 0;
  will-change: transform, opacity;
  animation: fruitFadeIn 1.2s var(--delay, 0s) ease-out forwards, fruitFloat var(--dur, 8s) var(--delay, 0s) ease-in-out infinite;
}

.fruit img {
  width: 100%; height: 100%;
  object-fit: cover;
  border-radius: 50%;
  filter: brightness(0.88) saturate(1.1);
}

@keyframes fruitFadeIn {
  from { opacity: 0; transform: scale(0.7) rotate(var(--rot, 0deg)); }
  to { opacity: var(--op, 0.22); transform: scale(1) rotate(var(--rot, 0deg)); }
}

@keyframes fruitFloat {
  0% { transform: translateY(0px) rotate(var(--rot, 0deg)) scale(1); }
  25% { transform: translateY(-18px) rotate(calc(var(--rot,0deg) + 8deg)) scale(1.04); }
  50% { transform: translateY(-8px) rotate(calc(var(--rot,0deg) - 4deg)) scale(0.97); }
  75% { transform: translateY(-24px) rotate(calc(var(--rot,0deg) + 12deg)) scale(1.06); }
  100% { transform: translateY(0px) rotate(var(--rot, 0deg)) scale(1); }
}

/* ─── HERO CONTENT ──────────────────────────────────────────── */
.hero-content {
  position: relative;
  z-index: 10;
  text-align: center;
  max-width: 860px;
  width: 100%;
}

.hero-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  font-size: 11px;
  letter-spacing: 0.22em;
  text-transform: uppercase;
  color: rgba(255, 255, 255, 0.38);
  margin-bottom: 32px;
  animation: fadeUp 1s 0.1s both;
}

.hero-eyebrow::before,
.hero-eyebrow::after {
  content: '';
  display: block;
  width: 28px; height: 1px;
  background: rgba(255, 255, 255, 0.16);
}

.hero-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(48px, 9vw, 100px);
  font-weight: 900;
  line-height: 1.05;
  letter-spacing: -0.03em;
  color: #fff;
  margin-bottom: 28px;
}

.hero-title .word-line {
  display: block;
}

.hero-title em {
  font-style: italic;
  color: rgba(255, 255, 255, 0.50);
}

.hero-sub {
  font-size: 16px;
  font-weight: 300;
  line-height: 1.75;
  color: rgba(255, 255, 255, 0.44);
  max-width: 420px;
  margin: 0 auto 48px;
  min-height: 60px;
}

.hero-sub::after {
  content: '|';
  display: inline-block;
  animation: blink 0.8s step-end infinite;
  color: rgba(255, 255, 255, 0.30);
  margin-left: 2px;
}

@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0; }
}

.hero-ctas {
  display: flex;
  gap: 16px;
  justify-content: center;
}

.btn-primary-link {
  text-decoration: none;
}

.btn-primary {
  font-family: 'Inter', sans-serif;
  font-size: 13px;
  font-weight: 500;
  letter-spacing: 0.06em;
  color: #000;
  background: #fff;
  padding: 14px 36px;
  border: none;
  border-radius: 100px;
  cursor: pointer;
  transition: background 0.25s, transform 0.2s;
}

.btn-primary:hover { background: rgba(255,255,255,0.86); transform: scale(1.04); }

.btn-secondary {
  font-family: 'Inter', sans-serif;
  font-size: 13px;
  font-weight: 400;
  letter-spacing: 0.06em;
  color: rgba(255, 255, 255, 0.65);
  background: transparent;
  padding: 14px 36px;
  border: 1px solid rgba(255, 255, 255, 0.14);
  border-radius: 100px;
  cursor: pointer;
  transition: border-color 0.25s, color 0.25s, transform 0.2s;
}

.btn-secondary:hover { border-color: rgba(255,255,255,0.32); color: #fff; transform: scale(1.04); }

/* ─── SCROLL HINT ───────────────────────────────────────────── */
.scroll-hint {
  position: absolute;
  bottom: 36px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 10;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  animation: fadeUp 1s 1.1s both;
}

.scroll-hint span {
  font-size: 10px;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: rgba(255, 255, 255, 0.22);
}

.scroll-line {
  width: 1px; height: 40px;
  background: linear-gradient(to bottom, rgba(255,255,255,0.22), transparent);
  animation: scrollPulse 2s ease-in-out infinite;
}

@keyframes scrollPulse {
  0%,100% { opacity: 0.3; transform: scaleY(1); }
  50% { opacity: 0.7; transform: scaleY(1.1); }
}

/* ─── MARQUEE ───────────────────────────────────────────────── */
.marquee-bar {
  border-top: 1px solid rgba(255,255,255,0.06);
  border-bottom: 1px solid rgba(255,255,255,0.06);
  padding: 16px 0;
  overflow: hidden;
  background: rgba(255,255,255,0.018);
}

.marquee-track {
  display: flex;
  gap: 64px;
  width: max-content;
  animation: marquee 26s linear infinite;
  align-items: center;
}

@keyframes marquee {
  from { transform: translateX(0); }
  to { transform: translateX(-50%); }
}

.marquee-item {
  font-size: 11px;
  letter-spacing: 0.22em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.20);
  white-space: nowrap;
  display: flex;
  align-items: center;
  gap: 20px;
}

.marquee-dot {
  width: 4px; height: 4px;
  background: rgba(255,255,255,0.16);
  border-radius: 50%;
}

/* ─── ANIMATIONS ────────────────────────────────────────────── */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(32px); }
  to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 768px) {
  .hero-ctas { flex-direction: column; align-items: center; }
  .fruit { width: 38px !important; height: 38px !important; }
}
</style>