import axios from 'axios'

export default {
  save (credentials) {
    return axios.post('/save_concallschedule', credentials)
  }
}
