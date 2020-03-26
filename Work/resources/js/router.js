import Vue from 'vue'
import Router from 'vue-router'

import * as mutations from '@/js/store/mutation-types'

import C_NotRegister from "@/js/layouts/NotRegister"
import C_App from "@/js/layouts/App"

Vue.use(Router)

export let _store

export function createRouter(store) {
    const defaultRoutes = [{
            path: '/',
            name: 'Welcome',
            component: () => import( /* webpackChunkName: "views-other-f-welcome" */ '@/js/views/other-f/Welcome')
        },
        {
            path: '/login/',
            name: 'Login',
            component: () => import( /* webpackChunkName: "views-auth-f-login" */ '@/js/views/auth-f/Login.vue')
        },
        {
            path: '/test/',
            name: 'Test',
            component: () => import( /* webpackChunkName: "views-posts-f-build-rolesprivilegies" */ '@/js/views/posts-f/Bild_RolesPrivilegies.vue')
        },
        {
            path: '/password_reset/',
            name: 'Reset',
            component: () => import( /* webpackChunkName: "views-auth-f-reset" */ '@/js/views/auth-f/Reset.vue')
        }
    ]

    const router = new Router({
        mode: 'history',
        routes: defaultRoutes
    })

    _store = store

    router.beforeEach((to, from, next) => {
        let slug = _store.getters.slug
        let layout = _store.getters.layout

        if (to.path.includes(slug)) {

            if (layout.name != "APP"){
                console.log("APP")
                _store.commit(mutations.SET_LAYOUT, {name:"APP",component:C_App})
            }

        } else {
            if (layout.name != "NOT_REGISTER")
            {
                console.log("NOT_APP")
                _store.commit(mutations.SET_LAYOUT, {name:"NOT_REGISTER",component:C_NotRegister})
            }

        }
        next()
    })

    return router
}
