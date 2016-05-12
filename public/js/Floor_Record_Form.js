

$('.modal-trigger').leanModal({
        dismissible: false
    }
);

$(document).ready(function(){
    $('.collapsible').collapsible({
        accordion : false// A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });
});



var checkbox = $("input[type='checkbox']"),
    radio = $("input[type='radio']");

checkbox.click(function() {
    radio.attr("disabled", !checkbox.is(":checked"));
});