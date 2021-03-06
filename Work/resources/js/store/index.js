import Vue from 'vue'
import Vuex from 'vuex'
import snackbar from './modules/snackbar'
import overlayLoading from './modules/overlayLoading'
import auth from './modules/auth'
import server from './modules/server'
import specialities from './modules/specialities'
import groups from './modules/groups'
import places from './modules/places'
import userPosts from './modules/userPost'
import users from './modules/users'
import teachers from './modules/teachers'
import disciplines from './modules/disciplines'
import timetable from './modules/timetable'
import callschedule from './modules/callSchedule'
import feedback from './modules/feedback'
import сertificate from './modules/сertificate'
import notifications from './modules/notifications'
import foundation from './modules/foundation'
import journals from './modules/journals'
import history from './modules/history'
import homework from './modules/homework'
import news from './modules/news'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    snackbar,
    overlayLoading,
    auth,
    server,
    specialities,
    groups,
    places,
    userPosts,
    users,
    teachers,
    disciplines,
    timetable,
    callschedule,
    feedback,
    сertificate,
    notifications,
    foundation,
    journals,
    history,
    homework,
    news
  },
  strict: debug
})