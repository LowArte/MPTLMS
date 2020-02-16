//Api для заказа документов

import axios from 'axios'

export default 
{
  //Заказ нового документа
  save (data)
  {
    return axios.post('/api/student/certificate/save', 
    {
      "data":data.data,
      "type":data.type
    });
  },

  //Уведомление о том, что справка выполнена + фиксация того, что справка выполнена
  sendMailReady (id) //!Требуется сделать рабочим
  {
    return axios.post('/api/chancellery/certificate/sendMailReady/'+id);
  }
}