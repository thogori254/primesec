<template>
    <transition name="slide-fade">
        <div>
            <div class="row home-container">
                <div class="left">
                    <div class="inline-editor">
                        <label style="display: block;" v-if="homeTitle !== ''"> Home Title </label>
                        <input class="form-control" v-model="homeTitle" type="text" placeholder='Home Title'></input>
                        <section class="home-content">
                            <label style="display: block;" v-if="homeData !== ''"> Home Body </label>
                            <div class="ck-content">
                                <ckeditor 
                                :editor="editor"
                                :config="postConfig"
                                v-model="homeData">
                                </ckeditor>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="home-header">
                    <div class="image-file-upload">
                        <label style="display: block;"> Side Image </label>
                        <div class="form-group image-upload-wrap" >
                            <input class="file-upload-input" type="file" name="files" v-on:change="readURL($event.target)" accept="image/*"></input>
                            <div class="drag-text">
                                <h5> Drag and drop a file or select add image </h5>
                            </div>
                        </div>
                        
                        <div class="file-upload-content">
                            <img class="file-upload-image" src="#" alt="header image"></img>
                            <div class="image-title-wrap">
                            <button type="button" class="file-upload-btn"  onclick="$('.file-upload-input').trigger( 'click' )" > Change Header image </button>
                            </div>
                        </div>

                        <span > <small>Its not recommended to change side image!</small> </span>
                        <span v-if="imageError"> <small>SideImage is required!</small> </span>
                    </div>
                </div>
                <div v-if="isSaving">
                    <h2>Saving....</h2>
                </div>
                <hr class="clear"/>
            </div>
            <div class="float-right" id="publish-btn">
                <b-button v-b-tooltip.hover.html="errorTooltip" variant="outline-danger" v-if="isFailed">
                    Error <i class="far fa-question-circle"></i>
                </b-button>
                <b-button :pressed.sync="toggleDraft" variant="outline-secondary" @click="saveHomepage()">Save as draft</b-button>
                <b-button :pressed.sync="togglePublish" variant="outline-success" @click="saveHomepage()">Publish</b-button>
            </div>
        </div>
    </transition>
</template>

<script>
    import CKEditor from '@ckeditor/ckeditor5-vue';
    import InlineEditor from '@ckeditor/ckeditor5-build-inline';
    const STATUS_INITIAL = 0, STATUS_SAVING = 1, STATUS_SUCCESS = 2, STATUS_FAILED = 3;
    
    export default {
        components: {
            // Use the <ckeditor> component in this view.
            ckeditor: CKEditor.component
            
        },
        mounted() {
            console.log('Component mounted.');
            this.getBlogDetails();
        },
        data() {
            return {
                editor: InlineEditor,
                sideImage: null,
                currentStatus: null,
                uploadError: false,
                imageError: false,
                titleError: false,
                bodyError: false,
                errors: [],
                homeData: '',
                homeTitle: '',
                titleConfig: {
                    placeholder: "Home Title"
                },
                postConfig: {
                    placeholder: "Home Body",
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
            }
        },
        methods: {
            readURL(input) {
                
                if (input.files && input.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function(e) {
                    $('.image-upload-wrap').hide();

                    $('.file-upload-image').hide(); //attr('src', e.target.result);
                    $('.home-header').css("background-image", "url('" + e.target.result + "')");

                    $('.file-upload-content').show();

                    $('.image-title').html(input.files[0].name);
                    };

                    reader.readAsDataURL(input.files[0]);
                    this.sideImage = input.files[0];
                    this.imageError = false;
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
            saveHomepage(){
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
                if(this.sideImage !== null){
                    formData.append('sideImage', this.sideImage);
                }
                formData.append('title', this.homeTitle);
                formData.append('body', this.homeData);

                console.log(formData);
                /*
                    *
                    Make the request to the POST /multiple-files URL
                */

                axios.post( '/edit/homepage',
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
                    console.log('SUCCESS!!', err.response.data);
                });

            },
            isValid () {
                this.errors = [];
                this.resetErrors();
                // if(this.sideImage === null){
                //     this.imageError = true;
                //     this.errors.push("Side Image is required.");
                // }

                if(this.homeTitle === ''){
                    this.titleError = true;
                    this.errors.push("Home Title cannot be empty.");
                }

                if(this.homeData === ''){
                    this.bodyError = true;
                    this.errors.push("Home Body Content Cannot be empty.");
                }

                if(this.homeTitle !== '' && this.homeData !== ''){
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
                this.imageError = false;
                this.titleError = false;
                this.bodyError = false;
            },
            async getBlogDetails() {
                var _this = this;
                console.log("Getting details");

                axios.get('/api/getblogdetails').then(function (response) {
                    console.log("details", response.data);
                    _this.homeTitle = response.data.title;
                    _this.homeData = response.data.article;
                    _this.name = response.data.org_name;
                    _this.email = response.data.org_email;
                    _this.whatsapp = response.data.org_whatsapp;
                    _this.contact = response.data.org_contact;
                });

            },
        }
    }
</script>