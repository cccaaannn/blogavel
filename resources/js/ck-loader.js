import { ClassicEditor, Essentials, Bold, Italic, Font, Paragraph } from 'ckeditor5';

import 'ckeditor5/ckeditor5.css';

import '../css/ck-styles.css';

window.addEventListener('DOMContentLoaded', () => {

    const editors = document.querySelectorAll('#editor');
    editors.forEach(editorElement => {
        ClassicEditor
            .create(editorElement, {
                plugins: [Essentials, Bold, Italic, Font, Paragraph],
                toolbar: [
                    'undo', 'redo', '|',
                    'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                ]
            })
            .then(editor => {
                editor.editing.view.document.on('change:isFocused', (evt, data, isFocused) => {
                    $('.ck-powered-by-balloon').remove();
                });
            })
            .catch(error => {
                console.log(error);
            });
    });

    const readonlyEditors = document.querySelectorAll('#readonly-editor');
    readonlyEditors.forEach(editorElement => {
        ClassicEditor
            .create(editorElement, {
                plugins: [Essentials, Bold, Italic, Font, Paragraph],
                toolbar: []
            })
            .then(editor => {
                editor.editing.view.document.on('change:isFocused', (evt, data, isFocused) => {
                    $('.ck-powered-by-balloon').remove();
                });

                const toolbarElement = editor.ui.view.toolbar.element;
                toolbarElement.style.display = 'none';

                editor.readonly = true;

                editor.enableReadOnlyMode("editor-lock");
            })
            .catch(error => {
                console.log(error);
            });
    });
});
