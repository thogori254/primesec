<template>
    <div class="col-md-3 mb-md-0 mb-3 bottomSupport">
        <div class="side-tweet float-right" id="home-timeline">
            <label>Recent writings</label>
            <div v-if="recents == null">

            </div>
            <div class="recents-container" v-else>
                <h5 transition="expand"  @click="goTo(recent)" class="recents-title" v-for="recent in recents">&#187;&nbsp;&nbsp;{{recent.title}}</h5>
            </div>
            <a class="twitter-timeline" href="https://twitter.com/PrimeSecKe?ref_src=twsrc%5Etfw">Tweets by PrimeSecKe</a>
        <!--<Tweet id="1255813141012905985"></Tweet>
        Timeline id="twitterdev" sourceType="profile" />-->
        </div>
<!--        <a href="" class="box-link" @click.prevent="toBottom()"> SUBSCRIBE </a>-->
    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: ['recents'],
        methods: {
            toBottom(){
                window.scrollTo(0, document.body.scrollHeight || document.documentElement.scrollHeight);
            },
            async goTo(post) {
                var _this = this;
                let url = '/' + post.type + '/' + post.slug;
                window.location.href = url;
            },
        }
    }
</script>
