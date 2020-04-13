require('./bootstrap');

import store from './store'
import vuetify from './vuetify'
import router from './router/router'
import ArrayHelpers from '@/js/plugins/ArrayHelpers'

import user_api from '@/js/api/users'
import * as mutations from '@/js/store/mutation-types'

import C_Layouts from '@/js/Layouts'

window.Vue = require('vue');



async function init() {
    let result = await user_api.init()
    if (result) {
        router.addRoutes(result.items);
        store.commit(mutations.SET_AUTH, result);
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
}

init()

new Vue({
    el: '#app',
    vuetify,
    store,
    router: router,
    components: {
        "c-layouts": C_Layouts,
    }
})
