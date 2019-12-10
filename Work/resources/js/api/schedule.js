import axios from 'axios'

export default {
  getSchedule (credentials) {
    return axios.get('/get_schedule_by_group_id', {"group_id":credentials})
  },
  
  saveSchedule (credentials) {
    return axios.post('/save_schedule', {"group_id":credentials.group_id, "schedule":credentials.schedule})
  }
}