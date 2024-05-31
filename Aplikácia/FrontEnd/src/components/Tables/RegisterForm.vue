<template>
  <div class="container">
    <form @submit.prevent="register">
      <div class="mb-3">
        <label for="login" class="form-label">Login</label>
        <input type="text" class="form-control" id="login" v-model="login">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" v-model="password">
      </div>
      <div class="mb-3">
        <label for="confirmed_password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="confirmed_password" v-model="confirmed_password">
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import axios from 'axios';

export default defineComponent({
  data() {
    return {
      login: '',
      password: '',
      confirmed_password: '',
    };
  },
  methods: {
    async register() {
      if (this.password !== this.confirmed_password) {
        alert('Passwords do not match');
        return;
      }

      try {
        const response = await axios.post('http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/adminRegister', {
          login: this.login,
          password: this.password,
          confirmed_password: this.confirmed_password,
        });

        console.log(response.data);
      } catch (error) {
        console.error(error);
      }
    },
  },
});
</script>