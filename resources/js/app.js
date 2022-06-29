/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VueRouter from 'vue-router';
import Axios from 'axios';


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
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('twitter-feed', require('./components/Twitter.vue').default);
const Home = require('./components/Home.vue').default;
const Products = require('./components/Products.vue').default;
const ArticlesView = require('./components/Articles.vue').default;
const AnalysisView = require('./components/Analysis.vue').default;
const Blog = require('./components/Blog.vue').default;
const Post = require('./components/Post.vue').default;
const BlogView = require('./components/BlogView.vue').default;
const ContactUs = require('./components/ContactUs.vue').default;
const NotFoundComponent = require('./components/NotFound.vue').default;
Vue.use(VueRouter);

// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.
const routes = [
    { path: '/', component: Home },
    { path: '/products', component: Products },
    { path: '/blog', name: 'blogs', component: Blog },
    { path: '/analysis', component: AnalysisView },
    { path: '/articles', component: ArticlesView },
    { path: '/post/:id', component: Post, props: true },
    { path: '/blog/:uid', name: 'blog', component: BlogView, props: true },
    { path: '/contact-us', component: ContactUs },
    { path: '*', component: NotFoundComponent }
];


// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
    mode: 'history',
    routes: routes 
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const STATUS_INITIAL = 0, STATUS_SAVING = 1, STATUS_SUCCESS = 2, STATUS_FAILED = 3;

const app = new Vue({
    el: '#minion',
    router: router,
    mounted() {
        console.log('Component mounted.',  this.id);
        // let externalScript = document.createElement('script')
        // externalScript.setAttribute('src', 'https://platform.twitter.com/widgets.js');
        // externalScript.setAttribute('charset', 'utf-8');
        // externalScript.async = true;
        // externalScript.defer = true;
        // const element = document.getElementById("footer-timeline"); 

        // if(document.head.contains(externalScript)){
        //     console.log('Script not empty', this.count);
        // }else{
        //     console.log('Script empty', this.count);
        //     document.head.appendChild(externalScript);
        // }
        
    },
    data: {
        showHomePage: true,
        showProductsPage: false,
        showArticlesPage: false,
        showBlogsPage: false,
        showContactUsPage: false,
        currentStatus: STATUS_INITIAL,
        savingMailing: false,
        savedMailing: false,
        mailingFailed: false,
        newMail: '',
        errors: [],
    },
    methods: {
        showHome(){
            this.showHomePage = true;
            this.showProductsPage = false;
            this.showArticlesPage = false;
            this.showBlogsPage = false;
            this.showContactUsPage = false;
            return true;
        },
        showProducts(){
            this.showHomePage = false;
            this.showProductsPage = true;
            this.showArticlesPage = false;
            this.showBlogsPage = false;
            this.showContactUsPage = false;
            return true;
        },
        showArticles(){
            this.showHomePage = false;
            this.showProductsPage = false;
            this.showArticlesPage = true;
            this.showBlogsPage = false;
            this.showContactUsPage = false;
            return true;
        },
        showBlog(){
            this.showHomePage = false;
            this.showProductsPage = false;
            this.showArticlesPage = false;
            this.showBlogsPage = true;
            this.showContactUsPage = false;
            return true;
        },
        showContactus(){
            this.showHomePage = false;
            this.showProductsPage = false;
            this.showArticlesPage = false;
            this.showBlogsPage = false;
            this.showContactUsPage = true;
            return true;
        },
        createMailing(){
            this.errors = [];
            if(this.newMail == ''){
                this.mailingFailed = true;
                this.errors.push("Email cannot be empty.");
                return;
            }
            this.savingMailing = true;
            this.mailingFailed = false;
            /*
                Initialize the form data
            */
            let formData = new FormData();

            this.currentStatus = STATUS_SAVING;

            //let file = this.fileList[key];
            formData.append('email', this.newMail);
            console.log(formData);
            /*
                *
                Make the request to the POST /multiple-files URL
            */

            axios.post( '/api/mailing',
                formData,
                {'Accept': 'application/json'}
            ).then(data => {
                console.log('SUCCESS!!', data);
                this.currentStatus = STATUS_SUCCESS;
                this.savedMailing = true;
                this.savingMailing = false;
                //optionally refetch records here
            })
            .catch(err => {
                console.log('FAILURE!!', err);
                this.currentStatus = STATUS_FAILED;
                this.savingMailing = false;
                this.mailingFailed = true;
                this.errors.push("Looks like this Email is not valid or has already been registered.");
            });

        }

    }
    
});
