import AuthMiddleware from '@middleware/authMiddleware'
import GuestMiddleware from '@middleware/guestMiddleware'
import Home from '@pages/Home.vue'
import Contact from '@pages/Contact.vue'
import Login from '@pages/auth/Login.vue'
import Register from '@pages/auth/Register.vue'
import Error404 from '@pages/Error404.vue'
import UserList from '@pages/users/UserList.vue'


const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
  },
  {
    path: '/contact',
    name: 'contact',
    component: Contact,
    beforeEnter: AuthMiddleware,
  },
  {
    path: '/users',
    name: 'users',
    component: UserList,
    beforeEnter: AuthMiddleware,
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    beforeEnter: GuestMiddleware,
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    beforeEnter: GuestMiddleware,
  },
  {
    path: '*',
    name: '404',
    component: Error404,
  },
]


export default routes
