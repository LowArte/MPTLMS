import Vue from 'vue'
import Router from 'vue-router'
import Account from '../views/account.vue'
import Schedule from '../views/schedule.vue'
import Constructor_Schedule from '../views/constructor_schedule.vue'
import Restore from '../views/account-res.vue'
import Home from '../views/Home'
import Login from '../views/account'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [{
      path: '/',
      name: 'Home',
      component: Constructor_Schedule
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