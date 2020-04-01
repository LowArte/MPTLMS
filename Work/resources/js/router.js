import Vue from 'vue'
import Router from 'vue-router'

import * as mutations from '@/js/store/mutation-types'

Vue.use(Router)

export function createRouter() {
    const defaultRoutes = [
        {
            path: '/',
            name: 'Welcome',
            component: () => import( /* webpackChunkName: "views-other-f-welcome" */ '@/js/views/other-f/Welcome'),
            meta:{
                layout:"default"
            }
        },
        {
            path: '/login/',
            name: 'Login',
            component: () => import( /* webpackChunkName: "views-auth-f-login" */ '@/js/views/auth-f/Login.vue'),
            meta:{
                layout:"default"
            }
        },
        {
            path: '/test/',
            name: 'Test',
            component: () => import( /* webpackChunkName: "views-timetable-f-testnewtimetable" */ '@/js/views/timetable-f/TestNewTimetable.vue'),
            meta:{
                layout:"default"
            }
        },
        {
            path: '/password_reset/',
            name: 'Reset',
            component: () => import( /* webpackChunkName: "views-auth-f-reset" */ '@/js/views/auth-f/Reset.vue'),
            meta:{
                layout:"default"
            }
        }
    ]

    const router = new Router({
        mode: 'history',
        routes: defaultRoutes
    })

    router.beforeEach((to, from, next) => {
        next()
    })

    return router
}
