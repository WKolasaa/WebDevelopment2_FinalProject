<template>
  <section>
    <div class="container">
      <h2 class="mt-3 mt-lg-5">Products</h2>
      
      <button class="btn btn-success" v-if="role == 'admin'" @click="addProduct()">Add product</button>&nbsp;&nbsp;
        
      <div class="row mt-3">
        <product-list-item
          v-for="product in products"
          :key="product.id"
          :product="product"
          @update="update"
        />
      </div>

      <h2 class="mt-5">Your Basket</h2>
      <div v-if="basket.items.length > 0">
        <ul class="list-group mt-3">
          <li class="list-group-item" v-for="(item, index) in basket.items" :key="index">
            {{ item.name }} - {{ item.price }}
            <button class="btn btn-danger btn-sm float-right" @click="removeItem(index)">Remove</button>
          </li>
        </ul>
        <a href="/checkout" class="btn btn-primary mt-3">
          Pay
        </a>
      </div>
      <p v-else class="mt-3">Your basket is empty.</p>

    </div>
  </section>
</template>

<script>
import axios from "axios";
import { basketStore } from "@/stores/basket";
import { login } from "@/stores/login";
import ProductListItem from "./ProductListItem.vue";
import { computed } from "vue";

export default {
  name: "ProductList",
  components: {
    ProductListItem,
  },
  setup() {
    const basket = basketStore();
    const loggedUser = login();

    const role = computed(() => loggedUser.getUserRole);

    return { basket, role };
  },
  data() {
    return {
      products: [],
    };
  },
  mounted() {
    this.update();
  },
  methods: {
    update() {
      axios
        .get("http://localhost/products")
        .then((result) => {
          console.log(result);
          this.products = result.data;
        })
        .catch((error) => {
          console.error("Error fetching products:", error);
          // Optionally, display an error message to the user
        });
    },
    removeItem(index) {
      this.basket.removeItem(index);
    },
    addProduct(id) {
      this.$router.push('/createproduct/');
    }
  },
};
</script>

<style>
</style>