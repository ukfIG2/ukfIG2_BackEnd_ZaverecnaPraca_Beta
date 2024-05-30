<template>
    <div>
        <!-- Button to trigger the modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#speakerModal">
        Add speaker
      </button>

        <!-- Modal for adding a new speaker -->
        <div class="modal fade" id="speakerModal" tabindex="-1" aria-labelledby="speakerModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="speakerModalLabel">Add Speaker</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Form for adding a new speaker -->
                    <form @submit.prevent="submitForm">
                    
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" v-model="newSpeaker.title" required/>
                        </div>

                        <div class="mb-3">
                            <label for="first_name" class="form-label">First name</label>
                            <input type="text" class="form-control" id="first_name" v-model="newSpeaker.first_name" required/>
                        </div>

                        <div class="mb-3">
                            <label for="middle_name" class="form-label">Middle name</label>
                            <input type="text" class="form-control" id="last_name" v-model="newSpeaker.middle_name" required/>
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="last_name" v-model="newSpeaker.last_name" required/>
                        </div>

                        <div class="mb-3">
                            <label for="company" class="form-label">Company</label>
                            <input type="text" class="form-control" id="company" v-model="newSpeaker.company" required/>
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" class="form-control" id="position" v-model="newSpeaker.position" required/>
                        </div>

                        <div class="mb-3">
                            <label for="short_description" class="form-label">Short description</label>
                            <input type="text" class="form-control" id="short_description" v-model="newSpeaker.short_description" required/>
                        </div>

                        <div class="mb-3">
                            <label for="long_description" class="form-label">Long description</label>
                            <input type="text" class="form-control" id="long_description" v-model="newSpeaker.long_description" required/>
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment</label>
                            <input type="text" class="form-control" id="comment" v-model="newSpeaker.comment" required/>
                        </div>

                    </form>
                    </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="submitForm">Create speaker</button>
                    </div>
                </div>
                </div>
            </div>
        <!-- Modal for editing a speaker -->
        <div class="modal fade" id="editSpeakerModal" tabindex="-1" aria-labelledby="editSpeakerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editSpeakerModalLabel">Edit speaker</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Form for editing a timetable -->
              <form v-if="editingSpeaker" @submit.prevent="submitEditForm">
                
                <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" v-model="newSpeaker.title" required/>
                        </div>

                        <div class="mb-3">
                            <label for="first_name" class="form-label">First name</label>
                            <input type="text" class="form-control" id="first_name" v-model="editingSpeaker.first_name" required/>
                        </div>

                        <div class="mb-3">
                            <label for="middle_name" class="form-label">Middle name</label>
                            <input type="text" class="form-control" id="last_name" v-model="editingSpeaker.middle_name" required/>
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="last_name" v-model="editingSpeaker.last_name" required/>
                        </div>

                        <div class="mb-3">
                            <label for="company" class="form-label">Company</label>
                            <input type="text" class="form-control" id="company" v-model="editingSpeaker.company" required/>
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" class="form-control" id="position" v-model="editingSpeaker.position" required/>
                        </div>

                        <div class="mb-3">
                            <label for="short_description" class="form-label">Short description</label>
                            <input type="text" class="form-control" id="short_description" v-model="editingSpeaker.short_description" required/>
                        </div>

                        <div class="mb-3">
                            <label for="long_description" class="form-label">Long description</label>
                            <input type="text" class="form-control" id="long_description" v-model="editingSpeaker.long_description" required/>
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment</label>
                            <input type="text" class="form-control" id="comment" v-model="editingSpeaker.comment" required/>
                        </div>

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="submitEditForm">Edit speaker</button>
            </div>
          </div>
        </div>
      </div>

        <!-- Table to display the list of speaker -->
        <div class="container">
            <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th> <!-- Add this line -->
                    <th scope="col">First_name</th>
                    <th scope="col">Middle_name</th>
                    <th scope="col">Last_name</th>
                    <th scope="col">Company</th>
                    <th scope="col">Position</th>
                    <th scope="col">short_description</th>
                    <th scope="col">long_description</th>
                    <th scope="col">comment</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <!-- Loop through the list of speaker and display each one in a table row -->
                <tr v-for="speaker in speakers" :key="speaker.id">
                    <th scope="row">{{ speaker.id }}</th>
                    <td>{{ speaker.title }}</td>
                    <td>{{ speaker.first_name }}</td>
                    <td>{{ speaker.middle_name }}</td>
                    <td>{{ speaker.last_name }}</td>
                    <td>{{ speaker.position }}</td>
                    <td>{{ speaker.company }}</td>
                    <td>{{ speaker.short_description }}</td>
                    <td>{{ speaker.long_description }}</td>
                    <td>{{ speaker.comment }}</td>
                    <td>
                        <button class="btn btn-primary m-2" @click="editSpeakerFunction(speaker)">Edit speaker</button>
                        <button class="btn btn-danger m-2" @click="deleteSpeaker(speaker.id)">Delete speaker</button>
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

  interface Speaker {
    id: number;
    title: string;
    first_name: string;
    middle_name: string;
    last_name: string;
    company: string;
    position: string;
    short_description: string;
    long_description: string;
    comment: string;
  }

  const SPEAKER_API_URL = 'http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/speakers';

  export default defineComponent({
    name: 'Speaker',
    data() {
      return {
        speakers: [] as Speaker[],
        newSpeaker: {} as Speaker,
        editingSpeaker: {} as Speaker,
        addModal: null as Modal | null,
        editModal: null as Modal | null,
      };
    },
    async mounted() {
        const editSpeakerModal = document.getElementById('editSpeakerModal');
        if (editSpeakerModal) {
            this.editModal = new Modal(editSpeakerModal);
        }

        this.speakers = await this.fetchSpeakers();
    },
    methods: {
        async fetchSpeakers() {
            const response = await axios.get(SPEAKER_API_URL);
            return response.data;
        },
        async deleteSpeaker(id: number) {
            try {
                await axios.delete(`${SPEAKER_API_URL}/${id}`);
                this.speakers = await this.fetchSpeakers();
            } catch (error) {
                console.error(error);
            }
        },
        async submitForm() {
            if(!this.newSpeaker.first_name || !this.newSpeaker.last_name ) {
                alert('Please fill in all required fields');
                return;
            }
            try {
                await axios.post(SPEAKER_API_URL, this.newSpeaker);
                this.newSpeaker = {} as Speaker;
                this.speakers = await this.fetchSpeakers();
            } catch (error) {
                console.error(error);
            } 
        },
        editSpeakerFunction(speaker: Speaker) {
            this.editingSpeaker = {
                id: speaker.id,
                title: speaker.title,
                first_name: speaker.first_name,
                middle_name: speaker.middle_name,
                last_name: speaker.last_name,
                company: speaker.company,
                position: speaker.position,
                short_description: speaker.short_description,
                long_description: speaker.long_description,
                comment: speaker.comment,
            }
            this.editModal?.show();
        },
        async submitEditForm() {
            if(!this.editingSpeaker.first_name || !this.editingSpeaker.last_name ) {
                alert('Please fill in all required fields');
                return;
            }
            try {
                await axios.put(`${SPEAKER_API_URL}/${this.editingSpeaker.id}`, this.editingSpeaker);
                this.editingSpeaker = {} as Speaker;
                this.speakers = await this.fetchSpeakers();
            } catch (error) {
                console.error(error);
            }
        },
    },
  });
</script>