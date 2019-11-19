import axios from 'axios'

export default {
  save (credentials) {
    return axios.post('/save_feedback', {"text":credentials.text,"type":credentials.type})
  },
  sendEmail (credentials) {
    return axios.post('/send_email', {"text":credentials.text,"to":credentials.mail,'id':credentials.id})
  }
}
