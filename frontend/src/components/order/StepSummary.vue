<template>
  <div class="step-summary">
    <h3 class="step-title">Order Summary</h3>
    
    <div class="summary-card">
      <div class="summary-items">
        <div v-for="item in cartStore.items" :key="item.id" class="summary-item">
          <span class="item-name">{{ item.name }} × {{ item.quantity }}</span>
          <span class="item-price">ETB {{ (item.price * 10 * item.quantity).toFixed(2) }}</span>
        </div>
      </div>
      
      <div class="summary-divider" />
      
      <div class="summary-row">
        <span>Subtotal</span>
        <span>ETB {{ (orderStore.subtotal * 10).toFixed(2) }}</span>
      </div>
      
      <div class="summary-row">
        <span>Delivery</span>
        <span>ETB {{ orderStore.deliveryFee.toFixed(2) }}</span>
      </div>
      
      <div class="summary-divider" />
      
      <div class="summary-row grand-total">
        <span>Grand Total</span>
        <span>ETB {{ (orderStore.total * 10).toFixed(2) }}</span>
      </div>
      
      <div class="delivery-info">
        <p>Estimated Delivery: <span>{{ deliveryTime }}</span></p>
        <p>Order Number: <span>{{ orderNumber }}</span></p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useCartStore } from '../../stores/cart.js'
import { useOrderStore } from '../../stores/order.js'

const cartStore = useCartStore()
const orderStore = useOrderStore()

const orderNumber = computed(() => {
  return orderStore.generateOrderNumber()
})

const deliveryTime = computed(() => {
  const methods = {
    express: '30-45 minutes',
    standard: '1-2 hours',
    pickup: 'Ready for pickup'
  }
  return methods[orderStore.orderData.delivery] || '1-2 hours'
})
</script>

<style scoped>
.step-summary {
  padding: 20px 0;
}

.step-title {
  font-family: 'Playfair Display', serif;
  font-size: 28px;
  font-weight: 700;
  color: #fff;
  margin-bottom: 24px;
}

.summary-card {
  padding: 32px;
  background: rgba(255,255,255,0.03);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255,255,255,0.06);
  border-radius: 20px;
  box-shadow: 0 30px 80px rgba(0,0,0,0.4);
}

.summary-items {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.summary-item {
  display: flex;
  justify-content: space-between;
  font-size: 15px;
  color: rgba(255,255,255,0.6);
  padding: 4px 0;
}

.summary-item .item-name {
  color: #fff;
}

.summary-divider {
  height: 1px;
  background: rgba(255,255,255,0.06);
  margin: 16px 0;
}

.summary-row {
  display: flex;
  justify-content: space-between;
  padding: 6px 0;
  font-size: 15px;
  color: rgba(255,255,255,0.5);
}

.grand-total {
  font-size: 22px;
  font-weight: 700;
  padding-top: 12px;
  margin-top: 8px;
  border-top: 1px solid rgba(255,255,255,0.06);
}

.grand-total span:first-child {
  color: #fff;
}

.grand-total span:last-child {
  color: #fff;
}

.delivery-info {
  margin-top: 20px;
  padding: 16px;
  background: rgba(255,255,255,0.03);
  border-radius: 12px;
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.delivery-info p {
  font-size: 13px;
  color: rgba(255,255,255,0.3);
}

.delivery-info p span {
  color: rgba(255,255,255,0.6);
}

@media (max-width: 768px) {
  .summary-card {
    padding: 20px;
  }
}
</style>