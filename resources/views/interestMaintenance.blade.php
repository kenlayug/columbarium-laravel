@extends('maintenanceLayout')
@section('body')

<!-- Import CSS/JS -->

<link rel = "stylesheet" href = "{!! asset('/css/Inventory_Form.css') !!}"/>
<script type="text/javascript" src="{!! asset('/interest/interest-controller.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>
<div ng-app="interestApp">
<!-- Section -->
<div class = "parent" style = "display: flex; flex-wrap: wrap; flex-direction: column;">
    <div class = "row">
        <div class = "col s4">
            <div id="alertDiv">

            </div>
            <!-- Create Interest -->
            <div class = "col s12" ng-controller="ctrl.newInterest">
                <form class = "aside aside z-depth-3" style = "margin-top: 20px; height: 350px; margin-left: 30px;" id="formCreate" ng-submit="SaveInterest()">
                    <div class = "header">
                        <h4 style = "font-family: myFirstFont2; font-size: 30px;padding-top: 10px; margin-top: 10px;">Interest Maintenance</h4>
                    </div>
                    <div class = "row">
                        <div style = "padding-left: 10px;">
                            <div class="input-field col s6">
                                <input ng-model="interest.intNoOfYear" id="numberOfYears" type="number" class="validate" name="item.strNumberOfYears" required = "" aria-required="true" min = "1" max="10">
                                <label id="createNoOfYear" for="numberOfYears" data-error = "Invalid format." data-success = "">Number of Years<span style = "color: red;">*</span></label>
                            </div>
                        </div>
                        <div style = "padding-left: 10px;">
                            <div class="input-field col s6">
                                <input ng-model="interest.deciInterestRate" id="interestRate" type="number" class="validate" name="item.dblPrice" required = "" min="1" step=".1" max="100" aria-required = "true" pattern = "^[0-9]{1,3}(,[0-9]{3})*(([\\.,]{1}[0-9]*)|())$">
                                <label id="createRate" for="interestRate" data-error = "Invalid Format." data-success = "">Interest Rate<span style = "color: red;">*</span></label>
                            </div>
                        </div>
                    </div>

                    <!-- Checkbox if at need -->
                    <div id = "checkbox" action="#">
                        <p style = "margin-left: 20px;">
                            <input ng-model="interest.intAtNeed" type="checkbox" id="yes" value="1"/>
                            <label for="yes">At Need?</label>
                        </p>
                    </div>
                    <br>
                    <i class = "left" style = "margin-bottom: 0px; padding-left: 20px; color: red;">*Required Fields</i>


                    <br><br>
                    <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-right: 10px;">Create</button>

                </form>

            </div>
        </div>


        <!-- Data Grid -->
        <div class = "col s7" style = "height: 500px; margin-top: 20px; margin-left: 40px;" ng-controller="ctrl.interestTable">
            <div class="row">
                <div id="admin">
                    <div class="z-depth-2 card material-table">
                        <div class="table-header" style="background-color: #00897b;">
                            <h4 style = "font-family: myFirstFont2; font-size: 30px; color: white; padding-left: 0px;">Interest Record</h4>
                            <div class="actions">
                                <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Item/s" style = "margin-right: 10px;" href = "#modalArchiveItem"><i class="material-icons" style = "color: black">delete</i></button>
                                <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                            </div>
                        </div>
                        <table id="datatable">
                            <thead>
                            <tr>
                                <th>Number of Years</th>
                                <th>Interest Rate</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="interest in interests">
                                <td ng-if="interest.intAtNeed">@{{ interest.intNoOfYear }}(At Need)</td>
                                <td ng-if="!interest.intAtNeed">@{{ interest.intNoOfYear }}</td>
                                <td>@{{ interest.interestRate.deciInterestRate }}%</td>
                                <td><button ng-click="UpdateInterest(interest.intInterestId, $index)" name = "action" class="modal-trigger btn-floating light-green" href = "#modalUpdateInterest"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                    <button ng-click="DeactivateInterest(interest.intInterestId, $index)" name = "action" class="modal-trigger btn-floating light-green" href = "#modalDeactivateInterest"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Modal Update -->
