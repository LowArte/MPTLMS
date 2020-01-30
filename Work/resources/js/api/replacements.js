import axios from 'axios'

export default {
  getReplacements(credentials) {
    return axios.get('/get_replacements_by_group_id_by_date', {
      params: {
        "group_id": credentials.group_id,
        "date": credentials.date,
      }
    })
  },

  getAllReplacementsByGroup(credentials) {
    return axios.get('/get_all_replacements_by_group', {
      params: {
        "group_id": credentials.group_id
      }
    })
  },

  getAllReplacementsByDate(credentials) {
    return axios.get('/get_all_replacements_by_date', {
      params: {
        "date": credentials.date
      }
    })
  },

  deleteReplacement(credentials) {
    return axios.post('/delete_replacement', {
      "id": credentials.id
    })
  },
  
  getAllReplacements() {
    return axios.get('/get_all_replacements')
  },

  saveReplacements(credentials) {
    return axios.post('/save_replacement', {
      "group_id": credentials.group_id,
      "replacement": credentials.replacement,
      "date": credentials.date
    })
  }
}
