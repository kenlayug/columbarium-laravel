@extends('v2.baseLayout')
@section('title', 'Service Purchase')
@section('body')

    <script type="text/javascript" src="{!! asset('/js/servicePurchases.js') !!}"></script>
    <link rel="stylesheet" href="{!! asset('/css/datepicker.css') !!}">
    <script type="text/javascript" src="{!! asset('/service-purchase/controller.js') !!}"></script>
<div ng-controller="ctrl.service-purchase">
    <div class = "col s12" >
        <div class = "row">
            <div class = "col s5" style="margin-top: 20px;">
                <div class = "col s12">
                    <div class = "aside aside z-depth-3" style="height: 500px; overflow: auto">
                        <div class="header" style="background-color: #00897b; margin-top: -15px;">
                            <center><h4 style = "font-size: 20px; font-family: myFirstFont; color: white; padding: 20px;">Service Purchases</h4></center>
                        </div>
                        
                        <div class="row" style="margin-top: -15px;">
                            <div class="input-field col s9">
                                <input name="cname"
                                       ng-model="newServicePurchase.strCustomerName"
                                       id="cname" type="text" required="" aria-required="true" class="validate" list="nameList">
                                <label for="cname" data-error="No Existing Customer Found!">Customer Name<span style = "color: red;">*</span></label>
                            </div>
                            <datalist id="nameList">
                                <option ng-repeat="customer in customerList" value="@{{ customer.strFullName }}">
                            </datalist>

                            <div class="col s3">

                                <a data-target="newCustomer"
                                   ng-show="newServicePurchase.strCustomerName == null"
                                   class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Add New Customer"
                                   href="#newCustomer" style="color: #000000; margin-top: 15px; margin-left: -15px;"><i class="material-icons">add</i><i class="material-icons">perm_identity</i></a>

                                <a data-target="newCustomer"
                                   ng-hide="newServicePurchase.strCustomerName == null"
                                   ng-click="updateCustomer(newServicePurchase.strCustomerName)"
                                   class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Update Customer Details"
                                   href="#newCustomer" style="color: #000000;width: 100px;"><i class="material-icons">mode_edit</i><i class="material-icons">perm_identity</i></a>

                            </div>
                        </div>
                        

                        <div class="col s8 offset-s2" style="margin-top: -25px;">
                            <ul class="tabs" style=" background-color: transparent">
                                <li class="tab col s2"><a class="orange-text" href="#purchaseDetails" style="font-family: myFirstFont">Step 1</a></li>
                                <label style="color: orange; margin-top: 3px;font-size: 25px; font-family: myFirstFont">></label>
                                <li class="tab col s2"><a class="orange-text" href="#paymentDetails" style="font-family: myFirstFont">Step 2</a></li>
                            </ul>
                        </div>

                        <div>
                            <!-- Purchase Details -->
                            <div id="purchaseDetails" class="col s12" style="margin-top: 30px;">
                                <div class="input-field col s12" style="margin-top: -30px;">
                                    <textarea id="textarea1" class="materialize-textarea"></textarea>
                                    <label for="textarea1">Remarks</label>
                                </div>
                                <div class="row">
                                    <center><label>Avail Options</label></center><br>
                                    <center><a class="waves-light btn light-green modal-trigger" style="color: #000000" data-target="packageList" href="#packageList">Package</a>
                                    <a class="waves-light btn light-green modal-trigger" style="color: #000000" data-target="serviceList" href="#serviceList">Service</a>
                                    <a class="waves-light btn light-green modal-trigger" style="color: #000000" data-target="additionalsList" href="#additionalsList">Additionals</a></center>
                                </div>
                                <div class="row" style="margin-top: 30px;">
                                    <input type="checkbox" id="future"/>
                                    <label for="future" style="font-family: Arial">For Future Use</label>
                                </div>
                                <i class = "left" style = "color: red; margin-top: 8px;margin-left : 15px;">*Required Fields</i>
                                <div class="right submit" style="margin-right: 15px; margin-top: 0px;">
                                    <button id="btnNext" class="waves-light btn light-green" href="paymentDetails" style="color: #000000; margin-top: 10px;">Next</button>
                                </div>
                            </div>

                            <div id="paymentDetails" class="col s12">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <select required>
                                            <option value="" disabled selected>Mode of Payment<span>*</span></option>
                                            <option value="cash">Cash</option>
                                            <option value="cheque">Cheque</option>
                                        </select>
                                    </div>
                                    <div class="input-field col s6">
                                        <select required>
                                            <option value="" disabled selected>Type of Payment<span>*</span></option>
                                            <option value="fullPayment">Full Payment</option>
                                            <option value="installment">Installment</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s6">
                                        <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <i>Total Amount:</i><br>
                                    </div>
                                    <div class="input-field col s3">
                                        <i>P54,000.00</i><br>
                                    </div>
                                    <div class="input-field col s6" style="margin-top: -2">
                                        <input id="amountPaid" type="text" required="" aria-required="true" class="validate" >
                                        <label for="amountPaid">Amount Paid:<span style = "color: red;">*</span></label>
                                    </div>
                                </div>
                                <i class = "left" style = "color: red; margin-top: 15px;margin-left : 15px;">*Required Fields</i>
                                
                                <div class="right submit" style="margin-right: 15px; margin-top: 40px;">
                                    <button class="waves-light btn light-green" style="color: #000000;">Submit</button>
                                </div>
                                <div class="right submit" style="margin-right: 15px; margin-top: 40px;">
                                    <button id="btnBack" class="waves-light btn light-green" href="purchaseDetails" style="color: #000000;">Back</button>
                                </div>
                            </div>
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
                                <i>@{{ newServicePurchase.dateNow | amDateFormat : "MMM D, YYYY" }}</i><br>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -13px;">
                            <div class="input-field col s3">
                                <i>Customer Name:</i><br>
                            </div>
                            <div class="input-field col s4" style="margin-left: -50px;">
                                <i>@{{ newServicePurchase.strCustomerName }}</i><br>
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
        <button data-target="successPackage" class="right waves-light btn blue modal-trigger" href="#successPackage" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Package</button>
        <button data-target="successService" class="right waves-light btn blue modal-trigger" href="#successService" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Service/s</button>
        <button data-target="successAdditionals" class="right waves-light btn blue modal-trigger" href="#successAdditionals" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Additionals</button>
    </div>

    <script>
        $(document).ready(function(){
            $('ul.tabs').tabs();
            $("#btnNext").click(function(){
            $('ul.tabs').tabs('select_tab', 'paymentDetails');
          });
        });
        $(document).ready(function(){
            $('ul.tabs').tabs();
            $("#btnBack").click(function(){
            $('ul.tabs').tabs('select_tab', 'purchaseDetails');
          });
        });        
    </script>
    <style type="text/css">
        .tabs .indicator {
        background-color: #00897b;
        }
    </style>
    @include('modals.collection-downpayment.cheque')
    @include('modals.manage-unit.newCustomer')
    @include('modals.service-purchases.requirements')
    @include('modals.service-purchases.scheduleService')
    @include('modals.service-purchases.packageList')
    @include('modals.service-purchases.serviceList')
    @include('modals.service-purchases.additionalsList')
    @include('modals.service-purchases.successPackage')
    @include('modals.service-purchases.successService')
    @include('modals.service-purchases.successAdditionals')

</div>
@endsection