<script setup>
import { useVegetableStore } from "../stores/vegetables";
import axios from "axios";
import Menu from "../components/Menu.vue";

const store = useVegetableStore();
store.fetchAll();

// Contient les légumes que l'utilisateur a aimés
const liked = {};

async function likeVeg(veg) {
  try {
    const res = await axios.post(`http://127.0.0.1:8000/api/vegetables/${veg.id}/like`);
    veg.likes = res.data.likes;
    liked[veg.id] = true; // marque comme aimé côté client
  } catch (err) {
    console.error(err);
  }
}
</script>

<template>
  <div class="container col-md-12 mt-4">
    <Menu />
    <h2 class="mb-3">Nos légumes frais 🥕🥬</h2>

    <div class="row g-3">
      <div v-for="veg in store.vegetables" :key="veg.id" class="col-md-4">
        <div class="card">
          <img :src="`http://127.0.0.1:8000/storage/images/${veg.image}`" class="card-img-top" alt="">
          <div class="card-body">
            <h5 class="card-title">{{ veg.title }}</h5>
            <p class="card-text">{{ veg.description }}</p>

            <button
              class="btn btn-sm me-2"
              :class="liked[veg.id] ? 'btn-secondary text-success' : 'btn-primary'"
              @click="!liked[veg.id] && likeVeg(veg)"
            >
              ❤️ J’aime ({{ veg.likes }})
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<style scoped>
.card-img-top {
  height: 200px;
  object-fit: cover;
}
</style>
