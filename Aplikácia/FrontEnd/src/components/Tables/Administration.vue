<template>
    <div>
        <!-- Button to trigger the modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#administrationModal">
        Pridaj konferenciu
        </button>

        <!-- Modal for adding a new administration -->
        <div class="modal fade" id="administrationModal" tabindex="-1" aria-labelledby="administrationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="administrationModalLabel">Pridaj administrátora</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for adding a new administration -->
                        <form @submit.prevent="submitForm">
                            <div class="mb-3">
                                <label for="login" class="form-label">Login</label>
                                <input type="text" class="form-control" id="login" v-model="newAdministration.login" placeholder="Pridaj login" required/>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Heslo</label>
                                <input type="password" class="form-control" id="password" v-model="newAdministration.password" placeholder="Pridaj heslo" required/>
                            </div>

                            <div class="mb-3">
                                <label for="confirmed_password" class="form-label">Potvrď heslo</label>
                                <input type="password" class="form-control" id="confirmed_password" v-model="newAdministration.confirmed_password" placeholder="Potvrď heslo" required/>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvoriť</button>
                        <button type="button" class="btn btn-primary" @click="submitForm">Vytvoriť administrátora</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for changing password -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for changing password -->
                    <form @submit.prevent="changePassword">
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" v-model="editPassword.password" required/>
                        </div>

                        <div class="mb-3">
                            <label for="confirmed_password" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmed_password" v-model="editPassword.confirmed_password" required/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="changePassword">Change Password</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for changing comment -->
    <div class="modal fade" id="changeCommentModal" tabindex="-1" aria-labelledby="changeCommentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeCommentModalLabel">Change Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for changing comment -->
                    <form @submit.prevent="changeComment">
                        <div class="mb-3">
                            <label for="comment" class="form-label">New Comment</label>
                            <input type="text" class="form-control" id="comment" v-model="editComment.comment" required/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="changeComment">Change Comment</button>
                </div>
            </div>
        </div>
    </div>

        <!-- Table to display list of administration-->
        <div class="container">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Login</th>
                            <th scope="col">Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="administration in administrations" :key="administration.id">
                            <th scope="row">{{ administration.id }}</th>
                            <td>{{ administration.login }}</td>
                            <td>{{ administration.comment }}</td>
                            <td>
                                <button class="btn btn-primary m-2" @click="openChangePasswordModal(administration)">Change Password</button>
                                <button class="btn btn-primary m-2" @click="openChangeCommentModal(administration)">Change Comment</button>
                                <button class="btn btn-danger m-2" @click="deleteAdministration(administration.id)">Delete</button>
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

interface Administration {
    id: number;
    login: string;
    comment?: string;
}

const API_ENDPOINT = 'http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/administrations';

export default defineComponent({
    name: 'Administration',
    data() {
        return {
            administrations: [] as Administration[],
            newAdministration: {
                login: '',
                password: '',
                confirmed_password: ''
            },
            editPassword: {
                id: 0,
                password: '',
                confirmed_password: ''
            },
            editComment: {
                id: 0,
                comment: '',
            },
        }
    },
    async mounted() {
        this.administrations = (await axios.get(API_ENDPOINT)).data;
    },
    methods: {
        async fetchAdministrations() {
            const response = await axios.get(API_ENDPOINT);
            return response.data;   
        },
        async deleteAdministration(id: number) {
            await axios.delete(`${API_ENDPOINT}/${id}`);
            this.administrations = await this.fetchAdministrations();
        },
        async submitForm() {
            await axios.post('http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/adminRegister', this.newAdministration);
            this.newAdministration = {
                login: '',
                password: '',
                confirmed_password: ''
            };
            this.administrations = await this.fetchAdministrations();
        },
        openChangePasswordModal(administration: Administration) {
            this.editPassword.id = administration.id;
            const modalElement = document.getElementById('changePasswordModal');
            if (modalElement) {
                const modal = new Modal(modalElement);
                modal.show();
            } else {
                console.error('Could not find #changePasswordModal');
            }
        },
        async changePassword() {
            await axios.put('http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/changePassword', this.editPassword);

            this.editPassword = {
                id: 0,
                password: '',
                confirmed_password: '',
            };
        },
        openChangeCommentModal(administration: Administration) {
            this.editComment.id = administration.id;
            this.editComment.comment = administration.comment || '';            const modalElement = document.getElementById('changeCommentModal');
            if (modalElement) {
                const modal = new Modal(modalElement);
                modal.show();
            } else {
                console.error('Could not find #changeCommentModal');
            }
        },
        async changeComment() {
            await axios.put('http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/changeComment', this.editComment);

            this.editComment = {
                id: 0,
                comment: '',
            };

            this.administrations = await this.fetchAdministrations();
        },
    }
})  
</script>