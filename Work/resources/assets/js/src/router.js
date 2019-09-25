import Vue from 'vue'
import Router from 'vue-router'
import Restore from '../views/account-res'
import Auth from '../views/account'
import Account from '../views/student'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [{
      path: '/',
      name: 'Account',
      component: Auth
    },
    {
      path: '/restore',
      name: 'restore',
      component: Restore
    },
    {
      path: '/account:token',
      name: 'account',
      props: true,
      component: Account
    }
  ]
})