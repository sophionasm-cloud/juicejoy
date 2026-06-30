<template>
  <Teleport to="body">
    <Transition name="drawer">
      <div v-if="isOpen" class="cart-overlay" @click="close">
        <div class="cart-drawer" @click.stop>
          <!-- Header -->
          <div class="drawer-header">
            <h2 class="drawer-title">
              <span class="title-icon">🛒</span>
              Your Cart
              <span v-if="store.totalItems > 0" class="cart-count">
                ({{ store.totalItems }})
              </span>
            </h2>
            <button class="close-btn" @click="close">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
              </svg>
            </button>
          </div>

          <!-- Cart Items -->
          <div class="drawer-body">
            <div v-if="store.items.length === 0" class="empty-cart">
              <div class="empty-icon">🧃</div>
              <p class="empty-text">Your cart is empty</p>
              <p class="empty-sub">Start adding some delicious juices!</p>
              <button class="empty-btn" @click="close">Start Shopping</button>
            </div>

            <div v-else class="cart-items">
              <div
                v-for="item in store.items"
                :key="item.id"
                class="cart-item"
              >
                <div class="item-image">
                  <img :src="item.img || item.fruitImg || 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=100&auto=format&fit=crop'" :alt="item.name" />
                  <div class="item-color-dot" :style="`background: ${item.color || '#fff'}`" />
                </div>
                
                <div class="item-details">
                  <h4 class="item-name">{{ item.name }}</h4>
                  <p class="item-price">${{ (item.price || 0).toFixed(2) }}</p>
                </div>

                <div class="item-controls">
                  <button class="qty-btn" @click="store.updateQuantity(item.id, item.quantity - 1)">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                      <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                  </button>
                  <span class="qty-num">{{ item.quantity }}</span>
                  <button class="qty-btn" @click="store.updateQuantity(item.id, item.quantity + 1)">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                      <line x1="12" y1="5" x2="12" y2="19"/>
                      <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                  </button>
                  <button class="remove-btn" @click="store.removeItem(item.id)">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                      <line x1="18" y1="6" x2="6" y2="18"/>
                      <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Footer -->
          <div v-if="store.items.length > 0" class="drawer-footer">
            <div class="total-row">
              <span class="total-label">Subtotal</span>
              <span class="total-price">${{ store.totalPrice.toFixed(2) }}</span>
            </div>
            <div class="total-row">
              <span class="total-label">Delivery</span>
              <span class="total-price">$0.00</span>
            </div>
            <div class="total-row grand-total">
              <span class="total-label">Total</span>
              <span class="total-price">${{ store.totalPrice.toFixed(2) }}</span>
            </div>
            <router-link to="/order" class="checkout-btn-link">
  <button class="checkout-btn">
    Proceed to Checkout
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <line x1="5" y1="12" x2="19" y2="12"/>
      <polyline points="12 5 19 12 12 19"/>
    </svg>
  </button>
</router-link>
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup>
import { useCartStore } from '../stores/cart.js'
import { useRouter } from 'vue-router'

const props = defineProps({
  isOpen: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['close'])

const store = useCartStore()
const router = useRouter()

const close = () => {
  emit('close')
}

const handleCheckout = () => {
  close()
  router.push('/checkout')
}
</script>

<style scoped>
/* Overlay */
.cart-overlay {
  position: fixed;
  inset: 0;
  z-index: 1000;
  background: rgba(0, 0, 0, 0.6);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  display: flex;
  justify-content: flex-end;
}

/* Drawer */
.cart-drawer {
  width: 100%;
  max-width: 480px;
  height: 100vh;
  background: rgba(10, 10, 15, 0.95);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border-left: 1px solid rgba(255, 255, 255, 0.06);
  display: flex;
  flex-direction: column;
}

/* Drawer transitions */
.drawer-enter-active,
.drawer-leave-active {
  transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}
.drawer-enter-from,
.drawer-leave-to {
  opacity: 0;
}
.drawer-enter-from .cart-drawer,
.drawer-leave-to .cart-drawer {
  transform: translateX(100%);
}

/* Header */
.drawer-header {
  padding: 24px 28px 20px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.06);
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-shrink: 0;
}

.drawer-title {
  font-family: 'Playfair Display', serif;
  font-size: 24px;
  font-weight: 700;
  color: #fff;
  display: flex;
  align-items: center;
  gap: 10px;
}

.title-icon {
  font-size: 20px;
}

.cart-count {
  font-size: 14px;
  font-weight: 400;
  color: rgba(255, 255, 255, 0.4);
  font-family: 'Inter', sans-serif;
}

