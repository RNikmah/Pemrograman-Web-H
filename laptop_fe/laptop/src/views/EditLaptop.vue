<script setup>
import { ref, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import api from "../api/index";

const router = useRouter();
const route = useRoute();

const id = route.params.id; // Ambil ID dari URL
const image = ref(null);
const name = ref("");
const deskription = ref("");
const price = ref("");
const errors = ref({});

// Ambil data laptop berdasarkan ID
const fetchLaptopDetails = async () => {
  try {
    const response = await api.get(`/api/laptop/${id}`);
    const laptop = response.data.data;
    name.value = laptop.name;
    deskription.value = laptop.description;
    price.value = laptop.price;
  } catch (error) {
    console.error("Error fetching laptop details:", error);
  }
};

// Handle file changes
const handleFileChange = (e) => {
  image.value = e.target.files[0];
};

// Update laptop data
const updateLaptop = async () => {
  const formData = new FormData();
  formData.append("name", name.value);
  formData.append("description", deskription.value);
  formData.append("price", price.value);
  if (image.value) {
    formData.append("image", image.value); // Tambahkan file jika ada
  }

  try {
    await api.post(`/api/laptop/${id}?_method=PUT`, formData); // Laravel menggunakan `_method` untuk PUT
    router.push("/"); // Redirect ke home setelah sukses
  } catch (error) {
    if (error.response && error.response.status === 422) {
      errors.value = error.response.data.errors; // Tampilkan error validasi
    } else {
      console.error("Error:", error); // Error lainnya
    }
  }
};

onMounted(fetchLaptopDetails);
</script>

<template>
    <div class="container mt-5">
      <h1 class="text-center mb-4">Edit Laptop</h1>
      <form @submit.prevent="updateLaptop" class="p-4 shadow rounded bg-white">
        <!-- Image Input -->
        <div class="mb-3">
          <label for="image" class="form-label">Ganti Gambar (Opsional)</label>
          <input type="file" id="image" class="form-control" @change="handleFileChange" />
          <div v-if="errors.image" class="text-danger">{{ errors.image[0] }}</div>
        </div>
  
        <!-- Name Input -->
        <div class="mb-3">
          <label for="name" class="form-label">Nama Laptop</label>
          <input type="text" id="name" v-model="name" class="form-control" />
          <div v-if="errors.name" class="text-danger">{{ errors.name[0] }}</div>
        </div>
  
        <!-- Description Input -->
        <div class="mb-3">
          <label for="description" class="form-label">Deskripsi</label>
          <textarea id="description" v-model="deskription" class="form-control"></textarea>
          <div v-if="errors.description" class="text-danger">{{ errors.description[0] }}</div>
        </div>
  
        <!-- Price Input -->
        <div class="mb-3">
          <label for="price" class="form-label">Harga</label>
          <input type="number" id="price" v-model="price" class="form-control" />
          <div v-if="errors.price" class="text-danger">{{ errors.price[0] }}</div>
        </div>
  
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary w-100">Perbarui</button>
      </form>
    </div>
  </template>
  