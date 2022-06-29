<template>
    <div class="row">
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
        <div class="row col-md-9" id="posts-container" v-else>
            <ul v-if="articles.length > 0" class="item-list row" id="items-card">
                <li class="col-md-6" transition="expand" v-for="(post, index) in paginatedData" :key="index">
                    <div class="article-card"   v-bind:style="{ backgroundImage: 'url(' + post.header + ')' }" >
                                                      
                        <div class="share-icons" id="share" v-show="shareIcons == post.uid" >
                            <!-- AddToAny BEGIN -->
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style"  v-bind:data-a2a-url="baseUrl + post.uid" v-bind:data-a2a-title="title">
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_twitter"></a>
                                <a class="a2a_button_email"></a>
                                <a class="a2a_button_whatsapp"></a>
                                <a class="a2a_button_telegram"></a>
                                <a class="a2a_button_google_gmail"></a>
                                <a class="a2a_button_linkedin"></a>
                            </div>
                            <!-- AddToAny END -->
                        </div>
                        <div class="article-card-content" @click="readMore(post.uid, index)">
                            <h4 class="article-card-header" v-html="post.title" @click="readMore(post.uid, index)"> </h4>
                            <p>{{post.created}}</p>
                        </div>
                        <button @click.prevent="share(post)" class="product-pencil iconShare"><i class="fas fa-share-alt"></i></button>           
                    </div>      
                </li>
            </ul>
            <div class="page-number">
                <label for="pageNumber" v-bind:key="index" v-for="(page, index) in pages" class="page-label"  @click="showPage(page)">{{page}}</label>
            </div>
        </div>
        <twitter-feed v-bind:recents = "recents"></twitter-feed>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            this.getArticleItems();
            let externalScript = document.createElement('script')
            externalScript.setAttribute('src', 'https://platform.twitter.com/widgets.js');
            externalScript.setAttribute('charset', 'utf-8');
            externalScript.async = true;
            externalScript.defer = true;
            const element = document.getElementById("home-timeline"); 
            const shareElement = document.getElementById("share"); 

            let shareJs = document.createElement('script')
            shareJs.setAttribute('src', 'https://static.addtoany.com/menu/page.js');
            shareJs.setAttribute('charset', 'utf-8');
            shareJs.async = true;
            shareJs.defer = true;
            const head = document.head; 
            head.appendChild(shareJs);

            if(document.head.contains(externalScript)){
                console.log('Script not empty', this.count);
            }else{
                console.log('Script empty', this.count);
                element.appendChild(externalScript);
            }
        
        },
        data(){
            return {
                articles: [],
                loadingArticles: true,
                noArticles: false,
                recents: null,
                baseUrl: 'https://primesecke.com/articles/',
                shareIcons: null,
                url: '',
                title: '',
                pageNumber: 0,
                size: 6,
            }
        },
        computed: {
            pageCount() {
                let l = this.articles.length,
                    s = this.size;
                return Math.ceil(l/s);
            },
            paginatedData(){
                const start = this.pageNumber * this.size,
                    end = start + this.size;
                return this.articles.slice(start, end);
            },
            pages(){
                let pages = [];
                for (let count = 1; count <= this.pageCount; count++) {
                    pages.push(count);                    
                }
                return pages;
            }
        },
        methods: {
            async getArticleItems() {
                var _this = this;
                console.log("Getting items");

                axios.get('/api/getarticles').then(function (response) {
                    console.log("Posts", response.data.data);
                    _this.articles = response.data.data;
                    _this.loadingArticles = false;

                    if(_this.articles.length == 0){
                        _this.noArticles = true;
                    }
                    _this.getRecents();
                });

            },
            share(item) {
                console.log("share", item);
                if(this.shareIcons == item.uid){
                    this.shareIcons = null;
                    this.url = '';
                    this.title = '';
                }else{
                    this.url = this.baseUrl + item.uid;
                    this.title = item.title;
                    this.shareIcons = item.uid;                    
                }

                console.log("share", this.$data);
            },
            async showPage(page){
                //Subtract one from value since pages start at 0
                this.pageNumber = page - 1;
            },
            async readMore(id, index) {
                var _this = this;
                console.log("Getting view more", id, index);
                let post = this.articles[index];
                console.log("Post", post);
                window.location.href = '/article/'+id;
                //this.$router.push({ name: 'article', params: post });
            },
            async getRecents() {
                var _this = this;

                axios.get('/api/getrecents').then(function (response) {
                    console.log("details", response.data);
                    _this.recents = response.data;
                });


            },
            nextPage(){
                let page = this.pageNumber + 1;
                if(page < this.pageCount ){
                    this.pageNumber++;
                }
            },
            prevPage(){
                let page = this.pageNumber - 1;
                if(page >= 0 ){
                    this.pageNumber--;
                }
            }
        }
    }
</script>
