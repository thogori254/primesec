import InlineEditorBase from '@ckeditor/ckeditor5-editor-inline/src/inlineeditor';
import CKFinder from '@ckeditor/ckeditor5-ckfinder/src/ckfinder';

export default class myEditor extends InlineEditorBase {}

myEditor.builtinPlugins = [
  CKFinder
];

myEditor.defaultConfig = {
    toolbar: {
        items: [
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            'imageUpload',
            'blockQuote',
            'undo',
            'redo'
        ]
    },
    image: {
        toolbar: [
            'imageStyle:full',
            'imageStyle:side',
            '|',
            'imageTextAlternative'
        ]
    },
    language: 'en'
};