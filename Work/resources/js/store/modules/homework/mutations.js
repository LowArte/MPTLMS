import * as types from '../../mutation-types'
import {CacheData} from '@/js/plugins/CacheData'

export default {
    [types.ADD_CACHE_HOMEWORK](state, data) {
        state.homework_list.add(data);
    },
    [types.ADD_ID_CACHE_HOMEWORK](state, id) {
        state.homework_list.addId(id);
    },
    [types.CLEAR_CACHE_GROUP](state) {
        state.homework_list = new CacheData()
    }
}