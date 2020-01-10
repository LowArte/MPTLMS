import axios from 'axios'

export default {
  setOptionValue (credentials) {
    return axios.post('/admin/set_options', {"id":credentials.id,'value':String(credentials.value)})
  }
}
