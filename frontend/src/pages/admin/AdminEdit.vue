<script setup>
import { useVegetableStore } from "../../stores/vegetables";
import { ref, onMounted } from "vue";
import axios from "axios";
import Menu from "../../components/Menu.vue";

const props = defineProps(["id"]);
const store = useVegetableStore();

// Form
const form = ref({
  title: "",
  description: "",
  image: ""
});

// File to upload
const file = ref(null);
function onFileChange(e) {
  file.value = e.target.files[0];
}

// Messages
const message = ref(null);

function showMessage(type, text) {
  message.value = { type, text };

  setTimeout(() => {
    message.value = null;
  }, 5000); // 5 secondes
}

// Load vegetable
onMounted(async () => {
  if (props.id) {
    try {
      const res = await axios.get(`http://localhost:8000/api/vegetables/${props.id}`);
      form.value = res.data;
    } catch (e) {
      flash("Impossible de charger ce légume.", "danger");
    }
  }
});

// Save / Update
async function save() {
  const data = new FormData();
  data.append("title", form.value.title);
  data.append("description", form.value.description);

  if (file.value) {
    data.append("image", file.value);
    data.append("original_name", file.value.name); // <- NOM ORIGINAL POUR BD
  }

  try {
    let url = "http://localhost:8000/api/vegetables";
    let method = "post";

    if (props.id) {
      url += `/${props.id}`;
      data.append("_method", "PUT"); // <- OBLIGATOIRE POUR EDIT
    }

    await axios({
      method: "post",              // on envoie TOUJOURS en POST
      url,
      data,
      headers: { "Content-Type": "multipart/form-data" }
    });

    showMessage("success", props.id ? "Modifié avec succès." : "Ajouté avec succès.");
    store.fetchAll();

  } catch (err) {
    showMessage("error", "Erreur : " + (err.response?.data?.message ?? "Une erreur est survenue"));
  }
}

</script>

<template>
  <div class="container mt-4">
    <!-- Inclure le menu -->
    <Menu />

    <h3>{{ props.id ? "Modifier" : "Ajouter" }} un légume</h3>
    <div v-if="message" 
        class="alert" 
        :class="message.type === 'success' ? 'alert-success' : 'alert-danger'" 
        role="alert">
    {{ message.text }}
    </div>
    <div class="mb-3 mt-3">
      <label>Titre</label>
      <input v-model="form.title" class="form-control">
    </div>

    <div class="mb-3">
      <label>Description</label>
      <textarea v-model="form.description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
      <label>Image actuelle : <strong>{{ form.image }}</strong></label>
      <input type="file" @change="onFileChange" class="form-control">
    </div>

    <button class="btn btn-primary" @click="save">Enregistrer</button>
  </div>
</template>
