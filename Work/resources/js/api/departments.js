//Api для работы с учебными отделениями

import axios from 'axios'

export default 
{
  //Получение отделений
  getDepartments(data) 
  {
    return axios.get('/api/'+data.slug+'/department_management/get_departments');
  },
  //Сохранение отделений
  saveDepartment(data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/department_management/save', 
    {
      "department": data.department
    });
  },
  //Удаление отделений
  deleteDepartment(data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/department_management/delete/'+data.id);
  },
  //Редактирование отделений
  editDepartment(data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/department_management/edit/'+department.department.id, 
    {
      "department": data.department
    });
  },

  dropDepartment() //!Требуется сделать рабочим
  {
    
  }
}