export const UPDATE_AUTH = (state, auth) => {
  state.auth = auth
}

export const UPDATE_USER = (state, user) => {
  state.user = user
}

export const CLEAR_ALL_DATA = (state) => {
  state.auth.isLoggedIn = false
  state.auth.tokenType = 'Bearer'
  state.auth.accessToken = null
  state.user = {
    name: '',
  }
}
