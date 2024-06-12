<template>
  <div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="width: 25rem;">
      <h2 class="text-center">Register</h2>
      <form>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Register</button>
      </form>
      <div class="text-center mt-3">
        <router-link to="/login">Already have an account? Log in</router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'register'
}
</script>

<style scoped>
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background-color: #f8f9fa;
}
</style>
