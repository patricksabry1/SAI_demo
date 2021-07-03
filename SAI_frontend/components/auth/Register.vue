<template>
    <b-card class="shadow sm rounded text-center" style="width: 24rem;">
        <b-form class="form-signin" @submit.prevent="submitRegistration">
            <h1 class="h3 mb-3 fw-normal text-center">Register</h1>
            <b-form-input v-model="registrationForm.name" class="form-control" placeholder="Name" required />
            <b-form-input v-model="registrationForm.email" type="email" class="form-control" placeholder="Email" required />
            <b-form-input v-model="registrationForm.password" type="password" class="form-control" placeholder="Password" required />
            <b-button variant="primary" class="btn btn-lg btn-block" type="submit">Register</b-button>
            <hr>
            <span>Already have an account? <a href="/login">login here</a></span>
        </b-form>
    </b-card>
</template>

<script>

export default {
    name: 'Login',
    data() {
        return {
            registrationForm: {
                name: '',
                email: '',
                password: '',
            }
        }
    },
    methods: {
        async submitRegistration() {

            await fetch('http://sai-backend.test/api/v1/user/create', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(this.registrationForm)
            });

            await this.$auth.login({ 
                data: {
                    email: this.registrationForm.email,
                    password: this.registrationForm.password
                } 
            });

            this.$router.push({ path: '/file-upload' });
        }
    }
}
</script>

<style>
    .card {
        margin: 0 auto; 
        float: none; 
        margin-top: 50px;
        margin-bottom: 10px; 
    }
    .form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;
    }
    .form-signin .checkbox {
    font-weight: 400;
    }
    .form-signin .form-control {
    position: relative;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    font-size: 16px;
    }
    .form-signin .form-control:focus {
    z-index: 2;
    }
    .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    }
</style>