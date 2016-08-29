@extends('v2.baseLayout')
@section('title', 'Interest Maintenance')
@section('body')

	<!-- Import CSS/JS -->
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <link rel = "stylesheet" href = "{!! asset('/css/interestMaintenance.css') !!}"/>
    <script type="text/javascript" src="{!! asset('/interest/controller.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>


<div ng-controller="ctrl.interest">
    <div class = "container">
        <div class = "row">

            <!-- Create Interest -->
            <div class = "col s12 m6 l4">
                <form class = "createForm aside aside z-depth-3" id="formCreate" ng-submit="saveInterest()" autocomplete="off">
                    <div class = "createHeader">
                        <h4 class = "center flow-text">Interest Maintenance</h4>
                    </div>
                    <div class = "numberOfYears row">
                        <div>
                            <div class="numberOfYears input-field col s6 m12 l6">
                                <input ng-model="interest.intNoOfYear" id="numberOfYears" type="number" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts whole numbers only. Max input: 10<br>*Example: 5" name="item.strNumberOfYears" required = "" aria-required="true" min = "1" max="10">
                                <label id="createNoOfYear" for="numberOfYears" data-error = "Invalid format." data-success = "">Number of Years<span style = "color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="interestRate input-field col s6 m12 l6">
                            <input ng-model="interest.deciInterestRate"
                                   ui-percentage-mask
                                   id="interestRate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts numbers only.<br>*Example: 25" name="item.dblPrice" required = "" max="100" aria-required = "true">
                            <label id="createRate" for="interestRate" data-error = "Invalid Format." data-success = "">Rate<span style = "color: red;">*</span></label>
                        </div>

                    </div>
                    <!-- Checkbox if at need -->
                    <div class = "checkbox" id = "checkbox" action="#">
                        <p>
                            <input ng-model="interest.intAtNeed" type="checkbox" class="filled-in" id="yes filled-in-box" value="1"/>
                            <label for="yes filled-in-box">At Need?</label>
                        </p>
                    </div>
                    <br>
                    <i class = "createRequiredField left">*Required Fields</i>
                    <br><br>
                    <button type = "submit" name = "action" class="btn light-green right" style = "margin-bottom: 10px; color: black; margin-right: 10px;">Create</button>
                </form>
            </div>


                <!-- Data Grid -->
                <div class = "dataGrid col s12 m6 l8">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header">
                                    <h3 class='flow-text'>Interest Record</h3>
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
                                    <tr ng-repeat="interest in interestList">
                                        <td ng-if="interest.intAtNeed">@{{ interest.intNoOfYear }}<span ng-if="interest.intAtNeed == 1">(At Need)</span></td>
                                        <td ng-if="!interest.intAtNeed">@{{ interest.intNoOfYear }}</td>
                                        <td>@{{ ((interest.interestRate.deciInterestRate)*100).toFixed(2)}}%</td>
                                        <td><button ng-click="getInterest(interest, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                            <button ng-click="deleteInterest(interest, $index)" name = "action" class="modal-trigger btn-floating light-green" href = "#modalDeactivateInterest"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
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

    @include('modals.interest.v2.archive')
    @include('modals.interest.v2.update')
</div>

@endsection