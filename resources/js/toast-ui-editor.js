import Editor from '@toast-ui/editor';
import 'codemirror/lib/codemirror.css';
import '@toast-ui/editor/dist/toastui-editor.css';
import '@toast-ui/editor/dist/theme/toastui-editor-dark.css';

/**
 * Utilizes the "Toast-UI markdown editor"
 * This allows the editor js assets to be accessed globally rather than repeated throughout the app.
 */

export const editor = new Editor({
    el: document.querySelector('#editor'),
    height: '600px',
    initialEditType: 'markdown',
    theme: 'dark'
});