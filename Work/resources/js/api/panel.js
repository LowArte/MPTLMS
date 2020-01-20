import axios from 'axios'

export default {
  setOptionValue (credentials) {
    return axios.post('/api/admin/set_options', {"id":credentials.id,'value':String(credentials.value)})
  }
}
