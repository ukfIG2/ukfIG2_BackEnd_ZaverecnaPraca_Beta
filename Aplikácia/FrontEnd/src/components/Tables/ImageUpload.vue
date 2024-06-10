<template>
  <div>
    <input type="file" multiple @change="onFilesChange" class="form-control mb-3">

    <form v-if="files.length > 0" @submit.prevent="submit">
      <div v-for="(file, index) in files" :key="index" class="mb-3">
        <img :src="file.preview" alt="" width="100" height="100">
        <label>{{ file.file.name }}</label>
        <input type="text" v-model="file.name" placeholder="Name" class="form-control">
        <input type="text" v-model="file.alt" placeholder="Alt" class="form-control">
        <input type="text" v-model="file.comment" placeholder="Comment" class="form-control">
        <button type="button" @click="removeFile(index)" class="btn btn-danger">Remove</button>
      </div>
      <button type="submit" class="btn btn-success">Submit</button>
    </form>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive } from 'vue';

interface FileObject {
  file: File;
  preview: string;
  name: string;
  alt: string;
  comment: string;
}

export default defineComponent({
  name: 'FileUpload',
  setup() {
    const files = reactive<FileObject[]>([]);

    function onFilesChange(e: Event) {
      const selectedFiles = (e.target as HTMLInputElement).files;
      if (selectedFiles) {
        for (let i = 0; i < selectedFiles.length; i++) {
          const file = selectedFiles[i];
          const preview = URL.createObjectURL(file);
          files.push({
            file,
            preview,
            name: '',
            alt: '',
            comment: ''
          });
        }
      }
    }

    function removeFile(index: number) {
      files.splice(index, 1);
    }

    /*async function submit() {
        const formData = new FormData();

        files.forEach((file, index) => {
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
        } else {
            console.error('Error uploading files:', response.statusText);
        }
    }*/

    async function submit() {
        const formData = new FormData();

        files.forEach((file, index) => {
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
            files.splice(0); // Clear the files array
        } else {
            console.error('Error uploading files:', response.statusText);
        }
    }

    return { files, onFilesChange, removeFile, submit };
  }
});
</script>