<template>
  <div>
    <span class="center-block">
        <b-img src="https://www.saiglobal.com/online/images/subscription_login.gif" alt="SAI Global" class="center-block" />
    </span>
    <br>
    <b-card class="shadow sm rounded text-center" style="width: 38rem;">      
      <b-form>
        <b-form-group id="input-group-2" label="File to upload:" label-for="input-2">
          <b-form-file
              v-model="file"
              :state="Boolean(file)"
              placeholder="Choose a file or drop it here..."
              drop-placeholder="Drop file here..."
          />
        </b-form-group>

        <b-button 
        type="submit" 
        variant="primary"
        @click.prevent="uploadFile"
        >
        Upload
        </b-button>
      </b-form>
    </b-card>
  </div>
</template>

<script>  
  export default {
    components: {
    },

    data() {
      return {
        file: null,
      }
    },

    mounted() {        
    },

    methods: {
      uploadFile() {

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
          console.log('successfully uploaded file!');
        }).catch((err) => {
          console.log(err);
        })
      },
      
      onReset(event) {
        event.preventDefault()
        // Reset form value
        this.formData.file = null
      },

      uploadSuccess(file, response) {
        console.log('File Successfully Uploaded with file name: ' + response.file);
        this.fileName = response.file;
      },
      
      uploadError(file, message) {
            console.log('An Error Occurred');
      },
      
      fileRemoved() {}
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