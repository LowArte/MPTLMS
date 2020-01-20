import axios from 'axios'

export default 
{
  getPlaces() 
  {
    return axios.get('place_managment/get_places');
  },

  savePlace(place) 
  {
    return axios.post('place_managment/save', 
    {
      "place": place.place
    })
  },

  deletePlace(place) 
  {
    return axios.post('place_managment/delete/'+place.id)
  },

  editPlace(place) 
  {
    return axios.post('place_managment/edit/'+place.place.id, 
    {
      "place": place.place
    })
  },
}