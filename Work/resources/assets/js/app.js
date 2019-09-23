import Vue from 'vue'
import App from './src/App.vue'
import router from './src/router'
import store from './src/store'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.config.productionTip = false
window.Vue = Vue;
Vue.use(VueAxios, axios)

new Vue({
    router,
    store,
    render: h => h(App)
  }).$mount('#app')
