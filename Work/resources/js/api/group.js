import axios from 'axios'

export default {
  getGroup(credentials) {
    return axios.get('/get_group_by_departament_id', {
      params: {
        "dep_id": credentials
      }
    })
  }
}
