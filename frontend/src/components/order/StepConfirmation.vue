<template>
  <div class="step-confirmation">
    <div class="confirmation-card">
      <div class="success-icon">
        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10"/>
          <polyline points="12 6 12 12 16 14"/>
        </svg>
      </div>
      
      <h3 class="confirmation-title">Order Confirmed!</h3>
      <p class="confirmation-sub">Thank you for ordering from Juicie Ride.</p>
      
      <div class="order-details">
        <div class="detail-row">
          <span>Order Number</span>
          <span class="highlight">{{ orderNumber }}</span>
        </div>
        <div class="detail-row">
          <span>Total</span>
          <span class="highlight">ETB {{ (orderStore.total * 10).toFixed(2) }}</span>
        </div>
        <div class="detail-row">
          <span>Delivery</span>
          <span>{{ deliveryLabel }}</span>
        </div>
        <div class="detail-row">
          <span>Estimated Time</span>
          <span>{{ deliveryTime }}</span>
        </div>
      </div>
      
      <div class="confirmation-message">
        <p>Your request has been prepared and is ready to be sent.</p>
        <p>You will receive a confirmation via Telegram shortly.</p>
      </div>
      
      <button class="confirm-btn" @click="confirmOrder" :disabled="loading">
        <span v-if="!loading">Confirm Order</span>
        <span v-else>Processing...</span>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <line x1="5" y1="12" x2="19" y2="12"/>
          <polyline points="12 5 19 12 12 19"/>
        </svg>
      </button>
    </div>
  </div>
</template>

<script setup>
import { computed, ref } from 'vue'
import { useCartStore } from '../../stores/cart.js'
import { useOrderStore } from '../../stores/order.js'
import axios from 'axios'

const cartStore = useCartStore()
const orderStore = useOrderStore()
const loading = ref(false)

const orderNumber = computed(() => orderStore.generateOrderNumber())

const deliveryLabel = computed(() => {
  const methods = {
    express: 'Express Delivery',
    standard: 'Standard Delivery',
    pickup: 'Pickup'
  }
  return methods[orderStore.orderData.delivery] || 'Standard Delivery'
})

const deliveryTime = computed(() => {
  const methods = {
    express: '30-45 minutes',
    standard: '1-2 hours',
    pickup: 'Ready for pickup'
  }
  return methods[orderStore.orderData.delivery] || '1-2 hours'
})

const confirmOrder = async () => {
  loading.value = true
  
  try {
    const orderData = {
      customer: {
        fullName: orderStore.orderData.customer.fullName,
        phone: orderStore.orderData.customer.phone,
        email: orderStore.orderData.customer.email || '',
        address: orderStore.orderData.customer.address,
        city: orderStore.orderData.customer.city,
        notes: orderStore.orderData.customer.notes || ''
      },
      items: cartStore.items.map(item => ({
        id: item.id,
        name: item.name,
        quantity: item.quantity,
        price: item.price
      })),
      delivery: orderStore.orderData.delivery,
      subtotal: orderStore.subtotal,
      total: orderStore.total
    }

    const response = await axios.post('/api/orders', orderData)
    
    if (response.data.success) {
      alert('✅ Order placed successfully! Check Telegram for confirmation.')
      
      cartStore.clearCart()
      orderStore.reset()
      
      window.location.href = '/'
    }
  } catch (error) {
    console.error('Order failed:', error)
    alert('❌ Something went wrong. Please try again.')
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
.step-confirmation {
  padding: 20px 0;
}

.confirmation-card {
  padding: 48px;
  background: rgba(255,255,255,0.03);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255,255,255,0.06);
  border-radius: 24px;
  text-align: center;
  box-shadow: 0 30px 80px rgba(0,0,0,0.4);
}

.success-icon {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  background: rgba(74, 222, 128, 0.1);
  border: 2px solid rgba(74, 222, 128, 0.3);
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 24px;
}

.success-icon svg {
  color: #4ade80;
  animation: checkmark 0.6s ease;
}

@keyframes checkmark {
  0% {
    transform: scale(0) rotate(-30deg);
    opacity: 0;
  }
  100% {
    transform: scale(1) rotate(0deg);
    opacity: 1;
  }
}

.confirmation-title {
  font-family: 'Playfair Display', serif;
  font-size: 32px;
  font-weight: 700;
  color: #fff;
  margin-bottom: 8px;
}

.confirmation-sub {
  font-size: 16px;
  color: rgba(255,255,255,0.4);
  margin-bottom: 32px;
}

.order-details {
  background: rgba(255,255,255,0.03);
  border-radius: 16px;
  padding: 20px 24px;
  margin-bottom: 24px;
  text-align: left;
}

.detail-row {
  display: flex;
  justify-content: space-between;
  padding: 8px 0;
  font-size: 14px;
  color: rgba(255,255,255,0.4);
  border-bottom: 1px solid rgba(255,255,255,0.03);
}

.detail-row:last-child {
  border-bottom: none;
}

.detail-row .highlight {
  color: #fff;
  font-weight: 500;
}

.confirmation-message {
  margin-bottom: 32px;
}

.confirmation-message p {
  font-size: 14px;
  color: rgba(255,255,255,0.3);
  margin: 4px 0;
}

.confirm-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  padding: 16px 40px;
  background: linear-gradient(135deg, #FF8C42, #F4A636);
  border: none;
  border-radius: 12px;
  font-family: 'Inter', sans-serif;
  font-size: 16px;
  font-weight: 600;
  color: #000;
  cursor: pointer;
  transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
  width: 100%;
}

.confirm-btn:hover:not(:disabled) {
  transform: translateY(-3px) scale(1.02);
  box-shadow: 0 20px 40px rgba(255,140,66,0.3);
}

.confirm-btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.confirm-btn svg {
  transition: transform 0.3s ease;
}

.confirm-btn:hover:not(:disabled) svg {
  transform: translateX(4px);
}

@media (max-width: 768px) {
  .confirmation-card {
    padding: 24px;
  }
  .order-details {
    padding: 16px;
  }
}
</style>