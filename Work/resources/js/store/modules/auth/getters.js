export default {
  isAuthenticated: state => state.accessToken!=null,
  user:state=>state.user,
  accessToken:state=>state.accessToken
}
