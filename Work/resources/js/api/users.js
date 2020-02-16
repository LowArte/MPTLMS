//Api для работы с пользователями системы

import axios from 'axios'

export default 
{
  //Получение пользователей
  getUsers() 
  {
    return axios.get('/api/getters/users');
  },

  //Сохранение пользователя
  saveUser(user) 
  {
    return axios.post('/api/admin/user_management/save', 
    {
      "user": user
    });
  },

  //Удаление пользователя
  deleteUser(user_id) 
  {
    return axios.post('/api/admin/user_management/delete/'+user_id);
  },
  
  //Редактирование пользователя
  editUser(data) 
  {
    return axios.post('/api/admin/user_management/edit/'+data.user_id, 
    {
      "user": data.user
    });
  }

  /*notificate(notId) { //! Не понятная хрень
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
  },*/
}