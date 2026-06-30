<template>
  <div class="step-options">
    <h3 class="step-title">Delivery Options</h3>
    
    <div class="options-grid">
      <div 
        v-for="option in deliveryOptions" 
        :key="option.value"
        class="option-card"
        :class="{ active: orderData.delivery === option.value }"
        @click="orderStore.setDelivery(option.value)"
      >
        <div class="option-icon">{{ option.icon }}</div>
        <h4 class="option-name">{{ option.name }}</h4>
        <p class="option-desc">{{ option.desc }}</p>
        <p class="option-price">{{ option.price }}</p>
        <div class="option-check">
          <svg v-if="orderData.delivery === option.value" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useOrderStore } from '../../stores/order.js'

const orderStore = useOrderStore()
const { orderData } = orderStore

const deliveryOptions = [
  {
    value: 'express',
    icon: '⚡',
    name: 'Express Delivery',
    desc: 'Fast delivery within 30-45 minutes',
    price: '+ ETB 50'
  },
  {
    value: 'standard',
    icon: '🚚',
    name: 'Standard Delivery',
    desc: 'Delivery within 1-2 hours',
    price: '+ ETB 20'
  },
  {
    value: 'pickup',
    icon: '🏪',
    name: 'Pickup',
    desc: 'Collect from our store',
    price: 'Free'
  }
]
</script>

<style scoped>
.step-options {
  padding: 20px 0;
}

.step-title {
  font-family: 'Playfair Display', serif;
  font-size: 28px;
  font-weight: 700;
  color: #fff;
  margin-bottom: 24px;
}

.options-grid {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap: 16px;
}

.option-card {
  position: relative;
  padding: 24px 20px;
  background: rgba(255,255,255,0.03);
  border: 2px solid rgba(255,255,255,0.06);
  border-radius: 16px;
  cursor: pointer;
  transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
  text-align: center;
}

.option-card:hover {
  background: rgba(255,255,255,0.06);
  border-color: rgba(255,255,255,0.12);
  transform: translateY(-2px);
}

.option-card.active {
  border-color: #FF8C42;
  background: rgba(255,140,66,0.08);
  box-shadow: 0 0 40px rgba(255,140,66,0.1);
}

.option-icon {
  font-size: 32px;
  margin-bottom: 12px;
}

.option-name {
  font-size: 16px;
  font-weight: 600;
  color: #fff;
  margin-bottom: 4px;
}

.option-desc {
  font-size: 12px;
  color: rgba(255,255,255,0.4);
  margin-bottom: 8px;
}

.option-price {
  font-size: 14px;
  font-weight: 500;
  color: rgba(255,255,255,0.6);
}

.option-check {
  position: absolute;
  top: 12px;
  right: 12px;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background: #FF8C42;
  color: #000;
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transform: scale(0.5);
  transition: all 0.3s ease;
}

.option-card.active .option-check {
  opacity: 1;
  transform: scale(1);
}

@media (max-width: 768px) {
  .options-grid {
    grid-template-columns: 1fr;
  }
}
</style>