//IMPORT SECTION
import Vue from 'vue'
import Router from 'vue-router'
import Home from './pages/Home.vue'
import Login from './pages/Login.vue'
import Register from './pages/Register'
import Profile from './pages/Profile'
import Ubah from './pages/Ubah'
import store from './store.js'

Vue.use(Router)

//DEFINE ROUTE
const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: { requiresAuth: true }
        },
        {
            path: '/home',
            name: 'home',
            component: Home,
            meta: { requiresAuth: true }
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/profile',
            name: 'profile',
            component: Profile,
            meta: { requiresAuth: true }
        },
        {
            path: '/profile/ubah',
            name: 'ubah',
            component: Ubah,
            meta: { requiresAuth: true }
        },
    ]
});

router.beforeEach((to, from, next) => {
    store.commit('CLEAR_ERRORS') //TAMBAHKAN BARIS INI
    if (to.matched.some(record => record.meta.requiresAuth)) {
        let auth = store.getters.isAuth
        if (!auth) {
            next({ name: 'login' })
        } else {
            next()
        }
    } else {
        next()
    }
})

export default router