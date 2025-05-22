<template>
  <div id="app">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="#">LaptopMart</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <router-link to="/" class="nav-link">Home</router-link>
            </li>
            <li class="nav-item">
            <router-link class="nav-link" to="/category">Kategori</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/create" class="nav-link">Tambah Laptop</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <router-view></router-view>

    <!-- Footer -->
    <footer>
      <p>&copy; 2024 LaptopMart. Semua Hak Dilindungi.</p>
      <small>Email: support@laptopmart.com | Telepon: +62 123 4567 890</small>
    </footer>
  </div>
</template>

<script>
export default {
  name: "App",
};
</script>
