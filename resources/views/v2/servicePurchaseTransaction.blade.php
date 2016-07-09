@extends('v2.baseLayout')
@section('title', 'Service Purchase')
@section('body')

    <script type="text/javascript" src="{!! asset('/js/servicePurchases.js') !!}"></script>

    <div class = "col s12" >
        <div class = "row">
            <div class = "col s5" style="margin-top: 20px;">
                <div class = "col s12">
                    <div class = "aside aside z-depth-3" style="height: 500px; overflow: auto">
                        <div class="header" style="background-color: #00897b; margin-top: -15px;">
                            <center><h4 style = "font-size: 20px; font-family: myFirstFont; color: white; padding: 20px;">Service Purchases</h4></center>
                        </div>
                        <div class="row" style="margin-top: -15px;">
                            <div class="input-field col s8">
                                <input name="cname" id="cname" type="text" required="" aria-required="true" class="validate" list="nameList">
                                <label for="cname" data-error="No Existing Customer Found!">Customer Name<span style = "color: red;">*</span></label>
                            </div>
                            <datalist id="nameList">
                                <option value="Monkey D. Luffy">
                                <option value="Roronoa Zoro">
                                <option value="Vinsmoke Sanji">
                                <option value="Tony Tony Chopper">
                                <option value="Nico Robin">
                            </datalist>

                            <div class="col s3">
                                <a data-target="newCustomer" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Add New Customer"
                                   href="#newCustomer" style="color: #000000; margin-top: 15px; margin-left: -15px;"><i class="material-icons">add</i><i class="material-icons">perm_identity</i></a>
                                <!--
                                <a data-target="updateCustomer" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Update Customer Details"
                                href="#updateCustomer" style="color: #000000;width: 100px;"><i class="material-icons">mode_edit</i><i class="material-icons">perm_identity</i></a>
                                -->

                            </div>
                        </div>
                        <div class="row" style="margin-top: -30px">
                            <div class="input-field col s6">
                                <select>
                                    <option value="" disabled selected>Service/Package/Addtionals</option>
                                    <option value="1">Additionals</option>
                                    <option value="2">Service</option>
                                    <option value="3">Package</option>
                                </select>
                                <label>Avail Options</label>
                            </div>
                            <div class="input-field col s6">
                                <select multiple>
                                    <option value="" disabled selected>Select At Least One</option>
                                    <option value="1">Cremation</option>
                                    <option value="2">Interment</option>
                                    <option value="3">Exhumation</option>
                                </select>
                                <label>Select Package/Service</label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -55px;">
                            <div class="input-field col s12">
                                <textarea id="textarea1" class="materialize-textarea"></textarea>
                                <label for="textarea1">Remarks</label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -30px; margin-left: 10px;">
                            <input type="checkbox" id="future"/>
                            <label for="future" style="font-family: Arial">For Future Use</label>
                        </div>
                        <div class="row" style="margin-top: -25px;">
                            <div class="input-field col s3">
                                <i>Total Amount:</i><br>
                            </div>
                            <div class="input-field col s4">
                                <i>P54,000.00</i><br>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -15px;">
                            <div class="input-field col s3">
                                <label for="amountPaid">Amount Paid:</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="amountPaid" type="text" required="" aria-required="true" class="validate" >
                            </div>
                        </div>
                        <div class="right submit" style="margin-right: 15px; margin-top: -50px;">
                            <button name = "action" class="waves-light btn light-green" style="color: #000000; margin-top: 0px;">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class = "col s7" style="margin-top: 20px;">
                <div class = "col s12">
                    <div class = "aside aside z-depth-3" style="height: 500px; overflow: hidden">
                        <div class="header" style="background-color: #00897b; margin-top:-15px;">
                            <center><h4 style = "font-size: 20px; font-family: myFirstFont; color: white; padding: 20px;">Purchase Details</h4></center>
                        </div>
                        <div class="row" style="margin-top: 0px;">
                            <a class="right waves-light btn light-green modal-trigger" style="color: #000000; margin-right: 15px;" data-target="requirements" href="#requirements">View Requirements</a>

                            <div class="input-field col s1">
                                <i>Date:</i><br>
                            </div>
                            <div class="input-field col s4">
                                <i>03/07/16</i><br>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -13px;">
                            <div class="input-field col s3">
                                <i>Customer Name:</i><br>
                            </div>
                            <div class="input-field col s4" style="margin-left: -50px;">
                                <i>Aaron Clyde Garil</i><br>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -13px;">
                            <div class="input-field col s3">
                                <i>Package Avail:</i><br>
                            </div>
                            <div class="input-field col s9" style="margin-left: -50px;">
                                <i>Cremation, Interment, Exhumation</i><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card material-table">
                                <table id="datatable" style="color: black; background-color: white; border: 2px solid white;">
                                    <thead>
                                    <tr>
                                        <th>Service Name</th>
                                        <th>Schedule</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Cremation</td>
                                        <td>07/03/16 12:00 pm</td>
                                        <td><a class="waves-light btn light-green modal-trigger" style="width: 70%; color: #000000" data-target="scheduleService" href="#scheduleService">Schedule</a></td>
                                    </tr>
                                    <tr>
                                        <td>Interment</td>
                                        <td>N/a</td>
                                        <td><a class="waves-light btn light-green modal-trigger" style="width: 70%; color: #000000" data-target="scheduleService" href="#scheduleService">Schedule</a></td>
                                    </tr>
                                    </tr>
                                        <td>Exhumation</td>
                                        <td>N/a</td>
                                        <td><a class="waves-light btn light-green modal-trigger" style="width: 70%; color: #000000" data-target="scheduleService" href="#scheduleService">Schedule</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modals.manage-unit.newCustomer')
    @include('modals.service-purchases.requirements')
    @include('modals.service-purchases.scheduleService')
</div>






@endsection