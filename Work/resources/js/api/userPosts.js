//Api для работы с ролями системы

import axios from 'axios'

export default 
{
  //Получение ролей
  getPosts(data) 
  {
    return axios.get('/api/'+data.slug+'/post_management/get_posts');
  },
  //Сохранение роли
  savePost(data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/post_management/save', 
    {
      "post": data.post
    });
  },
  //Удаление роли
  deletePost(data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/post_management/delete/'+data.id);
  },
  //Редактирование роли
  editPost(data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/post_management/edit/'+data.id, 
    {
      "post": data.post
    });
  }
}