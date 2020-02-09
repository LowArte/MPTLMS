//Api для работы с пользователями системы

import axios from 'axios'

export default 
{
  //Получение пользователей
  getUsers(data) 
  {
    return axios.get('/api/'+data.slug+'/user_management/get_users');
  },
  //Сохранение пользователя
  saveUser(data) 
  {
    return axios.post('/api/'+data.slug+'/user_management/save', 
    {
      "user": data.user
    });
  },
  //Удаление пользователя
  deleteUser(data) 
  {
    return axios.post('/api/'+data.slug+'/user_management/delete/'+data.id);
  },
  //Редактирование пользователя
  editUser(data) 
  {
    return axios.post('/api/'+data.slug+'/user_management/edit/'+data.id, 
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