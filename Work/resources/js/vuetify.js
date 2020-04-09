import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
//import 'roboto-fontface/css/roboto/roboto-fontface.css'
import '@mdi/font/css/materialdesignicons.css'

Vue.use(Vuetify)

const opts = {
    theme: {
        themes: {
            light: {
                primary: '#434343',
                accent: '#FF5722',
                error: '#FF3D00',
                info: '#4066FF',
                success: '#8BC34A',
                warning: '#FBC02D',
            }
        }
    }
}

export default new Vuetify(opts)
