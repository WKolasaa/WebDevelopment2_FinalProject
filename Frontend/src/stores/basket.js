import { defineStore } from 'pinia';

export const basketStore = defineStore('basket', {
  state: () => ({
    items: JSON.parse(localStorage.getItem('basketItems') || '[]'),
  }),

  actions: {
    // Adds a new product to the basket with a unique ID
    addItem(product) {
      const basketItem = {
        ...product,
        basketId: crypto.randomUUID(), // use Date.now() as fallback if needed
        quantity: 1
      };
      this.items.push(basketItem);
      this.updateLocalStorage();
    },

    // Removes one item by its unique basketId
    removeItem(basketId) {
      const index = this.items.findIndex(item => item.basketId === basketId);
      if (index !== -1) {
        this.items.splice(index, 1);
        this.updateLocalStorage();
      } else {
        console.warn('Basket item not found with basketId:', basketId);
      }
    },

    // Clears the entire basket
    clearBasket() {
      this.items = [];
      this.updateLocalStorage();
    },

    // Syncs state with localStorage
    updateLocalStorage() {
      localStorage.setItem('basketItems', JSON.stringify(this.items));
    }
  },

  getters: {
    // Returns total price of all items
    totalPrice: (state) => {
      return state.items.reduce((total, item) => total + item.price * item.quantity, 0);
    },

    // Returns total item count
    itemCount: (state) => {
      return state.items.reduce((count, item) => count + item.quantity, 0);
    }
  }
});
