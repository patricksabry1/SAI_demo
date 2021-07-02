<template>
  <div>
    <span class="center-block">
        <b-img src="https://www.saiglobal.com/online/images/subscription_login.gif" alt="SAI Global" class="center-block" />
    </span>
    <br>
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">
      <b-form-group id="input-group-2" label="File to upload:" label-for="input-2">
         <!-- Styled -->
        <b-form-file
            v-model="file1"
            :state="Boolean(file1)"
            placeholder="Choose a file or drop it here..."
            drop-placeholder="Drop file here..."
        />
        <div class="mt-3">Selected file: {{ file1 ? file1.name : '' }}</div>
      </b-form-group>

      <b-button type="submit" variant="primary">Upload</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        form: {
          name: '',
          checked: []
        },
        show: true
      }
    },
    methods: {
      onSubmit(event) {
        event.preventDefault()
        alert(JSON.stringify(this.form))
      },
      onReset(event) {
        event.preventDefault()
        // Reset our form values
        this.form.email = ''
        this.form.name = ''
        this.form.food = null
        this.form.checked = []
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      }
    }
  }
</script>

<style scoped>
    .center-block {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>