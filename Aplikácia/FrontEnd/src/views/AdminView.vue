<template>
  <div class="border border-5 m-3">
    <h1>Toto je admin page</h1>

    <!-- Dropdown for selecting a table -->
    <select class="form-select" v-model="selectedTable">
      <!-- Loop over each table in the tables array -->
      <option v-for="table in tables" :key="table" :value="table">{{ table }}</option>
    </select>

    <!-- Display the selected table -->
    <component :is="selectedTable"></component>
  </div>
</template>

<script lang="ts">
// Import all the table components
import Conference_table from '../components/Tables/Conference.vue'
import Stage_table from '../components/Tables/Stage.vue'
import Time_table from '../components/Tables/Time_table.vue'
import Presentation_table from '../components/Tables/Presentation.vue'
import Sponsor_table from '../components/Tables/Sponsor.vue'
import Speaker_table from '../components/Tables/Speaker.vue'
import RegisterForm from '@/components/Tables/RegisterForm.vue'
import LoginForm from '@/components/Tables/LoginForm.vue'
import LogOutForm from '@/components/Tables/LogOutForm.vue'
import ParticipantRegister from '@/components/Tables/ParticipantRegister.vue'
import ParticipantLogin from '@/components/Tables/ParticipantLogin.vue'
import ParticipantLogOut from '@/components/Tables/ParticipantLogOut.vue'
import Administration from '@/components/Tables/Administration.vue'
import ImageUpload from '@/components/Tables/ImageUpload.vue'
// Define the component

export default {
  components: {
    Conference_table,
    Stage_table,
    Time_table,
    Presentation_table,
    Sponsor_table,
    Speaker_table,
    RegisterForm,
    LoginForm,
    LogOutForm,
    ParticipantRegister,
    ParticipantLogin, 
    ParticipantLogOut,
    Administration,
    ImageUpload,

    // Add other components as needed
  },
  data() {
    return {
      selectedTable: 'Conference_table', // Default table
    }
  },
  computed: {
    tables() {
      return this.$options.components ? Object.keys(this.$options.components) : [];
    }
  }
}
</script>