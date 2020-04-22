export default {
  groups:state=>state.groups_full,
  groups_combobox_cache:state => state.groups_combobox_cache,
  groups_combo:state => state.groups_combobox_cache.getLast()
}