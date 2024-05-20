<template>
  <div>
    <!-- Button to trigger the modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#conferenceModal">
      Pridaj konferenciu
    </button>

    <!-- Modal for adding a new conference -->
    <div class="modal fade" id="conferenceModal" tabindex="-1" aria-labelledby="conferenceModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="conferenceModalLabel">Pridaj konferenciu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Form for adding a new conference -->
            <form @submit.prevent="submitForm">
              <div class="mb-3">
                <label for="name" class="form-label">Názov</label>
                <input type="text" class="form-control" id="name" v-model="newConference.name" placeholder="Pridaj názov" required>
              </div>
              <div class="mb-3">
                <label for="date" class="form-label">Dátum konania konferencie</label>
                <input type="date" class="form-control" id="date" v-model="newConference.date" placeholder="Zvoľ dátum" required>
              </div>
              <div class="mb-3">
                <label for="comment" class="form-label">Komentár</label>
                <input type="text" class="form-control" id="comment" v-model="newConference.comment" placeholder="Pridaj komentár">
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Adresa konania konferencie</label>
                <input type="text" class="form-control" id="address" v-model="newConference.address" placeholder="Pridaj adresu konferencie">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvoriť</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="submitForm">Vytvoriť konferenciu</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Table to display the list of conferences -->
    <div class="container">
      <div class="table-responsive"> <!-- Add this div with class .table-responsive -->
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Názov</th>
              <th scope="col">Dátum konania konferencie</th>
              <th scope="col">Stav konferencie</th>
              <th scope="col">Komentár</th>
              <th scope="col">Adresa konania konferencie</th>
            </tr>
          </thead>
          <tbody>
            <!-- Loop through the list of conferences and display each one in a table row -->
            <tr v-for="conference in conferences" :key="conference.id">
              <th scope="row">{{ conference.id }}</th>
              <td>{{ conference.name }}</td>
              <td>{{ conference.date }}</td>
              <td>{{ conference.state }}</td>
              <td>{{ conference.comment }}</td>
              <td>{{ conference.address_of_conference }}</td>
            </tr>
          </tbody>
        </table>
      </div> <!-- Close the .table-responsive div -->
    </div>
  </div>
</template>


<script lang="ts">
import { defineComponent } from 'vue';
import axios from 'axios';

interface Conference {
  id: number;
  name: string;
  date: string;
  state: 'preparing' | 'in_progress' | 'ended';
  comment?: string;
  address_of_conference?: string;
}

export default defineComponent({
  name: 'Conference',
  data() {
    return {
      conferences: [] as Conference[],
      showForm: false,
      newConference: {
        name: '',
        date: '',
        comment: '',
        address: '',
      },
    };
  },
  async mounted() {
    const response = await axios.get('http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/conferences');
    this.conferences = response.data;
  },
  methods: {
    async submitForm() {
      if (!this.newConference.name) {
        alert('Je potrebné zadať názov konferencie.');
        return;
      }

      if (!this.newConference.date) {
        alert('Je potrebné zadať dátum konania konferencie.');
        return;
      }

      const response = await axios.post('http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/conferences', this.newConference);
      
      this.newConference = {
        name: '',
        date: '',
        comment: '',
        address: '',
      };
      
      const refreshResponse = await axios.get('http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/conferences');
      this.conferences = refreshResponse.data;
      
    },
  },
});
</script>