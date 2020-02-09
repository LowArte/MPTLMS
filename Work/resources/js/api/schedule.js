//Api для работы с учебным расписанием групп

import axios from 'axios'

export default 
{
  //Получение учебного расписания для группы
  getSchedule(data) 
  {
    return axios.get('/api/'+data.slug+'/'+data.controller+'/get_schedule_by_group_id/'+data.group_id);
  },
  //Получение учебного расписания для группы для редактирования
  getScheduleBild(data) 
  {
    return axios.get('/api/'+data.slug+'/'+data.controller+'/get_schedule_bild_by_group_id/'+data.group_id);
  },
  //Редактирование учебного расписания
  editSchedule(data) 
  {
    return axios.post('/api/'+data.slug+'/'+data.controller+'/edit_schedule/'+data.group_id, 
    {
      "schedule": data.schedule
    });
  }
}