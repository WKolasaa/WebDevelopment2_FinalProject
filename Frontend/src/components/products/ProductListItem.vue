<template>
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xxl-3 p-2">
    <div class="card product-card h-100">
      <div class="card-body">
        <div class="product-image">
          <img :src="product.image" class="img-fluid" alt="Product Image"/>
        </div>
        <div class="float-start">
          <strong><p>{{ product.name }}</p></strong>
          <p>{{ product.description }}</p>
          <p>Quantity: {{ product.quantity }}</p>
        </div>
        <span class="price float-end">{{ product.price }} €</span>
      </div>
      <div class="card-footer">
        <button class="btn btn-success" @click="addBasket(product)">Add to basket</button>&nbsp;&nbsp;
        <button class="btn btn-warning" v-if="role == 'admin'" @click="editProduct(product.id)">Edit</button>&nbsp;&nbsp;
        <button class="btn btn-danger" v-if="role == 'admin'" @click="deleteProduct(product.id)">Delete</button>&nbsp;&nbsp;
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { basketStore } from "@/stores/basket"; // Import the basketStore
import { login } from "@/stores/login";
import { computed } from "vue";
import { defineComponent } from 'vue';

export default {
  name: "ProductListItem",
  props: {
    product: Object,
  },
  setup(props) {
    const basket = basketStore(); // Use the basketStore
    const loggedUser = login();
    const role = computed(() => loggedUser.getUserRole);

    function addBasket(item) {
      if(role.value !== null){
        basket.addItem(item);
      }
      else{
        alert("You need to login to add items to the basket.");
      }
    }

    return { addBasket, basket, role };
  },
  methods: {
    deleteProduct(id) {
      axios
        .delete("http://localhost/products/" + id)
        .then((result) => {
          console.log(result);
          this.$emit('update');
        })
        .catch((error) => console.log(error));
    },
    editProduct(id) {
      this.$router.push('/editproduct/' + id);
    }
  },
};
</script>

<style>
.card-img-top {
  width: 100%; /* Make the image fill the entire width of the card */
  height: 100%; /* Make the image fill the entire height of the card */
  object-fit: cover; /* Maintain aspect ratio and cover the entire space */
}
</style>