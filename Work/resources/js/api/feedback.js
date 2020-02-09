//Api для работы с обратной связью системы

import axios from 'axios'

export default 
{
  //Сохранения обращения обратной связи
  save (data) 
  {
    return axios.post('/api/'+data.slug+'/feedback/save', 
    {
      "text":data.text,
      "type":data.type
    });
  },
  //Оправка сообщений на почту
  sendEmail (data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/feedback/send_email', {"text":data.text,"to":data.mail,'id':data.id});
  }
}