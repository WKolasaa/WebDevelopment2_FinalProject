import { createRouter, createWebHistory } from 'vue-router'

import Home from '../components/Home.vue';
import ProductList from '../components/products/ProductList.vue';
import CreateProduct from '../components/products/CreateProduct.vue';
import EditProduct from '../components/products/EditProduct.vue';
import Login from '../components/Login.vue';
import Signup from '../components/Signup.vue';
import Checkout from '../components/Checkout.vue';
import OrderPlaced from '../components/OrderPlaced.vue';

const router = createRouter({
  history: createWebHistory("http://localhost"),
  routes: [
    { path: '/', component: Home },
    { path: '/products', component: ProductList },
    { path: '/login', component: Login },
    { path: '/signup', component: Signup },
    { path: '/createproduct', component: CreateProduct },
    { path: '/editproduct/:id', component: EditProduct, props: true  },
    { path: '/checkout', component: Checkout },
    { path: '/orderplaced', component: OrderPlaced },
  ]
})

export default router
