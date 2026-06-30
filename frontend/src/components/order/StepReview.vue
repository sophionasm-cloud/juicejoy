<template>
  <div class="step-review">
    <h3 class="step-title">Review Your Cart</h3>
    
    <div class="cart-items">
      <div v-for="item in cartStore.items" :key="item.id" class="cart-item">
        <div class="item-image">
          <img :src="item.img || item.fruitImg" :alt="item.name" />
        </div>
        
        <div class="item-details">
          <h4 class="item-name">{{ item.name }}</h4>
          <p class="item-price">ETB {{ (item.price * 10).toFixed(2) }}</p>
        </div>
        
        <div class="item-controls">
          <button class="qty-btn" @click="cartStore.updateQuantity(item.id, item.quantity - 1)">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
          </button>
          <span class="qty-num">{{ item.quantity }}</span>
          <button class="qty-btn" @click="cartStore.updateQuantity(item.id, item.quantity + 1)">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <line x1="12" y1="5" x2="12" y2="19"/>
              <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
          </button>
        </div>
        
        <button class="remove-btn" @click="cartStore.removeItem(item.id)">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <line x1="18" y1="6" x2="6" y2="18"/>
            <line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        </button>
      </div>
    </div>
    
    <div class="cart-summary">
      <div class="summary-row">
        <span>Subtotal</span>
        <span>ETB {{ (cartStore.totalPrice * 10).toFixed(2) }}</span>
      </div>
      <div class="summary-row grand-total">
        <span>Total</span>
        <span>ETB {{ (cartStore.totalPrice * 10).toFixed(2) }}</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useCartStore } from '../../stores/cart.js'

const cartStore = useCartStore()
</script>

<style scoped>
.step-review {
  padding: 20px 0;
}

.step-title {
  font-family: 'Playfair Display', serif;
  font-size: 28px;
  font-weight: 700;
  color: #fff;
  margin-bottom: 24px;
}

.cart-items {
  max-height: 400px;
  overflow-y: auto;
  margin-bottom: 24px;
}

.cart-items::-webkit-scrollbar {
  width: 4px;
}
.cart-items::-webkit-scrollbar-track {
  background: rgba(255,255,255,0.02);
}
.cart-items::-webkit-scrollbar-thumb {
  background: rgba(255,255,255,0.15);
  border-radius: 10px;
}

.cart-item {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 12px 0;
  border-bottom: 1px solid rgba(255,255,255,0.04);
}

.item-image {
  width: 52px;
  height: 52px;
  border-radius: 12px;
  overflow: hidden;
  flex-shrink: 0;
  border: 1px solid rgba(255,255,255,0.06);
}

.item-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.item-details {
  flex: 1;
}

.item-name {
  font-size: 14px;
  font-weight: 500;
  color: #fff;
  margin-bottom: 2px;
}

.item-price {
  font-size: 13px;
  color: rgba(255,255,255,0.5);
}

.item-controls {
  display: flex;
  align-items: center;
  gap: 6px;
}

.qty-btn {
  width: 28px;
  height: 28px;
  border: 1px solid rgba(255,255,255,0.08);
  background: rgba(255,255,255,0.03);
  border-radius: 50%;
  color: rgba(255,255,255,0.5);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.qty-btn:hover {
  border-color: rgba(255,255,255,0.2);
  background: rgba(255,255,255,0.06);
  color: #fff;
}

.qty-num {
  font-size: 13px;
  font-weight: 500;
  color: #fff;
  min-width: 20px;
  text-align: center;
}

.remove-btn {
  width: 28px;
  height: 28px;
  border: none;
  background: transparent;
  color: rgba(255,255,255,0.2);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  border-radius: 50%;
}

.remove-btn:hover {
  color: #ff6b6b;
  background: rgba(255,107,107,0.1);
}

.cart-summary {
  border-top: 1px solid rgba(255,255,255,0.06);
  padding-top: 20px;
}

.summary-row {
  display: flex;
  justify-content: space-between;
  padding: 6px 0;
  font-size: 15px;
  color: rgba(255,255,255,0.5);
}

.grand-total {
  font-size: 20px;
  font-weight: 700;
  padding-top: 12px;
  border-top: 1px solid rgba(255,255,255,0.06);
  margin-top: 6px;
}

.grand-total span:first-child {
  color: #fff;
}

.grand-total span:last-child {
  color: #fff;
}
</style>