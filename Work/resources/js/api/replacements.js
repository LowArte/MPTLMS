//Api для работы с заменами в учебном расписании групп

import axios from 'axios'

export default 
{
  //Получение всех замен
  getReplacements(data)
  {
    return axios.get('/api/getters/replacements');
  },

  //Получение замен для определённой даты и группы
  getReplacementsByGroupByDate(data)
  {
    return axios.get('/api/getters/replacements_by_group_by_date/'+data.group_id+'/'+data.date);
  },

  //Получение замен для определённой группы
  getReplacementsByGroup(group_id)
  {
    return axios.get('/api/getters/replacements_by_group/'+group_id);
  },

  //Получение замен для определённой даты
  getReplacementsByDate(date)
  {
    return axios.get('/api/getters/replacements_by_date/' + date);
  },

  //Удаление замены
  deleteReplacement(replacement_id)
  {
    return axios.post('/api/delete/replacement/'+replacement_id);
  },

  //Сохранение замены
  saveReplacements(data)
  {
    return axios.post('/api/save/replacement/' +data.group_id +'/'+data.date, 
    {
      "replacement": data.replacement
    });
  }
}