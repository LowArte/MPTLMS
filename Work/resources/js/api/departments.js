//Api для работы с учебными отделениями

import axios from 'axios'

export default 
{
  //Получение отделений
  getDepartments() 
  {
    return axios.get('/api/getters/department');
  },

  //Сохранение отделений
  saveDepartment(department) //!Требуется сделать рабочим
  {
    return axios.post('/api/admin/department_management/save', 
    {
      "department": department
    });
  },

  //Удаление отделений
  deleteDepartment(id) //!Требуется сделать рабочим
  {
    return axios.post('/api/admin/department_management/delete/'+id);
  },

  //Редактирование отделений
  editDepartment(department) //!Требуется сделать рабочим
  {
    return axios.post('/api/admin/department_management/edit/'+department.id, 
    {
      "department": department
    });
  },

  dropDepartment() //!Требуется сделать рабочим
  {
    
  }
}