$(function() {

    $("[data-activates=slide-out-l]").sideNav();
    $("[data-activates=slide-out-r]").sideNav({
        edge: 'right'
    });
})


$(document).ready(function(){
    $('.collapsible').collapsible({
        accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });
});