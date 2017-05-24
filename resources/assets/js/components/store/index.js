import Vuex from 'vuex'
import { state } from '@store/state'
import * as getters from '@store/getters'
import * as actions from '@store/actions'
import * as mutations from '@store/mutations'
import plugins from '@store/plugins'

export default new Vuex.Store({
  state,
  getters,
  actions,
  mutations,
  plugins
})
