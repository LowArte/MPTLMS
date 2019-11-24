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
import FeedbackComponent from './components/feedback/FeedbackComponent'
import CertificateComponent from './components/certificate/CertificateComponent'
import ListCertificateComponent from './components/certificate/ListCertificateComponent'
import SnackBar from './components/SnackBarComponent'
import Panel from './components/expention/Panel'
import TimetableComponent from './components/timetable/TimetableComponent'
import TeacherTimetableComponent from './components/timetable/TeacherTimetableComponent'
import TeacherHomeworkComponent from './components/teacherhomework/TeacherHomeworkComponent'
import ConTimeTable from './components/timetable/ContimetableComponent'
import ConReplacements from './components/timetable/ConreplacementsComponent'
import TeacherAcademicPerfomance from './components/academicperformance/TeacherAPComponent'
import ConCallSchedule from './components/callschedule/ConCallScheduleComponent'
import TitlePage from './components/mainpage/SpecialtyPageComponent'
import InfoPage from './components/mainpage/MainPageComponent'
import CallSchedule from './components/callschedule/CallScheduleComponent'
import RequestsUsers from './components/feedback/RequestsUsersComponent'
import PanelControl from './components/PanelControlComponent'
import Retraining from './components/additionaleducation/RetrainingComponent'
import UserManagement from './components/UserManagement'

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
    'panel': Panel,
    'feedback': FeedbackComponent,
    'certificate': CertificateComponent,
    'listcertificate' : ListCertificateComponent,
    'timetable': TimetableComponent,
    'teachertimetable': TeacherTimetableComponent,
    'teacherhomework': TeacherHomeworkComponent,
    'contimetable': ConTimeTable,
    'conreplacements': ConReplacements,
    'teacheracademicperfomance': TeacherAcademicPerfomance,
    'concallschedule': ConCallSchedule,
    'subtitle': TitlePage,
    'maintitle': InfoPage,
    'requestsusers': RequestsUsers,
    'panelcontrol': PanelControl,
    'callschedule': CallSchedule,
    'retraining': Retraining,
    'usermanagement' : UserManagement
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
      user: 'user',
    }),
    items: function () {
      switch (user.post_id) {
        case 1: { //Администраторы
          return [{
            icon: 'home',
            text: 'Главная',
            href: '/home'
          },
          {
            icon: 'edit',
            text: 'Панель управления', //Замены, расписание, перевод в режим профилактики, редактирование пользователей
            href: '/panelcontrol'
          },
          {
            icon: 'today',
            text: 'Расписание',
            href: '/contimetable'
          },
          {
            icon: 'today',
            text: 'Замены',
            href: '/conreplacements'
          },
          {
            icon: 'today',
            text: 'Расписание звонков',
            href: '/concallschedule'
          },
          {
            icon: 'edit',
            text: 'Управление пользователями',
            href: '/usermanagement'
          },
          {
            icon: 'feedback',
            text: 'Обращение пользователей',
            href: '/requestsusers'
          }];
        }
        case 2: { //Студент
          return [{
            icon: 'home',
            text: 'Главная',
            href: '/home'
          },
          {
            icon: 'portrait',
            text: 'Студенческая карточка',
            href: '/card'
          },
          {
            icon: 'today',
            text: 'Расписание',
            href: '/timetable'
          },
          {
            icon: 'today',
            text: 'Расписание звонков',
            href: '/callschedule'
          },
          /* 
          {
            icon: 'show_chart',
            text: 'Успеваемость',
            href: '/home'
          }, */
          /* {
            icon: 'business_center',
            text: 'Дополнительное образование',
            href: '/home'
          }, 
          {
            icon: 'school',
            text: 'Преподаватели',
            href: '/home'
          }, */
          {
            icon: 'edit',
            text: 'Справки',
            href: '/certificate'
          },/* 
          {
            icon: 'home',
            text: 'Домашнее задание',
            href: '/home'
          }, */
          /*{
            icon: 'storefront',
            text: 'Портфолио',
            href: '/home'
          }, {
            icon: 'layers',
            text: 'Базы практики',
            href: '/home'
          },*/
          {
            icon: 'feedback',
            text: 'Обратная связь',
            href: '/feedback'
          }];
        }
        case 3: { //Преподы
          return [{
            icon: 'home',
            text: 'Главная',
            href: '/home'
          },
          {
            icon: 'today',
            text: 'Расписание',
            href: '/timetable'
          },
          {
            icon: 'today',
            text: 'Расписание звонков',
            href: '/callschedule'
          },
          {
            icon: 'home',
            text: 'Домашнее задание',
            href: '/teacherhomework'
          },
          /*{
            icon: 'layers',
            text: 'Ведомости',
            href: '/home'
          },*/
          {
            icon: 'home',
            text: 'Электронный журнал',
            href: '/teacheracademicperfomance'
          }, {
            icon: 'feedback',
            text: 'Обратная связь',
            href: '/feedback'
          }];
        }
        case 4: { //Учебная часть
          return [{
            icon: 'home',
            text: 'Главная',
            href: '/home'
          },
          {
            icon: 'home',
            text: 'Расписание',
            href: '/contimetable'
          },
          {
            icon: 'home',
            text: 'Замены',
            href: '/conreplacements'
          },
          {
            icon: 'today',
            text: 'Расписание звонков',
            href: '/concallschedule'
          },
          {
            icon: 'feedback',
            text: 'Обратная связь',
            href: '/feedback'
          }];
        }
        case 5: { //Лапшина (Канцелярия)
          return [{
            icon: 'home',
            text: 'Главная',
            href: '/home'
          },
          {
            icon: 'home',
            text: 'Заказ справок',
            href: '/listcertificate'
          },
          {
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