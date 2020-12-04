<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12 mb-4">
                <h2><strong>Edit your profile here</strong></h2>
            </div>
            <div class="col-md-3 mb-5">
                <div id="uploadlah"
                    v-bind:style="{
                        width: '100%',
                        padding: '3.5rem',
                        height: 'auto',
                        borderRadius: '3rem',
                        background: '#ddd',
                        fontSize: '5rem',
                        textAlignLast:'center',
                        cursor: 'pointer',
                        fontWeight:'bold',
                        backgroundImage: `url(${photo})`,
                        backgroundSize:'cover',
                        backgroundPosition:'center'
                    }">
                    <span @click="click_gambar">+</span>
                </div>
                <div class="text-center mt-2">
                    <strong>Add your photo here</strong>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-8">
                <b-alert v-model="status" variant="success" dismissible>
                    {{ msg }}
                </b-alert>
                <b-form @submit.prevent="simpanProfile" enctype="multipart/form-data">
                    <input type="file" name="file" id="file" ref="file" accept="image/jpg,image/png" @change="preview_image" hidden />
                    <b-form-group label="Name">
                        <b-input type="text" name="name" placeholder="Name" v-model="name" />
                    </b-form-group>
                    <b-form-group label="Email">
                        <b-input type="text" name="email" placeholder="Email" v-model="email"/>
                    </b-form-group>
                    <b-form-group label="Password">
                        <b-input type="password" name="password" placeholder="Password" />
                    </b-form-group>
                    <b-form-group label="Phone Number">
                        <b-input type="text" placeholder="Phone Number" name="phone" v-model="phone" />
                    </b-form-group>
                    <b-form-group label="Date of Birth">
                        <b-form-datepicker id="datepicker" name="date" placeholder="Date of Birth"
                            v-model="date" class="mb-2"></b-form-datepicker>
                    </b-form-group>
                    <div>
                        <b-button class="ungu" :disabled="loading" type="submit">Submit</b-button>
                        <router-link class="btn btn-outline-secondary" to="/profile">Cancel</router-link>
                    </div>
                </b-form>
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
            photo: '',
            event: '',
            file: '',
            status: false,
            msg: '',
            loading: false
        }
    },
    methods: {
        async getData() {
            const response = await axios.get('/api/user', {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token'),
                }
            });
            const data = response.data
            this.name = data.name
            this.email = data.email
            this.phone = data.phone
            this.date = data.date_of_birth
            this.photo = '/storage/' + data.photo
        },

        async simpanProfile()
        {
            this.loading = true
            let formData = new FormData()
            formData.append('file', this.file)
            formData.append('name', this.name)
            formData.append('email', this.email)
            formData.append('phone', this.phone)
            formData.append('date', this.date)

            const response = await axios.post('/api/updateprofile', formData, {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token'),
                    'Content-Type': 'multipart/form-data'
                }
            })

            const data = response.data
            if (data.status === 'success') {
                this.status = status
                this.msg = data.data
                this.loading = false

                setTimeout(function () {
                    window.location.reload()
                }, 200)
            } else {
                this.status = false;
                this.loading = false
            }
        },

        click_gambar() {
            document.getElementById('file').click();
        },

        preview_image(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('gambar');
                document.getElementById('uploadlah').style.backgroundImage = 'url(' + reader.result + ')';
                document.getElementById('uploadlah').style.backgroundPosition = 'center center';
                document.getElementById('uploadlah').style.backgroundSize = 'cover';

            }
            this.file = this.$refs.file.files[0];
            reader.readAsDataURL(event.target.files[0]);
        }
    },
    created() {
        this.getData()
    }
}
</script>