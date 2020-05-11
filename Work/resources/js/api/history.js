//? Документация к api ------------------------

//! Описание
// Api для работы с историей системы

//! Таблицы базы данных
//

//! Метод 
/**
 * 
 */

import axios from 'axios'

export default {
    getHistory(){
        return axios.get('/api/getters/history')
        .then(res => {return res.data.history;})
        .catch(() => {return undefined});
    }
}