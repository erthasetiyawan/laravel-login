<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-lg-5">
                <b-card class="mt-5 shadow-sm" header="Register">
                    <div class="login-box-body">
                        <div class="form-group has-feedback">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Name" v-model="data.name">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            <p class="text-danger" v-if="errors.name">{{ errors.name[0] }}</p>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" v-model="data.email">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            <p class="text-danger" v-if="errors.email">{{ errors.email[0] }}</p>
                        </div>
                        <div class="form-group has-feedback" :class="{'has-error': errors.password}">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" v-model="data.password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            <p class="text-danger" v-if="errors.password">{{ errors.password[0] }}</p>
                        </div>
                        <div class="alert alert-danger" v-if="errors.invalid">{{ errors.invalid }}</div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <b-button type="submit" class="pink" block variant="success" @click.prevent="postRegister">Register</b-button>
                                <!-- <button type="submit" class="btn btn-primary btn-block btn-flat" @click.prevent="postLogin">Login</button> -->
                                <p class="mt-3 text-center">Already have account? <router-link to="/login">Login now!</router-link></p>
                            </div>
                        </div>
                    </div>
                </b-card>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return{
            data: { name: '', email: '', password: '', status: false },
            errors: {
                name: [],
                email: [],
                password: [],
                invalid: ''
            }
        }
    },
    methods: {
        postRegister() {
            return new Promise((resolve, reject) => {
                axios.post('/api/register', {
                name: this.data.name,
                email: this.data.email,
                password: this.data.password
            })
                .then((response) => {
                    if (response.data.status == 'success') {
                        this.status = true
                        this.$router.push('/login')
                    } else {
                    }
                    resolve(response.data)
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        this.errors.email = error.response.data.errors.email
                        this.errors.name = error.response.data.errors.name
                        this.errors.password = error.response.data.errors.password
                    }
                })
            })
        }
    }
}
</script>