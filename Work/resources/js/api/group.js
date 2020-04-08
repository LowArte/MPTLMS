//? Документация к api ------------------------

//! Описание
// Api для работы с учебными группами отделений

//! Таблицы базы данных
//

//! Метод 
/**
 * 
 */

import axios from 'axios'

export default {
    //*----------------------------------------
    //!         Модель данных
    //*----------------------------------------
    /**
     * id - BIGINT
     * group_name - string - not null
     * group_name - string - not null
     * group_name - string - not null
     * curs - string - not null
     * departaments_id - int - not null - FK
     */
    //*----------------------------------------


    //*----------------------------------------
    //!         Получение данных
    //*----------------------------------------
    //*Получение всех групп
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *GROUPS* (Группы)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //! Отсутсвует
    //!----------------------------------------
    getGroups(_this) {
        return axios.get('/api/getters/groups')
        .then(result => {return result.data.groups;})
        .catch(exception => {_this.showError("Ошибка получения данных!"); return undefined});
    },

    //*Получение групп по id отделению
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *GROUPS* (Группы)
    //? Возвращается таблица данных JSON формата по id соответствующей группы
    //! Требование ----------------------------
    //! Отсутсвует
    //!----------------------------------------
    getGroupsByDepartamentId(department_id, _this) {
        return axios.get('/api/getters/group_by_departament_id/' + department_id)
        .then(result => {return result.data.groups_info.groups;})
        .catch(exception => {_this.showError("Ошибка получения данных!"); return undefined;});
    },

    //*----------------------------------------
    //!         Работа с данными
    //*----------------------------------------
    //*Сохранение группы
    //! Комментарий ---------------------------
    //? Реализуется сохранение данных в таблице *GROUPS* (Группы)
    //? Передается объект
    //! Требование ----------------------------
    //! Реализовать back-end для api && Уточнить струткуру данных
    //!----------------------------------------
    saveGroup(group, _this) {
        return axios.post('/api/admin/group_management/save', {"group": group})
        .then(res => {_this.showMessage("Выполнено!"); return true;})
        .catch(exception => {_this.showError("Ошибка выполнения!"); return false;});
    },

    //*Редактирование группы
    //! Комментарий ---------------------------
    //? Реализуется изменение данных в таблице *GROUPS* (Группы)
    //? Передается объект и заменет оригинал по id
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    editGroup(group, _this) {
        return axios.post('/api/admin/group_management/edit/' + group.id, {"group": group})
        .then(res => {_this.showMessage("Выполнено!"); return true;})
        .catch(exception => {_this.showError("Ошибка выполнения!"); return false;});
    },

    //*Логическое удаление группы
    //! Комментарий ---------------------------
    //? Реализуется стирание данных в таблице *GROUPS* (Группы)
    //? Передается id группы
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    deleteGroup(group_id, _this) {
        return axios.post('/api/admin/group_management/delete/' + group_id)
        .then(result => {_this.showMessage("Выполнено!"); return true;})
        .catch(exception => {_this.showError("Ошибка выполнения!"); return false;});
    },

    //*Логическое удаление всех записей
    //! Комментарий ---------------------------
    //? Реализуется стирание данных в таблице *GROUPS* (Группы) С ВОЗМОЖНОСТЬЮ ВОССТАНОВЛЕНИЯ
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    dropGroups(_this) {
        return axios.post('/api/admin/group_management/deleteAll')
        .then(res => {_this.showMessage("Выполнено!"); return true;})
        .catch(exception => {_this.showError("Ошибка выполнения!"); return false});
    }
}