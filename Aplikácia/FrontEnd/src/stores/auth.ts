// store/auth.ts
import { defineStore } from 'pinia';
import axios from 'axios';

export const useAuthStore = defineStore({
  id: 'auth',
  state: () => ({
    token: null as string | null,
  }),
  actions: {
    setToken(token: string) {
      this.token = token;
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    },
    logout() {
      this.token = null;
      delete axios.defaults.headers.common['Authorization'];
    },
  },
});