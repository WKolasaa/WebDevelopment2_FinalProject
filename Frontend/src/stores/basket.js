import { defineStore } from 'pinia';
console.log('basket.js');
export const basketStore = defineStore( 'basket', {
  state: () => ({
    items: [], // Initialize items array
  }),
  actions: {
    addItem(item) {
      this.items.push(item);
    },
    removeItem(itemId) {
      const index = this.items.findIndex(item => item.id === itemId);
      if (index !== -1) {
        this.items.splice(index, 1);
      }
    },
  
    updateQuantity(itemId, newQuantity) {
      const item = this.items.find(item => item.id === itemId);
      if (item) {
        item.quantity = newQuantity;
      }
    },
  },
  getters: {
    totalPrice() {
      return this.items.reduce((total, item) => total + (item.price * item.quantity), 0);
    }
  }
});
