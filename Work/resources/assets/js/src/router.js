import Vue from 'vue'
import Router from 'vue-router'
import Account from '../views/account.vue'
import Schedule from '../views/schedule.vue'
import Constructor_Schedule from '../views/constructor_schedule.vue'
import SurgeonTest from '../views/SurgeonTest.vue'
import Restore from '../views/account-res.vue'
import Home from '../views/Home'
import Login from '../views/account'
import Many_combobox from '../components/many-combobox'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [{
      path: '/',
      name: 'Home',
      component: Schedule
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