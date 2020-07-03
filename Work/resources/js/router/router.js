import Vue from 'vue'
import Router from 'vue-router'

import {
    defaultRoutes
} from "./defaultRoutes"

Vue.use(Router)



const createRouter = () => {
    let ret = new Router({
        mode: 'history',
        routes: defaultRoutes
    })
    ret.beforeEach((to, from, next) => {
        next()
    })
    return ret
}

const router = createRouter()

export function resetRouter() {
    const newRouter = createRouter()
    router.matcher = newRouter.matcher
}

export default router
