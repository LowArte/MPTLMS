//Api для работы со студентом системы

import axios from 'axios'

export default 
{
  //Получение всех студентов
  getStudents() //!Требуется сделать рабочим
  {
    return axios.get('/api/admin/user_management/get_users');
  },

  //Получение студента
  getStudent(student_id) //!Требуется сделать рабочим
  {
    return axios.post('/api/admin/user_management/get_student/'+student_id);
  }
}