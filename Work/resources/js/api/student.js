import axios from 'axios'
export default {
    get_student (userId) {
      return axios.post('/api/get_student', {"user_id":userId})
    }
}