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

        editorSession.on('change', function(){

            var size = editorSession.getValue().split("\n").length * 20 + 15;

            $(divId).height(size);
            $(divId+"-placeholder").height(size + 20);

            editor.resize();

        });

        this.loadedEditors.divId = editor;

    },

    loadPageEditors: function() {
        $.each(this.requestedEditors, function(index, editorDiv) {
            codeEditor.loadEditor(editorDiv.id, editorDiv.mode)
        })
    }
};