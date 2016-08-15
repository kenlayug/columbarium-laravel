@extends('v2.baseLayout')
@section('title', 'Reports')
@section('body')

    <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>

        <div class = "row">
            <div class = "col s12 m6 l11" style = "margin-top: 20px; margin-left: 65px;">
                <div class = "aside aside z-depth-3" style = "height: 150px;">
                    <div class = "createHeader" style = "background-color: #00897b; height: 55px;">
                        <h4 class = "center" style = "font-family: fontSketch; font-size: 2.3vw; color: white; padding-top: 10px;">Reports</h4>
                    </div>
                    <div class = "row">
                        <div  style = "padding-left: 20px; margin-top: 10px;">
                            <div class="input-field col s3">
                                <select id = "test" name = "form_select" onchange = "showDiv(this)" material-select>
                                    <option class = "serviceType" value="" disabled selected>List of Reports</option>
                                    <option value="0" class = "serviceType">Sales Report</option>
                                    <option value="1" class = "serviceType">Collection Report</option>
                                    <option value="2" class = "serviceType">Unit Report</option>
                                    <option value="3" class = "serviceType">Transaction Report</option>
                                    <option value="4" class = "serviceType">Customers Report</option>
                                    <option value="5" class = "serviceType">Safekeeping Report</option>
                                    <option value="7" class = "serviceType">Schedule Report</option>
                                    <option value="8" class = "serviceType">Additionals, Services, Packages Report</option>
                                </select>
                                <label>List of Reports</label>
                            </div>

                            <div class="input-field col s3" style = "padding-left: 20px; margin-top: 10px;">
                                <select>
                                    <option value="" disabled selected>Frequency</option>
                                    <option value="1">Daily</option>
                                    <option value="2">Weekly</option>
                                    <option value="3">Monthly</option>
                                    <option value="4">Yearly</option>
                                </select>
                                <label>Frequency</label>
                            </div>

                            <div class="dateOfBirth input-field col s3" style = "padding-left: 25px; margin-top: 10px;">
                                <i class="material-icons prefix">today</i>
                                <input id="dateOfBirth" type="date" required="" aria-required="true" class="datepicker tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
                                <label for="dateOfBirth">To<span style = "color: red;">*</span></label>
                            </div>
                            <div class="dateOfBirth input-field col s3" style = "padding-left: 25px; margin-top: 10px;">
                                <i class="material-icons prefix">today</i>
                                <input id="dateOfBirth" type="date" required="" aria-required="true" class="datepicker tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
                                <label for="dateOfBirth">From<span style = "color: red;">*</span></label>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


            <!-- Sales Report -->
            <div class = "col s12 m6 l12" id = "hiddenSalesReport" style = "display: none; margin-top: 30px;">
                <div class = "serviceDataGrid">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header" style = "background-color: #00897b; height: 55px;">
                                    <h4 class = "dataGridH4" style = "color: white; font-family: fontSketch; font-size: 2.3vw">Sales Report</h4>
                                    <div class="actions">
                                        <button name = "action" class="btn tooltipped modal-trigger light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Print Report" style = "color: black; width: 100px; margin-right: 10px;" href = "#modalArchiveService">PRINT</button>
                                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id="datatableSalesReport">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Customer Name</th>
                                        <th>Additional/ Service</th>
                                        <th>Quantity</th>
                                        <th>Total Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="service in serviceList">
                                        <td>@{{ service.strServiceName }}</td>
                                        <td>@{{ service.price.deciPrice | currency: "₱"}}</td>
                                        <td>@{{ service.strServiceDesc }}</td>
                                        <td><button ng-click="viewRequirements(service.intServiceId)" name = "action" class="btn tooltipped modal-trigger btn light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "View Requirement/s" style = "color: black; font-size: 10px; width: 100px; margin-right: 10px;" href = "#modalListOfRequirement">View</button></td>
                                        <td><button ng-click="getService(service.intServiceId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                            <button ng-click="deleteService(service.intServiceId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Collection Report -->
            <div class = "col s12 m6 l12" id = "hiddenCollectionReport" style = "display: none; margin-top: 30px;">
                <div class = "serviceDataGrid">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header" style = "background-color: #00897b; height: 55px;">
                                    <h4 class = "dataGridH4" style = "color: white; font-family: fontSketch; font-size: 2.3vw">Collection Report</h4>
                                    <div class="actions">
                                        <button name = "action" class="btn tooltipped modal-trigger light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Print Report" style = "color: black; margin-right: 10px;" href = "#modalArchiveService">PRINT</button>
                                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id="datatableCollectionReport">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Customer Name</th>
                                        <th>Unit Type</th>
                                        <th>Unit Code</th>
                                        <th>Unit Price</th>
                                        <th>Mode of Payment</th>
                                        <th>Monthly Amortization</th>
                                        <th>Penalty</th>
                                        <th>Amount Paid</th>
                                        <th>Balance</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="service in serviceList">
                                        <td>@{{ service.strServiceName }}</td>
                                        <td>@{{ service.price.deciPrice | currency: "₱"}}</td>
                                        <td>@{{ service.strServiceDesc }}</td>
                                        <td><button ng-click="viewRequirements(service.intServiceId)" name = "action" class="btn tooltipped modal-trigger btn light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "View Requirement/s" style = "color: black; font-size: 10px; width: 100px; margin-right: 10px;" href = "#modalListOfRequirement">View</button></td>
                                        <td><button ng-click="getService(service.intServiceId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                            <button ng-click="deleteService(service.intServiceId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Unit Report -->
            <div class = "col s12 m6 l12" id = "hiddenUnitReport" style = "display: none; margin-top: 30px;">
                <div class = "serviceDataGrid">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header" style = "background-color: #00897b; height: 55px;">
                                    <h4 class = "dataGridH4" style = "color: white; font-family: fontSketch; font-size: 2.3vw">Unit Report</h4>
                                    <div class="actions">
                                        <button name = "action" class="btn tooltipped modal-trigger light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Print Report" style = "color: black; margin-right: 10px;" href = "#modalArchiveService">PRINT</button>
                                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id="datatableUnitReport">
                                    <thead>
                                    <tr>
                                        <th>Unit Code</th>
                                        <th>Unit Type</th>
                                        <th>Storage Type</th>
                                        <th>Status</th>
                                        <th>Unit Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="service in serviceList">
                                        <td>@{{ service.strServiceName }}</td>
                                        <td>@{{ service.price.deciPrice | currency: "₱"}}</td>
                                        <td>@{{ service.strServiceDesc }}</td>
                                        <td><button ng-click="viewRequirements(service.intServiceId)" name = "action" class="btn tooltipped modal-trigger btn light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "View Requirement/s" style = "color: black; font-size: 10px; width: 100px; margin-right: 10px;" href = "#modalListOfRequirement">View</button></td>
                                        <td><button ng-click="getService(service.intServiceId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                            <button ng-click="deleteService(service.intServiceId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Transaction Report -->
            <div class = "col s12 m6 l12" id = "hiddenTransactionReport" style = "display: none; margin-top: 30px;">
                <div class = "serviceDataGrid">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header" style = "background-color: #00897b; height: 55px;">
                                    <h4 class = "dataGridH4" style = "color: white; font-family: fontSketch; font-size: 2.3vw">Transaction Report</h4>
                                    <div class="actions">
                                        <button name = "action" class="btn tooltipped modal-trigger light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Print Report" style = "color: black; margin-right: 10px;" href = "#modalArchiveService">PRINT</button>
                                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id="datatableTransactionReport">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Transaction Code</th>
                                        <th>Employee Name</th>
                                        <th>Customer Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="service in serviceList">
                                        <td>@{{ service.strServiceName }}</td>
                                        <td>@{{ service.price.deciPrice | currency: "₱"}}</td>
                                        <td>@{{ service.strServiceDesc }}</td>
                                        <td><button ng-click="viewRequirements(service.intServiceId)" name = "action" class="btn tooltipped modal-trigger btn light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "View Requirement/s" style = "color: black; font-size: 10px; width: 100px; margin-right: 10px;" href = "#modalListOfRequirement">View</button></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Customer Report -->
            <div class = "col s12 m6 l12" id = "hiddenCustomerReport" style = "display: none; margin-top: 30px;">
                <div class = "serviceDataGrid">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header" style = "background-color: #00897b; height: 55px;">
                                    <h4 class = "dataGridH4" style = "color: white; font-family: fontSketch; font-size: 2.3vw">Customer Report</h4>
                                    <div class="actions">
                                        <button name = "action" class="btn tooltipped modal-trigger light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Print Report" style = "color: black; margin-right: 10px;" href = "#modalArchiveService">PRINT</button>
                                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id="datatableCustomerReport">
                                    <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Position</th>
                                        <th>Address</th>
                                        <th>Birthday</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="service in serviceList">
                                        <td>@{{ service.strServiceName }}</td>
                                        <td>@{{ service.price.deciPrice | currency: "₱"}}</td>
                                        <td>@{{ service.strServiceDesc }}</td>
                                        <td><button ng-click="viewRequirements(service.intServiceId)" name = "action" class="btn tooltipped modal-trigger btn light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "View Requirement/s" style = "color: black; font-size: 10px; width: 100px; margin-right: 10px;" href = "#modalListOfRequirement">View</button></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Safekeeping Report -->
            <div class = "col s12 m6 l12" id = "hiddenSafekeepingReport" style = "display: none; margin-top: 30px;">
                <div class = "serviceDataGrid">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header" style = "background-color: #00897b; height: 55px;">
                                    <h4 class = "dataGridH4" style = "color: white; font-family: fontSketch; font-size: 2.3vw">Safekeeping Report</h4>
                                    <div class="actions">
                                        <button name = "action" class="btn tooltipped modal-trigger light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Print Report" style = "color: black; margin-right: 10px;" href = "#modalArchiveService">PRINT</button>
                                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id="datatableSafekeepingReport">
                                    <thead>
                                    <tr>
                                        <th>Date of Transfer</th>
                                        <th>Customer Name</th>
                                        <th>Address</th>
                                        <th>Contact Number</th>
                                        <th>Storage Type</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="service in serviceList">
                                        <td>@{{ service.strServiceName }}</td>
                                        <td>@{{ service.price.deciPrice | currency: "₱"}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Penalties Report -->
            <div class = "col s12 m6 l12" id = "hiddenPenaltiesReport" style = "display: none; margin-top: 30px;">
                <div class = "serviceDataGrid">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header" style = "background-color: #00897b; height: 55px;">
                                    <h4 class = "dataGridH4" style = "color: white; font-family: fontSketch; font-size: 2.3vw">Penalties Report</h4>
                                    <div class="actions">
                                        <button name = "action" class="btn tooltipped modal-trigger light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Print Report" style = "color: black; margin-right: 10px;" href = "#modalArchiveService">PRINT</button>
                                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id="datatablePenaltiesReport">
                                    <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Penalty Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="service in serviceList">
                                        <td>@{{ service.strServiceName }}</td>
                                        <td>@{{ service.price.deciPrice | currency: "₱"}}</td>
                                        <td>@{{ service.strServiceDesc }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Schedule Report -->
            <div class = "col s12 m6 l12" id = "hiddenScheduleReport" style = "display: none; margin-top: 30px;">
                <div class = "serviceDataGrid">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header" style = "background-color: #00897b; height: 55px;">
                                    <h4 class = "dataGridH4" style = "color: white; font-family: fontSketch; font-size: 2.3vw">Schedule Report</h4>
                                    <div class="actions">
                                        <button name = "action" class="btn tooltipped modal-trigger light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Print Report" style = "color: black; margin-right: 10px;" href = "#modalArchiveService">PRINT</button>
                                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id="datatableScheduleReport">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Customer Name</th>
                                        <th>Service</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="service in serviceList">
                                        <td>@{{ service.strServiceName }}</td>
                                        <td>@{{ service.price.deciPrice | currency: "₱"}}</td>
                                        <td>@{{ service.strServiceDesc }}</td>
                                        <td><button ng-click="viewRequirements(service.intServiceId)" name = "action" class="btn tooltipped modal-trigger btn light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "View Requirement/s" style = "color: black; font-size: 10px; width: 100px; margin-right: 10px;" href = "#modalListOfRequirement">View</button></td>
                                        <td><button ng-click="getService(service.intServiceId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                            <button ng-click="deleteService(service.intServiceId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additionals, Services, and Packages Report -->
            <div class = "col s12 m6 l12" id = "hiddenServicesReport" style = "display: none; margin-top: 30px;">
                <div class = "serviceDataGrid">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header" style = "background-color: #00897b; height: 55px;">
                                    <h4 class = "dataGridH4" style = "color: white; font-family: fontSketch; font-size: 2.3vw">Additionals, Services, and Packages Report</h4>
                                    <div class="actions">
                                        <button name = "action" class="btn tooltipped modal-trigger light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Print Report" style = "color: black; margin-right: 10px;" href = "#modalArchiveService">PRINT</button>
                                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id="datatableServicesReport">
                                    <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Additionals Purchased</th>
                                        <th>Services Purchased</th>
                                        <th>Packages Purchased</th>
                                        <th>Total Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="service in serviceList">
                                        <td>@{{ service.strServiceName }}</td>
                                        <td>@{{ service.price.deciPrice | currency: "₱"}}</td>
                                        <td>@{{ service.strServiceDesc }}</td>
                                        <td><button ng-click="viewRequirements(service.intServiceId)" name = "action" class="btn tooltipped modal-trigger btn light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "View Requirement/s" style = "color: black; font-size: 10px; width: 100px; margin-right: 10px;" href = "#modalListOfRequirement">View</button></td>
                                        <td><button ng-click="getService(service.intServiceId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                            <button ng-click="deleteService(service.intServiceId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
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
            function showDiv(elem){

                //Sales Report
                if(elem.value == 0)
                    document.getElementById('hiddenSalesReport').style.display = "block";
                if(elem.value == 0)
                    document.getElementById('hiddenCollectionReport').style.display = "none";
                if(elem.value == 0)
                    document.getElementById('hiddenUnitReport').style.display = "none";
                if(elem.value == 0)
                    document.getElementById('hiddenTransactionReport').style.display = "none";
                if(elem.value == 0)
                    document.getElementById('hiddenCustomerReport').style.display = "none";
                if(elem.value == 0)
                    document.getElementById('hiddenSafekeepingReport').style.display = "none";
                if(elem.value == 0)
                    document.getElementById('hiddenPenaltiesReport').style.display = "none";
                if(elem.value == 0)
                    document.getElementById('hiddenScheduleReport').style.display = "none";
                if(elem.value == 0)
                    document.getElementById('hiddenServicesReport').style.display = "none";


                //Collection Report
                if(elem.value == 1)
                    document.getElementById('hiddenCollectionReport').style.display = "block";
                if(elem.value == 1)
                    document.getElementById('hiddenSalesReport').style.display = "none";
                if(elem.value == 1)
                    document.getElementById('hiddenUnitReport').style.display = "none";
                if(elem.value == 1)
                    document.getElementById('hiddenTransactionReport').style.display = "none";
                if(elem.value == 1)
                    document.getElementById('hiddenCustomerReport').style.display = "none";
                if(elem.value == 1)
                    document.getElementById('hiddenSafekeepingReport').style.display = "none";
                if(elem.value == 1)
                    document.getElementById('hiddenPenaltiesReport').style.display = "none";
                if(elem.value == 1)
                    document.getElementById('hiddenScheduleReport').style.display = "none";
                if(elem.value == 1)
                    document.getElementById('hiddenServicesReport').style.display = "none";


                //Unit Report
                if(elem.value == 2)
                    document.getElementById('hiddenCollectionReport').style.display = "none";
                if(elem.value == 2)
                    document.getElementById('hiddenSalesReport').style.display = "none";
                if(elem.value == 2)
                    document.getElementById('hiddenUnitReport').style.display = "block";
                if(elem.value == 2)
                    document.getElementById('hiddenTransactionReport').style.display = "none";
                if(elem.value == 2)
                    document.getElementById('hiddenCustomerReport').style.display = "none";
                if(elem.value == 2)
                    document.getElementById('hiddenSafekeepingReport').style.display = "none";
                if(elem.value == 2)
                    document.getElementById('hiddenPenaltiesReport').style.display = "none";
                if(elem.value == 2)
                    document.getElementById('hiddenScheduleReport').style.display = "none";
                if(elem.value == 2)
                    document.getElementById('hiddenServicesReport').style.display = "none";


                //Transaction Report
                if(elem.value == 3)
                    document.getElementById('hiddenCollectionReport').style.display = "none";
                if(elem.value == 3)
                    document.getElementById('hiddenSalesReport').style.display = "none";
                if(elem.value == 3)
                    document.getElementById('hiddenUnitReport').style.display = "none";
                if(elem.value == 3)
                    document.getElementById('hiddenTransactionReport').style.display = "block";
                if(elem.value == 3)
                    document.getElementById('hiddenCustomerReport').style.display = "none";
                if(elem.value == 3)
                    document.getElementById('hiddenSafekeepingReport').style.display = "none";
                if(elem.value == 3)
                    document.getElementById('hiddenPenaltiesReport').style.display = "none";
                if(elem.value == 3)
                    document.getElementById('hiddenScheduleReport').style.display = "none";
                if(elem.value == 3)
                    document.getElementById('hiddenServicesReport').style.display = "none";



                //Customer Report
                if(elem.value == 4)
                    document.getElementById('hiddenCollectionReport').style.display = "none";
                if(elem.value == 4)
                    document.getElementById('hiddenSalesReport').style.display = "none";
                if(elem.value == 4)
                    document.getElementById('hiddenUnitReport').style.display = "none";
                if(elem.value == 4)
                    document.getElementById('hiddenTransactionReport').style.display = "none";
                if(elem.value == 4)
                    document.getElementById('hiddenCustomerReport').style.display = "block";
                if(elem.value == 4)
                    document.getElementById('hiddenSafekeepingReport').style.display = "none";
                if(elem.value == 4)
                    document.getElementById('hiddenPenaltiesReport').style.display = "none";
                if(elem.value == 4)
                    document.getElementById('hiddenScheduleReport').style.display = "none";
                if(elem.value == 4)
                    document.getElementById('hiddenServicesReport').style.display = "none";


                //Safekeeping Report
                if(elem.value == 5)
                    document.getElementById('hiddenCollectionReport').style.display = "none";
                if(elem.value == 5)
                    document.getElementById('hiddenSalesReport').style.display = "none";
                if(elem.value == 5)
                    document.getElementById('hiddenUnitReport').style.display = "none";
                if(elem.value == 5)
                    document.getElementById('hiddenTransactionReport').style.display = "none";
                if(elem.value == 5)
                    document.getElementById('hiddenCustomerReport').style.display = "none";
                if(elem.value == 5)
                    document.getElementById('hiddenSafekeepingReport').style.display = "block";
                if(elem.value == 5)
                    document.getElementById('hiddenPenaltiesReport').style.display = "none";
                if(elem.value == 5)
                    document.getElementById('hiddenScheduleReport').style.display = "none";
                if(elem.value == 5)
                    document.getElementById('hiddenServicesReport').style.display = "none";



                //Penalties Report
                if(elem.value == 6)
                    document.getElementById('hiddenCollectionReport').style.display = "none";
                if(elem.value == 6)
                    document.getElementById('hiddenSalesReport').style.display = "none";
                if(elem.value == 6)
                    document.getElementById('hiddenUnitReport').style.display = "none";
                if(elem.value == 6)
                    document.getElementById('hiddenTransactionReport').style.display = "none";
                if(elem.value == 6)
                    document.getElementById('hiddenCustomerReport').style.display = "none";
                if(elem.value == 6)
                    document.getElementById('hiddenSafekeepingReport').style.display = "none";
                if(elem.value == 6)
                    document.getElementById('hiddenPenaltiesReport').style.display = "block";
                if(elem.value == 6)
                    document.getElementById('hiddenScheduleReport').style.display = "none";
                if(elem.value == 6)
                    document.getElementById('hiddenServicesReport').style.display = "none";



                //Schedule Report
                if(elem.value == 7)
                    document.getElementById('hiddenCollectionReport').style.display = "none";
                if(elem.value == 7)
                    document.getElementById('hiddenSalesReport').style.display = "none";
                if(elem.value == 7)
                    document.getElementById('hiddenUnitReport').style.display = "none";
                if(elem.value == 7)
                    document.getElementById('hiddenTransactionReport').style.display = "none";
                if(elem.value == 7)
                    document.getElementById('hiddenCustomerReport').style.display = "none";
                if(elem.value == 7)
                    document.getElementById('hiddenSafekeepingReport').style.display = "none";
                if(elem.value == 7)
                    document.getElementById('hiddenPenaltiesReport').style.display = "none";
                if(elem.value == 7)
                    document.getElementById('hiddenScheduleReport').style.display = "block";
                if(elem.value == 7)
                    document.getElementById('hiddenServicesReport').style.display = "none";


                //Services Report
                if(elem.value == 8)
                    document.getElementById('hiddenCollectionReport').style.display = "none";
                if(elem.value == 8)
                    document.getElementById('hiddenSalesReport').style.display = "none";
                if(elem.value == 8)
                    document.getElementById('hiddenUnitReport').style.display = "none";
                if(elem.value == 8)
                    document.getElementById('hiddenTransactionReport').style.display = "none";
                if(elem.value == 8)
                    document.getElementById('hiddenCustomerReport').style.display = "none";
                if(elem.value == 8)
                    document.getElementById('hiddenSafekeepingReport').style.display = "none";
                if(elem.value == 8)
                    document.getElementById('hiddenPenaltiesReport').style.display = "none";
                if(elem.value == 8)
                    document.getElementById('hiddenScheduleReport').style.display = "none";
                if(elem.value == 8)
                    document.getElementById('hiddenServicesReport').style.display = "block";
            }
        </script>

        <script>
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
        </script>

@endsection