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

        var size = editorSession.getValue().split("\n").length * 20 + 15;

        $(divId).height(size);
        $(divId+"-placeholder").height(size + 20);

        editor.resize();

        //TODO: this resize is not working, check it
        editorSession.on('change', function(){

            var size = editorSession.getValue().split("\n").length * 20 + 15;

            $(divId).height(size);
            $(divId+"-placeholder").height(size + 20);

            editor.resize();

        });

        this.loadedEditors.divId = editor;

    },

    wakeEditor: function(event) {
        var $btn, editorId, editor, data, html;

        event.preventDefault();

        $btn     = $(event.currentTarget);
        editorId = $btn.attr('rel');
        editor   = codeEditor.loadedEditors[editorId];
        data     = { nodeId: editorId+'-form', formAction: $btn.attr('href') };

        //get template
        html = $.tmpl( "editCodeForm", data );

        //append form
        $('#'+editorId+'-placeholder').after(html);

        //set variables
        //$('#ftc_bundle_codebundle_contributetype_code').parents(".control-group:first").hide();

        editor.setReadOnly(false);
        editor.getSession().on('change', function(){
            $('#ftc_bundle_codebundle_contributetype_code').val( editor.getSession().getValue() );
            console.log(editor.getSession().getValue());
        });
    },

    loadPageEditors: function() {
        $.each(this.requestedEditors, function(index, editorDiv) {
            codeEditor.loadEditor(editorDiv.id, editorDiv.mode)
        })
    }
};