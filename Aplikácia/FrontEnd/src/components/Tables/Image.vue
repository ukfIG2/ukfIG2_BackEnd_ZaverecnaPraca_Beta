<template>
    <!-- Button to trigger the modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#imageModal">
        Add Image
    </button>

    <!-- Modal for adding-->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Add Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="file" multiple @change="onFilesChange" class="form-control mb-3">

                    <form v-if="files.length > 0" @submit.prevent="submit">
                        <div v-for="(file, index) in files" :key="index" class="mb-3">
                            <img :src="file.preview" alt="" class="img-thumbnail mb-2">
                            <div class="input-group mb-2">
                                <span class="input-group-text">Name</span>
                                <input type="text" v-model="file.name" placeholder="Name" class="form-control">
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">Alt</span>
                                <input type="text" v-model="file.alt" placeholder="Alt" class="form-control">
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">Comment</span>
                                <input type="text" v-model="file.comment" placeholder="Comment" class="form-control">
                            </div>
                            <button type="button" @click="removeFile(index)" class="btn btn-danger mb-2">Remove</button>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editImageModal" tabindex="-1" aria-labelledby="editImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editImageModalLabel">Edit Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="updateImage">
                        <div class="input-group mb-2">
                            <span class="input-group-text">Name</span>
                            <input type="text" v-model="editImage.name" placeholder="Name" class="form-control">
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Alt</span>
                            <input type="text" v-model="editImage.alt" placeholder="Alt" class="form-control">
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Comment</span>
                            <input type="text" v-model="editImage.comment" placeholder="Comment" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Alt</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="image in images" :key="image.id">
                        <th scope="row">{{ image.id }}</th>
                        <td>{{ image.name }}</td>
                        <td>{{ image.alt }}</td>
                        <td>{{ image.comment }}</td>
                        <td>
                            <img :src="'http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplik%C3%A1cia/BackEnd/public/storage/' + image.path_to" alt="" width="100" height="100">                        
                        </td>
                        <td>
                            <button class="btn btn-danger m-2" @click="deleteImage(image.id)">Delete</button>
                            <button class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#editImageModal" @click="editImage = image">Edit</button>
                        </td>
                    </tr>
                </tbody>    
            </table>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, reactive } from 'vue';
import axios from 'axios';

interface Image {
    id: number;
    name: string;
    alt: string;
    comment: string;
    path_to: string;
}

interface FileObject {
    file: File;
    preview: string;
    name: string;
    alt: string;
    comment: string;
}

export default defineComponent({
    name: 'Image',
    data() {
        return {
            images: [] as Image[],
            files: [] as FileObject[],
            editImage: {} as Image,
        }
    },
    async mounted() {
        await this.fetchImages();
    },
    methods: {
        async fetchImages() {
            const response = await axios.get('http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/images');
            this.images = response.data;
        },
        onFilesChange(e: Event) {
            const selectedFiles = (e.target as HTMLInputElement).files;
            if (selectedFiles) {
                for (let i = 0; i < selectedFiles.length; i++) {
                    const file = selectedFiles[i];
                    const preview = URL.createObjectURL(file);
                    this.files.push({
                        file,
                        preview,
                        name: '',
                        alt: '',
                        comment: ''
                    });
                }
            }
        },
        removeFile(index: number) {
            this.files.splice(index, 1);
        },
        async submit() {
            const formData = new FormData();

            this.files.forEach((file, index) => {
                formData.append('images[]', file.file);
                formData.append('names[]', file.name);
                formData.append('alts[]', file.alt);
                formData.append('comments[]', file.comment);
            });

            const response = await fetch('http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/upload', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                console.log('Files uploaded successfully');
                this.files.splice(0); // Clear the files array
                await this.fetchImages(); // Refresh the images list
            } else {
                console.error('Error uploading files:', response.statusText);
            }
        },
        async deleteImage(id: number) {
            await axios.delete('http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/images/' + id);
            await this.fetchImages();
        },
        async updateImage() {
            const response = await axios.put('http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/images/' + this.editImage.id, this.editImage);
            if (response.status === 200) {
                console.log('Image updated successfully');
                await this.fetchImages(); // Refresh the images list
            } else {
                console.error('Error updating image:', response.statusText);
            }
        },
    }
});
</script>
