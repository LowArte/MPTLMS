//Api для заказа документов

import axios from 'axios'

export default 
{
  //Заказ нового документа
  save (data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/certificate/save_certificate', 
    {
      "data":data.data,
      "type":data.type
    });
  },

  //Уведомление о том, что справка выполнена + фиксация того, что справка выполнена
  sendMailReady (data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/certificate/sendMailReady/'+data.id);
  }
}