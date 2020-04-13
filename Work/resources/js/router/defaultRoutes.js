export const defaultRoutes = [
    {
        path: '/',
        name: 'Welcome',
        component: () => import( /* webpackChunkName: "views-other-f-welcome" */ '@/js/views/other-f/Welcome'),
    },
    {
        path: '/login/',
        name: 'Login',
        component: () => import( /* webpackChunkName: "views-auth-f-login" */ '@/js/views/auth-f/Login.vue'),
    },
    {
        path: '/password_reset/',
        name: 'Reset',
        component: () => import( /* webpackChunkName: "views-auth-f-reset" */ '@/js/views/auth-f/Reset.vue'),
    },
    {
        path: '/password_new/:token/:email',
        name: 'Reset_new',
        component: () => import( /* webpackChunkName: "views-auth-f-reset" */ '@/js/views/auth-f/Reset_new.vue'),
    }
]
