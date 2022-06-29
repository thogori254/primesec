<template>
    <div>
        <div class="row home-container">
            <div class="row" v-if="isLoading">
                ....
            </div>
            <div class="left" v-else>
                <h3 class="home-title" v-html="homeTitle"></h3>
                <section class="home-content" v-html="homeData">
                   
                </section>
                
            </div>
        
            <twitter-feed  v-bind:recents="recents"></twitter-feed>
   
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
            this.getBlogDetails();
        },
        computed: {
            isLoading() {
                return this.homeData === '' && this.homeTitle === '';
            },
            backgroundNull() {
                return this.homeImage === null;
            }
        },
        data() {
            return {
                homeData: '',
                homeTitle: '',
                homeImage: '',
                recents: null,
            }
        },
        methods: {
            toBottom(){
                window.scrollTo(0, document.body.scrollHeight || document.documentElement.scrollHeight);
            },
            populateFeed(){
                let externalScript = document.createElement('script')
                externalScript.setAttribute('src', 'https://platform.twitter.com/widgets.js');
                externalScript.setAttribute('charset', 'utf-8');
                externalScript.async = true;
                externalScript.defer = true;
                const element = document.getElementById("home-timeline"); 

                if(document.head.contains(externalScript)){
                    console.log('Script not empty', this.count);
                }else{
                    console.log('Script empty', this.count);
                    element.appendChild(externalScript);
                }
            },
            async getBlogDetails() {
                var _this = this;
                console.log("Getting details");

                axios.get('/api/getblogdetails').then(function (response) {
                    console.log("details", response.data);
                    _this.homeTitle = response.data.title;
                    _this.homeData = response.data.article;
                    _this.homeImage = response.data.image_url;
                    _this.populateFeed();
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
            
        }
    }
</script>