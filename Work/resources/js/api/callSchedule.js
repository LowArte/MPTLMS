import axios from 'axios'

export default {
  edit (data) {
    return axios.post('/api/admin/callschedule/edit_bildcallschedule', {
      'callSchedule': data.callSchedule
    })
  }
}