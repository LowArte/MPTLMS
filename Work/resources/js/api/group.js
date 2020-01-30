import axios from 'axios'

export default {
  getGroup(credentials) {
    return axios.get('/get_group_by_departament_id', {
      params: {
        "dep_id": credentials
      }
    })
  },

  getGroupAll() 
  {
    return axios.get('/api/admin/group_management/get_groups');
  },

  saveGroup(group) 
  {
    return axios.post('/api/admin/group_management/save', { "group": group.group })
  },

  deleteGroup(group) 
  {
    return axios.post('/api/admin/group_management/delete/'+group.id)
  },

  editGroup(group) 
  {
    return axios.post('/api/admin/group_management/edit/'+group.group.id, {"group": group.group})
  },
}
