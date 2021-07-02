<template>
    <b-form class="form-signin" @submit.prevent="login">
        <h1 class="h3 mb-3 fw-normal text-center">Sign in</h1>

        <b-form-input v-model="email" type="email" class="form-control" placeholder="Email" required />
        <b-form-input v-model="password" type="password" class="form-control" placeholder="Password" required />
        <b-button variant="primary" class="btn btn-lg btn-block" type="submit">Sign in</b-button>
    </b-form>
</template>

<script>

export default {
    name: 'Login',
    
    data() {
        return {
            email: '',
            password: '',
            }
    },
    methods: {
        async login() {
            const loginData = {
                'email': this.email,
                'password': this.password
            };

            const headers = {
                'Access-Control-Allow-Origin': '*',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            }

            let response = await this.$axios.post('http://sai-backend.test/api/v1/user/login', JSON.stringify(loginData), 
            {
                headers: headers
            }).then((res) => {
                console.log(res);
                this.$cookiz.set('token', res.data.token);
                this.$router.push('file-upload');
            }).catch((error) => {
                console.log('error caught: ', error)
            });
            console.log(response);        
        }
    }
}
</script>

<style>
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