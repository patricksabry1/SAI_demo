<template>
  <!-- <file-upload-form /> -->
  <Register />
</template>

<script>
  import FileUploadForm from '../components/FileUploadForm.vue';
  import Register from '../components/auth/Register.vue';

  export default {
      components: {
          Register,
          FileUploadForm,
      },
  };
</script>
