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


// Define the component

export default {
  components: {
    Conference_table,
    Stage_table
  

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