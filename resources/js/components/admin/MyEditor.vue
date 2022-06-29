<template>
    <div class="container"  id="inlineEditor">
        <div class="file-upload">
            <label style="display: block;"> {{this.type}} Header </label>
            <div class="form-group image-upload-wrap" v-show="!itsAnEdit">
                <input class="file-upload-input" type="file" name="files" v-on:change="readURL($event.target)" accept="image/*"></input>
                <div class="drag-text">
                <h5> Drag and drop a file or select add image </h5>
                </div>
            </div>
            
            <div class="file-upload-content" v-if="!itsAnEdit">
                <img class="file-upload-image" src="#" alt="header image"></img>
                <div class="image-title-wrap">
                <button type="button" class="file-upload-btn"  onclick="$('.file-upload-input').trigger( 'click' )" > Change Header image </button>
                </div>
            </div>
            <div v-else>
                <div class="img-edit-container">
                    <img class="file-upload-image" src="#" alt="header image" v-if="headerChanged"></img>
                    <div class="file-upload-edit" v-bind:style="{ backgroundImage: 'url(' + headerUrl + ')' }" v-else></div>
                    <div class="image-edit-wrap">
                        <button type="button" class="file-upload-btn more-btn"  onclick="$('.file-upload-input').trigger( 'click' )" > Change Header image </button>
                    </div>
                </div> 
            </div>
            <span v-if="headerError"> <small>Header is required!</small> </span>
        </div>
       
        <div class="inline-editor">
            <label style="display: block;" v-if="editorTitle !== ''"> {{this.type}} Title </label>
            <!-- <div class="ck-content">
                <ckeditor 
                :editor="editor"
                :config="titleConfig"
                v-model="editorTitle"
                >
                </ckeditor>
            </div> -->
            <input class="form-control" id="header-create" v-model="editorTitle" type="text" :placeholder="this.type + ' Title'"></input>

            <span v-if="titleError && editorTitle === ''"> <small>{{this.type}} Title cannot be empty!</small> </span>
        </div>
        <div class="inline-editor">
            <label style="display: block;" v-if="editorData !== ''"> {{this.type}} Body </label>
            <div class="ck-content">
                <ckeditor 
                :editor="editor"
                :config="postConfig"
                v-model="editorData">
                </ckeditor>
            </div>
            <span v-if="bodyError  && editorData === ''"> <small>{{this.type}} Body cannot be empty!</small> </span>
        </div>
        <div class="inline-editor">
            <label style="display: block;" v-if="articleCategory !== 'null'"> {{this.type}} Category </label>
            <select class="custom-select" v-model="articleCategory" v-on:change="checkSelection()">
                <option value="null">Select {{this.type}} Category</option>
                <option  v-for="item in categories" v-bind:value="item.id" >{{item.name}}</option>
                <option value="new">New Category</option>
            </select>
            <span v-if="categoryError"> <small>Category is required!</small> </span>
        </div>
        <div  class="inline-editor">
            <label style="display: block;" v-if="editorCategories !== ''"> {{this.type}} Tags </label>
            <div>
                <input class="form-control" v-model="editorCategories" type="text" :placeholder="this.type + ' Tags(Separated by comma)'"></input>
            </div>
        </div>
        

        <div v-if="isSaving">
            <h2>Saving....</h2>
        </div>

        <div class="float-right" id="publish-btn" v-if="itsAnEdit">
            <b-button v-b-tooltip.hover.html="errorTooltip" variant="outline-danger" v-if="isFailed">
                Error  <i class="far fa-question-circle"></i>
            </b-button>
            <b-button :pressed.sync="toggleDraft" variant="outline-secondary" @click="updatePost(false)">Update as draft</b-button>
            <b-button :pressed.sync="togglePublish" variant="outline-success" @click="updatePost(true)">Update & Publish</b-button>
        </div>

        <div class="float-right" id="publish-btn" v-else>
            <b-button v-b-tooltip.hover.html="errorTooltip" variant="outline-danger" v-if="isFailed">
                Error  <i class="far fa-question-circle"></i>
            </b-button>
            <b-button :pressed.sync="toggleDraft" variant="outline-secondary" @click="savePost(false)">Save as draft</b-button>
            <b-button :pressed.sync="togglePublish" variant="outline-success" @click="savePost(true)">Publish</b-button>
        </div>

        <b-modal
            id="modal-new-category"
            ref="modal"
            title="New Category"
            @show="resetModal"
            @hidden="resetModal"
            @ok="handleOk"
            >
            <form ref="form" @submit.stop.prevent="submitCategory">
                <b-row class="my-1">
                    <b-col sm="2">
                        <label for="input-default">Category:</label>
                    </b-col>
                    <b-col sm="10">
                        <b-form-input id="input-default" v-model="categoryName" placeholder="Enter your category name"></b-form-input>
                    </b-col>
                </b-row>            

            </form>
        </b-modal>
    </div>
