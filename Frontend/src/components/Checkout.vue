<template>
    <div class="container">
      <main>
        <div class="py-5 text-center">
          <h2>Checkout Form</h2>
          <p class="lead">Finalize your order</p>
        </div>
  
        <div class="row g-5">
          <div class="col-md-5 col-lg-4 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-primary">Your cart</span>
              <span class="badge bg-primary rounded-pill">{{ basket.items.length }}</span>
            </h4>
            <ul class="list-group mb-3">
              <li v-for="(item, index) in basket.items" :key="index" class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                  <h6 class="my-0">{{ item.name }}</h6>
                </div>
                <span class="text-muted">€{{ item.price }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <strong><span>Total (EURO)</span></strong>
                <strong><span class="text-muted">€{{ basket.totalPrice }}</span></strong>
              </li>
            </ul>
          </div>
  
          <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Billing address</h4>
            <form class="needs-validation" @submit.prevent="submitOrder" novalidate>
              <billing-address-form :user="user" :is-guest="isGuest" @update-user="updateUser"/>
              <hr class="my-4">
              <payment-methods 
                @update:paymentMethod="updatePaymentMethod"
                @update:cardDetails="updateCardDetails"
              />              
              <hr class="my-4">
              <button class="w-100 btn btn-primary btn-lg" type="submit">Pay</button>
            </form>
          </div>
        </div>
      </main>
    </div>
  </template>
  
  <script>
  import { ref, computed } from 'vue';
  import BillingAddressForm from './BillingAddressForm.vue';
  import PaymentMethods from './PaymentMethods.vue';
  import { basketStore } from '@/stores/basket';
  import axios from 'axios';
  
  export default {
    components: {
      BillingAddressForm,
      PaymentMethods
    },
    setup() {
      const basket = basketStore();
      const isGuest = ref(true);
      const user = ref({
        firstName: '',
        lastName: '',
        username: '',
        email: '',
        address: '',
        address2: '',
        country: '',
        zip: ''
      });
      const paymentMethod = ref('Credit card');
      const cardDetails = ref({
        name: '',
        number: '',
        expiration: '',
        cvv: ''
      });
  
      const totalPrice = computed(() => basket.items.reduce((total, item) => total + item.price, 0));
  
      const getAllOrderDetails = () => {
        return {
          user: user.value,
          payment: {
            method: paymentMethod.value,
            details: paymentMethod.value !== "PayPal" ? cardDetails.value : {}
          },
          basket: {
            items: basket.items,
            total: totalPrice.value
          }
        };
      };
  
      const submitOrder = () => {
        if (!checkUserData() || !checkCardData()) {
          alert('Please fill out all required fields correctly.');
          return; // Prevent order submission if data validation fails
        }
  
        const orderDetails = getAllOrderDetails();  // Get all order details
        console.log("Order Details:", orderDetails);

         axios
          .post('http://localhost/order/create', orderDetails)
            .then(response => {
              window.location.href = '/orderplaced';
            })
          .catch(error => {
            console.error('Order submission failed:', error);
            //alert('Failed to submit order.');
          });
      };
  
      const checkUserData = () => {
        const u = user.value;
        return u.firstName && u.lastName && u.email && u.address && u.country && u.zip;
      };
  
      const checkCardData = () => {
        const details = cardDetails.value;
        if (paymentMethod.value !== "PayPal") {
          return details.number && details.expiration && details.cvv;
        }
        return true;  // No card data needed for PayPal
      };
  
      const updateUser = (userData) => {
        Object.assign(user.value, userData);
      };
  
      const updatePaymentMethod = (method) => {
        paymentMethod.value = method;
      };
  
      const updateCardDetails = (details) => {
        cardDetails.value = details;
      };
  
      return { 
        basket, 
        totalPrice, 
        user, 
        isGuest, 
        submitOrder, 
        updateUser, 
        updatePaymentMethod, 
        updateCardDetails 
      };
    }
  };
  </script>
  
  
  
  
  <style scoped>
  .invalid-feedback {
    display: block;
    color: #dc3545;
  }
  </style>
  