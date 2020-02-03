import axios from 'axios'

export default {
  getSchedule(id) {
    return axios.get('/api/admin/timetable/get_schedule_by_group_id/'+id)
  },

  getScheduleBild(id) {
    return axios.get('/api/admin/timetable/get_schedule_bild_by_group_id/'+id)
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

  editSchedule(data) {
    return axios.post('/api/admin/timetable/edit_schedule/'+data.group_id, {
      "schedule": data.schedule
    })
  }
}
