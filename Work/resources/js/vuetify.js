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
                accent: '#FE532C',
                error: '#CC2222',
                info: '#4066FF',
                success: '#7EB03D',
                warning: '#FFCA28',
            }
        }
    }
}

export default new Vuetify(opts)
