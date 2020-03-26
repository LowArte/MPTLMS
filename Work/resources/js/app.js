require('./bootstrap');

import store from './store'
import vuetify from './vuetify'
import router from './router'

import user_api from '@/js/api/users'
import * as mutations from '@/js/store/mutation-types'

import C_NotRegistered from '@/js/layouts/NotRegister'
import C_App from '@/js/layouts/App'

window.Vue = require('vue');

user_api.init().then((res) => {
    if (res.data.success) {
        console.log(res.data.routes)
        store.commit(mutations.SET_AUTH, res.data)
        let slug = res.data.slug
        let items = [];
        res.data.routes.forEach(element => {
            if (element.children) {
                element.children.forEach(child => {
                    items.push({
                        path: '/' + slug + child.component.info.url,
                        name: child.component.info.name,
                        component: ()=>import( /* webpackChunkName: "[request]" */ `@/${child.component.path}.vue`)
                    })
                })
            } else {
                items.push({
                    path: '/' + slug  + element.component.info.url,
                    name: element.component.info.name,
                    component: ()=>import( /* webpackChunkName: "[request]" */ `@/${element.component.path}.vue`)
                })
            }
        })
        router.addRoutes(items)
    } else {
        console.log("not_auth")
    }
})


new Vue({
    el: '#app',
    vuetify,
    store,
    router: router,
    components: {
        "c-notregister": C_NotRegistered,
        "c-app": C_App
    }
})
