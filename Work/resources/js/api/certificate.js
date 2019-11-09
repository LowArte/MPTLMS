import axios from 'axios'

export default {
  save (credentials) {
    return axios.post('/save_certificate', {"cer_dat":credentials.data,"type":credentials.type})
  }
}
