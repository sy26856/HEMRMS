
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-default/index.css';

Vue.component('example', require('./components/Example.vue'));
Vue.component('elm', require('./components/Elm.vue'));

Vue.use(ElementUI);

const app = new Vue({
    el: '#app'
});
