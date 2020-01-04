/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * * Компоненты авторизации
 */
import LoginButton_C from './components/authentication-f/LoginButton'
import RememberPassword_C from './components/authentication-f/RememberPassword'
import ResetPassword_C from './components/authentication-f/ResetPassword'

// ! --------------------------------------------------------------------------------------------

/**
 * * Компоенты обратной связи и просмотр обращений
 */
import Feedback_C from './components/feedback-f/Feedback'
import RequestsUsers_C from './components/feedback-f/RequestsUsers'

// ! --------------------------------------------------------------------------------------------

/**
 * * Компоненты выдачи и заказа справок
 * ! Переписать вёрстку
 * ? <ListCertificateComponent> перенести в blade шаблон
 */
import CertificateComponent from './components/certificate/CertificateComponent'
import ListCertificateComponent from './components/certificate/ListCertificateComponent'

// ! --------------------------------------------------------------------------------------------

/**
 * * Компоненты уведомлений / системы 
 */
import SnackBar from './components/SnackBarComponent'
import Notifications_C from './components/notifications-f/Notifications'
import Panel_C from './components/expention-f/Panel'
import Downloadbutton_C from './components/buttons-f/DownloadButton'

// ! --------------------------------------------------------------------------------------------

/**
 * * Компоненты добавления и отображения звонков
 */
import Bild_CallSchedule_C from './components/call-schedule-f/Bild_CallSchedule'
import CallSchedule_C from './components/call-schedule-f/CallSchedule'

// ! --------------------------------------------------------------------------------------------

/**
 * * Компонент отображения списка специальностей
 */
import SpecialtiesList_C from './components/information-page-f/SpecialtiesList'

// ! --------------------------------------------------------------------------------------------

/**
 * * Компоненты админской панели
 */
import PanelControl_C from './components/administrator-f/PanelControl'
import UserManagement_C from './components/administrator-f/UserManagement'
import FileManagement_C from './components/administrator-f/FileManagement'

// ! --------------------------------------------------------------------------------------------

/**
 * * Компоненты центра дополнительного образования
 * ! Перенести в blade шаблон
 * ? Реализовать компонент кнопки записи
 */
import Retraining_C from './components/additional-education-f/Retraining'
import DetailedInformationRetrainign_C from './components/additional-education-f/DetailedInformationRetraining'

// ! --------------------------------------------------------------------------------------------

/**
 * * Компонент учебной нагрузки для студента
 */
import Journal_C from './components/journal-f/Journal'
import Timetable_C from './components/timetable-f/Timetable'
import Bild_Timetable_C from './components/timetable-f/Bild_Timetable'
import Replacements_C from './components/replacements-f/Replacements'
import Bild_Replacements_C from './components/replacements-f/Bild_Replacements'

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
    'c-login-button': LoginButton_C,
    'c-remember-password': RememberPassword_C,
    'c-reset-password': ResetPassword_C,
    'snackbar': SnackBar,
    'c-panel': Panel_C,
    'c-feedback': Feedback_C,
    'certificate': CertificateComponent, // !
    'listcertificate': ListCertificateComponent, // !
    'c-bild-call-schedule': Bild_CallSchedule_C,
    'c-specialties-list': SpecialtiesList_C,
    'c-requests-users': RequestsUsers_C,
    'c-panel-control': PanelControl_C, // ! ПРОВЕРИТЬ
    'c-call-schedule': CallSchedule_C,
    'c-retraining': Retraining_C,
    'c-user-management': UserManagement_C, // Изменена роль на комбобокс
    'c-file-management': FileManagement_C,
    'c-notifications': Notifications_C,
    'c-journal': Journal_C, //-
    'c-detailed-inf-ret': DetailedInformationRetrainign_C, // ! ДОПИСАТЬ ПОДХВАТ ДАННЫХ
    'c-timetable': Timetable_C,
    'c-bildtimetable': Bild_Timetable_C,
    'c-download-button' : Downloadbutton_C,
    'c-replacements' : Replacements_C,
    'c-bild-replacements' : Bild_Replacements_C
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
      if (user.disabled) //Заблокированный пользователь
      {
        return [{
          icon: 'home',
          text: 'Главная',
          href: '/home'
        },
        {
          icon: 'feedback',
          text: 'Обратная связь',
          href: '/feedback'
        }];
      };
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
              href: '/timetable'
            },
            {
              icon: 'today',
              text: 'Конструктор расписания',
              href: '/bildtimetable'
            },
            {
              icon: 'find_replace',
              text: 'Замены',
              href: '/replacements'
            },
            {
              icon: 'find_replace',
              text: 'Конструктор замен',
              href: '/bildreplacements'
            }, 
            {
              icon: 'today',
              text: 'Расписание звонков',
              href: '/bildcallschedule'
            },
            {
              icon: 'edit',
              text: 'Управление пользователями',
              href: '/usermanagement'
            },
            {
              icon: 'edit',
              text: 'Управление файлами',
              href: '/filemanagement'
            },
            {
              icon: 'feedback',
              text: 'Обращение пользователей',
              href: '/requestsusers'
            }
          ];
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
              icon: 'autorenew',
              text: 'Изменения в расписании',
              href: '/replaces'
            },
            /* 
            {
              icon: 'show_chart',
              text: 'Успеваемость',
              href: '/home'
            }, */
            {
              icon: 'business_center',
              text: 'Дополнительное образование',
              href: '/detailedir'
            },
            /*
                     {
                       icon: 'school',
                       text: 'Преподаватели',
                       href: '/home'
                     }, */
            {
              icon: 'edit',
              text: 'Справки',
              href: '/certificate'
            },
            /* 
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
            }
          ];
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
            }
          ];
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
              href: '/timetable'
            },
            {
              icon: 'home',
              text: 'Конструктор расписания',
              href: '/bildtimetable'
            },
            {
              icon: 'find_replace',
              text: 'Замены',
              href: '/replacements'
            },         
            {
              icon: 'feedback',
              text: 'Обратная связь',
              href: '/feedback'
            }
          ];
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
            }
          ];
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
