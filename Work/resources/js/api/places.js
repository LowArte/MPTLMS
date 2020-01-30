import axios from 'axios'

export default 
{
  getPlaces() 
  {
    return axios.get('/api/admin/place_management/get_places');
  },

  savePlace(place) 
  {
    return axios.post('/api/admin/place_management/save', 
    {
      "place": place.place
    })
  },

  deletePlace(place) 
  {
    return axios.post('/api/admin/place_management/delete/'+place.id)
  },

  editPlace(place) 
  {
    return axios.post('/api/admin/place_management/edit/'+place.place.id, 
    {
      "place": place.place
    })
  },
}