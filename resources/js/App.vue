<template>
    <div class="wrapper">
        <app-header v-if="isAuth" />
        <div class="content-wrapper">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    import { mapState, mapGetters } from 'vuex'
    import Header from './components/Header.vue'
    export default {
        computed: {
            ...mapState(['token']),
            ...mapGetters(['isAuth'])
        },
        components: {
            'app-header': Header,
        }
    }
</script>