/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import LoginButtonComponent from './components/authentication/LoginButtonComponent'
import RememberPasswordComponent from './components/authentication/RememberPasswordComponent'
import ResetPasswordComponent from './components/authentication/ResetPasswordComponent'
import FeadbackComponent from './components/feadback/FeadbackComponent'
import SnackBar from './components/SnackBarComponent'

//import vuetif from './plugins/vuetify'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import store from './store'
import * as actions from './store/action-types'
import * as mutations from './store/mutation-types'
import vuetify from './vuetify'

import {
  mapGetters
} from 'vuex'
import withSnackbar from './components/mixins/withSnackbar'

if (window.user) {
  store.commit(mutations.USER, user)
  store.commit(mutations.LOGGED, true)
}

new Vue({
  el: '#app',
  store,
  vuetify,
  mixins: [withSnackbar],
  components: {
    'login-button': LoginButtonComponent,
    'remember-password': RememberPasswordComponent,
    'reset-password': ResetPasswordComponent,
    'snackbar': SnackBar,
    'feadback' : FeadbackComponent
  },
  data: () => ({
    drawer: null,
    drawerRight: false,
    editingUser: false,
    logoutLoading: false,
    changingPassword: false,
    updatingUser: false
  }),
  computed: {
    ...mapGetters({
      user: 'user'
    }),
    items: function () {
      switch (user.post_id) {
        case 1: {
          return [{
            icon: 'home',
            text: 'Главная',
            href: '/home'
          }, {
            icon: 'portrait',
            text: 'Учетная карточка',
            href: '/card'
          }, {
            icon: 'info',
            text: 'Персональная информация',
            href: '/home'
          }, {
            icon: 'today',
            text: 'Расписание',
            href: '/home'
          }, {
            icon: 'show_chart',
            text: 'Успеваемость',
            href: '/home'
          }, {
            icon: 'business_center',
            text: 'Дополнительное образование',
            href: '/home'
          }, {
            icon: 'school',
            text: 'Преподаватели',
            href: '/home'
          }, {
            icon: 'group',
            text: 'Одногруппники',
            href: '/home'
          }, {
            icon: 'edit',
            text: 'Справки',
            href: '/home'
          }, {
            icon: 'storefront',
            text: 'Портфолио',
            href: '/home'
          }, {
            icon: 'layers',
            text: 'Базы практики',
            href: '/home'
          }, {
            icon: 'feedback',
            text: 'Обратная связь',
            href: '/feedback'
          }];
        }
        default: {
          return null;
        }
      }
    }
  },
  methods: {
    editUser() {
      this.editingUser = true
      this.$nextTick(this.$refs.email.focus)
    },
    updateUser() {
      this.updatingUser = true
      this.$store.dispatch(actions.UPDATE_USER, this.user).then(response => {
        this.showMessage('Изменения сохранены!')
      }).catch(error => {
        console.dir(error)
        /* this.showMessage('Вы пытаетесь созранить данные, не изменив их!') */
        this.showError(error)
      }).then(() => {
        this.editingUser = false
        this.updatingUser = false
      })
    },
    updateEmail(email) {
      this.$store.commit(mutations.USER, {
        ...this.user,
        email
      })
    },
    updateName(name) {
      this.$store.commit(mutations.USER, {
        ...this.user,
        name
      })
    },
    toogleRightDrawer() {
      this.drawerRight = !this.drawerRight
    },
    checkRoles(item) {
      if (item.role) {
        return this.$store.getters.roles.find(function (role) {
          return role == item.role // eslint-disable-line
        })
      }
      return true
    },
    logout() {
      this.logoutLoading = true
      this.$store.dispatch(actions.LOGOUT).then(response => {
        window.location = '/'
      }).catch(error => {
        console.log(error)
      }).then(() => {
        this.logoutLoading = false
      })
    },
    menuItemSelected(item) {
      if (item.href) {
        if (item.new) {
          window.open(item.href)
        } else {
          window.location.href = item.href
        }
      }
    },
    changePassword() {
      this.changingPassword = true
      this.$store.dispatch(actions.REMEMBER_PASSWORD, this.user.email).then(response => {
        this.showMessage(`Email sent to change password`)
      }).catch(error => {
        console.dir(error)
        this.showError(error)
      }).then(() => {
        this.changingPassword = false
      })
    }
  }
});
