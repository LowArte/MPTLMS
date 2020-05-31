import * as actions from '../../action-types'

export default {
    [actions.SET_NEWS] (state, news) {
        state.news = news;
    },
    [actions.ADD_COMMENT] (state, {newid,comment}) {
        var dat = state.news.findById(newid)
        dat.comments.push(comment)
    },
    [actions.SET_LIKE] (state, newInfo) {
        var dat = state.news.findById(newInfo.newsId)
        dat.likes = newInfo.result
        dat.isLike = !dat.isLike
    },
}
