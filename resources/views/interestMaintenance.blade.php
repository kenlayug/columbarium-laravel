@extends('maintenanceLayout')
@section('body')

<!-- Import CSS/JS -->
<link rel = "stylesheet" href = "{!! asset('/css/interestMaintenance.css') !!}"/>
<script type="text/javascript" src="{!! asset('/interest/interest-controller.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>
<div ng-app="interestApp">


<div class = "parent" style = "display: flex; flex-wrap: wrap; flex-direction: column;">
    <div class = "row">
        <div class = "col s4">
            <div id="alertDiv">

            </div>
            <!-- Create Interest -->
            <div class = "col s12" ng-controller="ctrl.newInterest">
                <form class = "createForm aside aside z-depth-3" id="formCreate" ng-submit="SaveInterest()">
                    <div class = "createHeader">
                        <h4>Interest Maintenance</h4>
                    </div>
                    <div class = "row">
                        <div class = "numberOfYears">
                            <div class="input-field col s6">
                                <input ng-model="interest.intNoOfYear" id="numberOfYears" type="number" class="validate" name="item.strNumberOfYears" required = "" aria-required="true" min = "1" max="10">
                                <label id="createNoOfYear" for="numberOfYears" data-error = "Invalid format." data-success = "">Number of Years<span style = "color: red;">*</span></label>
                            </div>
                        </div>
                        <div class = "interestRate">
                            <div class="input-field col s6">
                                <input ng-model="interest.deciInterestRate" id="interestRate" type="number" class="validate" name="item.dblPrice" required = "" min="1" step=".1" max="100" aria-required = "true" pattern = "^[0-9]{1,3}(,[0-9]{3})*(([\\.,]{1}[0-9]*)|())$">
                                <label id="createRate" for="interestRate" data-error = "Invalid Format." data-success = "">Interest Rate<span style = "color: red;">*</span></label>
                            </div>
                        </div>
                    </div>

                    <!-- Checkbox if at need -->
                    <div id = "checkbox" action="#">
                        <p class = "checkbox">
                            <input ng-model="interest.intAtNeed" type="checkbox" id="yes" value="1"/>
                            <label for="yes">At Need?</label>
                        </p>
                    </div>
                    <br>
                    <i class = "createRequiredField left">*Required Fields</i>

                    <br><br>
                    <button type = "submit" name = "action" class="btnCreate btn light-green right">Create</button>

                </form>

            </div>
        </div>


        <!-- Data Grid -->
        <div class = "dataGrid col s7" ng-controller="ctrl.interestTable">
            <div class="row">
                <div id="admin">
                    <div class="z-depth-2 card material-table">
                        <div class="table-header">
                            <h4 class = "dataGridH4">Interest Record</h4>
                            <div class="actions">
                                <button name = "action" class="btnArchive btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Item/s" href = "#modalArchiveItem"><i class="material-icons" style = "color: black">delete</i></button>
                                <a href="#" class="btnSearch search-toggle btn-flat nopadding"><i class="material-icons">search</i></a>
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
<div id="modalUpdateInterest" class="modalUpdate modal" ng-controller="ctrl.updateInterest">
    <div class = "modalUpdateHeader modal-header">
        <h4 class = "modalUpdateH4">Update Interest</h4>
    </div>
    <form id="formUpdate" ng-submit="SaveInterest()">
        <br>
        <div class = "row">
            <div class = "numberOfYearsUpdate">
                <div class="input-field col s6">
                    <input ng-model="update.intInterestId" type="hidden">
                    <input ng-model="update.intNoOfYear" id="updateNumberOfYears" type="number" class="validate" name="item.strNumberOfYears" required = "" aria-required="true" min = "1" max="10">
                    <label id="updateNoOfYear" for="updateNumberOfYears" data-error = "Invalid format." data-success = "">Number of Years<span style = "color: red;">*</span></label>
                </div>
            </div>
            <div class = "interestRateUpdate">
                <div class="input-field col s6">
                    <input ng-model="update.deciInterestRate" id="updateInterestRate" type="number" class="validate" name="item.dblPrice" required = "" min="1" step=".1" max="100" aria-required = "true" pattern = "^[0-9]{1,3}(,[0-9]{3})*(([\\.,]{1}[0-9]*)|())$">
                    <label id="updateRate" for="updateInterestRate" data-error = "Invalid Format." data-success = "">Interest Rate<span style = "color: red;">*</span></label>
                </div>
            </div>
        </div>

        <!-- Checkbox if at need -->
        <div id = "checkbox" action="#">
            <p class = "checkbox" style = "margin-left: 20px;">
                <input ng-model="update.intAtNeed" name="atNeed" type="checkbox" id="updateAtNeed" value="1"/>
                <label for="updateAtNeed">At Need?</label>
            </p>
        </div>
        <br>
        <i class = "createRequiredField left" style = "padding-left: 20px; color: red;">*Required Fields</i>
        <br>

        <div class="modal-footer">
            <button type="submit" name="action" class="btnConfirm btn light-green" style = "margin-left: 10px;">Confirm</button>
    </form>
            <a class="btnCancel btn light-green modal-close">Cancel</a>
        </div>
</div>


<!-- Modal Archive Item-->
<div id="modalArchiveItem" class="archiveDataGrid modal" ng-controller="ctrl.deactivatedTable">
    <div class="modal-content">
        <!-- Data Grid Deactivated Interest/s-->
        <div id="admin1" class="col s12">
            <div class="z-depth-2 card material-table">
                <div class="table-header">
                    <h4 class = "archiveModalH4">Archive Interest/s</h4>
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
    <button name = "action" class="btnArchiveDone btn green modal-close right">DONE</button>
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