//Api для работы с учебными группами отделений

import axios from 'axios'

export default {
    //Получение групп по id отделению
    getGroupsByDepartamentId(department_id) {
        return axios.get('/api/getters/group_by_departament_id/' + department_id);
    },

    //Получение всех групп
    getGroups() {
        return axios.get('/api/getters/groups');
    },

    //Сохранение группы
    saveGroup(group) //!Требуется сделать рабочим
    {
        return axios.post('/api/admin/group_management/save', {
            "group": group
        });
    },

    //Удаление группы
    deleteGroup(group_id) //!Требуется сделать рабочим
    {
        return axios.post('/api/admin/group_management/delete/' + group_id);
    },

    //Редактирование группы
    editGroup(data) //!Требуется сделать рабочим
    {
        return axios.post('/api/admin/group_management/edit/' + data.group.id, {
            "group": data.group
        });
    }
}