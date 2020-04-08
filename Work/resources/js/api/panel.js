//? Документация к api ------------------------

//! Описание
// Api для работы с панелью сервера

//! Таблицы базы данных
//

//! Метод 
/**
 * 
 */

import axios from 'axios'

export default {
    //*----------------------------------------
    //!         Функции управления
    //*----------------------------------------
    //*Установка опций
    //! Комментарий ---------------------------
    //? Реализуется установка настроек для сайта. Передается строковое значение.
    //! Требование ----------------------------
    //! Уточнить структуру данных, пердаваемых в back-end
    //!----------------------------------------
    setOptionValue(data, _this) {
        return axios.post('/api/admin/options/set_options', {
            'id': data.id,
            'value': String(data.value)
        })
        .then(result => { _this.showMessage("Выполнено!"); return true; })
        .catch(exception => { _this.showError("Ошибка выполнения!"); return false; });
    },

    //*Получение опция для панели администратора
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *site_options* (Замены)
    //? Возвращается таблица данных JSON формата в соотвествии с предаваемыми параметрами
    //! Требование ----------------------------
    //! Отсутсвует
    //!----------------------------------------
    getSiteOptions(_this) {
        return axios.get('/api/getters/get_site_options')
        .then(result => { return result.data.siteOptions; })
        .catch(exception => { _this.showError("Ошибка получения данных!"); return undefined; });
    },
}