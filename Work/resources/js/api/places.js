//Api для работы с местами проведения учебного дня

import axios from 'axios'

export default 
{
  //Получение мест проведения
  getPlaces() 
  {
    return axios.get('/api/getters/places');
  },

  //Сохранение мест проведения
  savePlace(place) //!Требуется сделать рабочим
  {
    return axios.post('/api/admin/place_management/save', 
    {
      "place": place
    });
  },

  //Удаление мест проведения
  deletePlace(place_id) //!Требуется сделать рабочим
  {
    return axios.post('/api/admin/place_management/delete/'+place_id);
  },

  //Редактирование мест проведения
  editPlace(data) //!Требуется сделать рабочим
  {
    return axios.post('/api/admin/place_management/edit/'+data.place.id, 
    {
      "place": data.place
    });
  },

  //Полное удаление мест проведений
  dropPlaces() //!Требуется сделать рабочим
  {
      return axios.post('/api/admin/place_management/deleteAll');
  }
}