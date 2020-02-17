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

  //Получение справок
  getCertificates ()
  {
    return axios.get('/api/getters/get_certificates');
  },

  //Уведомление о том, что справка выполнена + фиксация того, что справка выполнена
  sendEmailDone (answer) //!Требуется сделать рабочим
  {
    return axios.post('/api/chancellery/certificate/sendEmailDone/'+answer.id+'/'+answer.email);
  },

  //Ответ канцелярии заказчику, в случае если справку нельзя сделать, при том, что справка не будет зафиксирована о выполнении
  sendEmailAnswer (answer) //!Требуется сделать рабочим
  {
    return axios.post('/api/chancellery/certificate/sendEmailAnswer/'+answer.id+'/'+answer.email, {"answer": answer.text});
  }
}