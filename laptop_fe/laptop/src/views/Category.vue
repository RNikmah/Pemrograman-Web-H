<script setup>
import { ref, onMounted } from "vue";
import api from "../api/index";

// State untuk kategori
const Categories = ref([]);
const pagination = ref({});
const categoryName = ref(""); // Input untuk menambah kategori
const selectedCategoryId = ref(null); // ID kategori yang sedang diedit
const loadingCategories = ref(true);
const errorCategories = ref(null);
const errors = ref({}); // Error validasi untuk kategori

// Fungsi untuk mengambil data kategori
const fetchCategories = async (url = "/api/category") => {
  try {
    const response = await api.get(url);
    const paginatedData = response.data.data;
    Categories.value = paginatedData.data;
    pagination.value = {
      current_page: paginatedData.current_page,
      last_page: paginatedData.last_page,
      next_page_url: paginatedData.next_page_url,
      prev_page_url: paginatedData.prev_page_url,
    };
    console.log("Fetched categories:", Categories.value);
  } catch (err) {
    errorCategories.value = "Terjadi kesalahan saat mengambil data kategori.";
    console.error("Error fetching categories:", err);
  } finally {
    loadingCategories.value = false;
  }
};

// Fungsi untuk membuat kategori baru
const createCategory = async () => {
  if (!categoryName.value.trim()) {
    errors.value = { name: ["Nama kategori tidak boleh kosong."] };
    return;
  }

  try {
    const response = await api.post("/api/category", { name: categoryName.value });
    Categories.value.push(response.data.data); // Tambahkan kategori baru ke daftar
    categoryName.value = ""; // Reset input
  } catch (err) {
    if (err.response && err.response.status === 422) {
      errors.value = err.response.data.errors; // Validasi error
    } else {
      console.error("Error creating category:", err);
    }
  }
};

// Fungsi untuk mengedit kategori
const editCategory = (category) => {
  selectedCategoryId.value = category.id; // Set ID kategori yang akan diedit
  categoryName.value = category.name; // Set nama kategori ke input
  errors.value = {}; // Reset errors saat edit
};

// Fungsi untuk memperbarui kategori
const updateCategory = async () => {
  if (!categoryName.value.trim()) {
    errors.value = { name: ["Nama kategori tidak boleh kosong."] };
    return;
  }

  try {
    const response = await api.put(`/api/category/${selectedCategoryId.value}`, {
      name: categoryName.value
    });
    // Update kategori di daftar
    const index = Categories.value.findIndex(c => c.id === selectedCategoryId.value);
    Categories.value[index] = response.data.data;
    categoryName.value = ""; // Reset input
    selectedCategoryId.value = null; // Reset ID kategori yang sedang diedit
  } catch (err) {
    if (err.response && err.response.status === 422) {
      errors.value = err.response.data.errors; // Validasi error
    } else {
      console.error("Error updating category:", err);
    }
  }
};

// Fungsi untuk menghapus kategori
const deleteCategory = async (categoryId) => {
  if (confirm("Yakin ingin menghapus kategori ini?")) {
    try {
      await api.delete(`/api/category/${categoryId}`);
      // Hapus kategori dari daftar
      Categories.value = Categories.value.filter(c => c.id !== categoryId);
    } catch (err) {
      console.error("Error deleting category:", err);
    }
  }
};

// Memanggil fetchCategories saat komponen dipasang
onMounted(() => fetchCategories());
</script>

<template>
  <div class="container mt-5">
    <h1 class="text-center mb-4" style="font-weight: 700; font-size: 2rem;">
      Daftar Kategori
    </h1>

    <!-- Form untuk menambah kategori -->
    <div class="d-flex justify-content-between mb-4">
      <!-- Input untuk menambah kategori baru -->
      <div class="d-flex">
        <input
          v-model="categoryName"
          type="text"
          class="form-control me-2"
          placeholder="Masukkan nama kategori"
        />
        <button @click="createCategory" class="btn btn-primary">Tambah Kategori</button>
      </div>
    </div>

    <router-link to="/category" class="btn btn-outline-secondary mb-4">Kelola Kategori</router-link>

    <!-- Loading State -->
    <div v-if="loadingCategories" class="alert alert-info text-center">
      Memuat data kategori...
    </div>

    <!-- Error State -->
    <div v-else-if="errorCategories" class="alert alert-danger text-center">
      Terjadi kesalahan: {{ errorCategories }}
    </div>

    <!-- Daftar Kategori -->
    <div v-else>
      <div v-if="Categories.length === 0" class="alert alert-warning text-center">
        Tidak ada data kategori.
      </div>
      <div class="row">
        <div
          v-for="category in Categories"
          :key="category.id"
          class="col-md-4 col-sm-6 col-12 mb-4"
        >
          <div class="card">
            <div class="card-body">
              <!-- Edit Kategori -->
              <div v-if="selectedCategoryId === category.id">
                <input
                  v-model="categoryName"
                  type="text"
                  class="form-control mb-2"
                  placeholder="Masukkan nama kategori"
                />
                <button @click="updateCategory" class="btn btn-success btn-sm">Simpan</button>
                <button @click="selectedCategoryId = null" class="btn btn-secondary btn-sm">Batal</button>
              </div>
              <!-- Tampilan Kategori -->
              <div v-else>
                <h5 class="card-title">{{ category.name || "Nama tidak tersedia" }}</h5>
                <div class="d-flex justify-content-between">
                  <button @click="editCategory(category)" class="btn btn-warning btn-sm">Edit</button>
                  <button @click="deleteCategory(category.id)" class="btn btn-danger btn-sm">Hapus</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Paginasi -->
      <div class="pagination mt-4 d-flex justify-content-between">
        <button
          :disabled="!pagination.prev_page_url"
          @click="fetchCategories(pagination.prev_page_url)"
          class="btn btn-outline-primary"
        >
          &laquo; Sebelumnya
        </button>
        <button
          :disabled="!pagination.next_page_url"
          @click="fetchCategories(pagination.next_page_url)"
          class="btn btn-outline-primary"
        >
          Berikutnya &raquo;
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped>
.card {
  height: 150px;
}

.pagination button {
  min-width: 120px;
}
</style>
