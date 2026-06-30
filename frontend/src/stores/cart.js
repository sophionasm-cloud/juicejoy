import { defineStore } from 'pinia'
import { computed, ref } from 'vue'

export const useCartStore = defineStore('cart', () => {
  const items = ref([])

  // Load from localStorage
  const loadCart = () => {
    const saved = localStorage.getItem('juicepure_cart')
    if (saved) {
      try {
        items.value = JSON.parse(saved)
      } catch (e) {
        items.value = []
      }
    }
  }

  // Save to localStorage
  const saveCart = () => {
    localStorage.setItem('juicepure_cart', JSON.stringify(items.value))
  }

  const addItem = (product) => {
    const existing = items.value.find(item => item.id === product.id)
    if (existing) {
      existing.quantity += 1
    } else {
      items.value.push({ 
        ...product, 
        quantity: 1
      })
    }
    saveCart()
  }

  const removeItem = (productId) => {
    items.value = items.value.filter(item => item.id !== productId)
    saveCart()
  }

  const updateQuantity = (productId, quantity) => {
    const item = items.value.find(item => item.id === productId)
    if (item) {
      if (quantity <= 0) {
        removeItem(productId)
      } else {
        item.quantity = quantity
        saveCart()
      }
    }
  }

  const clearCart = () => {
    items.value = []
    saveCart()
  }

  const totalItems = computed(() => {
    return items.value.reduce((sum, item) => sum + item.quantity, 0)
  })

  const totalPrice = computed(() => {
    return items.value.reduce((sum, item) => sum + (item.price * item.quantity), 0)
  })

  // Load cart on store creation
  loadCart()

  return {
    items,
    addItem,
    removeItem,
    updateQuantity,
    clearCart,
    totalItems,
    totalPrice,
    loadCart,
    saveCart
  }
})