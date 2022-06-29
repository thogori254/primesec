/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VueRouter from 'vue-router';
import { BootstrapVue } from 'bootstrap-vue'
import VueSimpleAlert from "vue-simple-alert";

//import CKEditor from '@ckeditor/ckeditor5-vue';

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.use(BootstrapVue);
Vue.use(VueSimpleAlert);
//Vue.use(IconsPlugin);
//Vue.component('ckeditor', CKEditor.component);
Vue.component('modal', require('./components/Modal.vue').default);
Vue.component('chart', require('./components/admin/Chart.vue').default);
const DashBoard = require('./components/admin/Dashboard.vue').default;
const NewArticle = require('./components/admin/NewArticle.vue').default;
const NewAnalysis = require('./components/admin/NewAnalysis.vue').default;
const NewPost = require('./components/admin/NewPost.vue').default;
const EditHomepage = require('./components/admin/EditHome.vue').default;
const Subscriptions = require('./components/admin/Subscription.vue').default;
const ContentManage = require('./components/admin/Manage.vue').default;
const EditContent = require('./components/admin/EditContent.vue').default;
const EditProduct = require('./components/admin/EditProduct.vue').default;
const NotFoundComponent = require('./components/NotFound.vue').default;


// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.
const routes = [
    { path: '/', component: DashBoard },
    { path: '/new-article', component: NewArticle},
    { path: '/new-post', component: NewPost},
    { path: '/new-analysis', component: NewAnalysis},
    { path: '/edit/homepage', component: EditHomepage},
    { path: '/edit/products', component: EditProduct},
    { path: '/edit/:type/:uid', component: EditContent, props: true},
    { path: '/edit/blog/:uid', component: EditContent, props: true},
    { path: '/edit/analysis/:uid', component: EditContent, props: true},
    { path: '/manage-content', component: ContentManage},
    { path: '/subscriptions', component: Subscriptions},
    { path: '*', component: NotFoundComponent }
];


// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
});
Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#admin',
    router: router,
    data: {

    },
   
    
});
