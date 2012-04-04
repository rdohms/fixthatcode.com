var codeComments = {
    
    loadToggleButtons: function (buttonSelector) {
        $(buttonSelector).on('click', function(event) {
            var $btn, $diff, $code, btnText;
            
            event.preventDefault();
            
            $btn  = $(event.currentTarget);
            $diff = $('#' + $btn.attr('rel') + '-diff');
            $code = $('#' + $btn.attr('rel') + '-code');

            $diff.toggle('slow');
            $code.toggle('slow', function() {
                
                if ($diff.is(":visible")) {
                    btnText = "see code"
                } else {
                    btnText = "see diff"
                }

                $btn.text(btnText);
            });
            
            
        });
    }
    
};