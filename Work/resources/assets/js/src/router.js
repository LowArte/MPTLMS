import Vue from 'vue'
import Router from 'vue-router'
import Account from '../views/account.vue'
import Schedule from '../views/schedule.vue'
import Restore from '../views/account-res.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [{
      path: '/',
      name: '',
      component: Schedule
    },
    {
      path: '/restore',
      name: '',
      component: Restore
    }
  ]
})