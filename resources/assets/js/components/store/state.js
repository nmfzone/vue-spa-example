import env from '@root/env'


export const STORAGE_KEY = env.appStorageKey

let initialState = {}

if (localStorage.getItem(STORAGE_KEY)) {
  initialState = JSON.parse(localStorage.getItem(STORAGE_KEY))
} else {
  initialState = {
    auth: {
      isLoggedIn: false,
      tokenType: 'Bearer',
      accessToken: null,
    },
    user: {
      name: '',
    }
  }
}

export const state = initialState
