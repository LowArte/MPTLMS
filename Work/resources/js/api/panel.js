//Api для работы с панелью сервера

import axios from 'axios'

export default 
{
  //Установка опций
  setOptionValue (data) 
  {
    return axios.post('api/admin/options/set_options ', 
    {
      'id':data.id,
      'value':String(data.value)
    });
  }
}