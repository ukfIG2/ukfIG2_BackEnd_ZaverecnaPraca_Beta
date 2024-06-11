<template>
    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sponsorModal">
            Add Sponsor
        </button>

        <!-- Modal for adding a new sponsor -->
        <div class="modal fade" id="sponsorModal" tabindex="-1" aria-labelledby="sponsorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sponsorModalLabel">Add Sponsor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding a new sponsor -->
                <form @submit.prevent="addSponsor">

                <div class="mb-3">
                    <label for="conference_id" class="form-label">Conference</label>
                    <select class="form-control" id="conference_id" v-model="newSponsor.conference_id">
                    <option v-for="conference in conferences" :key="conference.id" :value="conference.id">
                        {{ conference.name }} - {{ conference.date }} - {{ conference.state }}
                    </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" v-model="newSponsor.name" required/>
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">URL</label>
                    <input type="url" class="form-control" id="url" v-model="newSponsor.url" required/>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="text" class="form-control" id="image" v-model="newSponsor.image" required/>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Comment</label>
                    <input type="text" class="form-control" id="comment" v-model="newSponsor.comment" placeholder="Add comment">
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="addSponsor">Add Sponsor</button>
            </div>
            </div>
        </div>
        </div>        
        <!-- Modal for editing a timetable -->
        <div class="modal fade" id="editSponsorModal" tabindex="-1" aria-labelledby="editSponsorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSponsorModalLabel">Edit Sponsor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for editing a sponsor -->
                        <form @submit.prevent="submitEditForm">
                            <!-- The form fields remain the same -->
                            <div class="mb-3">
                              <label for="conference_id" class="form-label">Conference</label>
                              <select class="form-control" id="conference_id" v-model="editingSponsor.conference_id">
                              <option v-for="conference in conferences" :key="conference.id" :value="conference.id">
                                  {{ conference.name }} - {{ conference.date }} - {{ conference.state }}
                              </option>
                              </select>
                          </div>

                          <div class="mb-3">
                              <label for="name" class="form-label">Name</label>
                              <input type="text" class="form-control" id="name" v-model="editingSponsor.name" required/>
                          </div>
                          <div class="mb-3">
                              <label for="url" class="form-label">URL</label>
                              <input type="url" class="form-control" id="url" v-model="editingSponsor.url" required/>
                          </div>
                          <div class="mb-3">
                              <label for="image" class="form-label">Image</label>
                              <input type="text" class="form-control" id="image" v-model="editingSponsor.image" required/>
                          </div>
                          <div class="mb-3">
                              <label for="comment" class="form-label">Comment</label>
                              <input type="text" class="form-control" id="comment" v-model="editingSponsor.comment" placeholder="Add comment">
                          </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="submitEditForm">Edit Sponsor</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table to display the list of sponsors -->
        <div class="container">
        <div class="table-responsive">
            <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Conference</th>
                <th scope="col">Name</th>
                <th scope="col">URL</th>
                <th scope="col">Image</th>
                <th scope="col">Comment</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through the list of sponsors and display each one in a table row -->
                <tr v-for="sponsor in sponsors" :key="sponsor.id">
                <th scope="row">{{ sponsor.id }}</th>
                <td>{{ getConferenceName(sponsor.conference_id) }}</td>
                <td>{{ sponsor.name }}</td>
                <td><a :href="sponsor.url" target="_blank">{{ sponsor.url }}</a></td>
                <td>
                    <div v-if="sponsor.image_id && images[sponsor.image_id]">
                        <img :src="'http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/storage/' + images[sponsor.image_id].path_to" 
                            :alt="images[sponsor.image_id].alt" 
                            width="100" 
                            height="100">
                    </div>
                    <div v-else class="text-danger fw-bold">
                        NO_IMAGE_SELECTED
                    </div>
                </td>
                <td>{{ sponsor.comment }}</td>
                <td>
                    <button class="btn btn-primary m-2" @click="editSponsor(sponsor)">Edit Sponsor</button>
                    <button class="btn btn-danger m-2" @click="sponsor.id !== undefined && deleteSponsor(sponsor.id)">Delete Sponsor</button>
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

  interface Sponsor {
    id: number;
    conference_id: number;
    name: string;
    url: string;
    image_id: string;
    comment: string;
  }

  interface Conference {
    id: number;
    name: string;
    date: string;
    state: string;
  }

  const SPONSOR_API_ENDPOINT = 'http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/sponsors';
  const CONFERENCE_API_ENDPOINT = 'http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/conferences';

  export default defineComponent({
    name: 'Sponsor',
    data() {
      return {
        sponsors: [] as Sponsor[],
        images: {} as Record<string, {alt: string, path_to: string}>,
        conferences: [] as Conference[],
        newSponsor: {
            conference_id: 0,
            name: '',
            url: '',
            image: '',
            comment: ''
        },
        editingSponsor: {
            id: 0,
            conference_id: 0,
            name: '',
            url: '',
            image: '',
            comment: ''
        },
        addModal: null as Modal | null,
        editModal: null as Modal | null,


      };
    },
    async mounted() {
        const [sponsors, conferences] = await Promise.all([
            this.fetchSponsors(), 
            this.fetchConferences()
        ]);
        this.sponsors = sponsors;
        this.conferences = conferences;
        console.log(this.sponsors);

        //
        // Fetch the image data for each sponsor
        for (const sponsor of sponsors) {
        if (sponsor.image_id) {
            this.images[sponsor.image_id] = await this.fetchImage(parseInt(sponsor.image_id));
            }
        }
        //

        const addModalElement = document.getElementById('sponsorModal');
        const editModalElement = document.getElementById('editSponsorModal');

        if(!addModalElement || !editModalElement) {
            throw new Error('Modal elements not found');
        }

        this.addModal = new Modal(addModalElement);
        this.editModal = new Modal(editModalElement);

    },
    methods: {
      async fetchSponsors() {
        const response = await axios.get(SPONSOR_API_ENDPOINT);
        return response.data;
      },
      async fetchConferences() {
        const response = await axios.get(CONFERENCE_API_ENDPOINT);
        return response.data;
      },
      async deleteSponsor(id: number) {
        await axios.delete(`${SPONSOR_API_ENDPOINT}/${id}`);
        this.sponsors = this.sponsors.filter(sponsor => sponsor.id !== id);
      },
      getConferenceName(conferenceId: number) {
        const conference = this.conferences.find(conference => conference.id === conferenceId);
        return conference ? conference.name : 'Conference not found';
      },
      async fetchImage(id: number) {
        const response = await axios.get(`http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/images/${id}`);
        return response.data;
      },
      async addSponsor() {

        if(this.newSponsor.conference_id === 0) {
            alert('Please select a conference');
            return;
        }

        if(this.newSponsor.name === '') {
            alert('Please enter a name');
            return;
        }

        const response = await axios.post(SPONSOR_API_ENDPOINT, this.newSponsor);
        this.newSponsor = {
            conference_id: 0,
            name: '',
            url: '',
            image: '',
            comment: ''
        };
        this.addModal?.hide();
        this.sponsors = await this.fetchSponsors();
      },
      async submitEditForm(){
        if(this.editingSponsor.conference_id === 0) {
            alert('Please select a conference');
            return;
        }

        if(this.editingSponsor.name === '') {
            alert('Please enter a name');
            return;
        }

        await axios.put(`${SPONSOR_API_ENDPOINT}/${this.editingSponsor.id}`, this.editingSponsor);
        this.editingSponsor = {
            id: 0,
            conference_id: 0,
            name: '',
            url: '',
            image: '',
            comment: ''
        };
        this.editModal?.hide();
        this.sponsors = await this.fetchSponsors();
      },
      editSponsor(sponsor: Sponsor) {
        const conference = this.conferences.find(conference => conference.id === sponsor.conference_id);
        if(!conference) {
            throw new Error('Conference not found');
        }
        console.log(sponsor);

        this.editingSponsor = {
            id: sponsor.id,
            conference_id: sponsor.conference_id,
            name: sponsor.name,
            url: sponsor.url,
            image: sponsor.image_id,
            comment: sponsor.comment
        };

        console.log(this.editingSponsor);
        this.editModal?.show();
      }
    }
  });

</script>