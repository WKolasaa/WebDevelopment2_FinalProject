import { defineStore } from 'pinia';

export const basketStore = defineStore('basket', {
  state: () => ({
    items: JSON.parse(localStorage.getItem('basketItems') || '[]'),
  }),
  actions: {
    addItem(item) {
      this.items.push(item);
      this.updateLocalStorage();
    },
    removeItem(itemId) {
      const index = this.items.findIndex(item => item.id === itemId);
      if (index !== -1) {
        this.items.splice(index, 1);
        this.updateLocalStorage();
      }
    },
    updateLocalStorage() {
      localStorage.setItem('basketItems', JSON.stringify(this.items)); // Ensure this key is correct
    },
    clearBasket() {
      this.items = [];
      this.updateLocalStorage();
    }
  },
  getters: {
    totalPrice: (state) => {
      let total = 0;
      state.items.forEach(item => {
        total += item.price
      });
      return total;
    },
    itemCount: (state) => {
      return state.items.reduce((count, item) => count + item.quantity, 0);
    }
  }
});
