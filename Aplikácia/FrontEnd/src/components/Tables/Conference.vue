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
                <input type="text" class="form-control" id="name" v-model="newConference.name" placeholder="Pridaj názov" required/>             </div>
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

    <!-- Modal for editing a conference -->
    <div class="modal fade" id="editConferenceModal" tabindex="-1" aria-labelledby="editConferenceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editConferenceModalLabel">Zmeniť konferenciu</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Form for editing a conference -->
            <form v-if="editingConference" @submit.prevent="submitEditForm">
              <div class="mb-3">
                <label for="name" class="form-label">Názov</label>
                <input type="text" class="form-control" id="name" v-model="editingConference.name" placeholder="Pridaj názov" required>
              </div>
              <div class="mb-3">
                <label for="date" class="form-label">Dátum konania konferencie</label>
                <input type="date" class="form-control" id="date" v-model="editingConference.date" placeholder="Zvoľ dátum" required>
              </div>
              <!-- Add this button in the form for editing a conference -->
              <div class="mb-3">
                <label for="state" class="form-label">Stav konferencie</label>
                <input type="text" class="form-control" id="state" v-model="editingConference.state" readonly>
              </div>
              <button type="button" class="btn btn-info" @click="changeState" :disabled="stateChanged">Change State</button>
              <div class="mb-3">
                <label for="comment" class="form-label">Komentár</label>
                <input type="text" class="form-control" id="comment" v-model="editingConference.comment" placeholder="Pridaj komentár">
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Adresa konania konferencie</label>
                <input type="text" class="form-control" id="address" v-model="editingConference.address_of_conference" placeholder="Pridaj adresu konferencie">
              </div>
            </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvoriť</button>
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="submitEditForm">Zmeniť</button>
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
              <th scope="col">Akcie</th> <!-- New column for actions -->
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
              <td>
                <button class="btn btn-primary m-2" @click="editConference(conference)">Zmeniť niečo na konferencií</button>
                <button class="btn btn-danger m-2" @click="deleteConference(conference.id)">Vymazať konferenciu</button>
              </td>
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
import { Modal } from 'bootstrap';

interface Conference {
  id: number;
  name: string;
  date: string;
  state: 'preparing' | 'in_progress' | 'ended';
  comment?: string;
  address_of_conference?: string;
}

const API_ENDPOINT = 'http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/conferences';

export default defineComponent({
  name: 'Conference',
  data() {
    return {
      conferences: [] as Conference[],
      newConference: {
        name: '',
        date: '',
        comment: '',
        address: '',
      },
      editingConference: null as Conference | null,
      addModal: null as Modal | null,
      editModal: null as Modal | null,
      stateChanged: false,
    };
  },
  async mounted() {
    this.conferences = await this.fetchConferences();

    const addModalElement = document.getElementById('conferenceModal');
    const editModalElement = document.getElementById('editConferenceModal');

    if (!addModalElement || !editModalElement) {
      throw new Error('Modal elements not found');
    }

    this.addModal = new Modal(addModalElement);
    this.editModal = new Modal(editModalElement);
  },
  methods: {
    async fetchConferences() {
      const response = await axios.get(API_ENDPOINT);
      return response.data;
    },
    async submitForm() {
      if (!this.newConference.name || !this.newConference.date) {
        alert('Je potrebné zadať názov a dátum konferencie.');
        return;
      }

      await axios.post(API_ENDPOINT, this.newConference);
      
      this.newConference = {
        name: '',
        date: '',
        comment: '',
        address: '',
      };
      
      this.conferences = await this.fetchConferences();
    },
    editConference(conference: Conference) {
      this.editingConference = { ...conference };
      this.editModal?.show();
      this.stateChanged = false;
    },
    async submitEditForm() {
      if (!this.editingConference) {
        return;
      }

      try {
        await axios.put(`${API_ENDPOINT}/${this.editingConference.id}`, this.editingConference);
        this.editingConference = null;
        this.conferences = await this.fetchConferences();
      } catch (error) {
        console.error('Failed to update conference:', error);
      }
      this.editModal?.hide();
    },
    async deleteConference(id: number) {
      try {
        await axios.delete(`${API_ENDPOINT}/${id}`);
        this.conferences = await this.fetchConferences();
      } catch (error) {
        console.error('Failed to delete conference:', error);
      }
    },
    changeState() {
      if (!this.editingConference) {
        return;
      }
      switch (this.editingConference.state) {
        case 'preparing':
          this.editingConference.state = 'in_progress';
          break;
        case 'in_progress':
          this.editingConference.state = 'ended';
          break;
        default:
          alert('The conference has already ended.');
      }
      this.stateChanged = true;
    },
  },
});
</script>