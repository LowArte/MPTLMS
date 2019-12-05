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
  
  saveUser(user){
    return axios.post('/save_user', {"user":user.user})
  },
  deleteUser(user){
    return axios.post('/delete_user', {"id":user.id})
  },
  notificate(notId){
    return axios.post("/setNotificationAsRead",{"id":notId})
  }
}