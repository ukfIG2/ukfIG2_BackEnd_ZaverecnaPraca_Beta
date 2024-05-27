<template>
    <!-- Button to trigger the modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#presentationModal">
      Add presentation
    </button>

    <!-- Modal for adding a new presentation -->
    <div class="modal fade" id="presentationModal" tabindex="-1" aria-labelledby="presentationModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="presentationModalLabel">Add presentation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Form for adding a new presentation -->
             <form @submit.prevent="submitForm"> 
            

              <div class="mb-3">
                <label for="conference_id" class="form-label">Conference</label>
                <select class="form-control" id="conference_id" v-model="newPresentation.conference_id">
                  <option v-for="conference in conferences" :key="conference.id" :value="conference.id">
                    {{ conference.name }} - {{ conference.date }} - {{ conference.state }}
                  </option>
                </select>
              </div>

              <div class="mb-3">
                <label for="stage_id" class="form-label">Stage</label>
                <select class="form-control" id="stageSelector" v-model="newPresentation.stage_id">
                    <option v-for="stage in filteredStages" :key="stage.id" :value="stage.id">
                      {{ stage.name }}
                    </option>
                  </select>
              </div>

              <div class="mb-3">
                <label for="timetable_id" class="form-label">Timetable</label>
                <select class="form-control" id="timetableSelector" v-model="newPresentation.time_table_id">
                  <option v-for="timetable in filteredTimeTables" :key="timetable.id" :value="timetable.id">
                    {{ timetable.time_start }} - {{ timetable.time_end }}
                  </option>
                </select>
              </div>
 
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" v-model="newPresentation.name" required/>
              </div>
              <div class="mb-3">
                <label for="short_description" class="form-label">Short Description</label>
                <input type="text" class="form-control" id="short_description" v-model="newPresentation.short_description" required/>
              </div>
              <div class="mb-3">
                <label for="long_description" class="form-label">Long Description</label>
                <textarea class="form-control" id="long_description" v-model="newPresentation.long_description" required></textarea>
              </div>
              <div class="mb-3">
                <label for="max_capacity" class="form-label">Max Capacity</label>
                <input type="number" class="form-control" id="max_capacity" v-model="newPresentation.max_capacity" required/>
              </div>
              <div class="mb-3">
                <label for="comment" class="form-label">Comment</label>
                <input type="text" class="form-control" id="comment" v-model="newPresentation.comment" placeholder="Add comment">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="submitForm">Create presentation</button> 
          </div>
        </div>
      </div>
    </div>
    

        <!-- Modal for editing a timetable -->
    <div class="modal fade" id="editPresentationModal" tabindex="-1" aria-labelledby="editPresentationModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editPresentationModalLabel">Edit presentation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Form for editing a presentation -->
            <form @submit.prevent="submitEditForm"> 

              <div class="mb-3">
                <label for="conference_id" class="form-label">Conference</label>
                <select class="form-control" id="conference_id" v-model="editingPresentation.conference_id">
                  <option v-for="conference in conferences" :key="conference.id" :value="conference.id">
                    {{ conference.name }} - {{ conference.date }} - {{ conference.state }}
                  </option>
                </select>
              </div>

              <div class="mb-3">
                <label for="stage_id" class="form-label">Stage</label>
                <select class="form-control" id="stageSelector" v-model="editingPresentation.stage_id">
                    <option v-for="stage in filteredEditStages" :key="stage.id" :value="stage.id">
                      {{ stage.name }}
                    </option>
                  </select>
              </div>

              <div class="mb-3">
                <label for="timetable_id" class="form-label">Timetable</label>
                <select class="form-control" id="timetableSelector" v-model="editingPresentation.time_table_id">
                  <option v-for="timetable in filteredEditTimeTables" :key="timetable.id" :value="timetable.id">
                    {{ timetable.time_start }} - {{ timetable.time_end }}
                  </option>
                </select>
              </div>

                  <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" v-model="editingPresentation.name" required/>
                  </div>
                  <div class="mb-3">
                    <label for="short_description" class="form-label">Short Description</label>
                    <input type="text" class="form-control" id="short_description" v-model="editingPresentation.short_description" required/>
                  </div>
                  <div class="mb-3">
                    <label for="long_description" class="form-label">Long Description</label>
                    <textarea class="form-control" id="long_description" v-model="editingPresentation.long_description" required></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="max_capacity" class="form-label">Max Capacity</label>
                    <input type="number" class="form-control" id="max_capacity" v-model="editingPresentation.max_capacity" required/>
                  </div>
                  <div class="mb-3">
                    <label for="comment" class="form-label">Comment</label>
                    <input type="text" class="form-control" id="comment" v-model="editingPresentation.comment" placeholder="Add comment">
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="submitEditForm">Save changes</button> 
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
                <th scope="col">Conference</th> 
                <th scope="col">Stage</th>
                <th scope="col">Time table</th>
                <th scope="col">Name</th>
                <th scope="col">Short_description</th>
                <th scope="col">Long_description</th>
                <th scope="col">Max_capacity</th>
                <th scope="col">Comment</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="presentation in presentations" :key="presentation.id">
                <th scope="row">{{ presentation.id }}</th>
                <td>{{ getConferenceName(presentation.time_table_id) }}</td>
                <td>{{ getStageName(presentation.time_table_id) }}</td>
                <td>{{ getTimeTableTime(presentation.time_table_id)}}</td>
                <td>{{ presentation.name }}</td>
                <td>{{ presentation.short_description }}</td>
                <td>{{ presentation.long_description }}</td>
                <td>{{ presentation.max_capacity }}</td>
                <td>{{ presentation.comment }}</td>
                <td>
                    <button class="btn btn-primary m-2" @click="editPresentation(presentation)">Edit timetable</button>
                    <button class="btn btn-danger m-2" @click="presentation.id !== undefined && deleteTimetable(presentation.id)">Delete timetable</button>                </td>
                </tr>
          </tbody>
        </table>
      </div>
    </div>
