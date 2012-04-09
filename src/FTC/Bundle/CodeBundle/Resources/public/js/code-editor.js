var codeEditor = {

    requestedEditors: new Array(),

    loadedEditors: new Array(),

    loadEditor: function(divId, mode) {

        var editor = new ace.edit(divId);

        editor.setShowPrintMargin(false);
        editor.setTheme("ace/theme/twilight");
        editor.setReadOnly(true);

        var editorSession = editor.getSession();

        editorSession.setUseWrapMode(true);
        editorSession.setMode(mode);

        editorSession.on('change', function(){
            codeEditor.resizeEditor(editor);
        });

        this.resizeEditor(editor);

        this.loadedEditors[divId] = editor;

    },

    resizeEditor: function(editor) {

        var size = editor.getSession().getValue().split("\n").length * 20 + 15;

        $("#"+editor.container.id).height(size);
        $("#"+editor.container.id+"-placeholder").height(size);

        editor.resize();
    },

    wakeEditor: function(event) {
        var $btn, editorId, editor, data, html;

        event.preventDefault();

        codeEditor.sleepAllEditors();

        $btn     = $(event.currentTarget);
        editorId = $btn.attr('rel');
        editor   = codeEditor.loadedEditors[editorId];
        data     = { nodeId: editorId+'-form', formAction: $btn.attr('href') };

        //get template
        html = $.tmpl( "editCodeForm", data );

        //append form
        $('#'+editorId+'-placeholder').after(html);

        //Populate and hide code field
        //$('#ftc_bundle_codebundle_contributetype_code').parents(".control-group:first").hide();
        $('#ftc_bundle_codebundle_contributetype_code').val( editor.getSession().getValue() );
        $('.btn-reset').on('click', codeEditor.sleepAllEditors);

        editor.setReadOnly(false);
        editor.getSession().on('change', function(x){
            $('#ftc_bundle_codebundle_contributetype_code').val( editor.getSession().getValue() );
        });
    },

    sleepAllEditors: function() {
        $('.code-comment-form-row').remove();
    },

    sleepEditor: function(event) {

    },

    loadPageEditors: function() {
        $.each(this.requestedEditors, function(index, editorDiv) {
            codeEditor.loadEditor(editorDiv.id, editorDiv.mode)
        })
    }
};