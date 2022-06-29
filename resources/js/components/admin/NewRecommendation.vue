<template>
    <div class="container"  id="newRecommendation">
        <my-editor v-bind:type="type"> </my-editor>
    </div>
</template>

<script>
    import MyEditor from './MyEditor.vue';
    export default {
        name: 'newRecommendation',
        components: {
            // Use the <ckeditor> component in this view.
            MyEditor
        },
        data(){
            return {
                type: 'Recommendation',
            }
        }
    }
</script>
