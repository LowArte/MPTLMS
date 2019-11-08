import axios from 'axios'

export default {
  getSchedule (credentials) {
    return axios.post('/get_schedule_by_group_id', {"group_id":credentials})
  }
}
