import VueRouter from 'vue-router'
import routes from '@router/routes'


export default new VueRouter({
  mode: 'history',
  scrollBehavior: () => ({ y: 0 }),
  routes: routes,
})
