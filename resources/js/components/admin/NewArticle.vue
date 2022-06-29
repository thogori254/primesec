<template>
    <div class="container"  id="newArticle">
        <my-editor v-bind:type="type"> </my-editor>
    </div>
</template>

<script>
    import MyEditor from './MyEditor.vue';
    export default {
        name: 'newArticle',
        components: {
            // Use the <ckeditor> component in this view.
            MyEditor
        },
        data(){
            return {
                type: 'Article',
            }
        }
    }
</script>