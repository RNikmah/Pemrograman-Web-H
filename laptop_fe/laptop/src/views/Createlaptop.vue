<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "../api/index";

const router = useRouter();
const image = ref(null);
const name = ref("");
const deskription = ref("");
const price = ref("");
const errors = ref({});

// Handle file changes
const handleFileChange = (e) => {
  image.value = e.target.files[0];
};

// Store laptop data
const storeLaptop = async () => {
  const formData = new FormData();
  formData.append("image", image.value);
  formData.append("name", name.value);
  formData.append("deskription", deskription.value);
  formData.append("price", price.value);

  try {
    await api.post("/api/laptop", formData);
    router.push("/"); // Redirect ke home setelah sukses
  } catch (error) {
    if (error.response && error.response.status === 422) {
      errors.value = error.response.data.errors; // Tampilkan error validasi
    } else {
      console.error("Error:", error); // Error lainnya
    }
  }
};
</script>

<template>
    <div class="container mt-5">
      <h1 class="text-center mb-4">Tambah Laptop</h1>
      <form @submit.prevent="storeLaptop" class="p-4 shadow rounded bg-white">
        <!-- Image Input -->
        <div class="mb-3">
          <label for="image" class="form-label">Upload Gambar</label>
          <input type="file" id="image" class="form-control" @change="handleFileChange" />
          <div v-if="errors.image" class="text-danger">{{ errors.image[0] }}</div>
        </div>
  
        <!-- Name Input -->
        <div class="mb-3">
          <label for="name" class="form-label">Nama Laptop</label>
          <input
            type="text"
            id="name"
            v-model="name"
            class="form-control"
            placeholder="Masukkan Nama Laptop"
          />
          <div v-if="errors.name" class="text-danger">{{ errors.name[0] }}</div>
        </div>
  
        <!-- Description Input -->
        <div class="mb-3">
          <label for="description" class="form-label">Deskripsi</label>
          <textarea
            id="description"
            v-model="deskription"
            class="form-control"
            placeholder="Masukkan Deskripsi Laptop"
          ></textarea>
          <div v-if="errors.description" class="text-danger">{{ errors.description[0] }}</div>
        </div>
  
        <!-- Price Input -->
        <div class="mb-3">
          <label for="price" class="form-label">Harga</label>
          <input
            type="number"
            id="price"
            v-model="price"
            class="form-control"
            placeholder="Masukkan Harga Laptop"
          />
          <div v-if="errors.price" class="text-danger">{{ errors.price[0] }}</div>
        </div>
  
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary w-100">Simpan</button>
      </form>
    </div>
  </template>
  