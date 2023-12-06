// popup disaable button untill user scrolls
jQuery(document).ready(function($) {
    // disable button  
    $('#popmake-wrap .button-green').prop('disabled', true);
    $('#popmake-wrap .popupscroll').scroll(function() {
        if ($(this).scrollTop() + $(this).height() > $(this)[0].scrollHeight - 80) {
            //enable button
            $('#popmake-wrap .button-green').prop('disabled', false);
        }
    });
});

function assinar() {
    window.location.href = "tutorial.html"
}

function reload() {
    window.location.href = "content.html"
}