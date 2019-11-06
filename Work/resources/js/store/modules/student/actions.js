import * as mutations from '../../mutation-types'
import * as actions from '../../action-types'
import student from '../../../api/student'

export default {
    [ actions.GET_STUDENT ] (context, userId) {
        return new Promise((resolve, reject) => {
          student.get_student(userId).then(response => {
            context.commit(mutations.SELECT_STUDENT,response.data)
            resolve(response)
          }).catch(error => {
            reject(error)
          })
        })
      },
}
