<template>
    <div>
      <!-- Button to trigger the modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#timetableModal">
        Add timetable
      </button>
  
      <!-- Modal for adding a new timetable -->
      <div class="modal fade" id="timetableModal" tabindex="-1" aria-labelledby="timetableModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="timetableModalLabel">Add timetable</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Form for adding a new timetable -->
              <form @submit.prevent="submitForm">
                <div class="mb-3">
                    <label for="conference_id" class="form-label">Conference</label>
                    <select class="form-control" id="conferenceSelector" v-model="newStage">
                      <option v-for="conference in conferences" :key="conference.id" :value="conference">
                        {{ conference.name }} - {{ conference.date }}
                      </option>
                    </select>
                </div>
                <div class="mb-3">
                  <select class="form-control" id="stageSelector" v-model="newTimetable.stage_id">
                    <option v-for="stage in filteredStages" :key="stage.id" :value="stage.id">
                      {{ stage.name }}
                    </option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="time_start" class="form-label">Start Time</label>
                  <input type="time" class="form-control" id="time_start" v-model="newTimetable.time_start" required/>
                </div>
                <div class="mb-3">
                  <label for="time_end" class="form-label">End Time</label>
                  <input type="time" class="form-control" id="time_end" v-model="newTimetable.time_end" required/>
                </div>
                <div class="mb-3">
                  <label for="comment" class="form-label">Comment</label>
                  <input type="text" class="form-control" id="comment" v-model="newTimetable.comment" placeholder="Add comment">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="submitForm">Create timetable</button>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Modal for editing a timetable -->
      <div class="modal fade" id="editTimetableModal" tabindex="-1" aria-labelledby="editTimetableModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editTimetableModalLabel">Edit timetable</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Form for editing a timetable -->
              <form v-if="editingTimetable" @submit.prevent="submitEditForm">
                <div class="mb-3">
                    <label for="conference_id" class="form-label">Conference</label>
                    <select class="form-control" id="conferenceSelector" v-model="newStage">
                      <option v-for="conference in conferences" :key="conference.id" :value="conference">
                        {{ conference.name }} - {{ conference.date }}
                      </option>
                    </select>
                </div>
                <div class="mb-3">
                  <select class="form-control" id="stageSelector" v-model="newTimetable.stage_id">
                    <option v-for="stage in filteredStages" :key="stage.id" :value="stage.id">
                      {{ stage.name }}
                    </option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="time_start" class="form-label">Start Time</label>
                  <input type="time" class="form-control" id="time_start" v-model="editingTimetable.time_start" required/>
                </div>
                <div class="mb-3">
                  <label for="time_end" class="form-label">End Time</label>
                  <input type="time" class="form-control" id="time_end" v-model="editingTimetable.time_end" required/>
                </div>
                <div class="mb-3">
                  <label for="comment" class="form-label">Comment</label>
                  <input type="text" class="form-control" id="comment" v-model="editingTimetable.comment" placeholder="Add comment">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="submitEditForm">Edit timetable</button>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Table to display the list of timetables -->
      <div class="container">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Conference</th> <!-- Add this line -->
                <th scope="col">Stage</th>
                <th scope="col">Start Time</th>
                <th scope="col">End Time</th>
                <th scope="col">Comment</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Loop through the list of timetables and display each one in a table row -->
              <tr v-for="timetable in timetablesWithConferenceNames" :key="timetable.id">
                <th scope="row">{{ timetable.id }}</th>
                <td>{{ timetable.conference_name }}</td>
                <td>{{ getStageName(timetable.stage_id) }}</td>
                <td>{{ timetable.time_start }}</td>
                <td>{{ timetable.time_end }}</td>
                <td>{{ timetable.comment }}</td>
                <td>
                    <button class="btn btn-primary m-2" @click="editTimetable(timetable)">Edit timetable</button>
                    <button class="btn btn-danger m-2" @click="deleteTimetable(timetable.id)">Delete timetable</button>
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
  import { watch } from 'vue';
  
  interface Timetable {
    id: number;
    stage_id: number;
    time_start: string;
    time_end: string;
    comment: string;
  }

  interface Stage {
    id: number;
    name: string;
    conference_id: number;
  }

  interface Conference {
    id: number;
    name: string;
    date: string;
    }
  
