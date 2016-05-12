$( document ).ready(function() {
    $('.datepicker').pickadate({
        format: 'mm/dd/yyyy',
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });
});