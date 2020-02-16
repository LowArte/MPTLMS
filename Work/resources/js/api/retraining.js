//Api для работы с дополнительным образрванием

import axios from 'axios'

export default 
{
  //Получение дополнительного образования
  getRetrainings(data) 
  {
    return axios.get('/api/getters/retrainings');
  },

  //Сохранение дополнительного образования
  saveRetraining(data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/retraining_management/save', 
    {
      "retraining": data.retraining
    });
  },

  //Удаление дополнительного образования
  deleteRetraining(data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/retraining_management/delete/'+data.id);
  },

  //Редактирование дополнительного образования
  editRetraining(data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/retraining_management/edit/'+data.id, 
    {
      "retraining": data.retraining
    });
  },

  //Подробнее об дополнительном образовании
  detailRetraining(data) //!Требуется сделать рабочим
  {
    
  }
}