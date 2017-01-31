import UserInfoRead from './components/users/UserInfoRead.vue'
import UserInfoEdit from './components/users/UserInfoEdit.vue'
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
        path:'*',
        component: home
    }
]