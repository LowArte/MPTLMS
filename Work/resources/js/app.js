require('./bootstrap');

import store from './store'
import vuetify from './vuetify'
import router from './router/router'

import user_api from '@/js/api/users'
import * as mutations from '@/js/store/mutation-types'

import C_Layouts from '@/js/Layouts'

window.Vue = require('vue');

user_api.init().then((res) => {
    if (res.data.success) {
        store.commit(mutations.SET_AUTH, res.data)
        let slug = res.data.user.post.slug
        let items = [];
        res.data.user.post.privilegies.forEach(element => {
            if (element.children) {
                element.children.forEach(child => {
                    if (child.component != null)
                        items.push({
                            path: '/' + slug + "/" + child.component.info.url,
                            name: child.component.info.name,
                            meta: {
                                layout: 'main'
                            },
                            component: () => import( /* webpackChunkName: "[request]" */ `@/${child.component.path}.vue`),
                        })
                })
            } else {
                items.push({
                    path: '/' + slug + "/" + element.component.info.url,
                    name: element.component.info.name,
                    meta: {
                        layout: 'main'
                    },
                    component: () => import( /* webpackChunkName: "[request]" */ `@/${element.component.path}.vue`),
                })
            }
        })
        router.addRoutes(items)
    } else {
        console.log("not_auth")
    }
    router.addRoutes([{
        path: "*",
        redirect: "/404",
    },
    {
        path: "/404",
        name: "404",
        component: () => import( /* webpackChunkName: "components-alert-pages-f-alert" */ '@/js/components/alert-pages-f/alert'),
        props: {
            error: {
                code: "404",
                annotation: "Страница не найдена"
            }
        },
        meta: {
            layout: "404"
        }
    },
])
})

new Vue({
    el: '#app',
    vuetify,
    store,
    router: router,
    components: {
        "c-layouts": C_Layouts,
    }
})
