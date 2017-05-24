import Vue from 'vue'
import $ from 'jquery'
import Vuex from 'vuex'
import Axios from 'axios'
import 'moment/locale/id'
import Lodash from 'lodash'
import Moment from 'moment'
import Echo from 'laravel-echo'
import VueRouter from 'vue-router'
import VeeValidate from 'vee-validate'
import BootstrapSass from 'bootstrap-sass'


Vue.use(Vuex)
Vue.use(VueRouter)
Vue.use(VeeValidate, {
  errorBagName: 'veeErrors',
  fieldsBagName: 'veeFields'
})
Vue.prototype.moment = Moment


window._ = Lodash

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = $

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = Vue

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = Axios

window.axios.defaults.headers.common = {
  'X-CSRF-TOKEN': window.Laravel.csrfToken,
  'X-Requested-With': 'XMLHttpRequest',
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

const {key} = window.PUSHER_OPTIONS

if (key) {
  window.Echo = new Echo({
    broadcaster: 'pusher',
    key: key,
  })
}
