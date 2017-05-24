import Vue from 'vue'
import '@root/bootstrap'
import '@config/axios'
import store from '@store'
import router from '@router'
import App from '@base/App.vue'
import Auth from '@common-auth'


Vue.use(Auth)


new Vue({
  router,
  store,
  ...App,
}).$mount('#app')
