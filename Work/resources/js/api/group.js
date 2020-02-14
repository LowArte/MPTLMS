//Api для работы с учебными группами отделений

import axios from 'axios'
import {
    mapGetters
} from 'vuex'

let slug = mapGetters(["slug"]).slug

export default {
    //Получение групп по id отделению
    getGroupByDepartamentId(data) {
        return axios.get('api/getters/group_by_departament_id/' + data.department_id);
    },
    //Получение всех групп
    getGroups(data) {
        return axios.get(' api/getters/groups ');
    },
    //Сохранение группы
    saveGroup(data) //!Требуется сделать рабочим
    {
        return axios.post('/api/' + slug + '/group_management/save', {
            "group": data.group
        });
    },
    //Удаление группы
    deleteGroup(data) //!Требуется сделать рабочим
    {
        return axios.post('/api/' + slug + '/group_management/delete/' + data.id);
    },
    //Редактирование группы
    editGroup(data) //!Требуется сделать рабочим
    {
        return axios.post('/api/' + slug + '/group_management/edit/' + data.group.id, {
            "group": data.group
        });
    }
}
