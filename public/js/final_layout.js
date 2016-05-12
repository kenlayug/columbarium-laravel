$(function() {

    $("[data-activates=slide-out-l]").sideNav();
    $("[data-activates=slide-out-r]").sideNav({
        edge: 'right'
    });
})

$(window).scroll(function() {
    if ($(window).scrollTop() == $(document).height() - $(window).height()) {
        alert('lelllo');
        /*$('div#loadmoreajaxloader').show();
         $.ajax({
         url: "loadmore.php",
         success: function(html) {
         if (html) {
         $("#postswrapper").append(html);
         $('div#loadmoreajaxloader').hide();
         } else {
         $('div#loadmoreajaxloader').html('<center>No more posts to show.</center>');
         }
         }
         });*/
    }
});

$('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrain_width: false, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        gutter: 0, // Spacing from edge
        belowOrigin: false, // Displays dropdown below the button
        alignment: 'left' // Displays dropdown with edge aligned to the left of button
    }
);