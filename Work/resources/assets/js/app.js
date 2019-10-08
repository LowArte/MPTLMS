import Vue from 'vue'
import App from './src/App.vue'
import router from './src/router'
import store from './src/store'
import axios from 'axios'
import Vuetify from 'vuetify/lib'
import VueAxios from 'vue-axios'


Vue.config.productionTip = false
window.Vue = Vue
Vue.use(VueAxios, axios)

Vue.use(Vuetify)
const opts = {}
export default new Vuetify(opts)

new Vue({
    Vuetify,
    router,
    store,
    render: h => h(App)
  }).$mount('#app')

 
