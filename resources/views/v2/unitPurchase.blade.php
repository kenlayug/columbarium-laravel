@extends('v2.baseLayout')
@section('title', 'Unit Purchases')
@section('body')

    <link rel="stylesheet" href="{!! asset('/css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('/css/vaults.css') !!}">

    <div id="unitDetails" class="modal modal-fixed-footer" style="overflow-y: hidden; height: 300px">
        <div class="modal-header">
            <center><h4 style = "font-size: 20px;font-family: myFirstFont2; color: white;">Unit Details</h4></center>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s6">
                    <div class="row">
                        <div class="input-field col s3">
                            <label>Unit:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>Unit B3C5</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <label>Building:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>Building B</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <label>Floor:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>Floor 3</u></label>
                        </div>
                    </div>
                </div>
                <div class="col s6">
                    <div class="row">
                        <div class="input-field col s3">
                            <label>Room:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>Room C</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <label>Block:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>Block C</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <label>Unit Price:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>P 54,000.00</u></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Close</button>
        </div>
    </div>

    <div id="newCustomer" class="modal modal-fixed-footer" style="width:75% !important; max-height: 100% !important; overflow-y: hidden">
        <div class="modal-header1" style="background-color: #00897b;">
            <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Add New Customer</h4></center>
        </div>
        <form class="modal-content" style="overflow-y: auto;">
            <div class="row">
                <div class="input-field col s4">
                    <input id="FirstName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="FirstName">First Name<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s4">
                    <input id="MidName" type="text" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="MidName">Middle Name</label>
                </div>
                <div class="input-field col s4">
                    <input id="LastName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="LastName">Last Name<span style = "color: red;">*</span></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s8">
                    <input id="address" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="100" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,100}">
                    <label for="address">Address<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s4">
                    <input id="cNum" type="text" required="" aria-required="true" class="validate" pattern="\d{4}[\-, ., ]\d{3}[\-, ., ]\d{4}">
                    <label for="cNum" data-error="Format: XXXX-XXX-XXXX">Contact Number<span style = "color: red;">*</span></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s2">
                    <label for="dayB">Date of Birth:</label>
                </div>
                <div class="input-field col s4">
                    <input id="dayB" type="date" class="">
                </div>
                <div class="input-field col s2">
                    <label>Gender:</label>
                </div>
                <div class="input-field col s4">
                    <p>
                        <input name="group1" type="radio" id="gender1" checked="checked"/>
                        <label for="gender1">Male</label>
                        <input name="group1" type="radio" id="gender2" />
                        <label for="gender2">Female</label>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s3">
                    <label>Civil Status:</label>
                </div>
                <div class="input-field col s8">
                    <p>
                        <input name="group11" type="radio" id="test1" checked="checked"/>
                        <label for="test1">Single</label>
                        <input name="group11" type="radio" id="test2" />
                        <label for="test2">Married</label>
                        <input name="group11" type="radio" id="test3" />
                        <label for="test3">Widow/Widower</label>
                    </p>
                </div>
                <i class = "left" style = "color: red; margin-top: 10px;">*Required Fields</i>
            </div>
            <br><br>
        </form>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Confirm</button>
            <button name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</button>
        </div>
    </div>

    <!-- Buy, Reserve, At Need Form -->
    <div id="availUnit" class="modal modal-fixed-footer" style="width:75% !important; max-height: 100% !important; overflow-y: hidden">
        <div class="modal-header" style="background-color: #00897b;">
            <center><label style="font-size: large;">Bill Out Form</label></center>
        </div>
        <form class="modal-content" style="overflow-y: auto;">
            <div class="row">
                <div class="input-field col s6">
                    <input name="cname" id="cname" type="text" required="" aria-required="true" class="validate" list="nameList">
                    <label for="cname">Customer Name<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s2">
                    <a data-target="newCustomer" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Add New Customer"
                       href="#newCustomer" style="color: #000000;width: 100px;"><i class="material-icons">add</i><i class="material-icons">perm_identity</i></a>
                    <!--
                    <a data-target="updateCustomer" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Update Customer Details"
                       href="#updateCustomer" style="color: #000000;width: 100px;"><i class="material-icons">mode_edit</i><i class="material-icons">perm_identity</i></a>
                    -->
                </div>
                <div class="input-field col s3">
                    <select required = "required">
                        <option value="" disabled selected>Select Avail Type<span style = "color: red;">*</span></option>
                        <option value="buyU">Buy Unit</option>
                        <option value="reserveU">Reserve Unit</option>
                        <option value="atNeedU">At Need</option>
                    </select>
                </div>
            </div>
            <div class="row" style="margin-top: -20px; margin-bottom: 10px;">
                <div class="card material-table">
                    <table id="datatable" style="color: black; background-color: white; border: 2px solid white;">
                        <thead>
                        <tr>
                            <th>Unit Code</th>
                            <th>Unit Details</th>
                            <th>Years To Pay</th>
                            <th>Price</th>
                            <th>Monthly</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>C001</th>
                            <th><a data-target="unitDetails" class="waves-light btn light-green btn modal-trigger" href="#unitDetails" style="width: 100%; color: #000000">View</a></th>
                            <th>
                                <select required = "required">
                                    <option value="" disabled selected><span style = "color: red;">*</span></option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                </select>
                            </th>
                            <th>43,000</th>
                            <th>3,000</th>
                            <th><a class="waves-light btn light-green" style="width: 100%; color: #000000">REMOVE</a></th>
                        </tr>
                        <tr>
                            <th>C011</th>
                            <th><a data-target="unitDetails" class="waves-light btn light-green btn modal-trigger" href="#unitDetails" style="width: 100%; color: #000000">View</a></th>
                            <th>
                                <select required = "required">
                                    <option value="" disabled selected><span style = "color: red;">*</span></option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                </select>
                            </th>
                            <th>10,000</th>
                            <th>1,000</th>
                            <th><a class="waves-light btn light-green" style="width: 100%; color: #000000">REMOVE</a></th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <div class="row" style="margin-top: -10px;">
                        <div class="input-field col s6">
                            <label>Reservation Fee:</label>
                        </div>
                        <div class="input-field col s6">
                            <label>P 4,000.00</label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 25px;">
                        <div class="input-field col s6">
                            <label>No. of Unit/s:</label>
                        </div>
                        <div class="input-field col s6">
                            <label>3</label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 40px; border-top: 2px solid #ad9ea2">
                        <div class="input-field col s6">
                            <label>Total Amount:</label>
                        </div>
                        <div class="input-field col s6">
                            <label>P 12,000.00</label>
                        </div>
                    </div>
                </div>
                <div class="col s6" style="border-left: 3px solid #7b7073;">
                    <div class="row" style="margin-top: -10px;">
                        <div class="input-field col s6">
                            <label>Total Amount to Pay:</label>
                        </div>
                        <div class="input-field col s6">
                            <label><u>P 12,000.00</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 25px;">
                        <div class="input-field col s6">
                            <label>Amount Paid:</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="aPaid" type="number" required="" aria-required="true" class="validate" minlength = "1">
                            <label for="aPaid"><span style = "color: red;">*</span></label>
                        </div>
                    </div>
                    <div class="row">
                        <i class = "left" style = "color: red;">*Required Fields</i>
                    </div>
                </div>
            </div>
            <br>
        </form>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Confirm</button>
            <button name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</button>
        </div>
    </div>

    <!-- Main Form for Manage Service (Avail and Cancelation of transaction)-->
    <div id="modal1" class="modal modal-fixed-footer" style="width: 75% !important ; max-height: 100% !important; overflow: hidden;">
        <center>
            <div class="modal-header">
                <label style="font-size: large">UNIT DETAILS</label>
            </div>

            <div id='viewDetails' class="modal-content" style="color: #000000">
                <div class="row" style="margin-top: -20px;">
                    <div class="input-field col s5" style="margin-left: 100px;">
                        <div class="row">
                            <div class="input-field col s4">
                                <label><b>Status:</b></label>
                            </div>
                            <div class="input-field col s8">
                                <label><u>Partially Owned</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <label><b>Owner:</b></label>
                            </div>
                            <div class="input-field col s8">
                                <label><u>Alba, Andrei Pascual</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <label><b>Price:</b></label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>P55,000</u></label>
                            </div>
                        </div>
                    </div>
                    <div class="input-field col s5" style="margin-left: 50px;">
                        <div class="row">
                            <div class="input-field col s4">
                                <label><b>Building:</b></label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>Building B</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <label><b>Floor:</b></label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>Floor 3</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <label><b>Room:</b></label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>Room C</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <label><b>Block:</b></label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>Block C</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <label><b>Unit:</b></label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>Unit B3C5</u></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </center>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left: 10px; margin-right: 10px;" disabled><i class="material-icons">shopping_cart</i>Avail Unit</button>
            <button name = "action" class="waves-light btn red modal-close" style = "color: #000000;"><i class="material-icons">not_interested</i>Cancel Transaction</button>
        </div>
    </div>


    <!-- Section -->
    <div class = "col s12" >
        <div class = "row">
            <div class = "responsive">

                <div class = "col s4">
                    <h4 style = "margin-top: 20px; margin-left: 20px; font-family: myFirstFont2">BUY UNIT</h4>


                    <!-- Collapsible -->
                    <div style = "overflow: auto;height: 370px;">
                        <div class = "col s12">
                            <div class = "aside aside ">
                                <ul class="collapsible" data-collapsible="accordion" watch>
                                    <li>
                                        <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                            <label style = "font-family: myFirstFont; font-size: 1.5vw; color: white;">Columbary</label>
                                        </div>
                                        <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                            <p style = "padding-top: 15px;">BA-1-St. Peter-1
                                                <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();" style="margin-top: -10px;"><i class="material-icons" style="color: #000000">visibility</i></button>
                                            </p>
                                        </div>

                                    </li>
                                    <li>
                                        <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                            <label style = "font-family: myFirstFont; font-size: 1.5vw; color: white;">Full Body</label>
                                        </div>
                                        <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                            <p style = "padding-top: 15px;">BA-1-St. Peter-2
                                                <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();" style="margin-top: -10px;"><i class="material-icons" style="color: #000000;">visibility</i></button>
                                            </p>
                                        </div>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>

                    <!-- Legends -->
                    <div class = "row" style="margin-top: -80px;">
                        <div class = "col s12">
                            <div class = "aside aside z-depth-3" style = "height: 120px;">
                                <div class = "header" style = "height: 35px; background-color: #00897b">
                                    <label style = "padding-left: 10px;font-size: 23px; color: white; font-family: myFirstFont2;">Legend:</label>
                                </div>

                                <div class = "row" style = "margin-top: 10px;">
                                    <div class = "col s4">
                                        <button id = "configure" name = "action" class="btn-floating green" style = "margin-left: 30px;"></button>
                                        <label style="font-size: 15px; color: #000000; padding-left: 20px;">Available</label>
                                    </div>
                                    <div class = "col s4">
                                        <button id = "notConfigure" name = "action" class="btn-floating red" style = "margin-left: 30px;"></button>
                                        <label style="font-size: 15px; color: #000000; padding-left: 25px;">Owned</label>
                                    </div>
                                    <div class = "col s4">
                                        <button id = "configuredFloorPrice" name = "action" class="btn-floating blue" style = "margin-left: 30px;"></button>
                                        <label style="font-size: 15px; color: #000000; padding-left: 20px;">Reserved</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class = "col s8">
                    <div class = "col s4 z-depth-2 " style = "margin-top: 5px; width: 100%;">
                        <div id="tableStart">
                            <div class = "col s12">
                                <div class = "aside aside z-depth-3">
                                    <div class="center vaults-content">
                                        <h2 style = "font-size: 30px; margin-top: 20px; margin-left: 20px; font-family: myFirstFont2">Select a Block</h2>
                                        <table style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                            <tbody>
                                            <tr>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            </tr>
                                            <tr>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            </tr>
                                            <tr>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            </tr>
                                            <tr>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            </tr>
                                            <tr>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="responsive" id="tableUnit" style="display: none">
                            <div class = "col s12">
                                <div class = "aside aside z-depth-3">
                                    <div class="center vaults-content">
                                        <h2 style = "font-size: 30px; margin-top: 20px; margin-left: 20px; font-family: myFirstFont2">BLOCK ONE</h2>
                                        <table style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                            <tbody>
                                            <tr>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E1</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E2</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E3</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E4</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E5</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E6</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E7</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E8</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E9</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E10</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E11</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E12</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E13</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E14</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E15</a></td>
                                            </tr>
                                            <tr>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D1</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D2</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D3</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D4</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D5</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D6</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D7</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D8</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D9</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D10</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D11</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D12</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D13</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D14</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D15</a></td>
                                            </tr>
                                            <tr>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C1</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C2</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C3</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C4</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C5</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C6</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C7</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C8</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C9</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C10</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C11</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C12</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C13</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C14</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C15</a></td>
                                            </tr>
                                            <tr>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B1</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B2</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B3</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B4</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B5</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B6</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B7</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B8</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B9</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B10</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B11</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B12</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B13</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B14</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B15</a></td>
                                            </tr>
                                            <tr>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A1</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A2</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A3</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A4</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A5</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A6</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A7</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A8</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A9</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A10</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A11</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A12</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A13</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A14</a></td>
                                                <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A15</a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button data-target="availUnit" class="right waves-light btn blue modal-trigger" href="#availUnit" style = "color: black;margin-bottom: 10px; margin-right: 10px">Bill out</button>
                    </div>
                </div>
            </div>
        </div>

        <script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js'></script>
        <script src='http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js'></script>
        <script>
            (function(window, document, undefined) {

                var factory = function($, DataTable) {
                    "use strict";

                    $('.search-toggle').click(function() {
                        if ($('.hiddensearch').css('display') == 'none')
                            $('.hiddensearch').slideDown();
                        else
                            $('.hiddensearch').slideUp();
                    });

                    <!-- Scheduling Slide Add Time -->
                    $('.add-toggle').click(function() {
                        if ($('#addTime').css('display') == 'none')
                            $('#addTime').slideDown();
                        else
                            $('#addTime').slideUp();
                    });


                    /* Set the defaults for DataTables initialisation */
                    $.extend(true, DataTable.defaults, {
                        dom: "<'hiddensearch'f'>" +
                        "tr" +
                        "<'table-footer'lip'>",
                        renderer: 'material'
                    });

                    /* Default class modification */
                    $.extend(DataTable.ext.classes, {
                        sWrapper: "dataTables_wrapper",
                        sFilterInput: "form-control input-sm",
                        sLengthSelect: "form-control input-sm"
                    });

                    /* Bootstrap paging button renderer */
                    DataTable.ext.renderer.pageButton.material = function(settings, host, idx, buttons, page, pages) {
                        var api = new DataTable.Api(settings);
                        var classes = settings.oClasses;
                        var lang = settings.oLanguage.oPaginate;
                        var btnDisplay, btnClass, counter = 0;

                        var attach = function(container, buttons) {
                            var i, ien, node, button;
                            var clickHandler = function(e) {
                                e.preventDefault();
                                if (!$(e.currentTarget).hasClass('disabled')) {
                                    api.page(e.data.action).draw(false);
                                }
                            };

                            for (i = 0, ien = buttons.length; i < ien; i++) {
                                button = buttons[i];

                                if ($.isArray(button)) {
                                    attach(container, button);
                                } else {
                                    btnDisplay = '';
                                    btnClass = '';

                                    switch (button) {

                                        case 'first':
                                            btnDisplay = lang.sFirst;
                                            btnClass = button + (page > 0 ?
                                                            '' : ' disabled');
                                            break;

                                        case 'previous':
                                            btnDisplay = '<i class="material-icons">chevron_left</i>';
                                            btnClass = button + (page > 0 ?
                                                            '' : ' disabled');
                                            break;

                                        case 'next':
                                            btnDisplay = '<i class="material-icons">chevron_right</i>';
                                            btnClass = button + (page < pages - 1 ?
                                                            '' : ' disabled');
                                            break;

                                        case 'last':
                                            btnDisplay = lang.sLast;
                                            btnClass = button + (page < pages - 1 ?
                                                            '' : ' disabled');
                                            break;

                                    }

                                    if (btnDisplay) {
                                        node = $('<li>', {
                                            'class': classes.sPageButton + ' ' + btnClass,
                                            'id': idx === 0 && typeof button === 'string' ?
                                            settings.sTableId + '_' + button : null
                                        })
                                                .append($('<a>', {
                                                            'href': '#',
                                                            'aria-controls': settings.sTableId,
                                                            'data-dt-idx': counter,
                                                            'tabindex': settings.iTabIndex
                                                        })
                                                                .html(btnDisplay)
                                                )
                                                .appendTo(container);

                                        settings.oApi._fnBindAction(
                                                node, {
                                                    action: button
                                                }, clickHandler
                                        );

                                        counter++;
                                    }
                                }
                            }
                        };

                        // IE9 throws an 'unknown error' if document.activeElement is used
                        // inside an iframe or frame.
                        var activeEl;

                        try {
                            // Because this approach is destroying and recreating the paging
                            // elements, focus is lost on the select button which is bad for
                            // accessibility. So we want to restore focus once the draw has
                            // completed
                            activeEl = $(document.activeElement).data('dt-idx');
                        } catch (e) {}

                        attach(
                                $(host).empty().html('<ul class="material-pagination"/>').children('ul'),
                                buttons
                        );

                        if (activeEl) {
                            $(host).find('[data-dt-idx=' + activeEl + ']').focus();
                        }
                    };

                    /*
                     * TableTools Bootstrap compatibility
                     * Required TableTools 2.1+
                     */
                    if (DataTable.TableTools) {
                        // Set the classes that TableTools uses to something suitable for Bootstrap
                        $.extend(true, DataTable.TableTools.classes, {
                            "container": "DTTT btn-group",
                            "buttons": {
                                "normal": "btn btn-default",
                                "disabled": "disabled"
                            },
                            "collection": {
                                "container": "DTTT_dropdown dropdown-menu",
                                "buttons": {
                                    "normal": "",
                                    "disabled": "disabled"
                                }
                            },
                            "print": {
                                "info": "DTTT_print_info"
                            },
                            "select": {
                                "row": "active"
                            }
                        });

                        // Have the collection use a material compatible drop down
                        $.extend(true, DataTable.TableTools.DEFAULTS.oTags, {
                            "collection": {
                                "container": "ul",
                                "button": "li",
                                "liner": "a"
                            }
                        });
                    }

                }; // /factory

                // Define as an AMD module if possible
                if (typeof define === 'function' && define.amd) {
                    define(['jquery', 'datatables'], factory);
                } else if (typeof exports === 'object') {
                    // Node/CommonJS
                    factory(require('jquery'), require('datatables'));
                } else if (jQuery) {
                    // Otherwise simply initialise as normal, stopping multiple evaluation
                    factory(jQuery, jQuery.fn.dataTable);
                }

            })(window, document);

            $(document).ready(function() {
                $('#datatable').dataTable({
                    "iDisplayLength": 3,
                    "oLanguage": {
                        "sStripClasses": "",
                        "sSearch": "",
                        "sSearchPlaceholder": "Enter Keywords Here",
                        "sInfo": "_START_ -_END_ of _TOTAL_",
                        "sLengthMenu": '<span>Rows per page:</span><select class="browser-default">' +
                        '<option value="5">5</option>' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">All</option>' +
                        '</select></div>'
                    },
                    bAutoWidth: false
                });
            });
        </script>

        <!-- Show Hide Unit -->x
        <script>
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
        </script>
        <script>
            $(document).ready(function(){
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal();
            });


            $(document).ready(function() {
                $('select').material_select();
            });
        </script>
        <style>
            label b, u{
                font-size: 16px;
            }
        </style>
    </div>

@endsection