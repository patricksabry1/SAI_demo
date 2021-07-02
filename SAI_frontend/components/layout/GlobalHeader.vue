<template>
    <div>
        <b-navbar toggleable="lg" type="dark" variant="dark">
            <b-navbar-brand href="#">File Upload Demo</b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>

            <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto" v-if="isAuthenticated">
                <b-nav-item @click="logout">Logout</b-nav-item>
            </b-navbar-nav>
            <b-navbar-nav v-else class="ml-auto" >
                <b-nav-item to="/register">Register</b-nav-item>
                <b-nav-item to="/login">Login</b-nav-item>
            </b-navbar-nav>

            </b-collapse>
        </b-navbar>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log(this.$store.state.auth.authenticated);
    },
    computed: {
        isAuthenticated() {
            return this.$store.state.auth.authenticated;
        }
    },
    methods: {
        logout() {
            this.$cookiz.remove('jwt');
            this.$router.push('/login');
            this.$store.commit('auth/setAuth', false);
        }
    }
}
</script>