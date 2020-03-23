require('./bootstrap');

import store from './store'
import vuetify from './vuetify'
import router from './router'

import user_api from '@/js/api/users'
import * as mutations from '@/js/store/mutation-types'

import NotRegister_Layouts_C from '@/js/layouts/NotRegister'

window.Vue = require('vue');

user_api.init().then((res) => {
    if (res.data.success) {
        console.log(res.data.routes)
        store.commit(mutations.SET_AUTH, res.data)
        let slug = res.data.slug
        let items = [];
        res.data.routes.forEach(element => {
            let com = import('@/js/views/posts-f/Bild_RolesPrivilegies')
            if (element.children) {
                element.children.forEach(child => {
                    items.push({
                        path: '/'+slug+'/' + child.id,
                        name: child.id,
                        component: () => com
                    })
                })
            } else {
                items.push({
                  path: '/'+slug+'/' + element.id,
                  name: element.id,
                  component: () => com
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
        'c-notregister': NotRegister_Layouts_C
    }
})
