import axios from 'axios'

export default 
{
  getDepartments() 
  {
    return axios.get('/api/admin/department_managment/get_departments');
  },

  saveDepartment(department) 
  {
    return axios.post('/api/admin/department_managment/save', 
    {
      "department": department.department
    })
  },

  deleteDepartment(department) 
  {
    return axios.post('/api/admin/department_managment/delete/'+department.id)
  },

  editDepartment(department) 
  {
    return axios.post('/api/admin/department_managment/edit/'+department.department.id, 
    {
      "department": department.department
    })
  },
}