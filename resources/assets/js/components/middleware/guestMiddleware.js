import router from '@router'

const guestMiddleware = (to, from, next) => {
  const auth = router.app.$options.store.state.auth

  if (auth.isLoggedIn) {
    next({
      path: '/',
    })
  } else {
    next()
  }
}


export default guestMiddleware
