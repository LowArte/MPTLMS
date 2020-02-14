//Api для работы с местами проведения учебного дня

import axios from 'axios'

export default 
{
  //Получение мест проведения
  getPlaces(data) 
  {
    return axios.get('api/getters/places');
  },
  //Сохранение мест проведения
  savePlace(data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/place_management/save', 
    {
      "place": data.place
    });
  },
  //Удаление мест проведения
  deletePlace(data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/place_management/delete/'+data.id);
  },
  //Редактирование мест проведения
  editPlace(data) //!Требуется сделать рабочим
  {
    return axios.post('/api/'+data.slug+'/place_management/edit/'+data.place.id, 
    {
      "place": data.place
    });
  }
}