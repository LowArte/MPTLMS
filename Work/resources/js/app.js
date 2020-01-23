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

import FileManagment_C from './components/administrator-f/FileManagement'
import UserManagment_C from './components/administrator-f/UserManagement'
import PlaceManagment_C from './components/administrator-f/PlaceManagement'
import DepartmentManagment_C from './components/administrator-f/DepartmentManagement'
import GroupManagment_C from './components/administrator-f/GroupManagement'
import PostManagment_C from './components/administrator-f/PostManagement'
import RetrainingManagement_C from './components/administrator-f/Retraining_Management'

import Timetable_C from './components/timetable-f/Timetable'
import BildTimetable_C from './components/timetable-f/Bild_Timetable'

import Replacements_C from './components/replacements-f/Replacements'
import Bild_Replacements_C from './components/replacements-f/Bild_Replacements'

import CallSchedule_C from './components/call-schedule-f/CallSchedule'
import BildCallSchedule_C from './components/call-schedule-f/Bild_CallSchedule'

import ListCertificate_C from './components/certificate-f/ListCertificateComponent'



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
      'c-user-managment' : UserManagment_C, 
      'c-timetable':Timetable_C,
      'c-bild-timetable':BildTimetable_C,
      'c-replacement':Replacements_C,
      'c-bild-replacement':Bild_Replacements_C,
      'c-call-schedule':CallSchedule_C,
      'c-bild-call-schedule':BildCallSchedule_C,
      'c-place-managment':PlaceManagment_C,
      'c-department-managment':DepartmentManagment_C,
      'c-group-managment':GroupManagment_C,
      'c-post-managment':PostManagment_C,
      'c-retraining-management':RetrainingManagement_C,
      'c-list-certificate':ListCertificate_C,
    }
});