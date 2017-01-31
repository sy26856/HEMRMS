
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//引入vue-router
var VueRouter = require('vue-router');
//引入axios
// var axios = require('axios');
// import axios from 'axios'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-default/index.css';
import routes from './routeConfig.js'

import example from './components/components/Example.vue';
import sex from './components/components/Sex.vue';
import birth from './components/components/Birthday.vue';
import logout from './components/components/Logout.vue';
import userleftbar from './components/users/UserLeftBar.vue';

Vue.use(ElementUI);
Vue.use(VueRouter);

const router=new VueRouter({
    mode: 'history', //切换路径模式，变成history模式
    routes
});

const app = new Vue({
    el: '#app',
    router,
    components:{
        example,
        birth,
        sex,
        logout,
        userleftbar,
    }
});
