<template>
    <b-navbar toggleable="lg" type="dark" variant="info">
        <div class="container">
            <b-navbar-brand href="/"><strong>ticketbooth</strong></b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <!-- Right aligned nav items -->
                <b-navbar-nav class="ml-auto">
                    <b-nav-item-dropdown text="Profile" right>
                        <router-link class="dropdown-item" to="/profile">Profile</router-link>
                        <a style="cursor:pointer" @click="logout" class="dropdown-item">Sign Out</a>
                    </b-nav-item-dropdown>
                </b-navbar-nav>
            </b-collapse>
        </div>
    </b-navbar>
</template>

<script>

import axios from 'axios'
import { mapState } from 'vuex'
export default {
    computed: {
        ...mapState('user', {
            authenticated: state => state.authenticated
        })
    },
    methods: {
        logout() {
            return new Promise((resolve, reject) => {
                const response = axios.post('/api/logout', {}, {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                })
                localStorage.removeItem('token')
                resolve()
            }).then(() => {
                this.$store.state.token = localStorage.getItem('token')
                this.$router.push('/login')
            })
        }
    },
}
</script>