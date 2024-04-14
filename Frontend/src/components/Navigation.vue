<template>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Shop</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/products">Products</a>
                </li>
            </ul>

            <!-- Content to be conditionally rendered -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown" id="crudDropdownContainer" style="display: none;">
                    <a class="nav-link dropdown-toggle" href="#" id="crudDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        CRUD
                    </a>
                    <div class="dropdown-menu" aria-labelledby="crudDropdown">
                        <a class="dropdown-item" href="/add">Add product</a>
                        <a class="dropdown-item" href="/remove">Remove product</a>
                        <a class="dropdown-item" href="/update">Update product</a>
                    </div>
                </li>

                <li class="nav-item dropdown col-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <!-- Content to be conditionally rendered -->
                        <ul id="loggedOutContent" class="navbar-nav" v-if="!loggedIn">
                            <li class="nav-item"><a class="nav-link" href="/login">Log in</a></li>
                            <li class="nav-item"><a class="nav-link" href="/signup">Create an account</a></li>
                        </ul>

                        <ul id="loggedInContent" class="navbar-nav" v-if="loggedIn">
                            <li class="nav-item"><span class="nav-link">Welcome back!</span></li>
                            <li class="nav-item"><a class="nav-link" @click="logout">Log out</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
</template>

<script>
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import { login } from "@/stores/login"
import { computed } from 'vue';

export default {
  name: "Navigation",
  setup() {
      const loggeduser = login();
      const loggedIn = computed(() => loggeduser.isLoggedIn);

      const logout = () => {
        loggeduser.logout(); 
      };

      return { loggedIn, logout };
  },
}
</script>

<style>
</style>