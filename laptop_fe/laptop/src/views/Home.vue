<template>
    <div class="container mt-5">
      <h1 class="text-center mb-4" style="font-weight: 700; font-size: 2rem;">
        Daftar Laptop
      </h1>
      <div class="d-flex justify-content-between mb-4">
        <a href="/create" class="btn btn-primary">Tambah Laptop</a>
        <a href="/category" class="btn btn-outline-secondary">Kelola Kategori</a>
      </div>
  
      <!-- Loading State -->
      <div v-if="loading" class="alert alert-info text-center">
        Memuat data laptop...
      </div>
  
      <!-- Error State -->
      <div v-else-if="error" class="alert alert-danger text-center">
        Terjadi kesalahan: {{ error.message }}
      </div>
  
      <!-- Daftar Laptop -->
      <div v-else>
        <div v-if="laptops.length === 0" class="alert alert-warning text-center">
          Tidak ada data laptop.
        </div>
        <div class="row">
          <div
            v-for="(laptop, index) in laptops"
            :key="laptop.id || index"
            class="col-md-4 col-sm-6 col-12 mb-4"
          >
            <div class="card">
              <img
                v-if="laptop.image"
                :src="laptop.image"
                class="card-img-top"
                alt="Laptop Image"
              />
              <div v-else class="placeholder-image">Gambar tidak tersedia</div>
              <div class="card-body">
                <h5 class="card-title">{{ laptop.name || "Nama tidak tersedia" }}</h5>
                <p class="card-text">
                  {{
                    laptop.deskription
                      ? laptop.deskription.slice(0, 100) + "..."
                      : "Deskripsi tidak tersedia"
                  }}
                </p>
                <p class="fw-bold">Rp {{ laptop.price || "Harga tidak tersedia" }}</p>
                <div class="d-flex justify-content-between">
                  <router-link
                    :to="'/edit/' + laptop.id"
                    class="btn btn-sm btn-primary"
                  >
                    Edit
                  </router-link>
                  <button
                    @click="deleteLaptop(laptop.id)"
                    class="btn btn-sm btn-danger"
                  >
                    Hapus
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Paginasi -->
        <div class="pagination mt-4 d-flex justify-content-between">
          <button
            :disabled="!pagination.prev_page_url"
            @click="fetchLaptops(pagination.prev_page_url)"
            class="btn btn-outline-primary"
          >
            &laquo; Sebelumnya
          </button>
          <button
            :disabled="!pagination.next_page_url"
            @click="fetchLaptops(pagination.next_page_url)"
            class="btn btn-outline-primary"
          >
            Berikutnya &raquo;
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from "vue";
  import api from "../api/index";
  
  const laptops = ref([]);
  const pagination = ref({});
  const loading = ref(true);
  const error = ref(null);
  
  const fetchLaptops = async (url = "/api/laptop") => {
    try {
      const response = await api.get(url);
      const paginatedData = response.data.data;
      laptops.value = paginatedData.data;
      pagination.value = {
        current_page: paginatedData.current_page,
        last_page: paginatedData.last_page,
        next_page_url: paginatedData.next_page_url,
        prev_page_url: paginatedData.prev_page_url,
      };
      console.log("Fetched laptops:", laptops.value);
    } catch (err) {
      error.value = err;
      console.error("Error fetching laptops:", err);
    } finally {
      loading.value = false;
    }
  };
  
  const deleteLaptop = async (id) => {
    if (confirm("Yakin ingin menghapus laptop ini?")) {
      try {
        await api.delete(`/api/laptop/${id}`);
        await fetchLaptops(); // Refresh data setelah menghapus
      } catch (err) {
        console.error("Error deleting laptop:", err);
      }
    }
  };
  
  onMounted(() => fetchLaptops());
  </script>
  
  <style scoped>
  .card img {
    max-height: 200px;
    object-fit: cover;
  }
  
  .placeholder-image {
    height: 200px;
    background-color: #f5f5f5;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    color: #999;
    border: 1px solid #ddd;
  }
  
  .pagination button {
    min-width: 120px;
  }
  </style>
  