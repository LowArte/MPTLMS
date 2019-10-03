import Vue from 'vue'
import Router from 'vue-router'
import Restore from '../views/restor-f.vue'
import Login from '../views/authentication-f.vue'
/* import Home from '../views/Home'
import Schedule from '../views/schedule.vue'
import Constructor_Schedule from '../views/constructor_schedule.vue'
import Restore from '../views/account-res.vue'
import Home from '../views/Home'
import Login from '../views/account'
import Many_combobox from '../components/many-combobox'
import Menu from '../views/menu'
import Home from '../views/Home'
import Many_combobox from '../components/many-combobox' */

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [{
      path: '/',
      name: 'Home',
      component: Login
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
    }
  ]
})
