<template>
    <div class="container"  id="newArticle">
        <my-editor v-bind:type="capitalizeFirstLetter(type)" v-bind:isEdit="true"  v-bind:uid="uid"> </my-editor>
    </div>
</template>

<script>
    import MyEditor from './MyEditor.vue';
    export default {
        mounted() {
            console.log('Component mounted.', this.$props)
        },
        name: 'editContent',
        props: ['type','uid'],
        components: {
            // Use the <ckeditor> component in this view.
            MyEditor
        },
        data(){
            return {
            }
        },
        methods: {
            capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }
        }
    }
</script>
