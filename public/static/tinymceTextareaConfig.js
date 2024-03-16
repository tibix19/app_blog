// configuration pour la création des postes (style, titre, etc...)
tinymce.init({
    selector: "#content",
    plugins: 'preview importcss searchreplace autolink autosave save directionality visualblocks link codesample charmap nonbreaking insertdatetime advlist lists charmap emoticons accordion',
    //editimage_cors_hosts: ['picsum.photos'],
    menubar: 'edit view insert format table',
    toolbar: "undo redo | accordion | blocks fontfamily fontsize | bold italic underline | align numlist bullist | lineheight outdent indent| forecolor backcolor | link charmap emoticons codesample | code preview",
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    autosave_prefix: '{path}{query}-{id}-',
    autosave_restore_when_empty: false,
    autosave_retention: '2m',
    image_advtab: true,
    importcss_append: true,
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 400,
    quickbars_selection_toolbar: 'bold italic quicklink h1 h2 blockquote quicktable',
    noneditable_class: 'mceNonEditable',
    toolbar_mode: 'sliding',
    contextmenu: 'link image table',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
});