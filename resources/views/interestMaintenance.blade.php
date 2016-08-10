@extends('maintenanceLayout')
@section('body')
@section('title', 'Interest Maintenance')

    <!-- Import CSS/JS -->

    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <link rel = "stylesheet" href = "{!! asset('/css/interestMaintenance.css') !!}"/>
    <script type="text/javascript" src="{!! asset('/interest/interest-controller.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>


<div ng-app="interestApp">
    <div style = "display: flex; flex-wrap: wrap; flex-direction: column;">
        <div class = "row">

            <!-- Create Interest -->
            <div class = "container-fluid col s12 m10 l4">
                <div ng-controller="ctrl.newInterest">
                    <form class = "createForm aside aside z-depth-3" id="formCreate" ng-submit="SaveInterest()">
                        <div class = "createHeader">
                            <h4 class = "center">Interest Maintenance</h4>
                        </div>

                    <div class = "field2">
                        <div class = "field numberOfYears row">
                            <div class="numberOfYears input-field col s6">
                                <input ng-model="interest.intNoOfYear" id="numberOfYears" type="number" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts whole numbers only. Max input: 10<br>*Example: 5" name="item.strNumberOfYears" required = "" aria-required="true" min = "1" max="10">
                                <label id="createNoOfYear" for="numberOfYears" data-error = "Invalid format." data-success = "">Number of Years<span style = "color: red;">*</span></label>
                            </div>
                            <div>
                                <div class="interestRate input-field col s6">
                                    <input ng-model="interest.deciInterestRate"
                                           ui-percentage-mask
                                           id="interestRate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts numbers only.<br>*Example: 25" name="item.dblPrice" required = "" max="100" aria-required = "true">
                                    <label id="createRate" for="interestRate" data-error = "Invalid Format." data-success = "">Rate<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                        </div>
                        <!-- Checkbox if at need -->
                        <div class = "checkbox" id = "checkbox" action="#">
                            <p>
                                <input ng-model="interest.intAtNeed" type="checkbox" id="yes" value="1"/>
                                <label for="yes">At Need?</label>
                            </p>
                        </div>
                        <br>
                        <i class = "createRequiredField left">*Required Fields</i>
                        <br><br>
                        <button type = "submit" name = "action" class="col s12 m5 l3 btn light-green right" style = "width: 30%; color: black; margin-right: 10px; font-size: 1.2vw;">Create</button>
                    </div>
                    </form>
                </div>
            </div>


                <!-- Data Grid -->
                <div class = "dataGrid col s12 m10 l8" ng-controller="ctrl.interestTable">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header">
                                    <h3>Interest Record</h3>
                                    <div class="actions">
                                        <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Item/s" style = "margin-right: 10px;" href = "#modalArchiveInterest"><i class="material-icons" style = "color: black">delete</i></button>
                                        <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id="datatable" datatable="ng">
                                    <thead>
                                    <tr>
                                        <th>Number of Years</th>
                                        <th>Interest Rate</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="interest in interests">
                                        <td ng-if="interest.intAtNeed">@{{ interest.intNoOfYear }}<span ng-if="interest.intAtNeed == 1">(At Need)</span></td>
                                        <td ng-if="!interest.intAtNeed">@{{ interest.intNoOfYear }}</td>
                                        <td>@{{ ((interest.interestRate.deciInterestRate)*100).toFixed(2)}}%</td>
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

    @include('modals.interest.update')
    @include('modals.interest.archive')
</div>
@endsection