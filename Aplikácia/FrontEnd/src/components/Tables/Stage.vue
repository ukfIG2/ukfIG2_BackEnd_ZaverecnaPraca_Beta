<template>
  <div>
    <!-- Button to trigger the modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#stageModal">
      Pridaj stage
    </button>

    <!-- Modal for adding a new stage -->
    <div class="modal fade" id="stageModal" tabindex="-1" aria-labelledby="stageModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="stageModalLabel">Pridaj stage</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Form for adding a new stage -->
            <form @submit.prevent="submitForm">
                <!-- New input for the conference -->
                <div class="mb-3">
                    <label for="conference" class="form-label">Konferencia</label>
                    <select class="form-control" id="conference" v-model="newStage.conference_id" required>
                        <option v-for="conference in conferences" :key="conference.id" :value="conference.id">
                        {{ conference.name }} ({{ conference.date }})
                        </option>
                    </select>
                </div>
                <!-- New input for the conference -->
              <div class="mb-3">
                <label for="name" class="form-label">Názov</label>
                <input type="text" class="form-control" id="name" v-model="newStage.name" placeholder="Pridaj názov" required/>
              </div>
              <div class="mb-3">
                <label for="comment" class="form-label">Komentár</label>
                <input type="text" class="form-control" id="comment" v-model="newStage.comment" placeholder="Pridaj komentár">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvoriť</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="submitForm">Vytvoriť stage</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for editing a stage -->
    <div class="modal fade" id="editStageModal" tabindex="-1" aria-labelledby="editStageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editStageModalLabel">Zmeniť stage</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Form for editing a stage -->
            <form v-if="editingStage" @submit.prevent="submitEditForm">
                <div class="mb-3">
                    <label for="conference" class="form-label">Konferencia</label>
                    <select class="form-control" id="conference" v-model="editingStage.conference_id" required>
                        <option v-for="conference in conferences" :key="conference.id" :value="conference.id">
                        {{ conference.name }} ({{ conference.date }})
                        </option>
                    </select>
                    </div>
                <!-- New input for the conference -->
              <div class="mb-3">
                <label for="name" class="form-label">Názov</label>
                <input type="text" class="form-control" id="name" v-model="editingStage.name" placeholder="Pridaj názov" required>
              </div>
              <div class="mb-3">
                <label for="comment" class="form-label">Komentár</label>
                <input type="text" class="form-control" id="comment" v-model="editingStage.comment" placeholder="Pridaj komentár">
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

    <!-- Table to display the list of stages -->
    <div class="container">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Konferencia</th> <!-- New column for the conference -->
                <th scope="col">Stage</th>
                <th scope="col">Komentár</th>
                <th scope="col">Akcie</th>
            </tr>
          </thead>
          <tbody>
            <!-- Loop through the list of stages and display each one in a table row -->
            <tr v-for="stage in stages" :key="stage.id">
                <th scope="row">{{ stage.id }}</th>
                <td>{{ getConferenceName(stage.conference_id) }}</td>
                <td>{{ stage.name }}</td>
                <td>{{ stage.comment }}</td>
                <td>
                <button class="btn btn-primary m-2" @click="editStage(stage)">Zmeniť niečo na stage</button>
                <button class="btn btn-danger m-2" @click="deleteStage(stage.id)">Vymazať stage</button>
                </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>


<script lang="ts">
import { defineComponent } from 'vue';
import axios from 'axios';
import { Modal } from 'bootstrap';
import SF from '@/assets/sharedFunctions';

interface Stage {
  id: number;
  conference: string; 
  conference_id: number; // changed from string to number
  name: string;
  comment?: string;
}

interface Conference {
  id: number;
  name: string;
  date: string;
}

export default defineComponent({
  name: 'Stage',
  data() {
    return {
      stages: [] as Stage[],
      conferences: [] as Conference[], // added conferences array
      newStage: {
        name: '',
        comment: '',
        //conference_id: '', // new property for the conference ID
        conference_id: 0, // changed from string to number
      },
      editingStage: null as Stage | null,
      addModal: null as Modal | null,
      editModal: null as Modal | null,
    };
  },
  async mounted() {
  const addModalElement = document.getElementById('stageModal');
  const editModalElement = document.getElementById('editStageModal');

  if (!addModalElement || !editModalElement) {
    throw new Error('Modal elements not found');
  }

  this.addModal = new Modal(addModalElement);
  this.editModal = new Modal(editModalElement);

  // Fetch conferences before stages
  this.conferences = await SF.fetchConferenceData();
  this.stages = await SF.fetchStageData();
},
  methods: {
    async submitForm() {
      if (!this.newStage.name) {
        alert('Je potrebné zadať názov stage.');
        return;
      }
      await axios.post(SF.API_ENDPOINT_STAGES, this.newStage);
      this.newStage = {
        name: '',
        comment: '',
        conference_id: 0, // reset the conference ID
      };
      this.stages = await SF.fetchStageData();
    },
    editStage(stage: Stage) {
  this.editingStage = { ...stage };
  this.editModal?.show();
},
    async submitEditForm() {
      if (!this.editingStage) {
        return;
      }

      try {
        await axios.put(`${SF.API_ENDPOINT_STAGES}/${this.editingStage.id}`, this.editingStage);
        this.editingStage = null;
        this.stages = await SF.fetchStageData();
      } catch (error) {
        console.error('Failed to update stage:', error);
      }
      this.editModal?.hide();
    },
    getConferenceName(id: number) {
    const conference = this.conferences.find(c => c.id === id);
    return conference ? conference.name : '';
  },

  async deleteStage(id: number) {
    try {
      await axios.delete(`${SF.API_ENDPOINT_STAGES}/${id}`);
      this.stages = await SF.fetchStageData();
    } catch (error) {
      console.error('Failed to delete stage:', error);
    }
  },
}, // closing bracket for methods
}); // closing bracket for export default
</script>