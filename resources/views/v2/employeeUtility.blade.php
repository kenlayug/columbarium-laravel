@extends('v2.baseLayout')
@section('title', 'Employee Utility')
@section('body')

     <!-- Import CSS/JS -->

<link rel = "stylesheet" href = "{!! asset('/css/additionalsMaintenance.css') !!}"/>
<script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>


<!-- Data Grid -->
<div class = "dataGrid col s12" style = "margin-top: 50px; margin-left: 80px; width: 1200px;">
    <div class="row">
        <div id="admin">
            <div class="z-depth-2 card material-table">
                <div class="table-header">
                    <h3>Employee Record</h3>
                    <div class="actions">
                        <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Create Employee" style = "margin-right: 10px;" href = "#modalCreateEmployee"><i class="material-icons" style = "color: black">add</i></button>
                        <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Employee" style = "margin-right: 10px;" href = "#modalArchiveEmployee"><i class="material-icons" style = "color: black">delete</i></button>
                        <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                    </div>
                </div>
                <table id="datatable">
                    <thead >
                    <tr>
                        <th style = "font-size: .9vw; color: black;">Name</th>
                        <th style = "font-size: .9vw; color: black;">Address</th>
                        <th style = "font-size: .9vw; color: black;">Birth Day</th>
                        <th style = "font-size: .9vw; color: black;">Position</th>
                        <th style = "font-size: .9vw; color: black;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><button name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                            <button name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal Create Employee -->
<div id="modalCreateEmployee" class="modalCreateEmployee modal" style = "width: 70%; max-height: 100%;">
    <div class = "itemHeaderUpdate modal-header">
        <h4 style = "padding-top: 0px; padding-left: 350px;">Create Employee</h4>
    </div>
    <form id="formUpdate">
        <div class = "container row col s12" style = "padding-left: 10px;">
            <div class="input-field col s4">
                <input id="last_name" type="text" class="validate">
                <label for="last_name">First Name</label>
            </div>
            <div class="input-field col s4">
                <input id="last_name" type="text" class="validate">
                <label for="last_name">Middle Name</label>
            </div>
            <div class="input-field col s4">
                <input id="last_name" type="text" class="validate">
                <label for="last_name">Last Name</label>
            </div>

            <label class = "labelOne left" style = "color: black; padding-left: 10px; font-family: Arial; font-size: 1.2vw;">Address</label>

            <div style = "padding-top: 100px;">
                <div class="input-field col s4">
                    <input id="last_name" type="text" class="validate">
                    <label for="last_name">Number</label>
                </div>
                <div class="input-field col s4">
                    <input id="last_name" type="text" class="validate">
                    <label for="last_name">Street</label>
                </div>
                <div class="input-field col s4">
                    <input id="last_name" type="text" class="validate">
                    <label for="last_name">City</label>
                </div>
            </div>

            <div class = "row" style = "padding-left: 10px;">

                <div class="input-field col s4">
                    <input id="dateOfBirth" type="date" required="" aria-required="true" class="datepicker">
                    <label for="dateOfBirth">Birth Day</label>
                </div>
                <div class="input-field col s4" style = "margin-top: 0px;">
                    <div class="input-field col s12">
                        <select>
                            <option value="" disabled selected>Select Position</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                        </select>
                        <label>Employee Position</label>
                    </div>
                </div>
                <button type = "submit" name = "action" class="btnPosition modal-trigger btn light-green right" href = "#modalCreatePosition" style = "color: black; margin-top: 35px; margin-right: 30px;">New Position</button>
            </div>

        </div>

        <i class = "requiredField left">*Required Fields</i>
        <br>

        <div class="modal-footer">
            <button type="submit" name="action" class="btnModalUpdateConfirm btn light-green" style = "margin-right: 20px;">Confirm</button>
    </form>
    <a class="btnModalUpdateCancel btn light-green modal-close" style = "margin-right: 5px;">Cancel</a>
</div>

<!-- Modal Additionals Category -->
<form id="modalCreatePosition" class="modalCreatePosition modal">
    <div class = "modalCategoryHeader modal-header">
        <h4 class = "text">New Position</h4>
    </div>
    <div class="modal-content" id="formCreateItemCategory">
        <div class = "additionalsNewCategory">
            <div class = "row">
                <div class="input-field col s12">
                    <input id="itemCategoryDesc" type="text" class="validate" name="item.strItemCategory" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="itemCategoryDesc" data-error = "Invalid format." data-success = "">Position Name<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s12">
                    <input id="itemCategoryDesc" type="text" class="validate" name="item.strItemCategory" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="itemCategoryDesc" data-error = "Invalid format." data-success = "">Position Name<span style = "color: red;">*</span></label>
                    <i class = "modalCatReqField left">*Required Fields</i>
                </div>
            </div>
            <br>
        </div>

    </div>
    <div class="modal-footer">
        <button name = "action" class="btnConfirmCategory btn light-green">Confirm</button>
        <a name = "action" class="btnCancel btn light-green modal-close" style = "margin-right: 10px;">Cancel</a>
    </div>

</form>

<!-- Modal Archive Additionals-->
<div id="modalArchiveEmployee" class="modalArchive modal">
    <div class="modalArchiveContent modal-content">
        <!-- Data Grid Deactivated Additionals/s-->
        <div id="admin1" class="col s12">
            <div class="z-depth-2 card material-table">
                <div class="table-header">
                    <h4>Archive Additionals</h4>
                    <a href="#" class="search-toggle btn-flat right"><i class="material-icons right" style="margin-left: 270px; color: #ffffff;">search</i></a>
                </div>
                <table id="datatable2">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="additional in deactivatedAdditionals">
                        <td>@{{ additional.strAdditionalName }}</td>
                        <td>
                            <button name = "action" class="btnActivate btn light-green modal-close">Activate</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal({dismissible: false});
    });

    $('.datepicker').pickadate({
        selectMonths: true,//Creates a dropdown to control month
        selectYears: 15,//Creates a dropdown of 15 years to control year
//The title label to use for the month nav buttons
        labelMonthNext: 'Next Month',
        labelMonthPrev: 'Last Month',
//The title label to use for the dropdown selectors
        labelMonthSelect: 'Select Month',
        labelYearSelect: 'Select Year',
//Months and weekdays
        monthsFull: [ 'January', 'February', 'March', 'April', 'March', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ],
        monthsShort: [ 'Jan', 'Feb', 'Mar', 'Apr', 'Mar', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ],
        weekdaysFull: [ 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' ],
        weekdaysShort: [ 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat' ],
//Materialize modified
        weekdaysLetter: [ 'S', 'M', 'T', 'W', 'T', 'F', 'S' ],
//Today and clear
        today: 'Today',
        clear: 'Clear',
        close: 'Close',
//The format to show on the `input` element
        format: 'dd/mm/yyyy'
    });
    //Copy settings and initialization tooltipped


    $(document).ready(function() {
        $('select').material_select();
    });
</script>

@endsection

