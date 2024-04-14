<template>
    <div class="thank-you">
      <h1>Thank You for Your Order!</h1>
      <p>Your order has been placed and is being processed. You will receive an email confirmation shortly.</p>
      <router-link to="/" class="btn btn-primary">Return Home</router-link>
    </div>
  </template>
  
  <script>
  export default {
    name: 'ThankYouPage',
    mounted() {
      localStorage.setItem('basketItems', []);
    }
  }
  </script>
  
  <style scoped>
  .thank-you {
    text-align: center;
    margin-top: 50px;
  }
  </style>
  