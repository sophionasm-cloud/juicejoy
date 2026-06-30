<template>
  <div class="step-delivery">
    <h3 class="step-title">Delivery Details</h3>
    
    <form class="delivery-form">
      <div class="form-group">
        <input type="text" id="fullName" v-model="orderData.customer.fullName" required />
        <label for="fullName">Full Name</label>
        <span class="focus-border" />
      </div>
      
      <div class="form-group">
        <input type="tel" id="phone" v-model="orderData.customer.phone" required />
        <label for="phone">Phone Number</label>
        <span class="focus-border" />
      </div>
      
      <div class="form-group">
        <input type="email" id="email" v-model="orderData.customer.email" />
        <label for="email">Email (Optional)</label>
        <span class="focus-border" />
      </div>
      
      <div class="form-group">
        <input type="text" id="address" v-model="orderData.customer.address" required />
        <label for="address">Delivery Address</label>
        <span class="focus-border" />
      </div>
      
      <div class="form-group">
        <input type="text" id="city" v-model="orderData.customer.city" required />
        <label for="city">City</label>
        <span class="focus-border" />
      </div>
      
      <div class="form-group">
        <textarea id="notes" v-model="orderData.customer.notes" rows="3"></textarea>
        <label for="notes">Additional Notes</label>
        <span class="focus-border" />
      </div>
    </form>
  </div>
</template>

<script setup>
import { useOrderStore } from '../../stores/order.js'

const orderStore = useOrderStore()
const { orderData } = orderStore
</script>

<style scoped>
.step-delivery {
  padding: 20px 0;
}

.step-title {
  font-family: 'Playfair Display', serif;
  font-size: 28px;
  font-weight: 700;
  color: #fff;
  margin-bottom: 24px;
}

.delivery-form {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.form-group {
  position: relative;
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 16px 16px 10px;
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 12px;
  font-family: 'Inter', sans-serif;
  font-size: 15px;
  color: #fff;
  transition: all 0.3s ease;
  outline: none;
}

.form-group textarea {
  resize: vertical;
  min-height: 80px;
}

.form-group label {
  position: absolute;
  top: 16px;
  left: 16px;
  font-size: 13px;
  color: rgba(255,255,255,0.3);
  transition: all 0.3s ease;
  pointer-events: none;
  font-weight: 400;
}

.form-group input:focus,
.form-group textarea:focus {
  border-color: rgba(255,140,66,0.4);
  background: rgba(255,255,255,0.06);
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
</style>