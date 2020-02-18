//Api для работы с обратной связью системы

import axios from 'axios'

export default {

    //Получение справок
    getFeedbackRequests ()
    {
        return axios.get('/api/getters/get_feedback_requests');
    },
    
    //Сохранения обращения обратной связи
    save(data) { //!Требуется сделать Общим
        return axios.post('/api/student/feedback/save', {
            "text": data.text,
            "type": data.type
        });
    },

    //Оправка сообщений на почту
    sendEmail(data) //!Требуется сделать рабочим
    {
        return axios.post('/api/admin/request_users/send_email/' + data.id, {
            "text": data.text,
            "to": data.mail,
        });
    },
    
    //Логически удаляет все записи
    drop(data) //!Требуется сделать рабочим
    {
        return axios.post('/api/admin/request_users/drop');
    }
}