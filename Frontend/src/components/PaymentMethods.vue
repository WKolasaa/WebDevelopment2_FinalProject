<template>
  <div>
    <h4 class="mb-3">Payment</h4>
    <div class="my-3">
      <div class="form-check">
        <input id="credit" type="radio" class="form-check-input" v-model="paymentMethod" value="Credit card" checked required>
        <label class="form-check-label" for="credit">Credit card</label>
      </div>
      <div class="form-check">
        <input id="debit" type="radio" class="form-check-input" v-model="paymentMethod" value="Debit card" required>
        <label class="form-check-label" for="debit">Debit card</label>
      </div>
      <div class="form-check">
        <input id="paypal" type="radio" class="form-check-input" v-model="paymentMethod" value="PayPal" required>
        <label class="form-check-label" for="paypal">PayPal</label>
      </div>
    </div>

    <div v-if="paymentMethod === 'Credit card' || paymentMethod === 'Debit card'">
      <div class="row gy-3">
        <div class="col-md-6">
          <label for="cc-name" class="form-label">Name on card</label>
          <input type="text" class="form-control" id="cc-name" v-model="cardDetails.name" required>
          <small class="text-muted">Full name as displayed on card</small>
          <div class="invalid-feedback" v-show="!cardDetails.name">
            Name on card is required
          </div>
        </div>

        <div class="col-md-6">
          <label for="cc-number" class="form-label">Card number</label>
          <input type="text" class="form-control" id="cc-number" v-model="cardDetails.number" required>
          <div class="invalid-feedback" v-show="!cardDetails.number">
            Credit card number is required
          </div>
        </div>

        <div class="col-md-3">
          <label for="cc-expiration" class="form-label">Expiration</label>
          <input type="date" class="form-control" id="cc-expiration" v-model="cardDetails.expiration" required>
          <div class="invalid-feedback" v-show="!cardDetails.expiration">
            Expiration date required
          </div>
        </div>

        <div class="col-md-3">
          <label for="cc-cvv" class="form-label">CVV</label>
          <input type="text" class="form-control" id="cc-cvv" v-model="cardDetails.cvv" required>
          <div class="invalid-feedback" v-show="!cardDetails.cvv">
            Security code required
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

  
<script>
import { ref, watch, watchEffect } from 'vue';

export default {
  name: "PaymentMethods",
  emits: ['update:paymentMethod', 'update:cardDetails'],
  setup(props, { emit }) {
    const paymentMethod = ref('Credit card');
    const cardDetails = ref({
      name: '',
      number: '',
      expiration: '',
      cvv: ''
    });

    watch(paymentMethod, (newValue) => {
      emit('update:paymentMethod', newValue);
    });

    // Watch cardDetails and emit an event whenever any property in cardDetails changes
    watchEffect(() => {
      if (paymentMethod.value === 'Credit card' || paymentMethod.value === 'Debit card') {
        emit('update:cardDetails', cardDetails.value);
      }
    });

    return {
      paymentMethod,
      cardDetails
    };
  }
};
</script>
  
<style scoped>
.invalid-feedback {
  display: block;
  color: #dc3545;
  visibility: hidden;
}
.invalid-feedback[show] {
  visibility: visible;
}
</style>
  