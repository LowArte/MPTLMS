import axios from 'axios'

export default {
  getSchedule(id) {
    return axios.get('/api/admin/timetable/get_schedule_by_group_id/'+id)
  },

  getScheduleByDay(credentials) {
    console.log(credentials);
    return axios.get('/get_schedule_by_day', {
      params: {
        "group_id": credentials.group_id,
        "day": credentials.day
      }
    })
  },

  getBildSchedule(credentials) {
    return axios.get('/get_bild_schedule_by_group_id', {
      params: {
        "group_id": credentials
      }
    })
  },

  saveSchedule(credentials) {
    return axios.post('/save_schedule', {
      "group_id": credentials.group_id,
      "schedule": credentials.schedule
    })
  }
}
