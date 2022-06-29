<template>
    <div class="container">
        <div class="row full-view col-md-9" v-if="loading">
                <div class="outer">
                    <div class="inner">
                        <p>Loading...</p>
                    </div>
                </div>        
        </div>
        <div v-else>
            <button class="btn btn-outline-success editsBtn" v-on:click="newProduct()"> <i class="fas fa-plus"></i> Add New</button>
            <div class="row">
                    <div class="product-container product-edit" v-bind:key="index" v-for="(item, index) in products">
                        <button v-on:click="setSelected(item)" class="product-pencil"><i class="fas fa-edit"></i></button>
                        <div class="product-icon">
                            <i class="fas" v-bind:class="item.icon"></i>
                        </div>
                        <div class="iconEdit" v-if="selected == item.id">
                            <label for="icon">Icon</label>
                            <select 
                            name="icon" 
                            id="icon-select" 
                            class="form-control"
                            required 
                            v-model="iconName"
                            @change="setIcon(index)">
                                <option v-bind:value="icon" v-bind:key="index" v-for="(icon, index) in icons" v-on:select="selectedIcon(value)"><i class="fas" v-bind:class="icon"></i>{{icon}}</option>
                            </select>
                        </div>
                        <div class="iconEdit" v-if="selected == item.id">
                            <label for="title">Title</label>
                            <ckeditor 
                                :editor="editor"
                                :config="productConfig"
                                v-model="editorTitle"
                                >
                            </ckeditor>
                        </div>
                        <div class="product-header" v-else v-html="item.title"></div>
                        
                        <div class="iconEdit" v-if="selected == item.id">
                            <label for="body">Body</label>
                            <ckeditor 
                                :editor="editor"
                                :config="productConfig"
                                v-model="editorData"
                                v-if="selected == item.id">
                            </ckeditor>
                        </div>
                        <div class="product-content" v-else v-html="item.content">
                        </div>

                        <div v-if="selected == item.id">
                            <label for="position">Position in list</label>
                            <input class="form-control" type="number" name="position" v-model="position" id="">
                        </div>
                        <br>
                        
                        <button class="btn btn-outline-success editsBtn" v-on:click="saveSelected(item.id)" v-if="selected == item.id"> Save</button>
                    </div>
            </div>
        </div>
        <b-modal
            id="modal-new-product"
            ref="modal"
            title="New Product"
            @show="resetModal"
            @hidden="resetModal"
            @ok="handleOk"
            >
                <div class="container">
                    <div class="product-icon">
                        <i class="fas" v-bind:class="iconName"></i>
                    </div>
                    <div class="iconEdit">
                        <label for="icon">Icon</label>
                        <select 
                        name="icon" 
                        id="icon-select" 
                        class="form-control"
                        required 
                        v-model="iconName"
                        >
                            <option v-bind:value="icon" v-bind:key="index" v-for="(icon, index) in icons"><i class="fas" v-bind:class="icon"></i>{{icon}}</option>
                        </select>
                    </div>
                    <div class="iconEdit">
                        <label for="title">Title</label>
                        <ckeditor 
                            :editor="editor"
                            :config="productConfig"
                            v-model="editorTitle"
                            >
                        </ckeditor>
                    </div>
                    
                    <div class="iconEdit">
                        <label for="body">Body</label>
                        <ckeditor 
                            :editor="editor"
                            :config="productConfig"
                            v-model="editorData"
                            >
                        </ckeditor>
                    </div>

                    <div class="iconEdit">
                        <label for="position">Position in list</label>
                        <input class="form-control" type="number" name="postion" v-model="position" id="">
                    </div>
                </div>
        </b-modal>
    </div>
</template>

<script>
    import CKEditor from '@ckeditor/ckeditor5-vue';
    import InlineEditor from '@ckeditor/ckeditor5-build-inline';
    
    export default {
        mounted() {
            console.log('Component mounted.');
            this.getProductItems();
            this.getIconsList();
        },
        components: {
            // Use the <ckeditor> component in this view.
            ckeditor: CKEditor.component
            
        },
        data(){
            return {
                editor: InlineEditor,
                selected: null,
                position: null,
                loading: false,
                editorData: '',
                editorTitle: '',
                products: [],
                iconName: '',
                icons: [],                
                productConfig: {
                    placeholder: "Product Description",
                    uploadUrl: 'https://admin.primesecke.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json'
                },
            }
        },
        methods: {
            setSelected(item){
                if(this.selected == item.id){
                    this.selected = null;
                }else{
                    this.selected = item.id;
                    this.iconName = item.icon;
                    this.editorTitle = item.title;
                    this.editorData = item.content;
                    this.position = item.position;
                }
            },
            setIcon(index){
                console.log("Icon",index);
                this.products[index].icon = this.iconName;
            },
            newProduct(){
                console.log("New Product")
                this.selected = 'new';
                this.$bvModal.show('modal-new-product');
            },
            saveSelected(id){
                if(this.isValid()){
                    this.updateItem(id);
                }
            },
            isValid(){
                if(this.editorTitle === '' || this.editorTitle === null){
                    return false;
                }
                if(this.editorData === '' || this.editorData === null){
                    return false;
                }

                return true;
            },
            async updateItem(uid){
                let route = '/saveproduct';
                let text = 'Product updated!';
                console.log(route);
                this.$confirm("Update product?", "", "info").then(() => {
                    console.log("Updating");
                    let data = {
                        id: uid,
                        title: this.editorTitle,
                        icon: this.iconName,
                        content: this.editorData,
                        position: this.position
                    }

                    //delete post...
                    axios.post(route,data)
                    .then(response => {
                        console.log('SUCCESS!!', response);
                        if(response.data.message == 'success'){
                            if(this.selected == 'new'){
                                this.$bvModal.hide('modal-new-product');
                                this.products.push(response.data.data);
                            }
                            this.selected = null;
                            this.position = null;
                            this.editorData = '';
                            this.editorTitle = '';
                            this.iconName = '';

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
            async getIconsList() {
                var _this = this;
                console.log("Getting icons");

                axios.get('/api/icons').then(function (response) {
                    console.log("icons", response.data);
                    _this.icons = response.data;
                });

            },
            resetModal() {
                this.iconName = '';
                this.editorData = '';
                this.editorTitle = '';
                this.position = null;
            },
            handleOk(bvModalEvt) {
                // Prevent modal from closing
                bvModalEvt.preventDefault()
                // Trigger submit handler
                this.saveSelected('new')
            },
        }
    }
</script>
