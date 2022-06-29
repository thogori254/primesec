<template>
    <div class="container">

        <div class="dropdown">
            <a class="dropdown-toggle" href="#" id="contentDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="fas fa-cog"></i>  {{selected}}
            </a>
            <div class="dropdown-menu content-options" aria-labelledby="contentDropdown">
                <a href="" @click.prevent="showArticles" class="">Articles</a>
                <a href=""  @click.prevent="showAnalysis" class="">Analysis</a>
                <a href=""  @click.prevent="showBlogs" class="">Blog</a>
            </div>
        </div>


        <div class="row justify-content-center" v-if="selected == 'articles'">
            <div class="row full-view col-md-9"  v-if="articles.length == 0">
                <div class="outer">
                    <div class="inner" v-if="loadingArticles">
                        <p>Loading articles...</p>
                    </div>
                    <div class="inner" v-if="noArticles">
                        <p>No articles...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12" id="posts-container" v-else>
                <ul v-if="articles.length > 0" class="item-list row" id="items-card">
                    <li class="col-md-6" transition="expand" v-for="(post, index) in articles" :key="index">
                        <div class="article-card"   v-bind:style="{ backgroundImage: 'url(' + post.header + ')' }" >
                            <div class="article-card-content">
                                <h4 class="article-card-header" v-html="post.title"> </h4>
                                <p>{{post.created}}</p>
                                <div class="more-container">
                                    <button type="button" class="btn btn-outline-success editsBtn" id="more-btn" v-show="!post.published" @click="publish(post.uid, post.title, index)">
                                        Publish
                                    </button>
                                    <button type="button" class="btn btn-outline-primary editsBtn" id="more-btn" @click="edit(post.uid, post.uid, index)">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-outline-danger editsBtn" id="more-btn" @click="deleteItem(post.uid, post.title, index)">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row justify-content-center" v-else-if="selected == 'analysis'">
            <div class="row col-md-9 full-view"  v-if="analysis.length == 0">
                <div class="outer">
                    <div class="inner" v-if="loadingAnalysis">
                        <p>Loading analysis...</p>
                    </div>
                    <div class="inner" v-if="noArticles">
                        <p>No analysis...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12" id="posts-container" v-else>
                <ul v-if="analysis.length > 0" class="item-list row" id="items-card">
                     <li class="col-md-6" transition="expand"  v-for="(post, index) in analysis" :key="index">
                        <div class="article-card"   v-bind:style="{ backgroundImage: 'url(' + post.header + ')' }" >
                            <div class="article-card-content">
                                <h4 class="article-card-header" v-html="post.title"> </h4>
                                <p>{{post.created}}</p>
                                <div class="more-container">
                                    <button type="button" class="btn btn-outline-success editsBtn" id="more-btn" v-show="!post.published" @click="publish(post.uid, post.title, index)">
                                        Publish
                                    </button>
                                    <button type="button" class="btn btn-outline-primary editsBtn" id="more-btn" @click="edit(post.uid, index)">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-outline-danger editsBtn" id="more-btn" @click="deleteItem(post.uid, post.title, index)">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>             
                    </li>
                </ul>
            </div>
        </div>
        <div class="row justify-content-center" v-else>
            <div class="row full-view col-md-9" v-if="loadingBlogs">
                    <div class="outer">
                        <div class="inner">
                            <p>Loading Blog Posts...</p>
                        </div>
                    </div>        
            </div>
            <div class="row full-view col-md-9" v-else-if="blogs.length == 0">
                    <div class="outer">
                        <div class="inner">
                            <p>No Blog Posts Yet...</p>
                        </div>
                    </div>        
            </div>
            <div class="posts-container col-md-12" v-else>
                <ul v-if="blogs.length > 0" class="item-list row" id="items-card">
                    <li  class="col-md-6" transition="expand" v-bind:key="post.id" v-for="(post, index) in blogs">
                                        
                         <div class="article-card"   v-bind:style="{ backgroundImage: 'url(' + post.header + ')' }" >
                            <div class="article-card-content">
                                <h4 class="article-card-header" v-html="post.title"> </h4>
                                <p>{{post.created}}</p>
                                <div class="more-container">
                                    <button type="button" class="btn btn-outline-success editsBtn" id="more-btn" v-show="!post.published" @click="publish(post.uid, post.title, index)">
                                        Publish
                                    </button>
                                    <button type="button" class="btn btn-outline-primary editsBtn" id="more-btn" @click="edit(post.uid, index)">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-outline-danger editsBtn" id="more-btn" @click="deleteItem(post.uid, post.title, index)">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>         
                    </li>
                </ul>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
            this.getArticleItems();
        },
        data() {
            return {
                selected: 'articles',
                articles: [],
                loadingArticles: false,
                noArticles: false,
                analysis: [],
                loadingAnalysis: false,
                noAnalysis: false,
                blogs: [],
                loadingBlogs: false,
                noBlogs: false,
            }
        },
        methods: {
            async showArticles(){
                this.selected = 'articles';
                this.getArticleItems();
            },
            async showAnalysis(){
                this.selected = 'analysis';
                this.getAnalysisItems();
            },
            async showBlogs(){
                this.selected = 'blogs';
                this.getBlogItems();
            },
            async deleteItem(uid, title, index){
                let route = '';
                let text = '';
                if(this.selected == 'articles'){
                    route = 'delete-article/' + uid;
                    text = 'Article deleted!';
                }else if(this.selected == 'analysis'){
                    route = 'delete-analysis/' + uid;
                    text = 'Analysis deleted!';
                }else{
                    route = 'delete-post/' + uid;
                    text = 'Blog Post deleted!';
                }
                console.log(route);

                this.$confirm("Are you sure you want to delete "+ title +"?", "", "warning").then(() => {
                    console.log("Deleting");
                    //delete post...
                    axios.post( route )
                    .then(response => {
                        console.log('SUCCESS!!', response);
                        let mylist = [];
                        if(response.data.message == 'success'){
                            if(this.selected == 'articles'){
                                this.articles.splice(index, 1);
                            }else if(this.selected == 'analysis'){
                                this.analysis.splice(index, 1);
                            }else{
                                this.blogs.splice(index, 1);
                            }
                            this.$fire({
                                title: "Success",
                                text: text,
                                type: "success",
                                timer: 3000
                            }).then(r => {
                                console.log(r.value);
                            });
                        }
                    })
                    .catch(err => {
                        console.log('FAILURE!!', err);
                    });
                }).catch(err => {console.log(err)});
                                
            },
            async edit(uid, index){
                let route = '';
                if(this.selected == 'articles'){
                    route = '/edit/article/' + uid;
                }else if(this.selected == 'analysis'){
                    route = '/edit/analysis/' + uid;
                }else{
                    route = '/edit/post/' + uid;
                }
                console.log(route);
                this.$router.push(route);
            },
            async publish(uid, title, index){
                let route = '';
                let text = '';
                if(this.selected == 'articles'){
                    route = 'publish-article/' + uid;
                    text = 'Article published!';
                }else if(this.selected == 'analysis'){
                    route = 'publish-analysis/' + uid;
                    text = 'Analysis published!';
                }else{
                    route = 'publish-post/' + uid;
                    text = 'Blog post published!';
                }
                console.log(route);
                this.$confirm("Publish "+ title +"?", "", "info").then(() => {
                    console.log("Publishing");
                    //delete post...
                    axios.post( route )
                    .then(response => {
                        console.log('SUCCESS!!', response);
                        if(this.selected == 'articles'){
                            this.articles[index].published = true;
                        }else if(this.selected == 'analysis'){
                            this.analysis[index].published = true;
                        }else{
                            this.blogs[index].published = true;
                        }
                        if(response.data.message == 'success'){
                            this.$fire({
                                title: "Success",
                                text: text,
                                type: "success",
                                timer: 3000
                            }).then(r => {
                                console.log(r.value);
                            });
                        }
                    })
                    .catch(err => {
                        console.log('FAILURE!!', err);
                    });
                }).catch(err => {console.log(err)});
            },
            async getArticleItems() {
                var _this = this;
                console.log("Getting items");
                this.loadingArticles = true;
                axios.get('/getarticles').then(function (response) {
                    console.log("Posts", response.data.data);
                    _this.articles = response.data.data;
                    _this.loadingArticles = false;

                    if(_this.articles.length == 0){
                        _this.noArticles = true;
                    }
                });
            },
            async getAnalysisItems() {
                var _this = this;
                console.log("Getting analysis");
                this.loadingAnalysis = true;

                axios.get('/getanalysis').then(function (response) {
                    console.log("Analysis", response.data.data);
                    _this.analysis = response.data.data;
                    _this.loadingAnalysis = false;

                    if(_this.analysis.length == 0){
                        _this.noAnalysis = true;
                    }
                });
            },
            async getBlogItems() {
                var _this = this;
                console.log("Getting blog items");
                this.loadingBlogs = true;

                axios.get('/getposts').then(function (response) {
                    console.log("Blog", response.data.data);
                    _this.blogs = response.data.data;
                    _this.loadingBlogs = false;

                    if(_this.blogs.length == 0){
                        _this.noBlogs = true;
                    }
                });
            },
            capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }
        }
    }
</script>
