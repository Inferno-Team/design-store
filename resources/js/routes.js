
import Home from './views/Home'
import Login from './views/Login'
import AddDesign from './views/AddDesign'
import ShowAllRequests from './views/ShowAllRequests'

export const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/add-design',
        name: 'add-design',
        component: AddDesign
    },
    {
        path: '/show-requests',
        name: 'show-requests',
        component: ShowAllRequests
    }

];