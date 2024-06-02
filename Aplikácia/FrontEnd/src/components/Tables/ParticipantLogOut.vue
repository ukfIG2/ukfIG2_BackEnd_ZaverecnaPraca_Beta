<template>
    <button @click="logout" class="btn btn-primary">Logout</button>
  </template>
  
  <script lang="ts">
  import { defineComponent } from 'vue';
  import axios from 'axios';
  import { useAuthStore } from '@/stores/auth';
  
  export default defineComponent({
    setup() {
      const auth = useAuthStore();
  
      const logout = async () => {
        try {
          await axios.post('http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/participantLogout', {}, {
            headers: {
              'Authorization': `Bearer ${auth.token}`
            }
          });
          auth.logout();
        } catch (error) {
          console.error(error);
        }
      };
  
      return {
        logout,
      };
    },
  });
  </script>