<template>
    <div class="row justify-content-center notfound-body">
        <div class="col-md-8">
            <div>
                Uh Oh...We could not find the page you requested.
                <div class="box-link-parent">
                    <div  class="box-link">
                        <a href=""  @click.prevent="toHome()"> Take me Home </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            let navs = document.querySelectorAll('.navbar')           // Hide
            let footers = document.querySelectorAll('.my-footer');
            this.hide(navs);
            this.hide(footers);
        },
        methods: {
            toHome(){
                console.log("Reset run");
                this.showNavs();
                this.showFooters();
                this.$router.push('/');
            },
            hide (elements) {
                elements = elements.length ? elements : [elements];
                console.log("hiding", elements);
                for (var index = 0; index < elements.length; index++) {
                    elements[index].style.display = 'none';
                }
            },
            showNavs () {
                let elements = document.querySelectorAll('.navbar');
                elements = elements.length ? elements : [elements];
                for (var index = 0; index < elements.length; index++) {
                    elements[index].style.display = 'flex';
                }
            },
            showFooters () {
                let elements = document.querySelectorAll('.my-footer');
                elements = elements.length ? elements : [elements];
                for (var index = 0; index < elements.length; index++) {
                    elements[index].style.display = 'block';
                }
            }
        }
    }
</script>
