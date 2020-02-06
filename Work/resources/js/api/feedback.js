import axios from 'axios'

export default 
{
  save (data) 
  {
    return axios.post('/api/'+data.slug+'/feedback/save', {"text":data.text,"type":data.type})
  },

  sendEmail (data) 
  {
    return axios.post('/send_email', {"text":data.text,"to":data.mail,'id':data.id})
  }
}