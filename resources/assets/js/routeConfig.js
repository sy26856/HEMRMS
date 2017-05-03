import UserInfoRead from './components/users/UserInfoRead.vue'
import UserInfoEdit from './components/users/UserInfoEdit.vue'
import UserChangepsw from './components/components/ChangePassword.vue';
import UserRegistes from './components/users/Registes.vue';
import DocInfoRead from './components/doctors/DocInfoRead.vue';
import DocChangepsw from './components/doctors/DocChangepsw.vue';
import DocInfoEdit from './components/doctors/DocInfoEdit.vue';
import DocPassRecord from './components/doctors/DocPassRecord.vue';
import DocWriteRecord from './components/doctors/DocWriteRecord.vue';
import TodayRecord from './components/doctors/TodayRecord.vue';

// 挂号信息查询模块
import GuahaoInfo from './components/users/GuahaoInfo.vue';
import UserProject from './components/users/UserProject.vue';
import UserInProject from './components/users/UserInProject.vue';
import PassRecord from './components/users/PassRecord.vue';

// 医院基本信息
import DocInfo from './components/doctorinfo/DocInfo.vue';
import DepInfo from './components/doctorinfo/DepInfo.vue';
import BedInfo from './components/doctorinfo/BedInfo.vue';
import ProInfo from './components/doctorinfo/ProInfo.vue';

// 住院,出院
import Inhos from './components/hosinfo/Inhos.vue';
import Outhos from './components/hosinfo/Outhos.vue';
import UserInhos from './components/hosinfo/UserInhos.vue';
import UserOuthos from './components/hosinfo/UserOuthos.vue';

import CheckPro from './components/doctors/CheckPro.vue';


import home from './components/users/Home.vue';

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
        path: '/doc/todayrecord',
        component:TodayRecord
    },
    {
        path: '/user/guahaoinfo',
        component:GuahaoInfo
    },
    {
        path: '/user/project',
        component:UserProject
    },
    {
        path: '/user/passRecord',
        component:PassRecord
    },
    {
        path: '/user/inproject',
        component:UserInProject
    },
    // 医院基本信息
    {
        path: '/doc/docinfo',
        component:DocInfo
    },
    {
        path: '/doc/depinfo',
        component:DepInfo
    },
    {
        path: '/doc/bedinfo',
        component:BedInfo
    },
    {
        path: '/doc/proinfo',
        component:ProInfo
    },
    // 挂号信息
    {
        path: '/user/guahaoinfo',
        component:GuahaoInfo
    },
    {
        path: '/doc/checkPro',
        component:CheckPro
    },
    // 住院出院
    {
        path: '/doc/inhos',
        component:Inhos
    },
    {
        path: '/doc/outhos',
        component:Outhos
    },
    {
        path: '/user/inhos',
        component:UserInhos
    },
    {
        path: '/user/outhos',
        component:UserOuthos
    },
    {
        path:'*',
        component: home
    }
]