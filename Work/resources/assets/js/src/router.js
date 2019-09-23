import Vue from 'vue'
import Router from 'vue-router'
import Account from '../views/account.vue'
import UploadFile from '../views/ff.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [{
      path: '/',
      name: '',
      component: Account
    },
    {
      path: '/up',
      name: '',
      component: UploadFile
    }
  ]
})
