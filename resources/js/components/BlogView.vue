<template>
    <div>
    <div class="post-container" v-if="post == null || loading">
        <p>Loading...</p>
    </div>
    <div class="article" id="blog-view" v-else>
            <div class="article-img" id="blog-img" @click="showPost(post.uid)" v-bind:style="{ backgroundImage: 'url(' + post.header + ')' }" v-if="post.header !== null"> 
            </div>
            <div class="mobileBlog" @click="showPost(post.uid)" v-else></div>
            <div class="article-content" id="blog-content" v-if="post.header !== null">
                <h4 class="article-header" @click="showPost(post.uid)" v-html="post.title"> </h4>
                <div class="blog-container" v-bind:id="'collapsed'+post.uid" v-html="post.content"></div>
            </div>
            <div class="article-content" id="blog-content" v-else style="width: 100%;">
                <h4 class="article-header" @click="showPost(post.uid)" v-html="post.title"> </h4>
                <div class="blog-container" v-bind:id="'collapsed'+post.uid" v-html="post.content"></div>
            </div>
        </div> 

                <a href="" class="box-link" @click.prevent="toBlogs()"> <i class="fas fa-arrow-left"></i> View More Posts </a>
    </div>    
    
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.',  this.id);
            console.log(this.post,  this.uid);
            this.getBlogItem();
            
        },
        props: ['id','uid','header','title','content','claps','by','created'],
        data() {
            return {
                post: null,
                loading: false,
            }
        },
        methods: {
            getBlogItem() {
                var _this = this;
                console.log("Getting item");
                axios.get('/api/post/'+this.uid).then(function (response) {
                    console.log("Blog", response.data.data);
                    _this.post = response.data.data;
                });

            },
            async toBlogs() {
                var _this = this;
                this.$router.push({ name: 'blogs'});
            },
        }
    }
</script>
