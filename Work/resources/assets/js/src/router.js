import Vue from 'vue'
import Router from 'vue-router'
import Restore from '../views/account-res'
import Home from '../views/Home'
import Login from '../views/account'
import Account from '../views/student'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [{
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/restore',
      name: 'restore',
      component: Restore
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/account',
      name: 'account',
      component: Account
    }
  ]
})