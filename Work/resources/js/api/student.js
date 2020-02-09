//Api для работы со студентом системы

import axios from 'axios'

export default 
{
  //Получение всех студентов
  getStudents(data) //!Требуется сделать рабочим
  {
    return axios.get('/api/'+data.slug+'/user_management/get_users');
  },
  //Получение студента
  getStudent(data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/user_management/getStudent/'+data.id);
  }
}