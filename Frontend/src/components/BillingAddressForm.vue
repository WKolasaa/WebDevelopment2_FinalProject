<template>
    <div>
      <div class="row g-3">
        <!-- First Name -->
        <div class="col-sm-6">
          <label for="firstName" class="form-label">First name</label>
          <input v-model="user.firstName" type="text" class="form-control" id="firstName" required>
          <div v-if="submitted && !user.firstName" class="invalid-feedback">
            Valid first name is required.
          </div>
        </div>
  
        <!-- Last Name -->
        <div class="col-sm-6">
          <label for="lastName" class="form-label">Last name</label>
          <input v-model="user.lastName" type="text" class="form-control" id="lastName" required>
          <div v-if="submitted && !user.lastName" class="invalid-feedback">
            Valid last name is required.
          </div>
        </div>
  
        <!-- Username -->
        <div class="col-12">
          <label for="username" class="form-label">Username</label>
          <div class="input-group has-validation">
            <span class="input-group-text">@</span>
            <input v-model="user.username" type="text" class="form-control" id="username" required>
            <div v-if="submitted && !user.username" class="invalid-feedback">
              Your username is required.
            </div>
          </div>
        </div>
  
        <!-- Email -->
        <div class="col-12">
          <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
          <input v-model="user.email" type="email" class="form-control" id="email">
          <div v-if="submitted && user.email && !validEmail(user.email)" class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>
  
        <!-- Address -->
        <div class="col-12">
          <label for="address" class="form-label">Address</label>
          <input v-model="user.address" type="text" class="form-control" id="address" required>
          <div v-if="submitted && !user.address" class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>
  
        <!-- Address 2 -->
        <div class="col-12">
          <label for="address2" class="form-label">Address 2 <span class="text-muted">(Optional)</span></label>
          <input v-model="user.address2" type="text" class="form-control" id="address2">
        </div>
  
        <!-- Country -->
        <div class="col-md-9">
          <label for="country" class="form-label">Country</label>
          <select v-model="user.country" class="form-select" id="country" required>
            <option value="">Choose...</option>
            <option value="The Netherlands">The Netherlands</option>
            <!-- Additional options can be dynamically added here -->
          </select>
          <div v-if="submitted && !user.country" class="invalid-feedback">
            Please select a valid country.
          </div>
        </div>
  
        <!-- Zip Code -->
        <div class="col-md-3">
          <label for="zip" class="form-label">Zip</label>
          <input v-model="user.zip" type="text" class="form-control" id="zip" required>
          <div v-if="submitted && !user.zip" class="invalid-feedback">
            Zip code required.
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { ref, reactive, watch, watchEffect, onMounted } from 'vue';
  import { login as useLoginStore } from '@/stores/login';
  
  export default {
    name: 'BillingAddressForm',
    setup(props, { emit }) {
      const login = useLoginStore();
      const user = reactive({
        firstName: '',
        lastName: '',
        username: '',
        email: '',
        address: '',
        address2: '',
        country: '',
        zip: ''
      });
      const submitted = ref(false);

      const validEmail = (email) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

      const submitForm = () => {
        submitted.value = true;
        if (validateFields()) {
          emit('update-user', user); // Emit the complete user object
          //alert('Form is valid: Data submitted.');
        } else {
          alert('Please fill out all required fields correctly.');
        }
      };
  
      // Immediately react to changes in login state
      watchEffect(() => {
        console.log("Login state changed. Is user logged in?", login.isLoggedIn);
        if (login.isLoggedIn && login.user) {
          loadUserData();
          submitForm();
        } else {
          clearFields();
        }
      });
  
      // Reactively update other components when user details change
      watch(user, (newValue) => {
        console.log("User data updated:", newValue);
        emit('update-user', newValue);
      }, { deep: true });  // Use { deep: true } to watch nested properties
  
      function loadUserData() {
        Object.assign(user, login.user);  // Load user data from the store
        console.log("User data loaded from login store:", user);
      }
  
      function clearFields() {
        const fields = Object.keys(user);
        fields.forEach(field => user[field] = '');  // Clear each field
        console.log("All user fields cleared");
      }
  
      function validateFields() {
        return user.firstName && user.lastName && user.username && user.email && user.address && user.zip && validEmail(user.email);
      }
    
      return { user, submitted, submitForm, validEmail };
    }
  };
  </script>
  
  
  <style scoped>
  .invalid-feedback {
    display: block;
    color: #dc3545;
  }
  </style>
  