import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import { useCartStore } from './cart.js'

export const useOrderStore = defineStore('order', () => {
  const cartStore = useCartStore()
  
  // Order state
  const currentStep = ref(0)
  const orderData = ref({
    customer: {
      fullName: '',
      phone: '',
      email: '',
      address: '',
      city: '',
      notes: ''
    },
    delivery: 'standard',
    orderNumber: '',
    status: 'pending'
  })
  
  const steps = ['Cart', 'Delivery', 'Options', 'Summary', 'Confirmation']
  
  // Computed
  const subtotal = computed(() => cartStore.totalPrice)
  const deliveryFee = computed(() => {
    if (orderData.value.delivery === 'express') return 50
    if (orderData.value.delivery === 'standard') return 20
    return 0
  })
  const total = computed(() => subtotal.value + deliveryFee.value)
  
  // Methods
  const nextStep = () => {
    if (currentStep.value < steps.length - 1) {
      currentStep.value++
    }
  }
  
  const prevStep = () => {
    if (currentStep.value > 0) {
      currentStep.value--
    }
  }
  
  const setDelivery = (method) => {
    orderData.value.delivery = method
  }
  
  const generateOrderNumber = () => {
    const year = new Date().getFullYear()
    const random = String(Math.floor(Math.random() * 9999)).padStart(4, '0')
    return `JR-${year}-${random}`
  }
  
  const reset = () => {
    currentStep.value = 0
    orderData.value = {
      customer: {
        fullName: '',
        phone: '',
        email: '',
        address: '',
        city: '',
        notes: ''
      },
      delivery: 'standard',
      orderNumber: '',
      status: 'pending'
    }
  }
  
  return {
    currentStep,
    orderData,
    steps,
    subtotal,
    deliveryFee,
    total,
    nextStep,
    prevStep,
    setDelivery,
    generateOrderNumber,
    reset
  }
})