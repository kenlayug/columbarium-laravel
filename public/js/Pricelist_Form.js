/**
 * Created by Leo on 2/4/2016.
 */

$(document).ready(function() {
    $('.modal-trigger').leanModal();
});

$(document).ready(function() {

    $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {

        var data_id = '';

        if (typeof $(this).data('id') !== 'undefined') {

            data_id = $(this).data('id');
        }

        $('#my_element_id').val(data_id);
    })
});

$(document).on("click", ".open-AddBookDialog", function () {
    var myBookId = $(this).data('id');
    $(".modal-content #bookId").val( myBookId );
    $('#addBookDialog').modal('show');
});