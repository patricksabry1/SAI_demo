<template>
  <div>
    <span class="center-block">
        <b-img src="https://www.saiglobal.com/online/images/subscription_login.gif" alt="SAI Global" class="center-block" />
    </span>
    <br>
    <b-card class="shadow sm rounded text-center" style="width: 38rem;">      
      <b-form>
        <b-form-group 
          id="input-group-1" 
          label="Choose a file to upload to Amazon S3:" 
          label-for="input-1">
          <b-form-file
              ref="fileInput"
              v-model="file"
              :state="Boolean(file)"
              accept=".csv, .pdf, .xml, .docx, .txt"
              placeholder="Choose a file or drop it here..."
              drop-placeholder="Drop file here..."
          />
        </b-form-group>

        <b-button 
          type="submit" 
          variant="primary"
          :disabled="spinner.submit"
          @click.prevent="uploadFile"
        >
          <b-spinner 
            v-if="spinner.submit" 
            small 
          />
          Upload
        </b-button>

        <b-button 
        type="submit" 
        variant="primary"
        :disabled="spinner.submit"
        v-if="file"
        @click.prevent="resetForm"
        >
          Reset
        </b-button>
      </b-form>
     
      <br />
     
      <b-alert 
        show
        variant="success"
        v-if="uploadResponse.status == 'success'"
      >
        <b>{{ this.uploadResponse.fileName }}</b> has been successfully uploaded to S3! <br/> 
        You will receive a confirmation email shortly.
      </b-alert>
      <b-alert 
        show
        variant="danger" 
        v-else-if="uploadResponse.status == 'failure'"
      >
        <b>{{this.uploadResponse.message}}</b>
      </b-alert>
    </b-card>
  </div>
</template>

<script>  
  export default {
    components: {
    },

    data() {
      return {
        spinner: {
          submit: false,
        },
        file: null,
        uploadResponse: {
          status: '',
          message: '',
          fileName: ''
        },
      }
    },

    mounted() {        
    },

    methods: {
      uploadFile() {
        this.spinner.submit = true;

        // make axios request as multipart form data to backend,
        let url = '/file/' + this.$auth.user.id + '/upload'

        // instantiate form data object, append the file
        let formData = new FormData();
        formData.append('file', this.file);

        this.$axios.$post(url, formData, {
          headers: {
            'Content-Type'  : 'multipart/form-data',
            'Accept'        : 'application/json',
            'Authorization' : this.$cookiz.get('auth._token.local')

          }
        }).then((res) => {
          this.uploadResponse.status = 'success';
          this.uploadResponse.fileName = res.file_name
        }).catch((error) => {
          this.uploadResponse.status = 'failure';
          this.uploadResponse.message = error.response.data.errors.file[0];
        }).finally(() => {
          this.spinner.submit = false;
        });
      },
      
      resetForm() {
        // Reset form file value
    	  this.$refs.fileInput.reset();
      },
    }
  }
</script>

<style scoped>
    .card {
        margin: 0 auto; 
        float: none; 
        margin-top: 50px;
        margin-bottom: 10px; 
    }
    .center-block {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>