<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12 mb-5">
                <h2><strong>PROFILE</strong></h2>
            </div>
            <div class="col-md-3">
                <div id="image" v-bind:style="{
                    width: '100%',
                    padding: '7.5rem',
                    height: 'auto',
                    borderRadius: '3rem',
                    background: '#ddd',
                    backgroundImage: `url(${photo})`,
                    backgroundSize:'cover',
                    backgroundPosition:'center'
                }"></div>
                <div class="text-center">
                    <router-link class="btn btn-primary ungu mt-4" to="/profile/ubah">Edit Profile</router-link>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-8">
                <strong>Name</strong>
                <p>{{ name }}</p>

                <strong>Email</strong>
                <p>{{ email }}</p>

                <strong>Phone Number</strong>
                <p>{{ phone }}</p>

                <strong>Date of Birth</strong>
                <p>{{ date }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            name: '',
            email: '',
            phone: '',
            date: '',
            photo: ''
        }
    },
    methods: {
        async getData() {
            const response = await axios.post('/api/profile',{}, {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token'),
                }
            });
            const data = response.data.data
            this.name = data.name
            this.email = data.email
            this.phone = data.phone
            this.date = data.date
            this.photo = data.photo
        }
    },
    created() {
        this.getData()
    }
}
</script>