import UserInfoRead from './components/users/UserInfoRead.vue'
import UserInfoEdit from './components/users/UserInfoEdit.vue'
import changepsw from './components/components/ChangePassword.vue';
import registes from './components/users/Registes.vue';


import home from './components/users/Home.vue'

export default [
    {
        path:'/user/inforead',
        component:UserInfoRead
    },
    {
        path:'/user/infoedit',
        component:UserInfoEdit
    },
    {
        path: '/user/changepsw',
        component:changepsw
    },
    {
        path: '/user/registes',
        component:registes
    },
    {
        path:'*',
        component: home
    }
]