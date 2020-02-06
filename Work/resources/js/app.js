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
import AccountCard_C from './components/account-card-f/AccountCard'

import Request_C from './components/feedback-f/Request'
import Feedback_C from './components/feedback-f/Feedback'

import FileManagement_C from './components/administrator-f/FileManagement'
import UserManagement_C from './components/administrator-f/UserManagement'
import PlaceManagement_C from './components/administrator-f/PlaceManagement'
import DepartmentManagement_C from './components/administrator-f/DepartmentManagement'
import GroupManagement_C from './components/administrator-f/GroupManagement'
import PostManagement_C from './components/administrator-f/PostManagement'
import RetrainingManagement_C from './components/administrator-f/Retraining_Management'
import TestCRUD_C from './components/administrator-f/CRUDForm'
import QuickAction_C from './components/administrator-f/QuickAction'

import Timetable_C from './components/timetable-f/Timetable'
import BildTimetable_C from './components/timetable-f/Bild_Timetable'

import Replacements_C from './components/replacements-f/Replacements'
import Bild_Replacements_C from './components/replacements-f/Bild_Replacements'

import CallSchedule_C from './components/call-schedule-f/CallSchedule'
import BildCallSchedule_C from './components/call-schedule-f/Bild_CallSchedule'

import ListCertificate_C from './components/certificate-f/ListCertificateComponent'

//* Студент
//! В данном разделе описываются компоненты для пользователя СТУДЕНТ



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
      'c-user-management' : UserManagement_C, 
      'c-timetable':Timetable_C,
      'c-bild-timetable':BildTimetable_C,
      'c-replacement':Replacements_C,
      'c-bild-replacement':Bild_Replacements_C,
      'c-call-schedule':CallSchedule_C,
      'c-bild-call-schedule':BildCallSchedule_C,
      'c-place-management':PlaceManagement_C,
      'c-department-management':DepartmentManagement_C,
      'c-group-management':GroupManagement_C,
      'c-post-management':PostManagement_C,
      'c-retraining-management':RetrainingManagement_C,
      'c-list-certificate':ListCertificate_C,
      'c-requests-users' :Request_C,
      'c-feedback' :Feedback_C,
      'c-account-card' :AccountCard_C,
      'c-crud' :TestCRUD_C,
      'c-quick-action' :QuickAction_C
    }
});