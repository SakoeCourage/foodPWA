import AddFood from '../views/AddFood.vue'
import Home from '../views/Home.vue'
import Messages from '../views/Messages.vue'
import Notifications from '../views/Notifications.vue'
import Settings from '../views/Settings.vue'
import Viewdish from '../views/Viewdish.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'

const routes = [{
        path: '/',
        component: Home,
        name: "Home"
    },
    {
        path: '/add',
        name: 'AddDish',
        component: AddFood
    },
    {
        path: '/messages',
        component: Messages
    },
    {
        path: '/notifications',
        component: Notifications
    },
    {
        path: '/viewdish/:slug',
        component: Viewdish,
        name: 'Viewdish'
    },
    {
        path: '/settings',
        component: Settings,
        name: 'Settings'
    },
    {
        path: '/login',
        component: Login,
        name: 'Login'
    },
    {
        path: '/register',
        component: Register,
        name: 'Register'
    },
]

export default routes