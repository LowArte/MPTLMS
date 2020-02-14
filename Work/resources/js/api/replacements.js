//Api для работы с заменами в учебном расписании групп

import axios from 'axios'

export default 
{
  //Получение всех замен
  getReplacements(data)
  {
    return axios.get('api/getters/replacements', 
    {
      params:{
        "date": data.date
      }
    });
  },
  //Получение замен для определённой даты и группы
  getReplacementsByGroupByDate(data)
  {
    return axios.get('api/getters/replacements_by_group_by_date/'+data.group_id+'/'+data.date);
  },
  //Получение замен для определённой группы
  getReplacementsByGroup(data)
  {
    return axios.get('api/getters/replacements_by_group/'+data.group_id);
  },
  //Получение замен для определённой даты
  getReplacementsByDate(data)
  {
    return axios.get('api/getters/replacements_by_date/' + data.date);
  },
  //Удаление замены
  deleteReplacement(data)
  {
    return axios.post('api/delete/replacement/'+data.id);
  },
  //Сохранение замены
  saveReplacements(data)
  {
    return axios.post('api/save/replacement/' +data.group_id, 
    {
      "replacement": data.replacement,
      "date": data.date
    });
  }
}