require('./bootstrap');

import withSnackbar from './components/mixins/withSnackbar'
import store from './store'
import vuetify from './vuetify'

import SnackBar from './components/SnackBarComponent'
import Login_C from './components/auth-f/Login'
import AppMenu_C from './components/menu-f/AppMenu'
import Panel_C from './components/expention-f/Panel'
import SpecialitiesList_C from './components/information-page-f/SpecialtiesList'
import Retraining_C from './components/additional-education-f/Retraining'
import PanelControl_C from './components/administrator-f/PanelControl'

import UserPanel_C from './components/administrator-f/PanelControl'
import FileManagment_C from './components/administrator-f/FileManagement'

import Timetable_C from './components/timetable-f/Timetable'
import BildTimetable_C from './components/timetable-f/Bild_Timetable'

import CallSchedule_C from './components/call-schedule-f/CallSchedule'
import BildCallSchedule_C from './components/call-schedule-f/Bild_CallSchedule'



window.Vue = require('vue');

new Vue({
    el: '#app',
    vuetify,
    store,
    mixins: [withSnackbar],
    data: () => ({
      rightdrawer :false,
      leftdrawer : false
    }),
    components: {
      'snackbar': SnackBar,
      'c-login' : Login_C,
      'c-app-menu' : AppMenu_C,
      'c-panel':Panel_C,
      'c-specialties-list':SpecialitiesList_C,
      'c-retraining' : Retraining_C,
      'c-panel-control' : PanelControl_C,
      // 'c-user-panel' : UserPanel_C 
      // ! Написать фронт
      // 'c-file-managment': FileManagment_C 
      // ! Написать фронт
      'c-timetable':Timetable_C,
      'c-bild-timetable':BildTimetable_C,
      'c-call-schedule':CallSchedule_C,
      'c-bild-call-schedule':BildCallSchedule_C
    }
});
