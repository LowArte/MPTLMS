import axios from 'axios'

export default {
  getUsers() {
    return axios.get('/api/admin/user_managment/get_users');
  },

  saveUser(user) {
    return axios.post('/api/admin/user_managment/save', {
      "user": user.user
    })
  },

  deleteUser(user) {
    return axios.post('/api/admin/user_managment/delete/'+user.id)
  },

  saveEdit(user) {
    return axios.post('/api/admin/user_managment/edit/'+user.id, {
      "user": user.user
    })
  },

  getStudent(user) {
    return axios.post('/api/admin/user_managment/getStudent/'+user.id, {})
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