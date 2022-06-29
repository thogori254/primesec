<template>
    <div class="container"  id="newPost">
        <my-editor v-bind:type="type"> </my-editor>
    </div>
</template>

<script>
    import MyEditor from './MyEditor.vue';
    export default {
        name: 'newPost',
        components: {
            // Use the <ckeditor> component in this view.
            MyEditor
        },
        data(){
            return {
                type: 'Post',
            }
        }
    }
</script>