//Api для работы с учебными группами отделений

import axios from 'axios'

export default 
{
  //Получение групп по id отделению
  getGroup(data) 
  {
    return axios.get('/api/'+data.slug+'/'+data.controller+'/get_group_by_departament_id/'+data.department_id);
  },
  //Получение всех групп
  getGroupAll(data) 
  {
    return axios.get('/api/'+data.slug+'/group_management/get_groups');
  },
  //Сохранение группы
  saveGroup(data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/group_management/save', 
    { 
      "group": data.group 
    });
  },
  //Удаление группы
  deleteGroup(data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/group_management/delete/'+data.id);
  },
  //Редактирование группы
  editGroup(data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/group_management/edit/'+data.group.id, 
    {
      "group": data.group
    });
  }
}