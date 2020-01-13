import axios from 'axios'

export default {
  fetch() {
    return axios.get('/api/v1/users')
  },
  update(user) {
    return axios.put('/api/v1/user', {
      'name': user.name,
      'email': user.email
    })
  },

  getUsers() {
    return axios.get('admin/user_managment/get_users');
  },

  saveUser(user) {
    return axios.post('/save', {
      "user": user.user
    })
  },
  deleteUser(user) {
    return axios.post('admin/user_managment/delete', {
      "id": user.id
    })
  },
  notificate(notId) {
    return axios.post("/setNotificationAsRead", {
      "id": notId
    })
  },
  downloadFile(file_name) {
    return axios.get("/download_file", {
      params: {
        "file_name":file_name
      }
    })
  },
}
