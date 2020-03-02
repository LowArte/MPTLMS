require('./bootstrap');

import store from './store'
import vuetify from './vuetify'

//?----------------------------------------------
//!           СИСТЕМНЫЕ КОМПОНЕНТЫ
//?----------------------------------------------
import SnackBar from './components/SnackBarComponent'
import Login_C from './components/auth-f/Login'
import Logout_C from './components/auth-f/Logout'
import AppMenu_C from './components/menu-f/AppMenu'
import Panel_C from './components/expention-f/Panel'
import SpecialitiesList_C from './components/information-page-f/SpecialtiesList'
import Retraining_C from './components/additional-education-f/Retraining'
import PanelControl_C from './components/administrator-f/PanelControl'
import AccountCard_C from './components/account-card-f/AccountCard'

//?----------------------------------------------
//!               ОБРАТНАЯ СВЯЗЬ
//?----------------------------------------------
import Request_C from './components/feedback-f/Request'
import Feedback_C from './components/feedback-f/Feedback'

//?----------------------------------------------
//!                    CRUD
//?----------------------------------------------
import User_CRUD_C from './components/administrator-f/CRUD/CRUDUser'
import Place_CRUD_C from './components/administrator-f/CRUD/CRUDPlace'
import Department_CRUD_C from './components/administrator-f/CRUD/CRUDDepartment'
import Group_CRUD_C from './components/administrator-f/CRUD/CRUDGroup'
import Post_CRUD_C from './components/administrator-f/CRUD/CRUDPost'

import QuickAction_C from './components/administrator-f/QuickAction'

//?----------------------------------------------
//!          КОНСТРУКТОР РАСПИСАНИЯ
//?----------------------------------------------
import Timetable_C from './components/timetable-f/Timetable'
import BildTimetable_C from './components/timetable-f/Bild_Timetable'

//?----------------------------------------------
//!            КОНСТРУКТОР ЗАМЕН
//?----------------------------------------------
import Replacements_C from './components/replacements-f/Replacements'
import Bild_Replacements_C from './components/replacements-f/Bild_Replacements'

//?----------------------------------------------
//!            КОНСТРУКТОР ЗВОНКОВ
//?----------------------------------------------
import CallSchedule_C from './components/call-schedule-f/CallSchedule'
import BildCallSchedule_C from './components/call-schedule-f/Bild_CallSchedule'

//?----------------------------------------------
//!                 СПРАВКИ
//?----------------------------------------------
import ListCertificate_C from './components/certificate-f/ListCertificateComponent'
import Certificate_C from './components/certificate-f/Certificate'
import Characteristic_C from './components/certificate-f/Characteristic'

//* Студент
//! В данном разделе описываются компоненты для пользователя СТУДЕНТ

window.Vue = require('vue');

import * as mutations from './store/mutation-types'


new Vue({
    el: '#app',
    vuetify,
    store,
    data: () => ({
        rightdrawer: false,
        leftdrawer: false
    }),
    created() {
        var element = document.querySelector('meta[property~="slug"]')
        var doc = element && element.getAttribute("content")
        this.$store.commit(mutations.SET_SLUG, doc)
    },
    components: {
        //?----------------------------------------------
        //!                CRUD - COM
        //?----------------------------------------------
        'c-department-crud': Department_CRUD_C,
        'c-group-crud': Group_CRUD_C,
        'c-user-crud': User_CRUD_C,
        'c-place-crud': Place_CRUD_C,
        'c-post-crud': Post_CRUD_C,

        //?----------------------------------------------
        //!                FOR ALL COM
        //?----------------------------------------------
        'snackbar': SnackBar,
        'c-login': Login_C,
        'c-app-menu': AppMenu_C,
        'c-specialties-list': SpecialitiesList_C,
        'c-retraining': Retraining_C,

        //?----------------------------------------------
        //!                EXOTIC COM
        //?----------------------------------------------
        'c-panel': Panel_C,
        'c-logout': Logout_C,

        //?----------------------------------------------
        //!                OTHER COM
        //?----------------------------------------------
        'c-panel-control': PanelControl_C,
        'c-timetable': Timetable_C,
        'c-bild-timetable': BildTimetable_C,
        'c-replacement': Replacements_C,
        'c-bild-replacement': Bild_Replacements_C,
        'c-call-schedule': CallSchedule_C,
        'c-bild-call-schedule': BildCallSchedule_C,
        'c-list-certificate': ListCertificate_C,
        'c-certificate': Certificate_C,
        'c-characteristic': Characteristic_C,
        'c-requests-users': Request_C,
        'c-feedback': Feedback_C,
        'c-account-card': AccountCard_C,
        'c-quick-action': QuickAction_C
    }
});
