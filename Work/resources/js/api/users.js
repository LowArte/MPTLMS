import axios from 'axios'

export default {
  fetch () {
    return axios.get('/api/v1/users')
  },
  update (user) {
    return axios.put('/api/v1/user', {
      'name': user.name,
      'email': user.email
    })
  },
  getUsers(){
    return axios.get('/get_users');
  },
  
  saveUsers(users){
    return axios.post('/save_users', {"users":users.users})
  },
}
