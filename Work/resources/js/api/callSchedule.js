import axios from 'axios'

export default {
  save (callSchedule) {
    return axios.post('/api/admin/callschedule/save_bildcallschedule', callSchedule)
  }
}