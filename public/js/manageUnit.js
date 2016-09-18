
function switchDiv1() {
    if (document.getElementById('pullOutOwnership') !== undefined) {

        if (document.getElementById('pullOutOwnership').style.display == 'block') {
            document.getElementById('pullOutOwnership').style.display = 'none';
            document.getElementById('deceasedForm').style.display = 'block';
        } else {
            document.getElementById('pullOutOwnership').style.display = 'block';
            document.getElementById('deceasedForm').style.display = 'none';
        }
    }
}
function switchDiv() {
    if (document.getElementById('transferOwnership') !== undefined) {

        if (document.getElementById('transferOwnership').style.display == 'block') {
            document.getElementById('transferOwnership').style.display = 'none';
            document.getElementById('deceasedForm').style.display = 'block';
        } else {
            document.getElementById('transferOwnership').style.display = 'block';
            document.getElementById('deceasedForm').style.display = 'none';
        }
    }
}
function switchVisible() {
    if (document.getElementById('tableUnit') !== undefined) {

        if (document.getElementById('tableUnit').style.display == 'block') {
            document.getElementById('tableUnit').style.display = 'none';
            document.getElementById('tableStart').style.display = 'block';
        } else {
            document.getElementById('tableUnit').style.display = 'block';
            document.getElementById('tableStart').style.display = 'none';
        }
    }
}
function switchVisible1() {
    if (document.getElementById('transferDeceasedShow') !== undefined) {

        if (document.getElementById('transferDeceasedShow').style.display == 'block') {
            document.getElementById('transferDeceasedShow').style.display = 'none';
            document.getElementById('transferDeceasedStart').style.display = 'block';
        } else {
            document.getElementById('transferDeceasedShow').style.display = 'block';
            document.getElementById('transferDeceasedStart').style.display = 'none';
        }
    }
}


$(document).ready(function(){
    $('ul.tabs').tabs();
});

$('.timepicker').pickatime({
    default: 'now',
    twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
    donetext: 'OK',
  autoclose: false,
  vibrate: true // vibrate the device when dragging clock hand
});