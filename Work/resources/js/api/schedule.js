//Api для работы с учебным расписанием групп

import axios from 'axios'

export default 
{
  //Получение учебного расписания для группы
  getScheduleByGroupId(data) 
  {
    return axios.get('api/getters/schedule_by_group_id/'+data.group_id);
  },
  //Получение учебного расписания для группы для редактирования
  getScheduleBildByGroupId(data) 
  {
    return axios.get('api/getters/schedule_bild_by_group_id/{group_id} '+data.group_id);
  },
  //Редактирование учебного расписания
  editSchedule(data) 
  {
    return axios.post('api/edit/schedule/'+data.group_id, 
    {
      "schedule": data.schedule
    });
  }
}