const TIMETABLE_API_ENDPOINT = 'http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/time_tables';
const STAGE_API_ENDPOINT = 'http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/stages';  

  export default defineComponent({
    name: 'Timetable',
    data() {
      return {
        newStage: null as Stage | null,
        timetables: [] as Timetable[],
        stages: [] as Stage[],
        conferences: [] as Conference[],
        newTimetable: {
          stage_id: 0,
          time_start: '',
          time_end: '',
          comment: '',
        },
        editingTimetable: {
          id: 0,
          stage_id: 0,
          time_start: '',
          time_end: '',
          comment: '',
        },
        addModal: null as Modal | null,
        editModal: null as Modal | null,
      };
    },
    async mounted() {
      const addModalElement = document.getElementById('timetableModal');
      const editModalElement = document.getElementById('editTimetableModal');
  
      if (!addModalElement || !editModalElement) {
        throw new Error('Modal elements not found');
      }
  
      this.addModal = new Modal(addModalElement);
      this.editModal = new Modal(editModalElement);
  
      this.timetables = await this.fetchTimetables();
      this.stages = await this.fetchStages();
      this.conferences = await this.fetchConferences();
      
    },
    methods: {
    async fetchTimetables() {
      const response = await axios.get(TIMETABLE_API_ENDPOINT);
        //console.log(response.data);
      return response.data;
    },
    async fetchStages() {
      const response = await axios.get(STAGE_API_ENDPOINT);
      //console.log(response.data);
      return response.data;
    },
    async fetchConferences() {
      const response = await axios.get('http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/conferences');
      //console.log(response.data); // Log the response data
      return response.data;
    },
    getConferenceName(stageId: number) {
      const stage = this.stages.find(stage => stage.id === stageId);
      if (!stage) {
          return 'Unknown conference';
      }
      const conference = this.conferences.find(conference => conference.id === stage.conference_id);
      return conference ? conference.name : 'Unknown conference';
    },
    getStageName(stageId: number) {
      const stage = this.stages.find(stage => stage.id === stageId);
      return stage ? stage.name : 'Unknown stage';
    },
      async submitForm() {
        if (!this.newTimetable.stage_id || !this.newTimetable.time_start || !this.newTimetable.time_end) {
          alert('Please fill in all required fields.');
          return;
        }
        await axios.post(TIMETABLE_API_ENDPOINT, this.newTimetable);
        //await axios.post(STAGE_API_ENDPOINT, this.newTimetable);
        this.newTimetable = {
          //conference_id: 0,
          stage_id: 0,
          time_start: '',
          time_end: '',
          comment: '',
        };
        this.timetables = await this.fetchTimetables();
        console.log("totok" + this.timetables);
      },
      editTimetable(timetable: Timetable) {
        this.editingTimetable = {
          id: timetable.id,
          //conference_id: timetable.conference_id,
          stage_id: null as any,
          time_start: timetable.time_start,
          time_end: timetable.time_end,
          comment: timetable.comment,
        }
        this.editModal?.show();
      },
      async submitEditForm() {
        if (!this.editingTimetable) {
          return;
        }

        this.editingTimetable.stage_id = this.newTimetable.stage_id;

        try {
          await axios.put(`${TIMETABLE_API_ENDPOINT}/${this.editingTimetable.id}`, this.editingTimetable);
          this.timetables = await this.fetchTimetables();
        } catch (error) {
          console.error('Failed to update timetable:', error);
        }
        this.editModal?.hide();
      },
      async deleteTimetable(id: number) {
        try {
          await axios.delete(`${TIMETABLE_API_ENDPOINT}/${id}`);
          this.timetables = await this.fetchTimetables();
        } catch (error) {
          console.error('Failed to delete timetable:', error);
        }
      },
    },
    computed: {
      filteredStages(): Stage[] {
        const filtered = this.stages.filter(stage => this.newStage && stage.conference_id == this.newStage.id);
        return filtered;
},
  timetablesWithConferenceNames() {
    return this.timetables.map(timetable => {
      // Find the corresponding stage
      const stage = this.stages.find(s => s.id === timetable.stage_id);
      // If the stage is not found, return the timetable with 'Unknown conference' as the conference name
      if (!stage) {
        return {
          ...timetable,
          conference_name: 'Unknown conference',
        };
      }
      // Find the corresponding conference
      const conference = this.conferences.find(c => c.id === stage.conference_id);
      // Return a new object that includes the conference name
      return {
        ...timetable,
        conference_name: conference ? conference.name : 'Unknown conference',
      };
    });
  },
},
  /*watch: {
    newStage() {
      this.filteredStages;
    },
  },*/
  });
  </script>