<div id="modalUpdateInterest" class="modal" style = "width: 500px;" ng-controller="ctrl.updateInterest">
    <div class = "modal-header" style = "height: 55px;">
        <h4 style = "font-family: myFirstFont2; padding-left: 20px; font-size: 30px;">Update Interest</h4>
    </div>
    <form id="formUpdate" ng-submit="SaveInterest()">
        <br>
        <div class = "row">
            <div style = "padding-left: 10px;">
                <div class="input-field col s6">
                    <input ng-model="update.intInterestId" type="hidden">
                    <input ng-model="update.intNoOfYear" id="updateNumberOfYears" type="number" class="validate" name="item.strNumberOfYears" required = "" aria-required="true" min = "1" max="10">
                    <label id="updateNoOfYear" for="updateNumberOfYears" data-error = "Invalid format." data-success = "">Number of Years<span style = "color: red;">*</span></label>
                </div>
            </div>
            <div style = "padding-left: 10px;">
                <div class="input-field col s6">
                    <input ng-model="update.deciInterestRate" id="updateInterestRate" type="number" class="validate" name="item.dblPrice" required = "" min="1" step=".1" max="100" aria-required = "true" pattern = "^[0-9]{1,3}(,[0-9]{3})*(([\\.,]{1}[0-9]*)|())$">
                    <label id="updateRate" for="updateInterestRate" data-error = "Invalid Format." data-success = "">Interest Rate<span style = "color: red;">*</span></label>
                </div>
            </div>
        </div>

        <!-- Checkbox if at need -->
        <div id = "checkbox" action="#">
            <p style = "margin-left: 20px;">
                <input ng-model="update.intAtNeed" name="atNeed" type="checkbox" id="updateAtNeed" value="1"/>
                <label for="updateAtNeed">At Need?</label>
            </p>
        </div>
        <br>
        <i class = "left" style = "margin-bottom: 0px; padding-left: 20px; color: red;">*Required Fields</i>
        <br>

        <div class="modal-footer">
            <button type="submit" name="action" class="btn light-green" style = "color: black; margin-top: 30px; margin-left: 10px; ">Confirm</button>
    </form>
            <a class="btn light-green modal-close" style = "color: black; margin-top: 30px">Cancel</a>
        </div>
</div>


<!-- Modal Archive Item-->
<div id="modalArchiveItem" class="modal" style = "height: 800px; width: 600px;" ng-controller="ctrl.deactivatedTable">
    <div class="modal-content">
        <!-- Data Grid Deactivated Interest/s-->
        <div id="admin1" class="col s12" style="margin-top: 0px">
            <div class="z-depth-2 card material-table" style="margin-top: 0px">
                <div class="table-header" style="height: 45px; background-color: #00897b;">
                    <h4 style = "font-family: myFirstFont2; padding-top: 10px; font-size: 30px; color: white; padding-left: 0px;">Archive Interest/s</h4>
                    <a href="#" class="search-toggle btn-flat right"><i class="material-icons right" style="margin-left: 150px; color: #ffffff;">search</i></a>
                </div>
                <table id="datatable2">
                    <thead>
                    <tr>
                        <th>No. of Year/s</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="interest in deactivatedInterests">
                        <td ng-if="interest.intAtNeed">@{{ interest.intNoOfYear }}(At Need)</td>
                        <td ng-if="!interest.intAtNeed">@{{ interest.intNoOfYear }}</td>
                        <td>
                            <button ng-click="ReactivateInterest(interest.intInterestId, $index)" name = "action" class="btn green modal-close">Activate</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <button name = "action" class="btn green modal-close right" style = "margin-bottom: 10px; margin-right: 30px;">DONE</button>
</div>

<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal({dismissible: false});
    });

</script>
</div>
@endsection