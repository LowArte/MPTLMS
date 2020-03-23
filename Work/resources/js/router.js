import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [{
            path: '/',
            name: 'Welcome',
            component: () => import('@/js/views/other-f/Welcome')
        },
        {
            path: '/login/',
            name: 'Login',
            component: () => import('@/js/views/auth-f/Login')
        },
        {
            path: '/test/',
            name: 'Test',
            component: () => import('@/js/views/posts-f/Bild_RolesPrivilegies')
        },
        {
            path: '/password/reset',
            name: 'Reset',
            component: () => import('@/js/views/auth-f/Reset')
        }
    ]
})
