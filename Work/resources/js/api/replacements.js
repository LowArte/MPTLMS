//Api для работы с заменами в учебном расписании групп

import axios from 'axios'

export default 
{
  //Получение всех замен
  getReplacements(data)
  {
    return axios.get('/api/'+data.slug+'/'+data.controller+'/get_replacements', 
    {
      params:{
        "date": data.date
      }
    });
  },
  //Получение замен для определённой даты и группы
  getReplacementsByGroupByDate(data)
  {
    return axios.get('/api/'+data.slug+'/'+data.controller+'/get_replacements_by_group_by_date/'+data.group_id, 
    {
      params:{
        "date": data.date
      }
    });
  },
  //Получение замен для определённой группы
  getReplacementsByGroup(data)
  {
    return axios.get('/api/'+data.slug+'/'+data.controller+'/get_replacements_by_group/'+data.group_id);
  },
  //Получение замен для определённой даты
  getReplacementsByDate(data)
  {
    return axios.get('/api/'+data.slug+'/'+data.controller+'/get_replacements_by_date', 
    {
      params:{
        "date": data.date
      }
    });
  },
  //Удаление замены
  deleteReplacement(data)
  {
    return axios.post('/api/'+data.slug+'/'+data.controller+'/delete_replacement/'+data.id);
  },
  //Сохранение замены
  saveReplacements(data)
  {
    return axios.post('/api/'+data.slug+'/'+data.controller+'/save_replacement/'+data.group_id, 
    {
      "replacement": data.replacement,
      "date": data.date
    });
  }
}