</template>

<script lang="ts">
  import { defineComponent } from 'vue';
  import axios from 'axios';
  import { Modal } from 'bootstrap';

  interface Presentation {
    id?: number;
    time_table_id: number;
    name: string;
    short_description: string;
    long_description: string;
    max_capacity: number;
    comment: string;
  }
  
  interface Timetable {
    id: number;
    stage_id: number;
    //time: string;
    time_start: string;
    time_end: string;
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
    state: string;
  }

  const PRESENTATION_API_ENDPOINT = 'http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/presentations';
  const TIMETABLE_API_ENDPOINT = 'http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/time_tables';
  const STAGE_API_ENDPOINT = 'http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/stages';  

  export default defineComponent({
    name: 'Presentation',
    data(){
      return {
        presentations: [] as Presentation[],
        timetables: [] as Timetable[],
        stages: [] as Stage[],
        conferences: [] as Conference[],
        newPresentation: {
          conference_id: 0,
          stage_id: 0,
          time_table_id: 0, //1
          name: '',
          short_description: '',
          long_description: '',
          max_capacity: 0,
          comment: '',
        },
        editingPresentation: {
          id: 0,
          conference_id: 0,
          stage_id: 0,
          time_table_id: 0, //1
          name: '',
          short_description: '',
          long_description: '',
          max_capacity: 0,
          comment: '',
        },
        addModal: null as Modal | null,
        editModal: null as Modal | null,
        editingTimeTable: null as Timetable | null,
      }
    },
    /*async mounted() {
      this.presentations = await this.fetchPresentations();
      this.timetables = await this.fetchTimetables();
      this.stages = await this.fetchStages();
      this.conferences = await this.fetchConferences();

    },*/
    async mounted() {
      const [presentations, timetables, stages, conferences] = await Promise.all([
        this.fetchPresentations(),
        this.fetchTimetables(),
        this.fetchStages(),
        this.fetchConferences(),
      ]);
      this.presentations = presentations;
      this.timetables = timetables;
      this.stages = stages;
      this.conferences = conferences;

      const addModalElement = document.getElementById('presentationModal');
      const editModalElement = document.getElementById('editPresentationModal');
  
      if (!addModalElement || !editModalElement) {
        throw new Error('Modal elements not found');
      }
  
      this.addModal = new Modal(addModalElement);
      this.editModal = new Modal(editModalElement);
    },
    methods: {
      async fetchPresentations() {
        const response = await axios.get(PRESENTATION_API_ENDPOINT);
        //console.log(response.data);
        return response.data;
      },
      async fetchTimetables() {
        const response = await axios.get(TIMETABLE_API_ENDPOINT);
        //console.log(response.data);
        return response.data;
      },
      async fetchStages() {
        const response = await axios.get(STAGE_API_ENDPOINT);
        return response.data;
      },
      async fetchConferences() {
        const response = await axios.get('http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/conferences');
        return response.data;
      },
      getTimeTableTime(timetableId: number) {
        const timetable = this.timetables.find(timetable => timetable.id === timetableId);
        if (timetable) {
          return `${timetable.time_start} - ${timetable.time_end}`;
        }
        return 'Timetable not found';
      },
      /*getStageName(presentationId: number) {
        const presentation = this.presentations.find(presentation => presentation.id === presentationId);
        if (presentation) {
          const timetable = this.timetables.find(timetable => timetable.id === presentation.time_table_id);
          if (timetable) {
            const stage = this.stages.find(stage => stage.id === timetable.stage_id);
            return stage ? stage.name : 'Stage not found';
          }
          return 'Timetable not found';
        }
        return 'Presentation not found';
      },*/
      getStageName(timetableId: number) {
        const timetable = this.timetables.find(timetable => timetable.id === timetableId);
        if (timetable) {
          const stage = this.stages.find(stage => stage.id === timetable.stage_id);
          return stage ? stage.name : 'Stage not found';
        }
        return 'Timetable not found';
      },
      /*getConferenceName(presentationId: number) {
        const presentation = this.presentations.find(presentation => presentation.id === presentationId);
        if (presentation) {
          const timetable = this.timetables.find(timetable => timetable.id === presentation.time_table_id);
          if (timetable) {
            const stage = this.stages.find(stage => stage.id === timetable.stage_id);
            if (stage) {
              const conference = this.conferences.find(conference => conference.id === stage.conference_id);
              return conference ? conference.name : 'Conference not found';
            }
            return 'Stage not found';
          }
          return 'Timetable not found';
        }
        return 'Presentation not found';
      },*/
      getConferenceName(timetableId: number) {
        const timetable = this.timetables.find(timetable => timetable.id === timetableId);
        if (timetable) {
          const stage = this.stages.find(stage => stage.id === timetable.stage_id);
          if (stage) {
            const conference = this.conferences.find(conference => conference.id === stage.conference_id);
            return conference ? conference.name : 'Conference not found';
          }
          return 'Stage not found';
        }
        return 'Timetable not found';
      },
      /*async submitForm() {
        const response = await axios.post(PRESENTATION_API_ENDPOINT, this.newPresentation);
        console.log(response.data);
        this.newPresentation = {
          conference_id: 0,
          time_table_id: 0,
          name: '',
          short_description: '',
          long_description: '',
          max_capacity: 0,
          comment: '',
        };
        addModal: null as Modal | null;
      },*/
      async submitForm() {

        if(this.newPresentation.conference_id === 0 || this.newPresentation.stage_id === 0 || this.newPresentation.time_table_id === 0){
          alert("Please select conference, stage and timetable");
          return;
        }
        if(this.newPresentation.name === ''){
          alert("Please enter name");
          return;
        }
        if(this.newPresentation.max_capacity === 0){
          alert("Please enter max capacity");
          return;
        }

        const response = await axios.post(PRESENTATION_API_ENDPOINT, this.newPresentation);
        //console.log(response.data);
        this.newPresentation = {
          conference_id: 0,
          stage_id: 0,
          time_table_id: 0,
          name: '',
          short_description: '',
          long_description: '',
          max_capacity: 0,
          comment: '',
        };
        this.addModal?.hide();
        this.presentations = await this.fetchPresentations();

      },
      async submitEditForm() {
        if(this.editingPresentation.conference_id === 0 || this.editingPresentation.stage_id === 0 || this.editingPresentation.time_table_id === 0){
          alert("Please select conference, stage and timetable");
          return;
        }
        if(this.editingPresentation.name === ''){
          alert("Please enter name");
          return;
        }
        if(this.editingPresentation.max_capacity === 0){
          alert("Please enter max capacity");
          return;
        }
/*         console.log("tototototk");
        console.log(this.editingPresentation); */

        const response = await axios.put(`${PRESENTATION_API_ENDPOINT}/${this.editingPresentation.id}`, this.editingPresentation);
        //console.log(response.data);
        this.editingPresentation = {
          id: 0,
          conference_id: 0,
          stage_id: 0,
          time_table_id: 0,
          name: '',
          short_description: '',
          long_description: '',
          max_capacity: 0,
          comment: '',
        };
        this.editModal?.hide();
        this.presentations = await this.fetchPresentations();

      },
      editPresentation(presentation: Presentation){
        const timetable = this.timetables.find(timetable => timetable.id === presentation.time_table_id);
        if (!timetable) {
          throw new Error('Timetable not found');
        }

        const stage = this.stages.find(stage => stage.id === timetable.stage_id);
        if (!stage) {
          throw new Error('Stage not found');
        }

        const conference = this.conferences.find(conference => conference.id === stage.conference_id);
        if (!conference) {
          throw new Error('Conference not found');
        }

        this.editingPresentation = {
          id: presentation.id !== undefined ? presentation.id : 0,
          conference_id: conference.id,
          stage_id: stage.id,
          time_table_id: presentation.time_table_id,
          name: presentation.name,
          short_description: presentation.short_description,
          long_description: presentation.long_description,
          max_capacity: presentation.max_capacity,
          comment: presentation.comment,
        };
        this.editModal?.show();
        //console.log(this.editingPresentation);
      },
      async deleteTimetable(timetableId: number) {
        await axios.delete(`${PRESENTATION_API_ENDPOINT}/${timetableId}`);
        this.presentations = await this.fetchPresentations();
      },
    },
    computed: {
      filteredStages(): Stage[] {
        /* console.log(this.newPresentation.conference_id);
        console.log(this.newPresentation); */
        return this.stages.filter(stage => stage.conference_id === this.newPresentation.conference_id);
      },
      filteredTimeTables(): Timetable[] {
        /* console.log(this.newPresentation.stage_id);
        console.log(this.newPresentation);
        console.log(this.timetables); */
        return this.timetables.filter(timetable => timetable.stage_id === this.newPresentation.stage_id);
      },
      filteredEditStages(): Stage[] {
        /* console.log(this.editingPresentation.conference_id);
        console.log(this.editingPresentation); */
        return this.stages.filter(stage => stage.conference_id === this.editingPresentation.conference_id);
      },
      filteredEditTimeTables(): Timetable[] {
        /* console.log(this.editingPresentation.stage_id);
        console.log(this.editingPresentation);
        console.log(this.timetables); */
        return this.timetables.filter(timetable => timetable.stage_id === this.editingPresentation.stage_id);
      },
    }
  })


</script>