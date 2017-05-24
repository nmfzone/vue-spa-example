import router from '@router'

const authMiddleware = (to, from, next) => {
  const auth = router.app.$options.store.state.auth

  if (! auth.isLoggedIn) {
    next({
      path: '/login',
      query: { redirect: to.fullPath }
    })
  } else {
    next()
  }
}


export default authMiddleware
