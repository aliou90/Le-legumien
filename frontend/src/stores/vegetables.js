import { defineStore } from "pinia";
import axios from "axios";

export const useVegetableStore = defineStore("vegStore", {
  state: () => ({
    vegetables: []
  }),

  actions: {
    async fetchAll() {
      const res = await axios.get("http://localhost:8000/api/vegetables");
      this.vegetables = res.data;
    },

    async create(data) {
      await axios.post("http://localhost:8000/api/vegetables", data);
      this.fetchAll();
    },

    async update(id, data) {
      await axios.put(`http://localhost:8000/api/vegetables/${id}`, data);
      this.fetchAll();
    },

    async delete(id) {
      await axios.delete(`http://localhost:8000/api/vegetables/${id}`);
      this.fetchAll();
    }
  }
});