.close-btn {
  width: 36px;
  height: 36px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  background: rgba(255, 255, 255, 0.04);
  border-radius: 50%;
  color: rgba(255, 255, 255, 0.5);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.close-btn:hover {
  border-color: rgba(255, 255, 255, 0.25);
  background: rgba(255, 255, 255, 0.08);
  color: #fff;
}

/* Body */
.drawer-body {
  flex: 1;
  overflow-y: auto;
  padding: 16px 28px;
}

.drawer-body::-webkit-scrollbar {
  width: 4px;
}
.drawer-body::-webkit-scrollbar-track {
  background: rgba(255, 255, 255, 0.02);
}
.drawer-body::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.15);
  border-radius: 10px;
}

/* Empty Cart */
.empty-cart {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;
  text-align: center;
}

.empty-icon {
  font-size: 56px;
  margin-bottom: 20px;
  opacity: 0.4;
}

.empty-text {
  font-size: 20px;
  font-weight: 500;
  color: #fff;
  margin-bottom: 8px;
}

.empty-sub {
  font-size: 14px;
  color: rgba(255, 255, 255, 0.4);
  margin-bottom: 24px;
}

.empty-btn {
  font-family: 'Inter', sans-serif;
  font-size: 12px;
  font-weight: 500;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: #000;
  background: #fff;
  border: none;
  padding: 12px 32px;
  border-radius: 100px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.empty-btn:hover {
  background: rgba(255, 255, 255, 0.85);
  transform: scale(1.03);
}

/* Cart Item */
.cart-item {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 14px 0;
  border-bottom: 1px solid rgba(255, 255, 255, 0.04);
  animation: itemFade 0.4s ease;
}

@keyframes itemFade {
  from { opacity: 0; transform: translateX(-10px); }
  to { opacity: 1; transform: translateX(0); }
}

.item-image {
  position: relative;
  width: 52px;
  height: 52px;
  border-radius: 12px;
  overflow: hidden;
  flex-shrink: 0;
  border: 1px solid rgba(255, 255, 255, 0.06);
}

.item-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.item-color-dot {
  position: absolute;
  bottom: -2px;
  right: -2px;
  width: 14px;
  height: 14px;
  border-radius: 50%;
  border: 2px solid rgba(0, 0, 0, 0.8);
}

.item-details {
  flex: 1;
  min-width: 0;
}

.item-name {
  font-size: 14px;
  font-weight: 500;
  color: #fff;
  margin-bottom: 2px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.item-price {
  font-size: 13px;
  color: rgba(255, 255, 255, 0.5);
}

.item-controls {
  display: flex;
  align-items: center;
  gap: 6px;
}

.qty-btn {
  width: 28px;
  height: 28px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  background: rgba(255, 255, 255, 0.03);
  border-radius: 50%;
  color: rgba(255, 255, 255, 0.5);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.qty-btn:hover {
  border-color: rgba(255, 255, 255, 0.2);
  background: rgba(255, 255, 255, 0.06);
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
  color: rgba(255, 255, 255, 0.2);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  border-radius: 50%;
}

.remove-btn:hover {
  color: #ff6b6b;
  background: rgba(255, 107, 107, 0.1);
}

/* Footer */
.drawer-footer {
  padding: 20px 28px 32px;
  border-top: 1px solid rgba(255, 255, 255, 0.06);
  flex-shrink: 0;
}

.total-row {
  display: flex;
  justify-content: space-between;
  padding: 4px 0;
  font-size: 14px;
  color: rgba(255, 255, 255, 0.5);
}

.total-row .total-price {
  color: #fff;
}

.grand-total {
  font-size: 18px;
  font-weight: 600;
  padding-top: 12px;
  margin-top: 8px;
  border-top: 1px solid rgba(255, 255, 255, 0.06);
}

.grand-total .total-label {
  color: #fff;
  font-weight: 500;
}

.grand-total .total-price {
  color: #fff;
  font-weight: 700;
}

.checkout-btn {
  width: 100%;
  font-family: 'Inter', sans-serif;
  font-size: 13px;
  font-weight: 600;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  color: #000;
  background: #fff;
  border: none;
  padding: 16px;
  border-radius: 12px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  transition: all 0.3s ease;
  margin-top: 16px;
}

.checkout-btn:hover {
  background: rgba(255, 255, 255, 0.85);
  transform: scale(1.02);
}

/* Responsive */
@media (max-width: 480px) {
  .cart-drawer {
    max-width: 100%;
  }
  .drawer-header {
    padding: 20px 20px 16px;
  }
  .drawer-body {
    padding: 12px 20px;
  }
  .drawer-footer {
    padding: 16px 20px 24px;
  }
  .drawer-title {
    font-size: 20px;
  }
  .checkout-btn-link {
  text-decoration: none;
  display: block;
}

.checkout-btn {
  width: 100%;
  font-family: 'Inter', sans-serif;
  font-size: 13px;
  font-weight: 600;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  color: #000;
  background: #fff;
  border: none;
  padding: 16px;
  border-radius: 12px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  transition: all 0.3s ease;
  margin-top: 16px;
}

.checkout-btn:hover {
  background: rgba(255, 255, 255, 0.85);
  transform: scale(1.02);
}
}
</style>