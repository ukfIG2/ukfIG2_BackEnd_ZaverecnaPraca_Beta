<template>
  <div class="container">
    <form @submit.prevent="submitForm">
      <div class="mb-3">
        <label for="login" class="form-label">Login</label>
        <input type="text" class="form-control" id="login" v-model="login">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" v-model="password">
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import axios from 'axios';
import { useAuthStore } from '@/stores/auth'; // corrected import statement

export default defineComponent({
  data() {
    return {
      login: '',
      password: '',
    };
  },
  methods: {
    async submitForm() {
      try {
        const response = await axios.post('http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/adminLogin', {
          login: this.login,
          password: this.password,
        });

        const auth = useAuthStore();
        auth.setToken(response.data.token);

        console.log(response.data);
      } catch (error) {
        console.error(error);
      }
    },
  },
});
</script>