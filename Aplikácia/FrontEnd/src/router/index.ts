import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue';
import SpeakersView from '../views/SpeakersView.vue';
import ScheduleView from '../views/ScheduleView.vue';
import sponsorsView from '../views/SponsorsView.vue';
import ContactView from '../views/ContactView.vue';
import loginView from '../views/LoginView.vue';
import registerView from '@/views/RegisterView.vue';


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'homeView',
      component: HomeView
    },
    {
      path: '/admin',
      name: 'admin',
      component: () => import('../views/AdminView.vue')
    },
    {
      path: '/speakersNav',
      name: 'speakersNav',
      component: SpeakersView
    },
    {
      path: '/scheduleNav',
      name: 'scheduleNav',
      component: ScheduleView
    },
    {
      path: '/sponsorsNav',
      name: 'sponsorsNav',
      component: sponsorsView
    },
    {
      path: '/contactNav',
      name: 'contactNav',
      component: ContactView
    },
    {
      path: '/login',
      name: 'login',
      component: loginView
    },
    {
      path: '/register',
      name: 'register',
      component: registerView
    }
  ]
})

export default router
