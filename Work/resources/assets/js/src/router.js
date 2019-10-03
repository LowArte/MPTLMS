import Vue from 'vue'
import Router from 'vue-router'
import Restore from '../views/restor-f.vue'
import Login from '../views/authentication-f.vue'
/* import Home from '../views/Home' */
/* import Schedule from '../views/schedule.vue'
import Constructor_Schedule from '../views/constructor_schedule.vue'
import SurgeonTest from '../views/SurgeonTest.vue'
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
