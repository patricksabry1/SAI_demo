<template>
    <b-card 
        class="shadow sm rounded text-center" 
        style="width: 24rem;"
    >
        <b-form 
            class="form-signin" 
            @submit.prevent="login"
        >
            <h1 class="h3 mb-3 fw-normal text-center">Login</h1>
            <b-form-input 
                v-model="loginForm.email" 
                type="email" 
                class="form-control" 
                placeholder="Email" 
                required 
            />
            <b-form-input 
                v-model="loginForm.password" 
                type="password" 
                class="form-control" 
                placeholder="Password" 
                required 
            />
            <b-button 
                variant="primary" 
                class="btn btn-lg btn-block" 
                type="submit"
            >
            Login
            </b-button>
            <hr>
            <span>Don't have an account? <a href="/register">register here</a></span>
        </b-form>
    </b-card>
</template>

<script>
export default {
    name: 'Login',
    
    data() {
        return {
            loginForm: {
                email: '',
                password: '',
            }
        }
    },
    methods: {
        // authenticate user using local strategy
        async login() {
            try {
                await this.$auth.loginWith('local', {data: {
                    email: this.loginForm.email,
                    password: this.loginForm.password
                }});
                
                this.$router.push({ path: '/file-upload' });
            } catch (e) {
                console.log(e);
            }
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