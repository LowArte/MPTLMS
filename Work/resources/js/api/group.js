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
    return axios.get('/api/admin/group_managment/get_groups');
  },

  saveGroup(group) 
  {
    return axios.post('/api/admin/group_managment/save', { "group": group.group })
  },

  deleteGroup(group) 
  {
    return axios.post('/api/admin/group_managment/delete/'+group.id)
  },

  editGroup(group) 
  {
    return axios.post('/api/admin/group_managment/edit/'+group.group.id, {"group": group.group})
  },
}
