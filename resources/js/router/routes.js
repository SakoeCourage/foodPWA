import AddFood from '../views/AddFood.vue'
import Home from '../views/Home.vue'
import Meetup from '../views/Meetup.vue'
import Notifications from '../views/Notifications.vue'
import Settings from '../views/Settings.vue'
import Viewdish from '../views/Viewdish.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Createprofile from '../views/Createprofile.vue'

const routes = [{
        path: '/',
        component: Home,
        name: "Home",
        meta: {
            NotfullScreen: false,
        }
    },
    {
        path: '/add',
        name: 'AddDish',
        component: AddFood,
        meta: {
            NotfullScreen: false,
        }
    },
    {
        path: '/meetup',
        component: Meetup,
        meta: {
            fullScreen: false,
        }
    },
    {
        path: '/notifications',
        component: Notifications,
        meta: {
            fullScreen: false,
        }
    },
    {
        path: '/viewdish/:slug',
        component: Viewdish,
        name: 'Viewdish',
        meta: {
            fullScreen: true,
        }
    },
    {
        path: '/settings',
        component: Settings,
        name: 'Settings',
        meta: {
            fullScreen: false,
        }
    },
    {
        path: '/login',
        component: Login,
        name: 'Login',
        meta: {
            fullScreen: true,
        }
    },
    {
        path: '/register',
        component: Register,
        name: 'Register',
        meta: {
            fullScreen: true,
        }
    },
    {
        path: '/profile/create',
        component: Createprofile,
        name: 'createprofile',
        meta: {
            fullScreen: true,
        }
    },
]

export default routes