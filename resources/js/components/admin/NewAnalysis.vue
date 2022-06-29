<template>
    <div class="container"  id="newAnalysis">
        <my-editor v-bind:type="type"> </my-editor>
    </div>
</template>

<script>
    import MyEditor from './MyEditor.vue';
    export default {
        name: 'newAnalysis',
        components: {
            // Use the <ckeditor> component in this view.
            MyEditor
        },
        data(){
            return {
                type: 'Analysis',
            }
        }
    }
</script>