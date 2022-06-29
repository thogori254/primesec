<template>
  <div class="products full-view">
        <div>
            <h4 class="section-header">OUR PRODUCTS</h4>
        </div>
        <div class="row productsRow">
            <div class="product-container" v-bind:key="index" v-for="(item, index) in products">
                <div class="product-icon">
                    <i class="fas" v-bind:class="item.icon"></i>
                </div>

                <div class="product-header" v-html="item.title"></div>

                <div class="product-content" v-html="item.content">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            this.getProductItems();
        },
        data(){
            return {
                products: [],
            }
        },
        methods: {
            async getProductItems() {
                var _this = this;
                console.log("Getting items");
                this.loading = true;
                axios.get('/api/getproducts').then(function (response) {
                    console.log("Products", response.data.data);
                    _this.products = response.data.data;
                    _this.loading = false;
                });

            },
        }
    }
</script>