<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-lg-5">
                <b-card class="mt-5 shadow-sm" header="Login">
                    <div class="login-box-body">
                        <div class="form-group has-feedback" :class="{'has-error': errors.email}">
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

                        <div class="mb-3"></div>
                        <b-form-group>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" v-model="data.remember_me">
                                <label class="form-check-label" for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </b-form-group>
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <b-button type="submit" class="pink" block variant="success" @click.prevent="postLogin">Submit</b-button>
                                <!-- <button type="submit" class="btn btn-primary btn-block btn-flat" @click.prevent="postLogin">Login</button> -->
                                <p class="mt-3 text-center">Not a member? <router-link to="/register">Sign Up now!</router-link></p>
                            </div>
                        </div>
                    </div>
                </b-card>
            </div>
        </div>
    </div>
</template>

<!-- JAVASCRIPT SECTION -->
<script>
import { mapActions, mapMutations, mapGetters, mapState } from 'vuex';
export default {
    data() {
        return {
            data: {
                email: '',
                password: '',
                remember_me: false,
            },
            
        }
    },
    created() {
        if (this.isAuth) {
            this.$router.push({ name: 'home' })
        }
    },
    computed: {
        ...mapGetters(['isAuth']),
      	...mapState(['errors'])
    },
    methods: {
        ...mapActions('auth', ['submit']),
        ...mapMutations(['CLEAR_ERRORS']),
      
        postLogin() {
            this.submit(this.data).then(() => {
                if (this.isAuth) {
                    this.CLEAR_ERRORS()
                    this.$router.push({ name: 'home' })
                }
            })
        }
    }
}
</script>