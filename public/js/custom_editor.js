//function tinymce_init_callback(editor)
function tinymce_setup_callback(editor)
{
    console.log('editor', editor);
    editor.init({
//        selector: 'textarea.tinymce',
        extended_valid_elements: 'span',
        //other options
    });
}
