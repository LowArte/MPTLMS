//Api для работы с расписанием звонков для учебных мест проведения

import axios from 'axios'

export default 
{
  //Редактирование расписания звонков
  edit (callSchedule) 
  {
    return axios.post('/api/edit/callschedule', 
    {
      'callSchedule': callSchedule
    });
  }
}