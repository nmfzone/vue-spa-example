import Vue from 'vue'
import store from '@store'
import router from '@router'


const LOGIN_URL = '/login'

const REGISTER_URL = '/register'

const REFRESH_TOKEN_URL = '/refresh-token'

const GET_CURRENT_USER_URL = '/api/v1/user'

export default {
  install(Vue, options) {
    axios.interceptors.response.use((response) => {
      if (this._isInvalidToken(response)) {
        return this._refreshToken()
      }

      return response
    })

    Vue.prototype.$auth = Vue.auth = this
  },

  login(credentials) {
    return axios.post(`${LOGIN_URL}`, {
      email: credentials.email,
      password: credentials.password,
    }).then(response => {
      if (response.data.access_token) {
        this._setAuth({
          tokenType: response.data.token_type,
          accessToken: response.data.access_token,
        })
      }

      return response
    })
  },

  register(data) {
    return axios.post(`${REGISTER_URL}`, {
      email: data.email,
      name: data.name,
      password: data.password,
      password_confirmation: data.password_confirmation,
    }).then(response => {
      return response
    })
  },

  setAuthHeader() {
    axios.defaults.headers.common.Authorization = `${store.state.auth.tokenType} ${store.state.auth.accessToken}`
  },

  logout() {
    store.commit('CLEAR_ALL_DATA')
    router.push({ name: 'login' })
  },

  _refreshToken() {
    return axios.post(REFRESH_TOKEN_URL)
      .then((response) => {
        this._setAuth({
          tokenType: response.data.token_type,
          accessToken: response.data.access_token,
        })

        return response
      })
      .catch((error) => {
        if (this._isInvalidToken(error)) {
          this.logout()
        }

        return error
      })
  },

  _setAuth(data) {
    let auth = store.state.auth

    // Processing auth
    auth.isLoggedIn = true
    auth.tokenType = data.tokenType
    auth.accessToken = data.accessToken

    store.commit('UPDATE_AUTH', auth)

    // Set the Authorization header
    this.setAuthHeader()

    // Get current user
    axios.get(GET_CURRENT_USER_URL)
      .then((response) => {
        store.commit('UPDATE_USER', response.data)
      })
  },

  _isInvalidToken(response) {
    return (response.status === 401 && response.data.error === 'invalid_token')
  }
}
