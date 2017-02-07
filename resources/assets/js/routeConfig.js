import UserInfoRead from './components/users/UserInfoRead.vue'
import UserInfoEdit from './components/users/UserInfoEdit.vue'
import UserChangepsw from './components/components/ChangePassword.vue';
import UserRegistes from './components/users/Registes.vue';
import DocInfoRead from './components/doctors/DocInfoRead.vue';
import DocChangepsw from './components/doctors/DocChangepsw.vue';
import DocInfoEdit from './components/doctors/DocInfoEdit.vue';
import DocPassRecord from './components/doctors/DocPassRecord.vue';
import DocWriteRecord from './components/doctors/DocWriteRecord.vue';


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
        component:UserChangepsw
    },
    {
        path: '/user/registes',
        component:UserRegistes
    },
    {
        path: '/doc/index',
        component:home
    },
    {
        path: '/doc/inforead',
        component:DocInfoRead
    },
    {
        path: '/doc/changepsw',
        component:DocChangepsw
    },
    {
        path: '/doc/infoedit',
        component:DocInfoEdit
    },
    {
        path: '/doc/passrecord',
        component:DocPassRecord
    },
    {
        path: '/doc/writerecord',
        component:DocWriteRecord
    },
    {
        path:'*',
        component: home
    }
]