</template>

<script>
    import CKEditor from '@ckeditor/ckeditor5-vue';
    import InlineEditor from '@ckeditor/ckeditor5-build-inline';
    // import InlineEditor from '@ckeditor/ckeditor5-editor-inline/src/inlineeditor';
    // import CKFinder from '@ckeditor/ckeditor5-ckfinder/src/ckfinder';
    // import EssentialsPlugin from '@ckeditor/ckeditor5-essentials/src/essentials';
    // import ListPlugin from '@ckeditor/ckeditor5-list/src/list';
    // import ParagraphPlugin from '@ckeditor/ckeditor5-paragraph/src/paragraph';
    // import AutoformatPlugin from '@ckeditor/ckeditor5-autoformat/src/autoformat';
    // import BoldPlugin from '@ckeditor/ckeditor5-basic-styles/src/bold';
    // import ItalicPlugin from '@ckeditor/ckeditor5-basic-styles/src/italic';
    // import BlockQuotePlugin from '@ckeditor/ckeditor5-block-quote/src/blockquote';
    // import HeadingPlugin from '@ckeditor/ckeditor5-heading/src/heading';
    // import UndoPlugin from '@ckeditor/ckeditor5-undo/src/undo';
    // import ToolbarView from '@ckeditor/ckeditor5-ui/src/toolbar/toolbarview';
    const STATUS_INITIAL = 0, STATUS_SAVING = 1, STATUS_SUCCESS = 2, STATUS_FAILED = 3;
    export default {
        name: 'inlineEditor',
        components: {
            // Use the <ckeditor> component in this view.
            ckeditor: CKEditor.component
            
        },
        props: ['type', 'isEdit','uid'],
        mounted() {
            $('.image-upload-wrap').bind('dragover', function () {
                $('.image-upload-wrap').addClass('image-dropping');
            });
            $('.image-upload-wrap').bind('dragleave', function () {
                $('.image-upload-wrap').removeClass('image-dropping');
            });
            this.getCategories();
            if(this.itsAnEdit){
                this.populateDetails();
            }
            
            console.log("TYPE!!", this.itsAnEdit);
        },
         data() {
            return {
                editor: InlineEditor,
                headerImage: null,
                currentStatus: null,
                articleCategory: 'null',
                uploadError: false,
                headerError: false,
                titleError: false,
                bodyError: false,
                categoryError: false,
                headerChanged: false,
                categories: [],
                tags: [],
                errors: [],
                headerUrl: '',
                editorData: '',
                editorTitle: '',
                editorCategories: '',
                categoryName: '',
                postUrl: '/author/save-post',
                analysisUrl: '/author/save-analysis',
                articleUrl: '/author/save-article',
                postUpdateUrl: '/author/edit-post/',
                analysisUpdateUrl: '/author/edit-analysis/',
                articleUpdateUrl: '/author/edit-article/',
                titleConfig: {
                    placeholder: this.type + " Title"
                },
                postConfig: {
                    placeholder: this.type + " Body",
                    uploadUrl: 'https://example.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json'
                },
                toggleDraft: false,
                togglePublish: false
            };
        },
        computed: {
            isInitial() {
                return this.currentStatus === STATUS_INITIAL;
            },
            isSaving() {
                return this.currentStatus === STATUS_SAVING;
            },
            isSuccess() {
                return this.currentStatus === STATUS_SUCCESS;
            },
            isFailed() {
                return this.currentStatus === STATUS_FAILED;
            },
            newCategory() {
                return this.articleCategory ==='new';
            },
            itsAnEdit() {
                if(this.isEdit == undefined){
                    return false;
                }
                return this.isEdit;
            }
        },
        methods: {
            readURL(input) {
                
                if (input.files && input.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function(e) {
                    $('.image-upload-wrap').hide();

                    $('.file-upload-image').attr('src', e.target.result);
                    $('.file-upload-content').show();

                    $('.image-title').html(input.files[0].name);
                    };

                    reader.readAsDataURL(input.files[0]);
                    this.headerImage = input.files[0];
                    this.headerError = false;

                    if(this.itsAnEdit){
                        this.headerChanged = true;
                    }
                } else {
                    removeUpload();
                }
            },
            removeUpload() {
                $('.file-upload-input').replaceWith($('.file-upload-input').clone());
                $('.file-upload-content').hide();
                $('.image-upload-wrap').show();
            },
            finish(){
                console.log("Reset run");
                // reset form to initial state
                this.currentStatus = STATUS_INITIAL;
                this.uploadError = null;
                this.$router.push('/');
            },
            saveCategory(){
                /*
                    Initialize the form data
                */
                let formData = new FormData();

                /*
                    Iteate over any file sent over appending the files
                    to the form data.
                */
                if(this.categoryName == '' || this.categoryName == 'new') {
                    this.categoryError = true;
                    return;
                }

                this.currentStatus = STATUS_SAVING;

                formData.append('category', this.categoryName);

                console.log(formData);
                /*
                    *
                    Make the request to the POST /multiple-files URL
                */
                axios.post( '/new/category',
                    formData,
                    {
                    headers: {
                        'Content-Type': 'form-data'
                    }
                    }
                ).then(response => {
                    console.log('SUCCESS!!', response);
                    this.currentStatus = STATUS_SUCCESS;
                    this.categories = response.data.categories;
                    this.articleCategory = response.data.selected;
                })
                .catch(err => {
                    console.log('FAILURE!!', err);
                    this.currentStatus = STATUS_FAILED;
                });

            },
            savePost(published){
                /*
                    Initialize the form data
                */
                let formData = new FormData();

                /*
                    Iteate over any file sent over appending the files
                    to the form data.
                */
                if(!this.isValid()) {
                    this.currentStatus = STATUS_FAILED;
                    return;
                }

                this.currentStatus = STATUS_SAVING;

                //let file = this.fileList[key];
                if (this.headerImage !== null){
                    formData.append('header', this.headerImage);
                }
                if (published){
                    formData.append('published', true);
                }
                formData.append('title', this.editorTitle);
                formData.append('body', this.editorData);
                formData.append('categoryId', this.articleCategory);
                formData.append('categories', this.editorCategories);

                console.log(formData);
                /*
                    *
                    Make the request to the POST /multiple-files URL
                */

                let url = this.articleUrl;
                if(this.type === 'Post'){
                    url = this.postUrl;
                }else if (this.type === 'Analysis'){
                    url = this.analysisUrl;
                }

                axios.post( url,
                    formData,
                    {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                    }
                ).then(data => {
                    console.log('SUCCESS!!', data);
                    this.currentStatus = STATUS_SUCCESS;
                    //optionally refetch records here
                    this.finish();
                })
                .catch(err => {
                    console.log('FAILURE!!', err);
                    this.currentStatus = STATUS_FAILED;
                    this.errors = err.response.data.errors;
                });

            },
            updatePost(published){
                /*
                    Initialize the form data
                */
                let formData = new FormData();

                /*
                    Iteate over any file sent over appending the files
                    to the form data.
                */
                if(!this.isValid()) {
                    this.currentStatus = STATUS_FAILED;
                    return;
                }

                this.currentStatus = STATUS_SAVING;

                //let file = this.fileList[key];
                if (this.headerImage !== null){
                    formData.append('header', this.headerImage);
                }
                if (published){
                    formData.append('published', true);
                }
                formData.append('title', this.editorTitle);
                formData.append('body', this.editorData);
                formData.append('categoryId', this.articleCategory);
                formData.append('categories', this.editorCategories);

                console.log(formData);
                /*
                    *
                    Make the request to the POST /multiple-files URL
                */

                let url = this.articleUpdateUrl + this.uid;
                if(this.type === 'Post'){
                    url = this.postUpdateUrl + this.uid;
                }else if (this.type === 'Analysis'){
                    url = this.analysisUpdateUrl + this.uid;
                }

                axios.post( url,
                    formData,
                    {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                    }
                ).then(data => {
                    console.log('SUCCESS!!', data);
                    this.currentStatus = STATUS_SUCCESS;
                    //optionally refetch records here
                    this.finish();
                })
                .catch(err => {
                    console.log('FAILURE!!', err);
                    this.currentStatus = STATUS_FAILED;
                    this.errors = err.response.data.errors;
                });

            },
            isValid () {
                this.errors = [];
                this.resetErrors();
                // if(this.headerImage === null){
                //     this.headerError = true;
                //     this.errors.push("Header Image is required.");
                // }

                if(this.editorTitle === ''){
                    this.titleError = true;
                    this.errors.push(this.type + " Title cannot be empty.");
                }

                if(this.editorData === ''){
                    this.bodyError = true;
                    this.errors.push(this.type + " Body Cannot be empty.");
                }

                if(this.editorTitle !== '' && this.editorData !== ''){
                    return true;
                }

                return false;
            },
            errorTooltip () {
                // Note this is called each time the tooltip is first opened.
                var length = this.errors.length;
                var i = 0;
                
                let tip = '<div>'+
                    '<h6>Upload failed.</h6>'+
                    '<hr class="tooltipHr"></hr>';
                    
                for(var key in this.errors){
                    tip = tip + '<span class="fullwidth"><strong>' + this.errors[key] + '</strong></span>'
                }

                tip = tip+'</div>';
                return tip;
            
            },
            resetErrors(){
                this.headerError = false;
                this.titleError = false;
                this.bodyError = false;
            },
            checkSelection(){
                console.log("check selection", this.articleCategory)
                if(this.newCategory){
                    this.$bvModal.show('modal-new-category');
                }
            },
            checkFormValidity() {
                const valid = this.$refs.form.checkValidity()
                this.replyState = valid
                return valid
            },
            resetModal() {
                this.reply = ''
                this.replyState = null
            },
            handleOk(bvModalEvt) {
                // Prevent modal from closing
                bvModalEvt.preventDefault()
                // Trigger submit handler
                this.submitCategory()
            },
            submitCategory() {
                // Exit when the form isn't valid
                if (!this.checkFormValidity()) {
                    return
                }
                // Push the name to submitted names
                console.log("Name", this.categoryName);
                this.saveCategory();
                // Hide the modal manually
                this.$nextTick(() => {
                this.$bvModal.hide('modal-new-category')
                })
            },
            async getCategories() {
                var _this = this;
                console.log("Getting items");

                axios.get('/api/getcategories').then(function (response) {
                    console.log("Categories", response.data.data);
                    _this.categories = response.data.data;
                });

            },
            async populateDetails() {
                var _this = this;
                let route = "/admin/article/" + this.uid;
                console.log("Getting details");
                if(this.type === 'Post'){
                    route = "/admin/post/"+ this.uid;
                }else if (this.type === 'Analysis'){
                    route = "/admin/analysis/" + this.uid;
                }

                axios.get(route).then(function (response) {
                    console.log("Response data", response.data.data);
                    _this.editorTitle = response.data.data.title;
                    _this.editorData = response.data.data.content;
                    _this.articleCategory = response.data.data.categoryId;
                    _this.headerUrl = response.data.data.header;
                });

            },
            capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }
        }
    }
</script>