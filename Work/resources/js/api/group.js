import axios from 'axios'

export default {
  getGroup (credentials) {
    return axios.post('/get_group_by_departament_id', {"dep_id":credentials})
  }
}