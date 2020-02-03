import axios from 'axios'

export default {
  getGroups(id) {
    return axios.get('/api/admin/timetable/get_group_by_departament_id/'+id)
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
