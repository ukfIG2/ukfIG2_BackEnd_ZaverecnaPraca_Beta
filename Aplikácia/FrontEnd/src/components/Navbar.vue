<template>
  <div>
    <div class="bg-success text-white py-2">
      <div class="container d-flex justify-content-between align-items-center">
        <div>
          <i class="fas fa-map-marker-alt me-2"></i> Študentské centrum UKF, Dražovská 2, Nitra
        </div>
        <div>
          <i class="fas fa-phone me-2"></i> +421 902 170 744
          <i class="fas fa-envelope ms-4 me-2"></i> info@nconnect.sk
        </div>
      </div>
    </div>


    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
      <div class="container">
        <router-link class="navbar-brand" to="/">
          <span class="fw-bold">n<span class="text-success">CONNECT</span></span>
        </router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <router-link class="nav-link" :class="{ active: isActive('/') }" to="/">Home</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :class="{ active: isActive('/speakersNav') }" to="/speakersNav">Speakers</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :class="{ active: isActive('/scheduleNav') }" to="/scheduleNav">Schedule</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :class="{ active: isActive('/sponsorsNav') }" to="/sponsorsNav">Sponsors</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :class="{ active: isActive('/contactNav') }" to="/contactNav">Contact</router-link>
            </li>
          </ul>
          <button class="btn btn-success me-md-2">
            <router-link class=nav-link :class="{ active: isActive('/login') }" to="/login">Login</router-link>
          </button>
          <button class="btn btn-success">
            <router-link class=nav-link :class="{ active: isActive('/register') }" to="/register">Register</router-link>
          </button>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: 'Navbar',
  methods: {
    isActive(path) {
      return this.$route.path === path;
    }
  }
}
</script>

<style scoped>
body {
  margin: 0;
  padding: 0;
}

.nav-link:hover, .nav-link.active {
  background-color: #26A69A;
  color: white !important;
  border-radius: 0.25rem;
}
.navbar-nav .nav-item + .nav-item {
  margin-left: 1rem;
}
.btn-success {
  background-color: #26A69A;
  border: none;
  margin-right: 1rem;
}
.btn-success:hover {
  background-color: #26A69A;
}
</style>
