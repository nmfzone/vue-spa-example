import Axios from 'axios'
import env from '@root/env'
import store from '@store'


window.axios = Axios.create({
  baseURL: env.appURL,
})

window.axios.defaults.headers.common.Authorization = `${store.state.auth.tokenType} ${store.state.auth.accessToken}`
