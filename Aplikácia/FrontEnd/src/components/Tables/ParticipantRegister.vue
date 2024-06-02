<template>
    <div class="container">
      <form @submit.prevent="register">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" v-model="email">
        </div>

        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" v-model="title">
        </div>

        <div class="mb-3">
          <label for="middle_name" class="form-label">Middle name</label>
          <input type="text" class="form-control" id="middle_name" v-model="middle_name">
        </div>

        <div class="mb-3">
          <label for="first_name" class="form-label">First name</label>
          <input type="text" class="form-control" id="name" v-model="first_name">
        </div>

        <div class="mb-3">
          <label for="last_name" class="form-label">Last name</label>
          <input type="text" class="form-control" id="last_name" v-model="last_name">
        </div>

        <div class="mb-3">
          <label for="company" class="form-label">company</label>
          <input type="text" class="form-control" id="company" v-model="company">
        </div>

        <div class="mb-3">
          <label for="position" class="form-label">Position</label>
          <input type="text" class="form-control" id="position" v-model="position">
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
        email: '',
        password: '',
        confirmed_password: '',
        title: '',
        middle_name: '',
        first_name: '',
        last_name: '',
        company: '',
        position: '',
      };
    },
    methods: {
      async register() {
        if (this.password !== this.confirmed_password) {
          alert('Passwords do not match');
          return;
        }
  
        try {
          const response = await axios.post('http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/participantRegister', {
            email: this.email,
            password: this.password,
            confirmed_password: this.confirmed_password,
            title: this.title,
            middle_name: this.middle_name,
            first_name: this.first_name,
            last_name: this.last_name,
            company: this.company,
            position: this.position,

          });
  
          console.log(response.data);
        } catch (error) {
          console.error(error);
        }
      },
    },
  });
  </script>