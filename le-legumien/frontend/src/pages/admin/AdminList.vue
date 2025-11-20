<script setup>
import { useVegetableStore } from "../../stores/vegetables";
import { useRouter } from "vue-router";
import { ref } from "vue";
import Menu from "../../components/Menu.vue";

const router = useRouter();
const store = useVegetableStore();
store.fetchAll();

// Confirmation popup
const confirmId = ref(null);

// Message (alert)
const message = ref(null);

function showMessage(type, text) {
  message.value = { type, text };
  setTimeout(() => (message.value = null), 5000);
}

function askConfirm(id) {
  confirmId.value = id;
}

async function deleteItem(id) {
  try {
    await store.delete(id);
    confirmId.value = null;
    showMessage("success", "Supprimé avec succès.");
  } catch (err) {
    showMessage("error", "Erreur lors de la suppression.");
  }
}
</script>

<template>
  <div class="container mt-4">

    <!-- Inclure le menu -->
    <Menu />

    <h2>Admin – Gestion des légumes</h2>

    <!-- Message -->
    <div v-if="message" 
         class="alert"
         :class="message.type === 'success' ? 'alert-success' : 'alert-danger'">
      {{ message.text }}
    </div>

    <button class="btn btn-success mb-3" @click="router.push('/admin/edit')">
      + Ajouter un légume
    </button>

    <!-- Table responsive avec border dashed -->
    <div class="table-responsive">
      <table class="table table-bordered border-dashed">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="veg in store.vegetables" :key="veg.id">
            <td>{{ veg.id }}</td>
            <td>{{ veg.title }}</td>
            <td class="position-relative">

              <!-- Bouton Modifier -->
              <button class="btn btn-sm btn-warning me-2"
                      @click="router.push(`/admin/edit/${veg.id}`)">
                Modifier
              </button>

              <!-- Bouton Supprimer -->
              <button class="btn btn-sm btn-danger"
                      @click="askConfirm(veg.id)">
                Supprimer
              </button>

              <!-- Popup de confirmation -->
              <div v-if="confirmId === veg.id"
                   class="card p-2 shadow position-absolute bg-light"
                   style="top: -10px; right: 0; z-index: 10; width: 160px;">
                <small>Confirmer ?</small>
                <div class="d-flex justify-content-between mt-2">
                  <button class="btn btn-sm btn-secondary"
                          @click="confirmId = null">
                    Annuler
                  </button>
                  <button class="btn btn-sm btn-danger"
                          @click="deleteItem(veg.id)">
                    Oui
                  </button>
                </div>
              </div>

            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</template>

<style scoped>
.border-dashed td, 
.border-dashed th {
  border-style: dashed !important;
}
</style>
