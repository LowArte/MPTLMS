import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

const opts = {
  theme: {
    themes: {
      light: {
        primary: '#434343',
        secondary: '#FFFFFF',
        accent: '#FF3D00',
        error: '#FF3D00',
        info: '#4066FF',
        success: '#FF3D00',
        warning: '#FFCA28',
        subsidiary: '#C3E88D'
      }
    }
  }
}

export default new Vuetify(opts)
