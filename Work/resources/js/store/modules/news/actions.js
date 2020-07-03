import * as actions from '../../action-types'
import api_new from "@/js/api/new";

export default{
    async [actions.SET_NEWS] ({ commit },id) {
        let result = await api_new.getNews(id);
        result.map((item => {
            item.links = JSON.parse(item.links)
            item.images = JSON.parse(item.images)
            return item
        }))
        if(result)
        {
            commit(actions.SET_NEWS, result);
        }
    },
    async [actions.SET_LIKE] ({ commit,store },{userId,newsId}) {
        var result = await api_new.likeNews({ new_id: newsId, user_id: userId });
        if (result != null) {
            commit(actions.SET_LIKE, {result,newsId});
        }
    },
    async [actions.ADD_COMMENT] ({ commit,store },{id,text}) {
        var result = await api_new.addComment({text:text},id);
        if (result != null) {
            commit(actions.ADD_COMMENT, {newid:id,comment:result});
        }
    },
}