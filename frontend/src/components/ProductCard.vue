<template>
  <div
    ref="cardRef"
    class="product-card"
    :class="{ visible: isVisible }"
    :style="`--delay: ${index * 0.1}s`"
  >
    <!-- Badge -->
    <div v-if="product.badge" class="card-badge">{{ product.badge }}</div>

    <!-- Image area -->
    <div class="card-image-wrap">
      <!-- Colour glow behind bottle -->
      <div class="card-glow" :style="`background: radial-gradient(ellipse at 50% 70%, ${product.color}28 0%, transparent 70%)`" />

      <img
        :src="product.img"
        :alt="product.name"
        class="card-img"
        loading="lazy"
      />

      <!-- Quick-view overlay -->
      <div class="card-overlay">
        <button class="overlay-btn" @click="$emit('add-to-cart', product)">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
          </svg>
          Quick Add
        </button>
      </div>
    </div>

    <!-- Card body -->
    <div class="card-body">
      <!-- Top row: name + price -->
      <div class="card-top">
        <div>
          <p class="card-category">{{ product.category }}</p>
          <h3 class="card-name">{{ product.name }}</h3>
        </div>
        <div class="card-price">${{ product.price.toFixed(2) }}</div>
      </div>

      <!-- Tagline -->
      <p class="card-tagline">{{ product.tagline }}</p>

      <!-- Divider -->
      <div class="card-divider" />

      <!-- CTA -->
      <div class="card-footer">
        <!-- Colour accent dot -->
        <div class="accent-dot" :style="`background: ${product.color}`" />

        <button class="btn-cart" @click="handleAdd">
          <span v-if="!added">Add to Cart</span>
          <span v-else class="added-label">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
            Added
          </span>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const props = defineProps({
  product: { type: Object, required: true },
  index:   { type: Number, default: 0 },
})
const emit = defineEmits(['add-to-cart'])

const cardRef    = ref(null)
const isVisible  = ref(false)
const added      = ref(false)
let addedTimer   = null
let observer     = null

onMounted(() => {
  observer = new IntersectionObserver(
    ([entry]) => {
      if (entry.isIntersecting) {
        isVisible.value = true
        observer.disconnect()
      }
    },
    { threshold: 0.15 }
  )
  if (cardRef.value) observer.observe(cardRef.value)
})

onUnmounted(() => {
  observer?.disconnect()
  if (addedTimer) clearTimeout(addedTimer)
})

function handleAdd() {
  emit('add-to-cart', props.product)
  added.value = true
  if (addedTimer) clearTimeout(addedTimer)
  addedTimer = setTimeout(() => { added.value = false }, 2000)
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Inter:wght@300;400;500;600&display=swap');

.product-card {
  position: relative;
  background: rgba(255,255,255,0.030);
  border: 1px solid rgba(255,255,255,0.07);
  border-radius: 20px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  cursor: pointer;
  opacity: 0;
  transform: translateY(48px);
  transition:
    opacity 0.75s cubic-bezier(0.16,1,0.3,1) var(--delay, 0s),
    transform 0.75s cubic-bezier(0.16,1,0.3,1) var(--delay, 0s),
    border-color 0.3s ease,
    background 0.3s ease;
}
.product-card.visible {
  opacity: 1;
  transform: translateY(0);
}
.product-card:hover {
  background: rgba(255,255,255,0.052);
  border-color: rgba(255,255,255,0.14);
}

.card-badge {
  position: absolute;
  top: 16px; left: 16px;
  z-index: 10;
  font-size: 9px;
  font-weight: 600;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: #000;
  background: #fff;
  padding: 5px 12px;
  border-radius: 100px;
}

.card-image-wrap {
  position: relative;
  width: 100%;
  aspect-ratio: 4 / 3;
  overflow: hidden;
  border-bottom: 1px solid rgba(255,255,255,0.06);
}
.card-glow {
  position: absolute;
  inset: 0;
  z-index: 1;
  pointer-events: none;
}
.card-img {
  position: absolute;
  inset: 0;
  width: 100%; height: 100%;
  object-fit: cover;
  transition: transform 0.7s cubic-bezier(0.16,1,0.3,1);
  z-index: 2;
  filter: brightness(0.82) saturate(1.05);
}
.product-card:hover .card-img {
  transform: scale(1.06);
  filter: brightness(0.72) saturate(1.1);
}

.card-overlay {
  position: absolute;
  inset: 0;
  z-index: 10;
  display: flex;
  align-items: flex-end;
  justify-content: center;
  padding-bottom: 20px;
  opacity: 0;
  transition: opacity 0.3s ease;
}
.product-card:hover .card-overlay { opacity: 1; }

.overlay-btn {
  display: flex;
  align-items: center;
  gap: 8px;
  font-family: 'Inter', sans-serif;
  font-size: 11px;
  font-weight: 500;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: #000;
  background: #fff;
  border: none;
  padding: 10px 22px;
  border-radius: 100px;
  cursor: pointer;
  transform: translateY(8px);
  transition: transform 0.35s cubic-bezier(0.16,1,0.3,1), background 0.2s;
}
.product-card:hover .overlay-btn { transform: translateY(0); }
.overlay-btn:hover { background: rgba(255,255,255,0.88); }

.card-body {
  padding: 24px 24px 20px;
  display: flex;
  flex-direction: column;
  gap: 12px;
  flex: 1;
}

.card-top {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 12px;
}

.card-category {
  font-size: 10px;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.30);
  margin-bottom: 4px;
}

.card-name {
  font-family: 'Playfair Display', serif;
  font-size: 22px;
  font-weight: 700;
  letter-spacing: -0.02em;
  color: #fff;
  line-height: 1.1;
}

.card-price {
  font-family: 'Inter', sans-serif;
  font-size: 18px;
  font-weight: 500;
  color: #fff;
  white-space: nowrap;
  padding-top: 18px;
}

.card-tagline {
  font-size: 13px;
  font-weight: 300;
  line-height: 1.6;
  color: rgba(255,255,255,0.40);
}

.card-divider {
  height: 1px;
  background: rgba(255,255,255,0.06);
  margin: 4px 0;
}

.card-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding-top: 4px;
}

.accent-dot {
  width: 10px; height: 10px;
  border-radius: 50%;
  flex-shrink: 0;
  opacity: 0.7;
}

.btn-cart {
  font-family: 'Inter', sans-serif;
  font-size: 11px;
  font-weight: 500;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.65);
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.10);
  padding: 10px 22px;
  border-radius: 100px;
  cursor: pointer;
  transition: all 0.25s ease;
  min-width: 120px;
  text-align: center;
}
.btn-cart:hover {
  color: #000;
  background: #fff;
  border-color: #fff;
}

.added-label {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  color: rgba(255,255,255,0.65);
}
</style>