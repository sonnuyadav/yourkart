
tinymce.init({
    selector:"textarea.tinyMce",
     plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste "
        ],
         toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | fontselect fontsizeselect",
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
        plugin_insertdate_dateFormat : "%Y-%m-%d",
        plugin_insertdate_timeFormat : "%H:%M:%S",
        theme_advanced_toolbar_align : "left",
        extended_valid_elements :"img[src|border=0|alt|title|width|height|align|name],"
        +"a[href|target|name|title],"
        +"p,",
        //invalid_elements: "table,span,tr,td,tbody,font",
        theme_advanced_resize_horizontal : false,
        theme_advanced_resizing : true,
        apply_source_formatting : true,
        theme_advanced_resizing : true,
        apply_source_formatting : true

});