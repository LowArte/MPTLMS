//Api для работы с расписанием звонков для учебных мест проведения

import axios from 'axios'

export default 
{
  //Редактирование расписания звонков
  edit (data) 
  {
    return axios.post('/api/'+data.slug+'/callschedule/edit_bildcallschedule', 
    {
      'callSchedule': data.callSchedule
    });
  }
}