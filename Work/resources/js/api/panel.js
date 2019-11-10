import axios from 'axios'

export default {
  setOptionValue (credentials) {
    return axios.post('/set_options', {"prop_name":credentials.prop,'value':credentials.value})
  }
}
