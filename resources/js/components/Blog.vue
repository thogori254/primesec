<template>
    <div class="row">
        <div class="row full-view col-md-9" v-if="loadingPosts">
                <div class="outer">
                    <div class="inner">
                        <p>Loading Blog Posts...</p>
                    </div>
                </div>        
        </div>
        <div class="row full-view col-md-9" v-else-if="posts.length == 0">
                <div class="outer">
                    <div class="inner">
                        <p>No Blog Posts Yet...</p>
                    </div>
                </div>        
        </div>
        <div class="posts-container col-md-9" v-else>
            <ul v-if="posts.length > 0" class="item-list" id="items-card">
                <li transition="expand" v-bind:key="post.id" v-for="post in paginatedData">
                                    
                    <div class="article" id="blog">
                        <div class="article-img" id="blog-img" @click="showPost(post.uid)" v-bind:style="{ backgroundImage: 'url(' + post.header + ')' }" v-if="post.header !== null"> 
                        </div>
                        <div class="mobileBlog" @click="showPost(post.uid)" v-else></div>
                        <div class="article-content" id="blog-content" v-if="post.header !== null">
                            <h4 class="article-header" @click="showPost(post.uid)" v-html="post.title"> </h4>
                            <div class="blog-container" v-bind:id="'collapsed'+post.uid" v-html="post.content"></div>
                            <div class="blog-icons" >
                                <!-- AddToAny BEGIN -->
                                <div class="a2a_kit a2a_kit_size_32 a2a_default_style" v-show="shareIcons == post.uid" v-bind:data-a2a-url="baseUrl + post.uid" v-bind:data-a2a-title="title">
                                    <a class="a2a_button_facebook"></a>
                                    <a class="a2a_button_twitter"></a>
                                    <a class="a2a_button_email"></a>
                                    <a class="a2a_button_whatsapp"></a>
                                    <a class="a2a_button_telegram"></a>
                                    <a class="a2a_button_google_gmail"></a>
                                    <a class="a2a_button_linkedin"></a>
                                </div>
                                <!-- AddToAny END -->
                                <button @click.prevent="share(post)" class="product-pencil blog-share"><i class="fas fa-share-alt"></i></button>   
                            </div>
                        </div>
                        <div class="article-content" id="blog-content" v-else style="width: 100%;">
                            <h4 class="article-header" @click="showPost(post.uid)" v-html="post.title"> </h4>
                            <div class="blog-container" v-bind:id="'collapsed'+post.uid" v-html="post.content"></div>
                            <div class="blog-icons">
                                <!-- AddToAny BEGIN -->
                                <div class="a2a_kit a2a_kit_size_32 a2a_default_style"  v-show="shareIcons == post.uid" v-bind:data-a2a-url="baseUrl + post.uid" v-bind:data-a2a-title="title">
                                    <a class="a2a_button_facebook"></a>
                                    <a class="a2a_button_twitter"></a>
                                    <a class="a2a_button_email"></a>
                                    <a class="a2a_button_whatsapp"></a>
                                    <a class="a2a_button_telegram"></a>
                                    <a class="a2a_button_google_gmail"></a>
                                    <a class="a2a_button_linkedin"></a>
                                </div>
                                <!-- AddToAny END -->
                                <button @click.prevent="share(post)" class="product-pencil blog-share" id="blog-share"><i class="fas fa-share-alt"></i></button>   
                            </div>
                        </div>
                    </div>        
                </li>
            </ul>
            <div class="page-number">
                <label for="pageNumber" v-bind:key="index" v-for="(page, index) in pages" class="page-label"  @click="showPage(page)">{{page}}</label>
            </div>
        </div>
        <twitter-feed v-bind:recents = "recents"></twitter-feed>
        <div id="share"></div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            this.getBlogItems();
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


            console.log('Mobile', this.isMobile());
            element.appendChild(externalScript);
        },
        data(){
            return {
                posts: [],
                loadingPosts: true,
                recents: null,
                displayed: 'block',
                hidden: 'none',
                selectedId: null,
                shareIcons: null,
                baseUrl: 'https://primesecke.com/blog/',
                url: '',
                title: '',
                pageNumber: 0,
                size: 6,
            }
        },
        computed: {
            isSelected: function (id) {
                let status = this.displayed;
                if(this.isMobile()){
                    if(this.selectedId !== id){
                        status = this.hidden;
                    }
                }
                return status;
            },
            pageCount() {
                let l = this.posts.length,
                    s = this.size;
                return Math.ceil(l/s);
            },
            paginatedData(){
                const start = this.pageNumber * this.size,
                    end = start + this.size;
                return this.posts.slice(start, end);
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
            getBlogItems() {
                var _this = this;
                console.log("Getting items");

                axios.get('/api/getposts').then(function (response) {
                    console.log("Posts", response.data.data);
                    _this.posts = response.data.data;
                    _this.loadingPosts = false;
                    _this.getRecents();
                });

            },
            async getRecents() {
                var _this = this;

                axios.get('/api/getrecents').then(function (response) {
                    console.log("details", response.data);
                    _this.recents = response.data;
                });


            },
            async showPost(uid) {
                let prevId = this.selectedId;
                this.selectedId = uid;
                let status = this.displayed;
                console.log("show Post");
                console.log("Prev Id", prevId);

                //Prevent hiding same element if clicked twice
                if(prevId !== null && prevId !== uid){
                    if (this.isMobile()){
                        let elementId = 'collapsed' + prevId;
                        const element = document.getElementById(elementId);
                        element.style.display = this.hidden; 
                    } else {

                    }
                }

                if(this.isMobile()){
                    let elementId = 'collapsed' + uid;
                    const element = document.getElementById(elementId);
                    console.log("Show", element);

                    if(element.style.display == this.displayed){
                        element.style.display = this.hidden; 
                    }else{
                        element.style.display = this.displayed; 
                    }
                }
            },
            async showPage(page){
                //Subtract one from value since pages start at 0
                this.pageNumber = page - 1;
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
            
            isMobile() {
                let check = false;
                (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
                return check;
            },
        }
    }
</script>
