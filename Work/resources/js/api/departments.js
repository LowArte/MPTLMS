import axios from 'axios'

export default 
{
  getDepartments() 
  {
    return axios.get('/api/admin/department_management/get_departments');
  },

  saveDepartment(department) 
  {
    return axios.post('/api/admin/department_management/save', 
    {
      "department": department.department
    })
  },

  deleteDepartment(department) 
  {
    return axios.post('/api/admin/department_management/delete/'+department.id)
  },

  editDepartment(department) 
  {
    return axios.post('/api/admin/department_management/edit/'+department.department.id, 
    {
      "department": department.department
    })
  },
}