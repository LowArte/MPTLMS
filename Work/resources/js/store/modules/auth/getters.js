export default {
  isAuthenticated: state => state.accessToken!=null,
  user:state=>state.user,
  routes:state=>state.routes,
  slug:state=>state.slug
}
