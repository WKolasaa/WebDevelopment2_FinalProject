<template>
    <div class="container">
      <h1 class="mb-4">Register</h1>
      <form @submit.prevent="registerUser" class="needs-validation" novalidate>
        <div id="message" class="alert alert-light"></div>
        <div class="mb-3">
          <label for="username" class="form-label">Username:</label>
          <input type="text" id="username" v-model="username" class="form-control" required>
          <div class="invalid-feedback">Please provide a username.</div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email" id="email" v-model="email" class="form-control" required>
          <div class="invalid-feedback">Please provide a valid email address.</div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password:</label>
          <input type="password" id="password" v-model="password" class="form-control" required>
          <div class="invalid-feedback">Please provide a password.</div>
        </div>
        <div class="mb-3">
          <label for="firstname" class="form-label">First Name:</label>
          <input type="text" id="firstname" v-model="firstname" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="lastname" class="form-label">Last Name:</label>
          <input type="text" id="lastname" v-model="lastname" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Phone Number:</label>
          <input type="text" id="phone" v-model="phone" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="address" class="form-label">Address:</label>
          <input type="text" id="address" v-model="address" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="address2" class="form-label">Address 2:</label>
          <input type="text" id="address2" v-model="address2" class="form-control">
        </div>
        <div class="mb-3">
          <label for="country" class="form-label">Country:</label>
          <input type="text" id="country" v-model="country" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="zip" class="form-label">Zip:</label>
          <input type="text" id="zip" v-model="zip" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="dob" class="form-label">Date of Birth:</label>
          <input type="date" id="dob" v-model="dob" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
      </form>
    </div>
  </template>

<script>
export default {
    name: 'Signup',
    data() {
        return {
            username: '',
            email: '',
            password: '',
            firstname: '',
            lastname: '',
            phone: '',
            address: '',
            address2: '',
            country: '',
            zip: '',
            dob: ''
        };
    },
    methods: {
        registerUser() {
            // Example code to make an API request to create a user
            const user = {
                username: this.username,
                email: this.email,
                password: this.password,
                firstName: this.firstname,
                lastName: this.lastname,
                phone: this.phone,
                address: this.address,
                address2: this.address2,
                country: this.country,
                zip: this.zip,
                dateOfBirth: this.dob
            };

            // Make an API request to your backend server to create the user
            // Replace the URL with the actual endpoint of your backend server
            if (this.username === '' || this.email === '' || this.password === '' || this.firstname === '' || this.lastname === '' || this.phone === '' || this.address === '' || this.country === '' || this.zip === '' || this.dob === '') {
                this.showMessage('Please fill in all required fields', 'alert-danger');
            } else {
                fetch('http://localhost/users/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(user)
                })
                .then(response => response.json())
                .then(data => {
                    console.log('User created:', data);
                    this.showMessage('User created successfully', 'alert-success');
                    this.$router.replace('/login');
                })
                .catch(error => {
                    console.error('Error creating user:', error);
                    this.showMessage('Error creating user', 'alert-danger');
                });
                console.log('Registering user...');
            }
        },
        showMessage(message, alertClass){
            var messageDiv = document.getElementById('message');
            messageDiv.innerHTML = '<div class="alert ' + alertClass + '">' + message + '</div>';
        }
    }
};
</script>

<style scoped>
/* Add your custom styles here */
</style>