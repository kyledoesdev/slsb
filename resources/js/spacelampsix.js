import Editor from "@toast-ui/editor";
import 'codemirror/lib/codemirror.css';
import '@toast-ui/editor/dist/toastui-editor.css';
import '@toast-ui/editor/dist/theme/toastui-editor-dark.css';

/**
 * Global Namespace
 */
window.spacelampsix = window.spacelampsix || {};

/**
 * Global Variables
 */
spacelampsix.page_name = null;
spacelampsix.markdown = null;
spacelampsix.toast = null;

/**
 * Global Init
 */
$(function () {
    spacelampsix.page_name = $('#page_name').val();
    spacelampsix.markdown = document.querySelector('#editor');

    if (spacelampsix.markdown != null) {
        spacelampsix.toast = new Editor({
            el: spacelampsix.markdown,
            height: '600px',
            initialEditType: 'markdown',
            theme: 'dark'
        });
    }

    spacelampsix.init();
});

/**
 * Global Spacelampsix blog functions
 */
window.spacelampsix = {
    init: function () {
        this.loadRouteJS();
    },

    /**
     * Load the route specific JS
     */
    loadRouteJS: function (functionName = 'boot') {
        var namespace = [];
        var find = '';

        $(spacelampsix.page_name.split('.')).each(function () {
            if (namespace.length) {
                namespace.push(namespace[namespace.length - 1] + '.' + this);
            } else {
                namespace.push(this);
            }

            find += 'window.spacelampsix.' + namespace[namespace.length - 1] + ' && ';
        });

        find = find.trim();
        find = find ? find.substring(0, find.length - 2).trim() : '';
        console.log('Trying to find route JS: ' + spacelampsix.page_name + '.' + functionName);
        
        eval('if (' + find + ' && window.spacelampsix.' + spacelampsix.page_name + '.' + functionName +") { \
                console.log('Success!! - Found: " + spacelampsix.page_name + '.' + functionName +"'); \
                window.spacelampsix." + spacelampsix.page_name + '.' + functionName +'(); \
            } else { \
                console.log("Could not find route JS '+ spacelampsix.page_name + '.' + functionName +'") \
            }',
        );
    },
};